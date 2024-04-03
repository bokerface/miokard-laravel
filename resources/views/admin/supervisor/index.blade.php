<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supervisor Stase</h1>
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
            @foreach ($clinicalRotations as $clinicalRotation)
                <ul class="list-group mb-3">
                    <li class="list-group-item font-weight-bold bg-primary text-white d-flex justify-content-between">
                        {{ $clinicalRotation->name }}
                        @if ($clinicalRotation->clinicalRotationSupervisor == null)
                            <a href="{{ route('admin.add_supervisor', $clinicalRotation->id) }}"
                                class="btn btn-sm btn-success">
                                Tambah Supervisor
                            </a>
                        @else
                            <a href="{{ route('admin.change_supervisor', $clinicalRotation->id) }}"
                                class="btn btn-sm btn-warning">
                                Ganti Supervisor
                            </a>
                        @endif
                    </li>
                    @if ($clinicalRotation->clinicalRotationSupervisor != null)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $clinicalRotation->clinicalRotationSupervisor->user->userProfile->name }}

                            <form action="{{ route('admin.remove_supervisor', $clinicalRotation->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus Supervisor
                                </button>
                            </form>
                        </li>
                    @endif
                </ul>
            @endforeach
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
