<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaian = Penilaian::latest('tanggal')->paginate(10);
        return view('penilaian.index', compact('penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tingkatan = $request->query('tingkatan');
        $soal = collect();
        
        if ($tingkatan) {
            // Ambil SEMUA soal untuk tingkatan ini, urutkan berdasarkan kategori
            $soal = \App\Models\Soal::where('tingkatan', $tingkatan)
                ->orderBy('kategori')
                ->get();
        }
        
        return view('penilaian.create', compact('tingkatan', 'soal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tingkatan' => 'required|in:Putih,Kuning,Merah,Biru,Coklat,Hitam',
            'nilai' => 'required|array', // Array score per soal: [soal_id => score]
            'nilai.*' => 'numeric|min:0|max:100',
            'huruf' => 'nullable|array', // Array huruf per soal: [soal_id => text]
            'huruf.*' => 'nullable|string|max:255',
        ]);

        $tingkatan = $request->tingkatan;
        $nilaiInput = $request->nilai;
        $hurufInput = $request->huruf ?? [];
        
        // Defines categories and their DB fields
        $categories = [
            'SALAM PAGAR NUSA' => 'nilai_salam',
            'TEKNIK DASAR PUKULAN' => 'nilai_pukulan',
            'TEKNIK DASAR TANGKISAN' => 'nilai_tangkisan',
            'TEKNIK DASAR TENDANGAN' => 'nilai_tendangan',
            'TEKNIK DASAR PAGAR NUSA' => 'nilai_teknik_pn',
            'FISIK' => 'nilai_fisik',
            'TEKNIK SERANG BALAS' => 'nilai_serang_balas',
            'JURUS WAJIB IPSI' => 'nilai_jurus',
        ];

        $categoryScores = [];
        $detailNilai = [];

        // Calculate average per category based on submitted question scores
        foreach ($categories as $catName => $dbField) {
            // Get all questions identifiers for this category in this tingkatan
            $catSoalIds = \App\Models\Soal::where('tingkatan', $tingkatan)
                ->where('kategori', $catName)
                ->pluck('id')
                ->toArray();
            
            $totalScore = 0;
            $count = 0;

            foreach ($catSoalIds as $id) {
                // Check if score exists for this question
                if (isset($nilaiInput[$id])) {
                    $score = (float) $nilaiInput[$id];
                    $totalScore += $score;
                    $count++;
                    
                    // Store detailed score
                    if (!isset($detailNilai[$catName])) {
                        $detailNilai[$catName] = [];
                    }
                    $detailNilai[$catName][] = [
                        'soal_id' => $id,
                        'nilai' => $score,
                        'huruf' => $hurufInput[$id] ?? ''
                    ];
                }
            }

            // Calculate average for this category
            $avg = $count > 0 ? $totalScore / $count : 0;
            $categoryScores[$dbField] = $avg;
        }

        // Calculate Grand Average
        $grandTotal = array_sum($categoryScores);
        $rataRata = count($categoryScores) > 0 ? $grandTotal / count($categoryScores) : 0;

        $penilaian = Penilaian::create([
            'name' => $request->name,
            'tingkatan' => $tingkatan,
            'nilai_salam' => $categoryScores['nilai_salam'],
            'nilai_pukulan' => $categoryScores['nilai_pukulan'],
            'nilai_tangkisan' => $categoryScores['nilai_tangkisan'],
            'nilai_tendangan' => $categoryScores['nilai_tendangan'],
            'nilai_teknik_pn' => $categoryScores['nilai_teknik_pn'],
            'nilai_fisik' => $categoryScores['nilai_fisik'],
            'nilai_serang_balas' => $categoryScores['nilai_serang_balas'],
            'nilai_jurus' => $categoryScores['nilai_jurus'],
            'rata_rata' => $rataRata,
            'detail_nilai' => $detailNilai, // Stores JSON of detailed scores
            'petugas' => auth()->user()->name,
            'tanggal' => now(),
        ]);

        return redirect()->route('penilaian.show', $penilaian)->with('success', 'Penilaian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilaian $penilaian)
    {
        return view('penilaian.show', compact('penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Penilaian tidak bisa diedit untuk menjaga integritas data
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Data penilaian berhasil dihapus');
    }

    public function export_excel(Penilaian $penilaian)
    {
        $fileName = 'Nilai_UKT_' . str_replace(' ', '_', $penilaian->name) . '_' . $penilaian->tingkatan . '.csv';
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Helper number to words
        $numberToWords = function($num) {
            if (!$num) return '-';
            $ones = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'];
            $tens = ['', '', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'];
            $parts = explode('.', strval($num));
            $intPart = intval($parts[0]);
            $result = '';
            
            if ($intPart >= 10 && $intPart < 20) {
                 $onesDigit = $intPart - 10;
                 $result = ($onesDigit === 0 ? 'Sepuluh' : ($onesDigit === 1 ? 'Sebelas' : $ones[$onesDigit] . ' Belas'));
            } else {
                 $tensDigit = floor($intPart / 10);
                 $onesDigit = $intPart % 10;
                 $result = ($tensDigit > 0 ? $tens[$tensDigit] . ' ' : '') . $ones[$onesDigit];
            }
            return trim($result);
        };

        $columns = ['No', 'Materi Ujian', 'Nilai Angka', 'Nilai Huruf'];
        
        $callback = function() use ($penilaian, $numberToWords, $columns) {
            $file = fopen('php://output', 'w');
            
            // Header Info
            fputcsv($file, ['NILAI MATERI UJIAN KENAIKAN TINGKAT']);
            fputcsv($file, ['PENCAK SILAT NU PAGAR NUSA']);
            fputcsv($file, ['PIMPINAN CABANG BANGIL']);
            fputcsv($file, []);
            fputcsv($file, ['Nama Peserta', ':', strtoupper($penilaian->name)]);
            fputcsv($file, ['UKT yang ditempuh', ':', 'STRIP ' . strtoupper($penilaian->tingkatan)]);
            fputcsv($file, []);
            
            // Table Header
            fputcsv($file, $columns);
            
            // Detail Nilai
            $detailNilai = is_array($penilaian->detail_nilai) ? $penilaian->detail_nilai : [];
            $categories = [
                'SALAM PAGAR NUSA', 'TEKNIK DASAR PUKULAN', 'TEKNIK DASAR TANGKISAN', 
                'TEKNIK DASAR TENDANGAN', 'TEKNIK DASAR PAGAR NUSA', 'FISIK', 
                'TEKNIK SERANG BALAS', 'JURUS WAJIB IPSI'
            ];
            $letters = range('A', 'Z');
            $catIndex = 0;

            foreach ($categories as $category) {
                if (isset($detailNilai[$category]) && count($detailNilai[$category]) > 0) {
                    // Category Header
                    fputcsv($file, [$letters[$catIndex] . '.', $category, '', '']);
                    
                    foreach ($detailNilai[$category] as $index => $item) {
                        $soalId = is_array($item) ? ($item['soal_id'] ?? null) : null;
                        $nilai = is_array($item) ? ($item['nilai'] ?? 0) : 0;
                        $huruf = is_array($item) ? ($item['huruf'] ?? null) : null;
                        
                        if (!$huruf) {
                            $huruf = $numberToWords($nilai);
                        }
                        
                        $soal = $soalId ? \App\Models\Soal::find($soalId) : null;
                        $soalText = $soal ? $soal->soal : 'Soal tidak ditemukan';
                        
                        fputcsv($file, [$index + 1, $soalText, $nilai, $huruf]);
                    }
                    
                    fputcsv($file, []); // Spacer
                    $catIndex++;
                }
            }
            
            fputcsv($file, []);
            
            // Summary
            $totalNilai = $penilaian->nilai_salam + $penilaian->nilai_pukulan + $penilaian->nilai_tangkisan + 
                          $penilaian->nilai_tendangan + $penilaian->nilai_teknik_pn + $penilaian->nilai_fisik + 
                          $penilaian->nilai_serang_balas + $penilaian->nilai_jurus;
            
            fputcsv($file, ['', 'TOTAL NILAI', number_format($totalNilai, 1), $numberToWords($totalNilai)]);
            fputcsv($file, ['', 'RATA-RATA NILAI', number_format($penilaian->rata_rata, 2), $numberToWords($penilaian->rata_rata)]);
            
            fputcsv($file, []);
            fputcsv($file, []);
            fputcsv($file, ['', '', 'Pagar Nusa, ' . $penilaian->tanggal->translatedFormat('d F Y')]);
            fputcsv($file, ['', '', 'Ketua Dewan Penguji,']);
            fputcsv($file, []);
            fputcsv($file, []);
            fputcsv($file, ['', '', '( ' . $penilaian->petugas . ' )']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
