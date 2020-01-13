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
            <div class="col-lg-12 col-xl-8">
                <div class="icon-cards-row">
                    <div class="owl-container">
                        <div class="owl-carousel dashboard-numbers">
                            <a class="card grad-blue" href="{{ route('students.index') }}">
                                <div class="card-body text-center">
                                    <i class="iconsminds-student-male-female text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Etudiants</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countStudentInCurrentYear }}</p>
                                </div>
                            </a>
                            <a class="card grad-green" href="{{ route('teachers.index') }}">
                                <div class="card-body text-center">
                                    <i class="iconsminds-business-man-woman text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Enseignants</p>
                                        <p class="lead text-white text-shadow-slow text-center">{{ $countTeachers }}</p>
                                </div>
                            </a>
                            <a class="card grad-black" href="{{ route('levels.index') }}">
                                <div class="card-body text-center">
                                    <i class="iconsminds-three-arrow-fork text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Niveaux</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countLevelsInCurrentYear }}</p>
                                </div>
                            </a>
                            <a class="card grad-pink" href="{{ route('classes.index') }}">
                                <div class="card-body text-center">
                                    <i class="simple-icon-grid text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Classes</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countClassesInCurrentYear }}</p>
                                </div>
                            </a>
                            <a class="card grad-orange" href="{{ route('admins.index') }}">
                                <div class="card-body text-center">
                                    <i class="iconsminds-male-female text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Administrateurs</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countAdmins }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Nombre des etudiants par niveau</h5>
                                <div class="dashboard-donut-chart chart">
                                    <canvas id="studentsPerSecationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Nombre des etudiants par niveau</h5>
                                <div class="dashboard-donut-chart chart">
                                    <canvas id="studentsPerSecationChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Etudiants non inscrits</h5>

                        <div class="scroll dashboard-list-with-user">
                            @forelse ($unRegisterdStudents as $student)
                                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                    <a href="{{ route('students.show', ['id' => $student->id]) }}">
                                        <img src="{{ $student->user->picture_path }}" alt="Mayra Sibley" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                    </a>
                                    <div class="pl-3">
                                        <a href="{{ route('students.show', ['id' => $student->id]) }}">
                                            <p class="font-weight-medium mb-0">{{ $student->user->full_name }}</p>
                                            <p class="text-muted mb-0 text-small">{{ $student->registration_number }}</p>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Aucune données ...</p>
                            @endforelse
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
                margin: 20,
                responsiveClass: true,
                autoplay:true,
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

            var studentsPerSecationChartElement = document.getElementById("studentsPerSecationChart").getContext("2d");
            new Chart(studentsPerSecationChartElement, {
                type: "pie",
                options: {
                    plugins:{
                        datalabels: { display: !1 } },
                        responsive: !0,
                        maintainAspectRatio:!1, legend: { position:"bottom", labels: { padding: 30, usePointStyle: !0, fontSize:12 } }
                    },
                data: {
                    datasets: [{
                        borderColor: @json($studentsPerSection['colors']),
                        backgroundColor: @json($studentsPerSection['backgroundColors']),
                        borderWidth: 2,
                        data: @json($studentsPerSection['data'])
                    }],
                    labels: @json($studentsPerSection['labels'])
                }
            });

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
