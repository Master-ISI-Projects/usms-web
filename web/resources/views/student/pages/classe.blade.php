@extends('layouts.master')

@section('title', 'Classe')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ $classe->title }}</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ma Classe</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-4 col-left">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>{{ $classe->title }}</h4>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Niveau scolaire</p>
                            <p class="mb-3">{{ $classe->subLevel->level->title }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Section</p>
                            <p class="mb-3">{{ $classe->subLevel->title }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Etudiants</p>
                            <p class="mb-3">{{ $classe->students()->count() }} Etudiants</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Modules</p>
                            <p class="mb-3">{{ $classe->modules()->count() }} Module(s)</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Annee scolaire</p>
                            <p class="mb-0">{{ $classe->scholarYear->scholar_year }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 col-right">
                    <div class="sortable-survey">
                        @foreach ($classe->modules as $module)
                            <div class="sub-level">
                                <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                <span class="log-indicator border-theme-1 mr-1" style="border-color: {{ $module->color }} !important"></span>
                                                <span class="text-uppercase">
                                                    {{ $module->title }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class=" pl-1 align-self-center pr-4">
                                            <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate" type="button" data-toggle="collapse" data-target="#{{ $module->id }}" aria-expanded="true" aria-controls="{{ $module->id }}">
                                                <i class="simple-icon-arrow-down with-rotate-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="question-collapse collapse" id="{{ $module->id }}">
                                        <div class="card-body pt-0">
                                            <div class="border-bottom mb-3"></div>
                                            @foreach ($module->courses as $course)
                                                <div class="d-flex flex-row pb-3 {!! $loop->last ? '' : 'border-bottom mb-3' !!} justify-content-between align-items-center">
                                                    <div class="pl-3 flex-fill">
                                                        <a href="{{ route('student.students.course', ['id' => $course->id]) }}">
                                                            <p class="font-weight-semibold text-primary mb-0">{{ $course->title }}</p>
                                                            <p class="text-muted mb-3 mt-1 text-small">
                                                                {{ substr($course->description, 0, 50) }}
                                                            </p>
                                                            <p class="text-muted mb-0 mt-1 text-small">
                                                                <b>Publier le : </b>
                                                                {{ Helper::formatDate($course->published_at, 'd.m.Y à h:i') }}
                                                            </p>
                                                            <p class="text-muted mb-0 mt-1 text-small">
                                                                <b>Enseignant : </b>
                                                                {{ $course->teacher->user->full_name }}
                                                            </p>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-outline-success btn-xs" href="{{ route('student.students.course', ['id' => $course->id]) }}">Details</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugin-stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fullcalendar.min.css') }}">
@endsection

@section('plugin-javascript')
    <script src="{{ asset('assets/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/locale-all.js') }}"></script>
@endsection

@section('custom-stylesheet')
    <style>
        .card-panel .card-body {
            padding: 1.3rem !important;
        }
    </style>
@endsection
