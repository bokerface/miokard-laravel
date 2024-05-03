<x-student.layout>
    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Tugas</h1>
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
            <form action="{{ route('student.update_task', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group d-flex">
                    <label for="title" class="col-sm-2 col-form-label">
                        Judul
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') ?? $task->title }}"
                        class="form-control col-sm-10 {{ $errors->has('title') ? 'is-invalid' : '' }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                <div class="form-group d-flex">
                    <label for="description" class="col-sm-2 col-form-label">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control col-sm-10 {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') ?? $task->description }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="form-group d-flex">
                    <label for="category_id" class="col-sm-2 col-form-label">
                        Kategori
                    </label>
                    <select name="category_id" id="category_id"
                        class="form-control col-sm-10 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id') ? (old('category_id') == $category->id ? 'selected' : '') : $task->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group d-flex">
                    <label for="file" class="col-sm-2 col-form-label">
                        File Tugas
                    </label>
                    <div class="col-sm-10">
                        <div class="d-flex">
                            <input type="file" id="file" name="file"
                                class="form-control col-sm-10 {{ $errors->has('file') ? 'is-invalid' : '' }}">
                            <div class="col-sm-2">
                                <a href="{{ route('file.preview') . '?f=' . $task->file }}"
                                    class="btn btn-success btn-block" target="_blank">
                                    File Tugas
                                </a>
                            </div>
                        </div>
                        @if ($errors->has('file'))
                            <div class="text-danger">
                                {{ $errors->first('file') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label for="presentation_file" class="col-sm-2 col-form-label">
                        File Presentasi
                    </label>
                    <div class="col-sm-10">
                        <div class="d-flex">
                            <input type="file" id="presentation_file" name="presentation_file"
                                class="form-control col-sm-10 {{ $errors->has('presentation_file') ? 'is-invalid' : '' }}">
                            <div class="col-sm-2">
                                <a href="{{ route('file.preview') . '?f=' . $task->presentation_file }}"
                                    class="btn btn-success btn-block" target="_blank">
                                    File Presentasi
                                </a>
                            </div>
                        </div>
                        @if ($errors->has('presentation_file'))
                            <div class="text-danger">
                                {{ $errors->first('presentation_file') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
    </div>



    @push('js')
    @endpush
</x-student.layout>
