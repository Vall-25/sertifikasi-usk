<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan dashboard peserta.
     */
    public function dashboard(Request $request)
    {
        $peserta = $request->user()
            ->peserta()
            ->with('skema')
            ->first();

        return view('user.profil.dashboard', compact('peserta'));
    }

    /**
     * Menampilkan halaman edit data peserta milik sendiri.
     */
    public function edit(Request $request)
    {
        $peserta = $request->user()
            ->peserta()
            ->with('skema')
            ->firstOrFail();

        $skemas = Skema::orderBy('nama_skema')->get();

        return view(
            'user.profil.edit',
            compact('peserta', 'skemas')
        );
    }

    /**
     * Memperbarui data peserta milik sendiri.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $peserta = $user->peserta;

        abort_if(
            !$peserta,
            404,
            'Data peserta belum ditambahkan oleh admin.'
        );

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u',
            ],
            'nik' => [
                'required',
                'digits:16',
                Rule::unique('pesertas', 'nik')
                    ->ignore($peserta->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pesertas', 'email')
                    ->ignore($peserta->id),
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],
            'no_hp' => [
                'required',
                'digits:12',
            ],
            'tanggal_lahir' => [
                'required',
                'date',
                'before:today',
            ],
            'skema_id' => [
                'required',
                'exists:skemas,id',
            ],
            'alamat' => [
                'required',
                'string',
                'max:1000',
            ],
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah digunakan peserta lain.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.digits' => 'Nomor telepon harus tepat 12 digit angka.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'skema_id.exists' => 'Skema yang dipilih tidak tersedia.',
        ]);

        DB::transaction(function () use (
            $user,
            $peserta,
            $validated
        ) {
            $peserta->update($validated);

            $user->name = $validated['nama'];
            $user->email = $validated['email'];
            $user->save();
        });

        return redirect()
            ->route('user.profil.edit')
            ->with(
                'success',
                'Profil peserta berhasil diperbarui.'
            );
    }
}