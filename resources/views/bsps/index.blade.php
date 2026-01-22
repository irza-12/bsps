@extends('layouts.app')

@section('title', 'Data Penerima BSPS')

@section('content')
    <div class="header">
        <div class="page-title">
            <h1>Data Penerima</h1>
            <p>Kelola data penerima bantuan stimulasi perumahan swadaya.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('export.excel') }}" class="btn btn-light"><i class="fas fa-file-excel"
                    style="color: #10b981;"></i> Excel</a>
            <a href="{{ route('export.pdf') }}" class="btn btn-light"><i class="fas fa-file-pdf"
                    style="color: #ef4444;"></i> PDF</a>
            <a href="{{ route('bsps.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>
    </div>

    <div class="card">
        <!-- Filter Section -->
        <div style="padding: 20px; border-bottom: 1px solid var(--border); background: #f8fafc;">
            <form action="{{ route('bsps.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari NIK, Nama, atau Alamat..."
                        style="width: 100%; padding: 9px 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 13px;">
                </div>

                <select name="tahun"
                    style="padding: 9px 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; min-width: 120px;">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <select name="dusun"
                    style="padding: 9px 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; min-width: 150px;">
                    <option value="">Semua Dusun</option>
                    @foreach($dusuns as $dusun)
                        <option value="{{ $dusun }}" {{ request('dusun') == $dusun ? 'selected' : '' }}>{{ $dusun }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Filter</button>
                @if(request()->anyFilled(['search', 'tahun', 'dusun']))
                    <a href="{{ route('bsps.index') }}" class="btn btn-light">Reset</a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Informasi Penerima</th>
                        <th>Alamat & Lokasi</th>
                        <th>Tahun</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td style="text-align: center; color: var(--text-light);">{{ $data->firstItem() + $index }}</td>
                            <td>
                                <div style="font-weight: 600; font-size: 13px;">{{ $item->nama }}</div>
                                <div style="font-size: 11px; color: var(--text-light);">NIK: {{ $item->nik }}</div>
                                <div style="font-size: 11px; color: var(--text-light);">KK: {{ $item->no_kk }}</div>
                            </td>
                            <td>
                                <div style="font-size: 13px;">{{ $item->dusun }}</div>
                                <div style="font-size: 11px; color: var(--text-light);">RT {{ $item->rt }} - {{ $item->alamat }}
                                </div>
                            </td>
                            <td><span class="badge badge-year">{{ $item->tahun }}</span></td>
                            <td style="text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('bsps.edit', $item) }}" class="btn-flat" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <form action="{{ route('bsps.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Hapus data ini?');" style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-flat" style="color: #ef4444;" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fas fa-inbox"
                                    style="font-size: 32px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                Tidak ada data ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($data->hasPages())
            <div style="padding: 16px 24px; border-top: 1px solid var(--border);">
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection