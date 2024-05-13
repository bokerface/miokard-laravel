<x-admin.layout>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Status PPDS</h6>
        </div>
        <div class="card-body">
            <div class="mb-5">
                <table class="table table-bordered mb-3">
                    <th colspan="2">Stase Saat Ini</th>
                    <tr>
                        <th scope="col">Stase</th>
                        <td>{{ $user->activeClinicalRotation->clinicalRotation->name }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Tanggal Mulai</th>
                        <td>{{ $user->activeClinicalRotation->start_date }}</td>
                    </tr>
                </table>

                <table class="table table-bordered mb-3">
                    <th colspan="2">Tugas</th>
                    <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Status</th>
                    </tr>
                    @foreach ($user->activeClinicalRotation->tasks as $task)
                        <tr>
                            <td>
                                <a href="{{ route('admin.task_detail', $task->id) }}"
                                    class="font-weight-bold">{{ $task->title }}
                                </a>
                            </td>
                            <td>{{ $task->status }}</td>
                        </tr>
                    @endforeach
                </table>

                <table class="table table-bordered mb-3">
                    <th colspan="2">Logbook</th>
                    <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Tanggal Kegiatan</th>
                    </tr>
                    @foreach ($user->logbooks as $logbook)
                        <tr>
                            <td scope="col">
                                <a href="{{ route('admin.logbook_detail', $logbook->id) }}">{{ $logbook->title }}</a>
                            </td>
                            <td scope="col">{{ $logbook->date }}</td>
                        </tr>
                    @endforeach
                </table>

                <div class="col-12">
                    <form action="{{ route('admin.change_student_clinical_rotation', $user->id) }}" method="POST"
                        onsubmit="return confirm('Aksi ini tidak dapat dikembalikan. Pastikan PPDS benar-benar telah menyelesaikan tugas stase yang diberikan. Lanjutkan?');">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="clinical_rotation_id" class="col-sm-2 col-form-label">
                                Stase :
                            </label>
                            <div class="col-sm-8">
                                <select name="clinical_rotation_id" id="clinical_rotation_id"
                                    class="form-control @error('clinical_rotation_id') is-invalid @enderror">
                                    <option value="">--Pilih Stase--</option>
                                    @foreach ($clinicalRotations as $clinicalRotation)
                                        <option value="{{ $clinicalRotation->id }}">{{ $clinicalRotation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('clinical_rotation_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary col-sm-2">Ubah Stase</button>
                        </div>
                    </form>
                </div>

                <table class="table table-bordered">
                    <th colspan="3">Stase Selesai</th>
                    <tr>
                        <th scope="col">Stase</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                    </tr>
                    @foreach ($user->finishedClinicalRotations as $finishedClinicalRotation)
                        <tr>
                            <td>{{ $finishedClinicalRotation->clinicalRotation->name }}</td>
                            <td>{{ $finishedClinicalRotation->start_date }}</td>
                            <td>{{ $finishedClinicalRotation->end_date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bimbingan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.change_student_mentor', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="mentor_user_id" class="form-label col-sm-2">
                        Pembimbing Saat Ini
                    </label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single form-control" id="mentor_user_id" name="mentor_user_id">
                            @if ($user->mentor != null)
                                <option value="{{ old('mentor_user_id') ?? $user->mentor->mentor_user_id }}" selected>
                                    {{ App\Models\User::find(old('mentor_user_id'))->userProfile->name ?? $user->mentor->mentorUser->userProfile->name }}
                                </option>
                            @endif
                        </select>

                        @error('mentor_user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ganti Pembimbing</button>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.update_student_data', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="text-center">
                    <img src="https://dummyimage.com/600x400/000/fff" class="rounded-circle" alt="..."
                        style="object-fit: cover;width: 180px;height: 180px;">
                </div>
                <div class="form-group">
                    <label for="photo">Ganti Foto Profil</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                        name="photo" value="{{ old('photo') ?? $user->userProfile->photo }}">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
                    <label for="student_id">NIM</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="student_id"
                        name="student_id" value="{{ old('student_id') ?? $user->userProfile->student_id }}">
                    @error('student_id')
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
                    <textarea name="origin_address" id="origin_address"
                        class="form-control @error('origin_address') is-invalid @enderror" cols="30" rows="10">{{ old('origin_address') ?? $user->userProfile->origin_address }}</textarea>
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="emergency_phone" name="emergency_phone"
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    placeholder: "Cari berdasarkan nama dosen",
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_supervisor_by_name') . '?f=supervisor' }}",
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public'
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: $.map(data, function(user) {
                                    return {
                                        text: user.user_profile.name,
                                        id: user.id
                                    }
                                })
                            };
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin.layout>
