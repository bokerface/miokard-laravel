<x-student.layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Logbook</h1>
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
                <form action="{{ route('student.store_logbook') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-form-label">Judul Logbook</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Deskripsi</label>
                        <textarea id="description" name="description" value="{{ old('description') }}"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="5">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-form-label">Tanggal Kegiatan</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}"
                            class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}">
                        @if ($errors->has('date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="patient_name" class="col-form-label">Nama Pasien</label>
                        <input type="text" id="patient_name" name="patient_name" value="{{ old('patient_name') }}"
                            class="form-control {{ $errors->has('patient_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('patient_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('patient_name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="patient_gender" class="col-form-label">Jenis Kelamin Pasien</label>
                        <select id="patient_gender" name="patient_gender" value="{{ old('patient_gender') }}"
                            class="form-control {{ $errors->has('patient_gender') ? 'is-invalid' : '' }}">
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->value }}">{{ $gender->value }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('patient_gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('patient_gender') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="patient_age" class="col-form-label">Usia Pasien</label>
                        <input type="number" id="patient_age" name="patient_age" value="{{ old('patient_age') }}"
                            class="form-control {{ $errors->has('patient_age') ? 'is-invalid' : '' }}">
                        @if ($errors->has('patient_age'))
                            <div class="invalid-feedback">
                                {{ $errors->first('patient_age') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="type_of_action" class="col-form-label">Jenis Tindakan</label>
                        <textarea id="type_of_action" name="type_of_action" value="{{ old('type_of_action') }}"
                            class="form-control {{ $errors->has('type_of_action') ? 'is-invalid' : '' }}" cols="30" rows="5">{{ old('type_of_action') }}</textarea>
                        @if ($errors->has('type_of_action'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type_of_action') }}
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>
</x-student.layout>
