@extends('admin.dashboard_layout')

@section('content')
<div class="container" style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 1.5rem; font-weight: 700;">Manajemen User</h1>
            <p style="color: #64748b; font-size: 0.875rem;">Kelola akses admin dan user biasa</p>
        </div>
        <button onclick="document.getElementById('modalAdd').style.display='flex'" class="btn btn-primary" style="background: #4F46E5; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">+ Tambah User</button>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #059669; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #10b981;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div style="overflow-x: auto;">
            <table class="datatable" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Nama User</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Username</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Role</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Terdaftar</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s; cursor: pointer;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'" ondblclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->username) }}', '{{ $user->role }}')">
                        <td style="padding: 16px 20px; text-align: left;">
                            <div style="font-size: 14px; font-weight: 600; color: #1e293b;">{{ $user->name }}</div>
                        </td>
                        <td style="padding: 16px 20px; font-size: 14px; color: #64748b; text-align: center;">{{ $user->username ?? '-' }}</td>
                        <td style="padding: 16px 20px; text-align: center;">
                            @php
                                $badgeStyle = 'background: #f1f5f9; color: #64748b;';
                                if($user->role == 'admin') $badgeStyle = 'background: #eef2ff; color: #4f46e5;';
                                elseif($user->role == 'asesor') $badgeStyle = 'background: #ecfdf5; color: #059669;';
                            @endphp
                            <span style="padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 700; {{ $badgeStyle }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td style="padding: 16px 20px; font-size: 13px; color: #94a3b8; text-align: center;">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline; margin-left: 12px;" id="delete-form-{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 12px; font-weight: 600; padding: 4px 8px; border-radius: 6px; transition: background 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'" onclick="if(confirm('Hapus user ini?')) document.getElementById('delete-form-{{ $user->id }}').submit(); event.stopPropagation();">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle;"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="font-size: 11px; color: #94a3b8; margin-top: 10px;">* Klik ganda (Double-click) pada baris untuk mengedit data user.</div>
        </div>
    </div>
</div>

<!-- Modal Add User -->
<div id="modalAdd" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; z-index: 1000;">
    <div style="background: white; padding: 2.5rem; border-radius: 24px; width: 100%; max-width: 450px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem;">Tambah User</h2>
            <p style="font-size: 14px; color: #64748b;">Buat akun baru untuk akses sistem kredensial.</p>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="name" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4F46E5'" onblur="this.style.borderColor='#e2e8f0'" required>
            </div>
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Username</label>
                <input type="text" name="username" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none;" required>
            </div>
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Password Akun</label>
                <input type="password" name="password" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none;" required>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Pilih Role</label>
                <select name="role" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; appearance: none; background: #fff;" required>
                    <option value="user">User Biasa</option>
                    <option value="asesor">Asesor</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="document.getElementById('modalAdd').style.display='none'" style="flex: 1; padding: 12px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">Batal</button>
                <button type="submit" style="flex: 1; padding: 12px; background: #4F46E5; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: transform 0.2s, background 0.2s;" onmouseover="this.style.background='#4338CA'; this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#4F46E5'; this.style.transform='none'">Simpan User</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="modalEdit" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; z-index: 1000;">
    <div style="background: white; padding: 2.5rem; border-radius: 24px; width: 100%; max-width: 450px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem;">Edit Data User</h2>
            <p style="font-size: 14px; color: #64748b;">Perbarui informasi akun pengguna ini.</p>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" id="editName" name="name" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none;" required>
            </div>
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Username</label>
                <input type="text" id="editUsername" name="username" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none;" required>
            </div>
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Password Baru (Opsional)</label>
                <input type="password" name="password" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none;" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px;">Pilih Role</label>
                <select id="editRole" name="role" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; outline: none; appearance: none; background: #fff;" required>
                    <option value="user">User Biasa</option>
                    <option value="asesor">Asesor</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="document.getElementById('modalEdit').style.display='none'" style="flex: 1; padding: 12px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 1; padding: 12px; background: #10B981; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, username, role) {
    document.getElementById('editForm').action = '/admin/users/' + id;
    document.getElementById('editName').value = name;
    document.getElementById('editUsername').value = username;
    document.getElementById('editRole').value = role;
    document.getElementById('modalEdit').style.display = 'flex';
}
</script>
@endsection
