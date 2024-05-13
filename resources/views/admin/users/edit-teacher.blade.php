<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.update_teacher_data', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                        name="name" value="{{ old('name') ?? $user->userProfile->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="str_id">No. STR</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="str_id"
                        name="str_id" value="{{ old('str_id') ?? $user->userProfile->str_id }}">
                    @error('str_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sip_id">No. SIP</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="sip_id"
                        name="sip_id" value="{{ old('sip_id') ?? $user->userProfile->sip_id }}">
                    @error('sip_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') ?? $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender"
                        name="gender">
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->value }}"
                                {{ old('gender') ?? $user->userProfile->gender == $gender->value ? 'selected' : '' }}>
                                {{ $gender->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="origin_address">Alamat Asli</label>
                    <textarea name="origin_address" id="origin_address" class="form-control @error('origin_address') is-invalid @enderror"
                        cols="30" rows="10">{{ old('origin_address') ?? $user->userProfile->origin_address }}</textarea>
                    @error('origin_address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="residence_address">Alamat Tempat Tinggal</label>
                    <textarea name="residence_address" id="residence_address"
                        class="form-control @error('residence_address') is-invalid @enderror" cols="30" rows="10">{{ old('residence_address') ?? $user->userProfile->residence_address }}</textarea>
                    @error('residence_address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="phone"
                        name="phone" value="{{ old('phone') ?? $user->userProfile->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="emergency_phone">Nomor Telepon Darurat</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="emergency_phone"
                        name="emergency_phone"
                        value="{{ old('emergency_phone') ?? $user->userProfile->emergency_phone }}">
                    @error('emergency_phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bpjs_id">Nomor BPJS</label>
                    <input type="text" class="form-control @error('bpjs_id') is-invalid @enderror" id="bpjs_id"
                        name="bpjs_id" value="{{ old('bpjs_id') ?? $user->userProfile->bpjs_id }}">
                    @error('bpjs_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bank_account">Nomor Rekening</label>
                    <input type="text" class="form-control @error('bank_account') is-invalid @enderror"
                        id="bank_account" name="bank_account"
                        value="{{ old('bank_account') ?? $user->userProfile->bank_account }}">
                    @error('bank_account')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="age">Usia</label>
                    <input type="text" class="form-control @error('age') is-invalid @enderror" id="age"
                        name="age" value="{{ old('age') ?? $user->userProfile->age }}">
                    @error('age')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    @push('js')
        <!-- Page level plugins -->

        <!-- Page level custom scripts -->
    @endpush
</x-admin.layout>
