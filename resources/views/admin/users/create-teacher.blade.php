<x-admin.layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Akun Dosen Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.store_teacher') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama
                        Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sip" class="form-label">SIP</label>
                    <input type="text" name="sip" class="form-control @error('sip') is-invalid @enderror"
                        id="sip">
                    @error('sip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="laki-laki"
                            checked>
                        <label class="form-check-label" for="gender">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="perempuan">
                        <label class="form-check-label" for="gender">
                            Perempuan
                        </label>
                    </div>
                    @error('gender')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" name="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" name="password_confirmation" class="form-label">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control @error('password') is-invalid @enderror" id="password_confirmation">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary" type="submit">Tambahkan</button>
            </form>
        </div>
    </div>
</x-admin.layout>
