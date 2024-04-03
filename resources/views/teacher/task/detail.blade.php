<x-teacher.layout>
    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Ilmiah</h1>
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
            <div class="mb-3 row">
                <div class="col-3">
                    <span class="font-weight-bold">Nama</span>
                    <br>
                    <span id="title">{{ $task->user->userProfile->name }}</span>
                </div>
                <div class="col-3">
                    <span class="font-weight-bold">Stase</span>
                    <br>
                    <span id="title">{{ $task->clinicalRotation->name }}</span>
                </div>
                <div class="col-3">
                    <span class="font-weight-bold">Kategori</span>
                    <br>
                    <span id="title">{{ $task->category->name }}</span>
                </div>
                <div class="col-3">
                    <span class="font-weight-bold">Status</span>
                    <br>
                    <span id="title">
                        @if ($task->status)
                            <span class="badge badge-success">Disetujui</span>
                        @else
                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                        @endif
                    </span>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <span class="font-weight-bold">Judul</span>
                <br>
                <span id="title">{{ $task->title }}</span>
            </div>
            <div class="mb-3">
                <span class="font-weight-bold">Deskripsi</span>
                <br>
                <span id="title">
                    {{ $task->description }}
                </span>
            </div>
            <hr>
            <div class="mb-3 d-flex">
                <div class="mr-3">
                    <a href="{{ route('teacher.download_task_file', $task->id) . '?f=' . $task->file }}"
                        class="btn btn-outline-success">
                        download pdf
                    </a>
                </div>
                <div class="mr-3">
                    <a href="{{ route('teacher.download_task_file', $task->id) . '?f=' . $task->presentation_file }}"
                        class="btn btn-outline-danger">
                        download file presentasi
                    </a>
                </div>
            </div>
            @if ($isSupervisor)
                @if ($task->status != 1)
                    <hr>
                    <div class="mb-3 d-flex">
                        <div class="mr-3">
                            <a href="{{ route('teacher.approve_task', $task->id) }}"
                                onclick="return confirm('Status Ilmiah yang telah disetujui tidak dapat dikembalikan. Lanjutkan?')"
                                class="btn btn-outline-success">
                                Setujui Ilmiah
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    @push('js')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
    @endpush
</x-teacher.layout>
