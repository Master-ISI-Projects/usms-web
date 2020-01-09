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
            <div class="col-md-4">
                <div class="row icon-cards-row mt-0">
                    <div class="col-md-6 mb-4">
                        <div class="card grad-blue">
                            <div class="card-body text-center">
                                <i class="iconsminds-digital-drawing text-white text-shadow-slow"></i>
                                <p class="card-text text-white text-shadow-slow font-weight-semibold mt-1 mb-0">Cours d'aujourdhui</p>
                                <p class="lead text-white text-shadow-slow text-center">{{ $todayCourses->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card grad-green">
                            <div class="card-body text-center">
                                <i class="iconsminds-sand-watch-2 text-white text-shadow-slow"></i>
                                <p class="card-text text-white text-shadow-slow font-weight-semibold mt-1 mb-0">Nombre d'heurs</p>
                                <p class="lead text-white text-shadow-slow text-center">{{ $countHours }} hrs</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-header-light icon-button">
                                    <i class="simple-icon-refresh"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Cours d'aujourdhui</h5>
                                <div class="scroll" style="height: 290px">
                                    @forelse ($todayCourses as $course)
                                        <div class="d-flex flex-row {!! $loop->last ? '' : 'border-bottom mb-3 pb-3' !!}">
                                            <a class="d-flex" href="{{ route('student.students.course', ['id' => $course->id]) }}">
                                                <div class="rounded-circle align-self-center list-thumbnail-letters small" style="background: {{ $course->module->color  }}">
                                                    {{ Helper::formatDate($course->published_at, 'h:i') }}
                                                </div>
                                            </a>
                                            <div class="pl-3">
                                                <a href="{{ route('student.students.course', ['id' => $course->id]) }}">
                                                    <p class="list-item-heading mb-2">{{ $course->title }}</p>
                                                    <div class="pr-4 d-none d-sm-block">
                                                        <p class="text-muted mb-1 text-small">{{ $course->module->title }}</p>
                                                    </div>
                                                    <div class="text-muted text-small d-none d-sm-block">Par : {{ $course->teacher->user->full_name }}</div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Aucun cours.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <course-calendar :class-id="{{ $classId }}"></course-calendar>
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
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Init
            runClock();

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