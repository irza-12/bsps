<?php

namespace App\Http\Controllers;

use App\Models\Bsps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BspsController extends Controller
{
    public function index(Request $request)
    {
        $query = Bsps::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_kk', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('dusun', 'like', "%{$search}%");
            });
        }

        // Filter by year
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        // Filter by dusun
        if ($request->has('dusun') && $request->dusun != '') {
            $query->where('dusun', $request->dusun);
        }

        // Sorting
        $sortBy = $request->get('sort', 'id');
        $sortDir = $request->get('dir', 'asc');
        $query->orderBy($sortBy, $sortDir);

        $data = $query->paginate(15)->withQueryString();

        // Get unique years and dusuns for filter
        $years = Bsps::selectRaw('DISTINCT tahun')->orderBy('tahun', 'desc')->pluck('tahun');
        $dusuns = Bsps::selectRaw('DISTINCT dusun')->orderBy('dusun')->pluck('dusun');

        return view('bsps.index', compact('data', 'years', 'dusuns'));
    }

    public function create()
    {
        $dusuns = ['Dusun I', 'Dusun II', 'Dusun III', 'Dusun IV', 'Dusun V'];
        return view('bsps.create', compact('dusuns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'dusun' => ['required', 'string', 'max:100'],
            'rt' => ['required', 'string', 'max:5'],
            'tahun' => ['required', 'integer', 'min:2000', 'max:2100'],
        ], [
            'no_kk.size' => 'No KK harus 16 digit.',
            'no_kk.regex' => 'No KK hanya boleh berisi angka.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nama.required' => 'Nama tidak boleh kosong.',
        ]);

        Bsps::create($validated);

        return redirect()->route('bsps.index')
            ->with('success', 'Data BSPS berhasil ditambahkan.');
    }

    public function edit(Bsps $bsp)
    {
        return view('bsps.edit', ['bsps' => $bsp]);
    }

    public function update(Request $request, Bsps $bsp)
    {
        $validated = $request->validate([
            'no_kk' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'dusun' => ['required', 'string', 'max:100'],
            'rt' => ['required', 'string', 'max:5'],
            'tahun' => ['required', 'integer', 'min:2000', 'max:2100'],
        ], [
            'no_kk.size' => 'No KK harus 16 digit.',
            'no_kk.regex' => 'No KK hanya boleh berisi angka.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nama.required' => 'Nama tidak boleh kosong.',
        ]);

        $bsp->update($validated);

        return redirect()->route('bsps.index')
            ->with('success', 'Data BSPS berhasil diperbarui.');
    }

    public function destroy(Bsps $bsp)
    {
        // Only admin can delete
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('bsps.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $bsp->delete();

        return redirect()->route('bsps.index')
            ->with('success', 'Data BSPS berhasil dihapus.');
    }
}
