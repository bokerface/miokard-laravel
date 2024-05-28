<x-teacher.layout>
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
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Mahasiswa Bimbingan Saya</h6>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($user->mentees as $mentee)
                            <li class="mb-3">
                                <div class="row">
                                    <div class="col-2">Nama</div>
                                    <div class="col-10">{{ $mentee->menteeUser->userProfile->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-2">Stase</div>
                                    <div class="col-10">
                                        {{ $mentee->menteeUser->activeClinicalRotation->clinicalRotation->name }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-teacher.layout>
