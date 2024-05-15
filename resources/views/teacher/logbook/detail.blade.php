<x-teacher.layout>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Logbook PPDS</h1>
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
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group d-flex">
                <label for="title" class="col-sm-2 col-form-label">
                    Judul
                </label>
                <span class="form-control col-sm-10">
                    {{ $logbook->title }}
                </span>
            </div>
            <div class="form-group d-flex">
                <label for="description" class="col-sm-2 col-form-label">
                    Deskripsi
                </label>

                <p class="form-control col-sm-10">
                    {{ $logbook->description }}
                </p>
            </div>
            <div class="form-group d-flex">
                <label for="title" class="col-sm-2 col-form-label">
                    Tanggal Kegiatan
                </label>
                <span class="form-control col-sm-10">
                    {{ $logbook->date }}
                </span>
            </div>
            <div class="form-group d-flex">
                <label for="title" class="col-sm-2 col-form-label">
                    Nama Patient
                </label>
                <span class="form-control col-sm-10">
                    {{ $logbook->patient_name }}
                </span>
            </div>
            <div class="form-group d-flex">
                <label for="description" class="col-sm-2 col-form-label">
                    Jenis Tindakan
                </label>
                <p class="form-control col-sm-10">
                    {{ $logbook->type_of_action }}
                </p>
            </div>
        </div>
    </div>

    @push('js')
    @endpush
</x-teacher.layout>
