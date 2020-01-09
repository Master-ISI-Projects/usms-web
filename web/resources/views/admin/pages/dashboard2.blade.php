@extends('layouts.master')

@section('title', 'Tableau de bord')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Tableau de bord</h1>
                <div class="top-right-button-container">
                    <h1 id="clock"></h1>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de bord</a>
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row icon-cards-row mt-0">
                    <div class="col mb-4">
                        <a href="{{ route('students.index') }}">
                            <div class="card grad-blue">
                                <div class="card-body text-center">
                                    <i class="iconsminds-student-male-female text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Etudiants</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countStudentInCurrentYear }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-4">
                        <a href="{{ route('teachers.index') }}">
                            <div class="card grad-green">
                                <div class="card-body text-center">
                                    <i class="iconsminds-business-man-woman text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Enseignants</p>
                                        <p class="lead text-white text-shadow-slow text-center">{{ $countTeachers }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-4">
                        <a href="{{ route('levels.index') }}">
                            <div class="card grad-black">
                                <div class="card-body text-center">
                                    <i class="iconsminds-three-arrow-fork text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Niveaux</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countLevelsInCurrentYear }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-4">
                        <a href="{{ route('classes.index') }}">
                            <div class="card grad-pink">
                                <div class="card-body text-center">
                                    <i class="simple-icon-grid text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Classes</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countClassesInCurrentYear }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-4">
                        <a href="{{ route('admins.index') }}">
                            <div class="card grad-orange">
                                <div class="card-body text-center">
                                    <i class="iconsminds-male-female text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Administrateurs</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countAdmins }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="simple-icon-refresh"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right mt-3">
                            <a class="dropdown-item" href="#">Sales</a>
                            <a class="dropdown-item" href="#">Orders</a>
                            <a class="dropdown-item" href="#">Refunds</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sales</h5>
                        <div class="dashboard-line-chart chart">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Product Categories</h5>
                        <div class="dashboard-donut-chart chart">
                            <canvas id="studentsPerSecationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin-stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/owl.carousel.min.css') }}">
@endsection

@section('plugin-javascript')
    <script src="{{ asset('assets/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/locale-all.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/chartjs-plugin-datalabels.js') }}"></script>
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Init
            runClock();

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 4,
                        nav: false
                    }
                }
            });

            var Q=document.getElementById("studentsPerSecationChart").getContext("2d"); new Chart(Q, {
                type: "doughnut",
                options: {plugins:{datalabels:{display:!1}},responsive:!0,maintainAspectRatio:!1,legend:{position:"bottom",labels:{padding:30,usePointStyle:!0,fontSize:12}}},
                data:{datasets:[{label:"Stock",borderWidth:2,data:[80,90,50]}],labels:["Cakes","Desserts","Cupcakes"]}});

            function runClock() {
                var now = new Date();
                var months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
                var time = now.getHours() + ':' + now.getMinutes(), date = [now.getDate(), months[now.getMonth()], now.getFullYear()].join(' ');

                $('#clock').html(date + ' - ' + time);

                setTimeout(runClock, 1000);
            }
        })
    </script>
@endsection