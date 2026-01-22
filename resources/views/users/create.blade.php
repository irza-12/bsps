@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-plus" style="color: var(--success); margin-right: 8px;"></i>
                Tambah User Baru
            </h3>
            <a href="{{ route('users.index') }}" class="btn btn-outline btn-sm">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">
                        Nama Lengkap <span style="color: var(--danger);">*</span>
                    </label>
                    <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                        value="{{ old('name') }}" placeholder="Nama lengkap user" required>
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        Email <span style="color: var(--danger);">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="form-control @error('email') error @enderror"
                        value="{{ old('email') }}" placeholder="user@example.com" required>
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">
                            Password <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') error @enderror" placeholder="Minimal 8 karakter"
                            required>
                        @error('password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            Konfirmasi Password <span style="color: var(--danger);">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="role">
                        Role <span style="color: var(--danger);">*</span>
                    </label>
                    <select id="role" name="role" class="form-control @error('role') error @enderror" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                    @error('role')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    <small style="color: var(--text-muted); font-size: 12px; margin-top: 6px; display: block;">
                        <strong>Admin:</strong> Dapat menambah, edit, hapus data, dan mengelola user<br>
                        <strong>Operator:</strong> Hanya dapat menambah dan edit data
                    </small>
                </div>

                <div
                    style="display: flex; gap: 12px; padding-top: 20px; border-top: 1px solid var(--border-color); margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan User
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection