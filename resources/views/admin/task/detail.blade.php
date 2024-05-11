<x-admin.layout>
    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Tugas</h1>
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
            @csrf
            @method('PUT')
            <div class="form-group d-flex">
                <label for="title" class="col-sm-2 col-form-label">
                    Judul
                </label>
                <span class="form-control col-sm-10">
                    {{ $task->title }}
                </span>
            </div>
            <div class="form-group d-flex">
                <label for="description" class="col-sm-2 col-form-label">
                    Deskripsi
                </label>

                <p class="form-control col-sm-10">
                    {{ $task->description }}
                </p>
            </div>
            <div class="form-group d-flex">
                <label for="category_id" class="col-sm-2 col-form-label">
                    Kategori
                </label>
                <p class="form-control col-sm-10">
                    {{ $task->category->name }}
                </p>
            </div>
            <div class="form-group d-flex">
                <label for="file" class="col-sm-2 col-form-label">
                    File Tugas
                </label>
                <div class="col-sm-10">
                    <div class="d-flex">
                        <div class="col-sm-2">
                            <a href="{{ route('file.preview') . '?f=' . $task->file }}"
                                class="btn btn-success btn-block" target="_blank">
                                File Tugas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex">
                <label for="presentation_file" class="col-sm-2 col-form-label">
                    File Presentasi
                </label>
                <div class="col-sm-10">
                    <div class="d-flex">
                        <div class="col-sm-2">
                            <a href="{{ route('file.preview') . '?f=' . $task->presentation_file }}"
                                class="btn btn-success btn-block" target="_blank">
                                File Presentasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    @endpush
</x-admin.layout>
