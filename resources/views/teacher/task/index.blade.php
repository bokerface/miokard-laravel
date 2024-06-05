<x-teacher.layout>
    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tugas Mahasiswa Bimbingan Saya</h1>
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
                            <th>Nama Mahasiswa</th>
                            <th>Judul</th>
                            <th>Stase</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tasks->count() == 0)
                            <tr>
                                <td colspan="4" class="text-center">Belum ada tugas</td>
                            </tr>
                        @else
                            @foreach ($tasks as $task)
                                <tr>
                                    <td><a
                                            href="{{ route('teacher.detail_task', $task->id) }}">{{ $task->user->userProfile->name }}</a>
                                    </td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->clinicalRotation->name }}</td>
                                    <td>{{ $task->category->name }}</td>
                                </tr>
                            @endforeach
                        @endif
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
</x-teacher.layout>
