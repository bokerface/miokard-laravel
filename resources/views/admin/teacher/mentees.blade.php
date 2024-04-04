<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mahasiswa bimbingan {{ $user->userProfile->name }}</h1>
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
            <div class="row">
                <div class="col-4">
                    <span class="font-weight-bold">Nama</span>
                    <br>
                    <span>{{ $user->userProfile->name }}</span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold">No SIP</span>
                    <br>
                    <span>{{ $user->userProfile->sip_id }}</span>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a href="{{ route('admin.add_teacher_mentees', $user->id) }}" class="btn btn-primary">
                        tambah mahasiswa bimbingan
                    </a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->mentees as $mentee)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.user_detail', $mentee->mentee->id) }}">
                                        {{ $mentee->mentee->userProfile->name }}
                                    </a>
                                </td>
                                <td>{{ $mentee->mentee->userProfile->student_id }}</td>
                                <td class="text-center">
                                    <form action="">
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
