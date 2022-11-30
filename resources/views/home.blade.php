@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Data Penduduk</p>
                            <h4 class="my-1 text-info">{{ $total_penduduk }}</h4>
                            {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                            <i class='bx bxs-user-circle'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Data Kecamatan</p>
                            <h4 class="my-1 text-danger">{{ $total_kecamatan }}</h4>
                            {{-- <p class="mb-0 font-13">+5.4% from last week</p> --}}
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                            <i class='bx bxs-dice-5'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Data Desa</p>
                            <h4 class="my-1 text-success">{{ $total_desa }}</h4>
                            {{-- <p class="mb-0 font-13">-4.5% from last week</p> --}}
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                            <i class='bx bxs-dice-3'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Bantuan</p>
                            <h4 class="my-1 text-warning">{{ $total_bantuan }}</h4>
                            {{-- <p class="mb-0 font-13">+8.4% from last week</p> --}}
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                            <i class='bx bxs-donate-heart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Data Bantuan</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #14abef"></i>Bantuan</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            {{-- <h5 class="mb-0">24.15M</h5> --}}
                            <small class="mb-0">Total Data Penduduk<span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                    {{ $total_penduduk }}</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            {{-- <h5 class="mb-0">12:38</h5> --}}
                            <small class="mb-0">Total Data Desa <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                    {{ $total_desa }}</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            {{-- <h5 class="mb-0">639.82</h5> --}}
                            <small class="mb-0">Total Bantuan <span id="total_bantuan"><i
                                        class="bx bx-up-arrow-alt align-middle"></i></span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Data Bantuan</h6>
                        </div>
                    </div>
                    <div class="chart-container-2 mt-4">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Jeans <span
                            class="badge bg-success rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">T-Shirts
                        <span class="badge bg-danger rounded-pill">10</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Shoes
                        <span class="badge bg-primary rounded-pill">65</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Lingerie
                        <span class="badge bg-warning text-dark rounded-pill">14</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection


@push('customjs')
    <script>
        const cart1 = (label, data) => {
            var ctx = document.getElementById("chart1").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#6078ea');
            gradientStroke1.addColorStop(1, '#17c5ea');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#ff8359');
            gradientStroke2.addColorStop(1, '#ffdf40');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Bantuan',
                        data: data,
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 0
                    }]
                },

                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: .5
                        }]
                    }
                }
            });
        }

        const cart2 = (label, data) => {
            var ctx = document.getElementById("chart2").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#fc4a1a');
            gradientStroke1.addColorStop(1, '#f7b733');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#4776e6');
            gradientStroke2.addColorStop(1, '#8e54e9');


            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#ee0979');
            gradientStroke3.addColorStop(1, '#ff6a00');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#42e695');
            gradientStroke4.addColorStop(1, '#3bb2b8');

            var gradientStroke5 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke5.addColorStop(0, '#810CA8');
            gradientStroke5.addColorStop(1, '#C147E9');

            var gradientStroke6 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke6.addColorStop(0, '#E8C4C4');
            gradientStroke6.addColorStop(1, '#F2E5E5');

            var gradientStroke7 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke7.addColorStop(0, '#7FE9DE');
            gradientStroke7.addColorStop(1, '#A5F1E9');

            var gradientStroke8 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke8.addColorStop(0, '#9C254D');
            gradientStroke8.addColorStop(1, '#D23369');

            var gradientStroke9 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke9.addColorStop(0, '#3B185F');
            gradientStroke9.addColorStop(1, '#00005C');

            var gradientStroke10 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke10.addColorStop(0, '#735F32');
            gradientStroke10.addColorStop(1, '#735F32');

            var gradientStroke11 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke11.addColorStop(0, '#F49D1A');
            gradientStroke11.addColorStop(1, '#FFE15D');

            var gradientStroke12 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke12.addColorStop(0, '#0D4C92');
            gradientStroke12.addColorStop(1, '#59C1BD');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: label,
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5,
                            gradientStroke6,
                            gradientStroke7,
                            gradientStroke8,
                            gradientStroke9,
                            gradientStroke10,
                            gradientStroke11,
                            gradientStroke12,
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5,
                            gradientStroke6,
                            gradientStroke7,
                            gradientStroke8,
                            gradientStroke9,
                            gradientStroke10,
                            gradientStroke11,
                            gradientStroke12,
                        ],
                        data: data,
                        borderWidth: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    }
                }
            });
        }
        $(document).ready(function() {
            const data = {
                label: []
            }
        })

        $.ajax({
            url: '{{ route('home.cart') }}',
            method: 'get',
            data: {
                data: 'cart1'
            },
            success: function(res) {
                const label = res.map((el) => el.month)
                const count = res.map((el) => el.count)
                const total_bantuan = res.reduce((prev, next) => prev + parseInt(next.count), 0)
                cart1(label, count)
                cart2(label, count)
                $("#total_bantuan").html(`<i class="bx bx-up-arrow-alt align-middle"></i> ${total_bantuan}`)
                let list = ''
                const color = [
                    '#fc4a1a',
                    '#4776e6',
                    '#ee0979',
                    '#42e695',
                    '#810CA8',
                    '#E8C4C4',
                    '#7FE9DE',
                    '#9C254D',
                    '#3B185F',
                    '#735F32',
                    '#F49D1A',
                    '#0D4C92',
                ];
                res.map((el, index) => {
                    list += `<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">${el.month} <span
                            class="badge rounded-pill" style="background-color:${color[index]}">${el.count}</span>
                            </li>`
                })
                $('.list-group').html(list)
            }
        })
    </script>
@endpush
