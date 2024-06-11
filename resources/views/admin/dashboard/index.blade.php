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
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Mahasiswa Berdasarkan Stase</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="studentsByClinicalRotation"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Mahasiswa Berdasarkan Angkatan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="studentsByYear"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="card shadow mb-4">
        <div class="card-body">

        </div>
    </div> --}}



    @push('js')
        {{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

        <script>
            $.ajax({
                url: "{{ route('admin.dashboard') }}",
                method: "GET",
                dataType: 'JSON',
                async: true,
            }).done(function(data) {
                new Chart(document.getElementById('studentsByYear'), {
                    type: 'bar',
                    data: {
                        labels: data.entryYear.map(row => row.year),
                        datasets: [{
                            label: 'Jumlah Mahasiswa Berdasarkan Angkatan',
                            barThickness: 10,
                            indexAxis: 'y',
                            data: data.entryYear.map(row => row.count),
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        animation: false,
                        plugins: {
                            legend: {
                                display: true
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                                }
                            }
                        },
                    }
                });

                new Chart(document.getElementById('studentsByClinicalRotation'), {
                    type: 'bar',
                    data: {
                        labels: data.clinicalRotation.map(row => row.clinicalRotation),
                        datasets: [{
                            label: 'Jumlah Mahasiswa Berdasarkan Stase',
                            barThickness: 15,
                            barPercentage: 0.5,
                            categoryPercentage: 0.5,
                            indexAxis: 'x',
                            data: data.clinicalRotation.map(row => row.count),
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 5,
                                right: 5,
                                top: 5,
                                bottom: 0
                            }
                        },
                        animation: true,
                        plugins: {
                            legend: {
                                display: true
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        // legend: {
                        //     display: false
                        // },
                        tooltips: {
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                                }
                            }
                        },
                    }
                })
            })
        </script>
    @endpush
</x-admin.layout>
