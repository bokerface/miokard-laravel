<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        @if ($role == 'student')
            <a class="btn btn-primary mb-3" href="{{ route('admin.create_student') }}">Tambah Mahasiswa</a>
        @elseif ($role == 'teacher')
            <a class="btn btn-primary" href="{{ route('admin.create_teacher') }}">Tambah Dosen</a>
        @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Pengguna
            </button>
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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
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
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->userProfile->name }}</td>
                                @if ($role == 'student')
                                    <th>{{ $user->userProfile->studentId }}</th>
                                @elseif ($role == 'teacher')
                                    <th>{{ $user->userProfile->sipId }}</th>
                                @endif
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
