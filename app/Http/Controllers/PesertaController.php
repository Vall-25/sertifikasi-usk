<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::with(['skema', 'user'])
            ->latest()
            ->get();

        return view('admin.peserta.index', compact('pesertas'));
    }

    public function create()
    {
        // Hanya akun user yang sudah register dan belum
        // memiliki data peserta yang dapat dipilih.
        $users = User::where('role', 'user')
            ->whereDoesntHave('peserta')
            ->orderBy('name')
            ->get();

        $skemas = Skema::orderBy('nama_skema')->get();

        return view('admin.peserta.create', compact('users', 'skemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'user'),
                'unique:pesertas,user_id',
            ],
            'nik' => [
                'required',
                'digits:16',
                'unique:pesertas,nik',
            ],
            'no_hp' => ['required', 'digits:12'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'skema_id' => ['required', 'exists:skemas,id'],
            'alamat' => ['required', 'string', 'max:1000'],
        ], [
            'user_id.required' => 'Pilih akun yang sudah terdaftar.',
            'user_id.exists' => 'Akun peserta tidak valid.',
            'user_id.unique' => 'Akun ini sudah memiliki data peserta.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'no_hp.digits' => 'Nomor telepon harus tepat 12 digit angka.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'skema_id.exists' => 'Skema yang dipilih tidak tersedia.',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::where('role', 'user')
                ->lockForUpdate()
                ->findOrFail($validated['user_id']);

            // Cegah akun yang sama ditautkan ke dua peserta.
            if ($user->peserta()->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'user_id' => 'Akun ini sudah memiliki data peserta.',
                ]);
            }

            Peserta::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'nik' => $validated['nik'],
                'no_hp' => $validated['no_hp'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'skema_id' => $validated['skema_id'],
                'alamat' => $validated['alamat'],
            ]);
        });

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan dan dihubungkan dengan akun.');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load(['skema', 'user']);

        return view('admin.peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $skemas = Skema::orderBy('nama_skema')->get();

        return view('admin.peserta.edit', compact('peserta', 'skemas'));
    }

    public function update(Request $request, Peserta $peserta)
    {
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
                Rule::unique('pesertas', 'nik')->ignore($peserta->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pesertas', 'email')->ignore($peserta->id),
                Rule::unique('users', 'email')->ignore($peserta->user_id),
            ],
            'no_hp' => ['required', 'digits:12'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'skema_id' => ['required', 'exists:skemas,id'],
            'alamat' => ['required', 'string', 'max:1000'],
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.digits' => 'Nomor telepon harus tepat 12 digit angka.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'skema_id.exists' => 'Skema yang dipilih tidak tersedia.',
        ]);

        DB::transaction(function () use ($validated, $peserta) {
            $peserta->update($validated);

            $peserta->user()->update([
                'name' => $validated['nama'],
                'email' => $validated['email'],
            ]);
        });

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        DB::transaction(function () use ($peserta) {
            // Menghapus akun akan menghapus data peserta juga,
            // sesuai cascadeOnDelete pada foreign key user_id.
            $peserta->user()->delete();
        });

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Data peserta dan akun terkait berhasil dihapus.');
    }
}