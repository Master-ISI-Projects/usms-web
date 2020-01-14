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
                            <a href="{{ url('home') }}">Tableau de bord</a>
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-8">
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
                            <a class="card grad-black" href="{{ route('departements.index') }}">
                                <div class="card-body text-center">
                                    <i class="iconsminds-three-arrow-fork text-white text-shadow-slow"></i>
                                    <p class="card-text text-white text-shadow-slow text-semibold text-uppercase mt-1 mb-0">Departements</p>
                                    <p class="lead text-white text-shadow-slow text-center">{{ $countDepartements }}</p>
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

                <h5 class="mb-4 mt-2">Dérnier Actualités</h5>
                <div class="row">
                    @foreach ($news  as $newsItem)
                        <div class="col-xs-6 col-md-4 col-12 mb-4">
                            <div class="card">
                                <div class="position-relative">
                                    <img class="card-img-top" src="{{ $newsItem->image_path }}" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('news.show', ['id' => $newsItem->id]) }}">
                                        <p class="list-item-heading mb-4">{{ $newsItem->title }}</p>
                                    </a>
                                    <footer>
                                        <p class="text-muted text-small mb-0 font-weight-light">{{ Helper::formatDate($newsItem->published_at, 'd-m-Y à h:i') }}</p>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Evénements</h5>

                        <div class="scroll dashboard-list-with-user">
                            @forelse ($events as $event)
                                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                    <div>
                                        <a href="{{ route('news.show', ['id' => $event->id]) }}">
                                            <p class="font-weight-medium mb-2">{{ $event->title }}</p>
                                            <p class="text-muted mb-0 text-small">{{ Helper::formatDate($event->published_at, 'd-m-Y à h:i') }}</p>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Aucune événement ...</p>
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
