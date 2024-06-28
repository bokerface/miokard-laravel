<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if ($role == 'student')
            <h1 class="h3 mb-0 text-gray-800">PPDS</h1>
            <a class="btn btn-primary mb-3" href="{{ route('admin.create_student') }}">Tambah Mahasiswa</a>
        @elseif ($role == 'teacher')
            <h1 class="h3 mb-0 text-gray-800">Dosen</h1>
            <a class="btn btn-primary" href="{{ route('admin.create_teacher') }}">Tambah Dosen</a>
        @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Pengguna
            </button>
            <a href="{{ route('admin.import_users') }}" type="button" class="btn btn-primary">
                Import Pengguna (Excel)
            </a>
        @endif
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @if ($role == 'student')
                                <th>NIM</th>
                            @elseif ($role == 'teacher')
                                <th>SIP</th>
                                <th style="width: 25%"></th>
                            @endif
                            <th style="width: 15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.user_detail', $user->id) }}">
                                        {{ $user->userProfile->name }}
                                    </a>
                                </td>
                                @if ($role == 'student')
                                    <td>{{ $user->userProfile->student_id }}</td>
                                @elseif ($role == 'teacher')
                                    <td>{{ $user->userProfile->sip_id }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.teacher_mentees', $user->id) }}"
                                            class="btn btn-primary">
                                            Mahasiswa Bimbingan
                                            <span class="badge badge-light">
                                                {{ $user->mentees->count() }}
                                            </span>
                                        </a>
                                    </td>
                                @endif
                                <td class="text-center">
                                    <form action="{{ route('admin.delete_user', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Pengguna yang sudah dihapus tidak dapat dikembalikan dengan cara apapun. Lanjutkan?')">
                                            Hapus User
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jenis Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a class="btn btn-primary mb-3" href="{{ route('admin.create_student') }}">Akun Mahasiswa</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('admin.create_teacher') }}">Akun Dosen</a>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    @endpush
</x-admin.layout>
