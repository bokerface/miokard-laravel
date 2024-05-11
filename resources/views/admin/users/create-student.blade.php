<x-admin.layout>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mahasiswa Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.store_student') }}" method="POST">
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
                    <label for="student_id" class="form-label">NIM</label>
                    <input type="number" name="student_id"
                        class="form-control @error('student_id') is-invalid @enderror" id="student_id">
                    @error('student_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
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
                    <label for="mentor_user_id" class="form-label">Pembimbing</label>
                    <select class="js-example-basic-single form-control" id="mentor_user_id" name="mentor_user_id">
                        @if (old('mentor_user_id'))
                            <option value="{{ old('mentor_user_id') }}" selected>
                                {{ App\Models\User::find(old('mentor_user_id'))->userProfile->name }}
                            </option>
                        @endif
                    </select>
                    @error('mentor_user_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
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
