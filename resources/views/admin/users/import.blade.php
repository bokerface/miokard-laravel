<x-admin.layout>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Data Mahasiswa</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.store_imported_users') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">File spreadsheet</label>
                    <input type="file" name="file" class="form-control @error('name') is-invalid @enderror"
                        id="file">
                    @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Import</button>
            </form>
        </div>
    </div>

</x-admin.layout>
