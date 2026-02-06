<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soal = Soal::orderBy('tingkatan')->paginate(10);
        return view('soal.index', compact('soal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('soal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tingkatan' => 'required|in:Putih,Kuning,Merah,Biru,Coklat,Hitam',
            'kategori' => 'required|string|max:255',
            'soal' => 'required|string',
        ]);

        Soal::create($validated);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soal $soal)
    {
        return view('soal.edit', compact('soal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soal $soal)
    {
        $validated = $request->validate([
            'tingkatan' => 'required|in:Putih,Kuning,Merah,Biru,Coklat,Hitam',
            'kategori' => 'required|string|max:255',
            'soal' => 'required|string',
        ]);

        $soal->update($validated);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus');
    }
}
