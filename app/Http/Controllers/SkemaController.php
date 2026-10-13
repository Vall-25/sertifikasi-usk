<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkemaController extends Controller
{
    public function index()
    {
        $skemas = Skema::latest()->get();

        return view('admin.skema.index', compact('skemas'));
    }

    public function create()
    {
        return view('admin.skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skema' => ['required', 'string', 'max:255'],
            'kode_skema' => ['required', 'string', 'max:50', 'unique:skemas,kode_skema'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Skema::create($validated);

        return redirect()
            ->route('admin.skema.index')
            ->with('success', 'Skema berhasil ditambahkan.');
    }

    public function show(Skema $skema)
    {
        return view('admin.skema.show', compact('skema'));
    }

    public function edit(Skema $skema)
    {
        return view('admin.skema.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $validated = $request->validate([
            'nama_skema' => ['required', 'string', 'max:255'],
            'kode_skema' => [
                'required',
                'string',
                'max:50',
                Rule::unique('skemas', 'kode_skema')->ignore($skema->id),
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $skema->update($validated);

        return redirect()
            ->route('admin.skema.index')
            ->with('success', 'Skema berhasil diperbarui.');
    }

    public function destroy(Skema $skema)
    {
        if ($skema->pesertas()->exists()) {
            return redirect()
                ->route('admin.skema.index')
                ->with('error', 'Skema tidak dapat dihapus karena masih digunakan peserta.');
        }

        $skema->delete();

        return redirect()
            ->route('admin.skema.index')
            ->with('success', 'Skema berhasil dihapus.');
    }
}