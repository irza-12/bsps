@extends('layouts.app')

@section('title', 'Edit Data BSPS')

@section('content')
    <div class="header">
        <div class="page-title">
            <h1>Form Edit Data</h1>
            <p>Perbarui data penerima bantuan yang sudah ada.</p>
        </div>
        <a href="{{ route('bsps.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header">
            <h3 style="font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-edit" style="color: var(--primary);"></i> Edit Data Penerima
            </h3>
        </div>

        <div class="card-body">
            <form action="{{ route('bsps.update', $bsps->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Section: Identitas -->
                <div style="margin-bottom: 24px;">
                    <h4
                        style="font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                        Identitas Penerima</h4>

                    <div class="grid-2">
                        <!-- No KK -->
                        <div class="form-group">
                            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">No. Kartu
                                Keluarga (KK) <span style="color: red;">*</span></label>
                            <input type="text" name="no_kk" class="form-control" placeholder="16 digit angka"
                                value="{{ old('no_kk', $bsps->no_kk) }}" required maxlength="16"
                                style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px;">
                            @error('no_kk') <div style="color: red; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="form-group">
                            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">NIK <span
                                    style="color: red;">*</span></label>
                            <input type="text" name="nik" class="form-control" placeholder="16 digit angka"
                                value="{{ old('nik', $bsps->nik) }}" required maxlength="16"
                                style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px;">
                            @error('nik') <div style="color: red; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group" style="margin-top: 20px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Nama Lengkap
                            <span style="color: red;">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Sesuai KTP"
                            value="{{ old('nama', $bsps->nama) }}" required
                            style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px;">
                    </div>
                </div>

                <!-- Section: Alamat -->
                <div style="margin-bottom: 24px;">
                    <h4
                        style="font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                        Alamat & Lokasi</h4>

                    <!-- Alamat -->
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Alamat Lengkap
                            <span style="color: red;">*</span></label>
                        <textarea name="alamat" rows="2" placeholder="Nama Jalan, Gg, atau patokan" required
                            style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit;">{{ old('alamat', $bsps->alamat) }}</textarea>
                    </div>

                    <div class="grid-3">
                        <!-- Dusun -->
                        <div class="form-group">
                            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Dusun
                                <span style="color: red;">*</span></label>
                            <select name="dusun" required
                                style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px; background: white;">
                                <option value="">-- Pilih Dusun --</option>
                                <option value="Simpang Abadi" {{ old('dusun', $bsps->dusun) == 'Simpang Abadi' ? 'selected' : '' }}>Simpang Abadi</option>
                                <option value="Terjun Jaya" {{ old('dusun', $bsps->dusun) == 'Terjun Jaya' ? 'selected' : '' }}>Terjun Jaya</option>
                                <option value="Betara 8" {{ old('dusun', $bsps->dusun) == 'Betara 8' ? 'selected' : '' }}>
                                    Betara 8</option>
                            </select>
                        </div>

                        <!-- RT -->
                        <div class="form-group">
                            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">RT <span
                                    style="color: red;">*</span></label>
                            <input type="text" name="rt" placeholder="Contoh: 001" value="{{ old('rt', $bsps->rt) }}"
                                required
                                style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px;">
                        </div>

                        <!-- Tahun -->
                        <div class="form-group">
                            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Tahun
                                Anggaran <span style="color: red;">*</span></label>
                            <input type="number" name="tahun" value="{{ old('tahun', $bsps->tahun) }}" required
                                style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div
                    style="display: flex; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--border);">
                    <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">
                        <i class="fas fa-save"></i> Perbarui Data
                    </button>
                    <a href="{{ route('bsps.index') }}" class="btn btn-light" style="padding: 10px 24px;">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection