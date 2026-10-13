<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $peserta = $request->user()
            ->peserta()
            ->with('skema')
            ->firstOrFail();

        $skemas = \App\Models\Skema::orderBy('nama_skema')->get();

        return view('user.profil.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $peserta = $user->peserta;

        abort_if(!$peserta, 404, 'Data peserta tidak ditemukan.');

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'nik' => ['required', 'digits:16',
                Rule::unique('pesertas', 'nik')->ignore($peserta->id)],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('pesertas', 'email')->ignore($peserta->id),
                Rule::unique('users', 'email')->ignore($user->id)],
            'no_hp' => ['required', 'digits:12'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'skema_id' => ['required', 'exists:skemas,id'],
            'alamat' => ['required', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($user, $peserta, $validated) {
            $peserta->update($validated);
            $user->name = $validated['nama'];
            $user->email = $validated['email'];
            $user->save();
        });

        return redirect()->route('user.profil.edit')
            ->with('success', 'Profil peserta berhasil diperbarui.');
    }
}