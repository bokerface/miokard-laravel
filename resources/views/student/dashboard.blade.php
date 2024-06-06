<x-student.layout>
    {{-- 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div> --}}

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
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>Selamat Datang <strong>{{ $user->userProfile->name }}</strong></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <h6 class="col-3">Stase Saat Ini</h6>
                        <h6>
                            <strong>{{ $user->activeClinicalRotation->clinicalRotation->name }}</strong>
                        </h6>
                    </div>
                    @if ($user->mentor != null)
                        <div class="row">
                            <h6 class="col-3">Pembimbing</h6>
                            <h6>
                                <strong>{{ $user->mentor->mentorUser->userProfile->name }}</strong>
                            </h6>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('js')
    @endpush
</x-student.layout>
