@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users-cog" style="color: var(--primary); margin-right: 8px;"></i>
                Daftar User Sistem
            </h3>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Tambah User
            </a>
        </div>

        <div class="card-body" style="padding: 0;">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                <td style="font-weight: 500;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 36px; height: 36px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $user->role }}">{{ $user->role }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-icon btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?');" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 60px; color: var(--text-muted);">
                                    <i class="fas fa-users" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
                                    <p>Tidak ada user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection