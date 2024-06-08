<x-admin.layout>


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
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>Selamat Datang Admin</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @foreach ($clinicalRotations as $clinicalRotation)
                        <div class="row">
                            <div class="col-4">
                                <span>{{ $clinicalRotation->name }}</span>
                            </div>
                            <div class="col-8">
                                <div class="progress">
                                    <div class="progress-bar w-{{ ($clinicalRotation->students->count() / $totalStudents) * 100 }}"
                                        role="progressbar" aria-valuenow="{{ $clinicalRotation->students->count() }}"
                                        aria-valuemin="0" aria-valuemax="{{ $totalStudents }}">
                                        {{ $clinicalRotation->students->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="card shadow mb-4">
        <div class="card-body">

        </div>
    </div> --}}




    @push('js')
    @endpush
</x-admin.layout>
