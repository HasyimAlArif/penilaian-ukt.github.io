<x-app-layout>
    <!-- Modern UI (Screen Only) -->
    <div class="print:hidden">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Detail Penilaian</h1>
                <p class="text-gray-400">Hasil Ujian Kenaikan Tingkat</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('penilaian.index') }}" class="px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 transition">
                    Kembali
                </a>
                <div class="dropdown inline-block relative">
                    <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export / Cetak
                    </button>
                    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 right-0 w-48 z-10 transition-all duration-300 transform origin-top-right scale-95">
                        <li class="">
                            <button onclick="window.print()" class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-full text-left">
                                <span class="font-bold">Cetak PDF</span>
                            </button>
                        </li>
                        <li class="">
                            <a href="{{ route('penilaian.export_excel', $penilaian->id) }}" class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap w-full text-left">
                                <span class="font-bold">Export Excel</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Certificate Card Screen View -->
        <div class="glass-card rounded-xl p-8 max-w-4xl mx-auto">
            <div class="text-center border-b border-white/10 pb-6 mb-6">
                <div class="flex justify-center mb-4">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg">
                        <span class="text-4xl">🥋</span>
                    </div>
                </div>
                <h2 class="text-3xl font-bold mb-2 uppercase tracking-wider">Hasil Penilaian UKT</h2>
                <p class="text-gray-400">Pagar Nusa - Sistem Penilaian Digital</p>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Nama Peserta</p>
                    <p class="text-xl font-bold">{{ $penilaian->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400 mb-1">Tanggal Ujian</p>
                    <p class="text-xl font-bold">{{ $penilaian->tanggal->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Tingkatan</p>
                    <span class="tingkatan-badge badge-{{ strtolower($penilaian->tingkatan) }}">
                        {{ $penilaian->tingkatan }}
                    </span>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400 mb-1">Status Kelulusan</p>
                    @if($penilaian->rata_rata >= 75)
                        <span class="text-green-400 font-bold text-lg uppercase">LULUS</span>
                    @else
                        <span class="text-red-400 font-bold text-lg uppercase">TIDAK LULUS</span>
                    @endif
                </div>
            </div>

            <!-- Detail Nilai Screen View -->
            @if(!empty($penilaian->detail_nilai) && is_array($penilaian->detail_nilai))
            <div class="mb-8">
                <h3 class="font-bold text-lg mb-4">Rincian Detail Penilaian</h3>
                <div class="space-y-4">
                    @foreach($penilaian->detail_nilai as $kategori => $items)
                        <div class="bg-black/20 rounded-lg p-4">
                            <h4 class="font-bold text-blue-400 mb-2">{{ $kategori }}</h4>
                            <div class="space-y-2">
                                @foreach($items as $item)
                                    @php 
                                        $soalId = is_array($item) ? ($item['soal_id'] ?? null) : null;
                                        $nilai = is_array($item) ? ($item['nilai'] ?? 0) : 0;
                                        $huruf = is_array($item) ? ($item['huruf'] ?? '-') : '-';
                                        $soal = $soalId ? \App\Models\Soal::find($soalId) : null; 
                                    @endphp
                                    @if($soal)
                                    <div class="flex justify-between items-start text-sm border-b border-white/5 pb-2 last:border-0 pt-2">
                                        <span class="text-gray-300 flex-1 pr-4">{{ $soal->soal }}</span>
                                        <div class="text-right">
                                            <span class="font-bold text-white block">{{ $nilai }}</span>
                                            <span class="text-xs text-blue-300 block italic">{{ $huruf }}</span>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="mt-6 pt-4 border-t border-white/10 flex justify-between items-center">
                <p class="text-gray-300 font-medium">Nilai Rata-rata Akhir</p>
                <p class="text-4xl font-bold {{ $penilaian->rata_rata >= 75 ? 'text-green-400' : 'text-yellow-400' }}">
                    {{ number_format($penilaian->rata_rata, 1) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Legacy Print Template (Visible only on Print) -->
    <div class="hidden print:block bg-white text-black p-0 m-0 font-sans text-sm">
        <div class="text-center mb-5 font-bold">
            <div class="text-sm">NILAI MATERI UJIAN KENAIKAN TINGKAT</div>
            <div class="text-sm">PENCAK SILAT NU PAGAR NUSA</div>
            <div class="text-sm">PIMPINAN CABANG BANGIL</div>
        </div>
        
        <div class="mb-5 text-[13px]">
            <div style="margin-bottom: 5px;">
                <span style="display: inline-block; width: 150px;">Nama Peserta</span>
                <span>: {{ strtoupper($penilaian->name) }}</span>
            </div>
            <div>
                <span style="display: inline-block; width: 150px;">UKT yang ditempuh</span>
                <span>: <span style="background: #ffff00; padding: 0 5px; font-weight: bold;">STRIP {{ strtoupper($penilaian->tingkatan) }}</span></span>
            </div>
        </div>
        
        <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 6px; width: 5%; background: #d0d0d0; text-align: center;">No.</th>
                    <th colspan="2" style="border: 1px solid #000; padding: 6px; background: #d0d0d0; text-align: center;">MATERI UJIAN</th>
                    <th colspan="2" style="border: 1px solid #000; padding: 6px; background: #d0d0d0; text-align: center;">NILAI</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #000; padding: 6px; background: #d0d0d0;"></th>
                    <th colspan="2" style="border: 1px solid #000; padding: 6px; background: #d0d0d0;"></th>
                    <th style="border: 1px solid #000; padding: 6px; width: 12%; background: #d0d0d0; text-align: center;">ANGKA</th>
                    <th style="border: 1px solid #000; padding: 6px; width: 30%; background: #d0d0d0; text-align: center;">HURUF</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $letters = range('A', 'Z');
                    $catIndex = 0;
                    $detailNilai = is_array($penilaian->detail_nilai) ? $penilaian->detail_nilai : [];
                    
                    // Order of categories based on legacy app
                    $categories = [
                        'SALAM PAGAR NUSA',
                        'TEKNIK DASAR PUKULAN',
                        'TEKNIK DASAR TANGKISAN',
                        'TEKNIK DASAR TENDANGAN',
                        'TEKNIK DASAR PAGAR NUSA',
                        'FISIK',
                        'TEKNIK SERANG BALAS',
                        'JURUS WAJIB IPSI'
                    ];
                    
                    function numberToWords($num) {
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
                    }
                @endphp

                @foreach($categories as $category)
                    @if(isset($detailNilai[$category]) && count($detailNilai[$category]) > 0)
                        <tr style="background: #e8e8e8;">
                            <td style="border: 1px solid #000; padding: 6px; font-weight: bold;">{{ $letters[$catIndex] }}.</td>
                            <td style="border: 1px solid #000; padding: 6px; font-weight: bold;" colspan="2">{{ $category }}</td>
                            <td style="border: 1px solid #000; padding: 6px;"></td>
                            <td style="border: 1px solid #000; padding: 6px;"></td>
                        </tr>
                        @foreach($detailNilai[$category] as $index => $item)
                            @php
                                $soalId = is_array($item) ? ($item['soal_id'] ?? null) : null;
                                $nilai = is_array($item) ? ($item['nilai'] ?? 0) : 0;
                                // Use saved huruf if exists, else fallback to numberToWords helper
                                $huruf = is_array($item) ? ($item['huruf'] ?? null) : null;
                                if (!$huruf) {
                                    $huruf = numberToWords($nilai);
                                }
                                $soal = $soalId ? \App\Models\Soal::find($soalId) : null;
                            @endphp
                            @if($soal)
                            <tr>
                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid #000; padding: 6px; padding-left: 15px;" colspan="2">{{ $soal->soal }}</td>
                                <td style="border: 1px solid #000; padding: 6px; text-align: center;">{{ $nilai }}</td>
                                <td style="border: 1px solid #000; padding: 6px;">{{ $huruf }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @php $catIndex++; @endphp
                    @endif
                @endforeach
            </tbody>
        </table>

        @php
            // Calculate total and averages for display
            $totalNilai = $penilaian->nilai_salam + $penilaian->nilai_pukulan + $penilaian->nilai_tangkisan + 
                          $penilaian->nilai_tendangan + $penilaian->nilai_teknik_pn + $penilaian->nilai_fisik + 
                          $penilaian->nilai_serang_balas + $penilaian->nilai_jurus;
        @endphp

        <table style="width: 100%; border-collapse: collapse; font-size: 13px; margin-top: 20px;">
            <tr>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold; width: 40%;">TOTAL NILAI</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold; width: 20%;">{{ number_format($totalNilai, 1) }}</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; width: 40%;">{{ numberToWords($totalNilai) }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">RATA-RATA NILAI</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">{{ number_format($penilaian->rata_rata, 2) }}</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ numberToWords($penilaian->rata_rata) }}</td>
            </tr>
        </table>

        <div style="margin-top: 40px; text-align: center;">
            <p>Pagar Nusa, {{ $penilaian->tanggal->translatedFormat('d F Y') }}</p>
            <p style="margin-top: 10px; font-weight: bold;">Ketua Dewan Penguji,</p>
            
            <div style="margin-top: 60px; border-top: 1px solid #000; display: inline-block; padding-top: 5px; width: 200px;">
                ( {{ $penilaian->petugas }} )
            </div>
        </div>
    </div>
    
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</x-app-layout>
