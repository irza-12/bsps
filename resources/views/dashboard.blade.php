@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <!-- Card Total -->
        <div class="card" style="display: flex; align-items: center; padding: 24px;">
            <div
                style="width: 56px; height: 56px; border-radius: 16px; background: #eff6ff; color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div style="font-size: 28px; font-weight: 700;">{{ number_format($totalData) }}</div>
                <div style="color: var(--text-light); font-size: 13px;">Total Penerima</div>
            </div>
        </div>

        <!-- Card Tahun Ini -->
        <div class="card" style="display: flex; align-items: center; padding: 24px;">
            <div
                style="width: 56px; height: 56px; border-radius: 16px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <div style="font-size: 28px; font-weight: 700;">{{ number_format($dataThisYear) }}</div>
                <div style="color: var(--text-light); font-size: 13px;">Tahun {{ $currentYear }}</div>
            </div>
        </div>

        <!-- Card Dusun -->
        <div class="card" style="display: flex; align-items: center; padding: 24px;">
            <div
                style="width: 56px; height: 56px; border-radius: 16px; background: #fff7ed; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div>
                <div style="font-size: 28px; font-weight: 700;">{{ $dusunStats->count() }}</div>
                <div style="color: var(--text-light); font-size: 13px;">Wilayah Dusun</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        <!-- Recent Table -->
        <div class="card">
            <div class="card-header">
                <h3 style="font-size: 15px; font-weight: 700;">Data Terbaru</h3>
                <a href="{{ route('bsps.index') }}" class="btn-flat" style="font-size: 12px;">Lihat Semua</a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Penerima</th>
                            <th>Alamat</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestData as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $item->nama }}</div>
                                    <div style="font-size: 11px; color: var(--text-light);">{{ $item->nik }}</div>
                                </td>
                                <td>
                                    <div style="font-size: 12px;">{{ $item->dusun }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-year">{{ $item->tahun }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-light);">Belum ada
                                    data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stats Dusun -->
        <div class="card">
            <div class="card-header">
                <h3 style="font-size: 15px; font-weight: 700;">Statistik per Dusun</h3>
            </div>
            <div class="card-body">
                @forelse($dusunStats as $stat)
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 13px;">
                            <span style="font-weight: 500;">{{ $stat->dusun }}</span>
                            <span style="font-weight: 600; color: var(--text-main);">{{ $stat->total }}</span>
                        </div>
                        <div style="height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                            @php $percent = $totalData > 0 ? ($stat->total / $totalData) * 100 : 0; @endphp
                            <div style="height: 100%; background: var(--primary); width: {{ $percent }}%; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--text-light);">Tidak ada data</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection