<x-student.layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('student.update_password', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="password">Password saat ini</label>
                    <input type="password" class="form-control @error('name') is-invalid @enderror" name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="new_password">Password baru</label>
                    <input type="password" class="form-control @error('name') is-invalid @enderror" name="new_password">
                    @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmasi password baru</label>
                    <input type="password" class="form-control @error('name') is-invalid @enderror"
                        name="new_password_confirmation">
                    @error('new_password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </form>
        </div>
    </div>
</x-student.layout>
