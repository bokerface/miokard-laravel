<x-admin.layout>

    @push('css')
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ganti Supervisor Stase {{ $clinicalRotation->name }}</h1>
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
            <div class="mb-3">
                <span class="font-weight-bold">Supervisor saat ini :</span>
                <span>
                    {{ $clinicalRotation->clinicalRotationSupervisor->user->userProfile->name }}
                </span>
            </div>
            <hr>
            <form action="{{ route('admin.update_supervisor', $clinicalRotation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="user_id">Pilih Dosen</label>
                <select class="js-example-basic-single form-control" id="user_id" name="user_id">
                </select>
                <button type="submit" class="btn btn-primary btn-block mt-3">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    @push('js')
        <!-- Page level plugins -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    placeholder: "Cari berdasarkan nama dosen",
                    theme: "bootstrap",
                    ajax: {
                        url: "{{ route('admin.get_supervisor_by_name') }}",
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'public'
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: $.map(data, function(user) {
                                    return {
                                        text: user.user_profile.name,
                                        id: user.id
                                    }
                                })
                            };
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin.layout>
