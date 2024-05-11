<x-student.layout>
    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Logbook Saya</h1>
        <a class="btn btn-primary mb-3" href="{{ route('student.create_logbook') }}">Upload Logbook Baru</a>
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
                            <th>Judul</th>
                            <th>Nama Pasien</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logbooks as $logbook)
                            <tr>
                                <td>
                                    <a href="{{ route('student.edit_logbook', $logbook->id) }}">
                                        {{ $logbook->title }}
                                    </a>
                                </td>
                                <td>{{ $logbook->patient_name }}</td>
                                <td>
                                    <form action="{{ route('student.delete_logbook', $logbook->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Logbook yang sudah dihapus tidak dapat dikembalikan dengan cara apapun. Lanjutkan?')">Hapus
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
</x-student.layout>
