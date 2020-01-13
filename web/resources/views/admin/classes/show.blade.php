@extends('layouts.master')

@section('title', $classe->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ $classe->name }}</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('classes.index') }}">Classes</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $classe->name }}</li>
                    </ol>
                </nav>
                <div class="mb-2"></div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-5 col-xl-4 col-left">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>{{ $classe->name }}</h4>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Departement</p>
                            <p class="mb-3">{{ $classe->option->departement->name }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Option</p>
                            <p class="mb-3">{{ $classe->option->name }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Année scolaire</p>
                            <p class="mb-0">{{ $classe->scholarYear->scholar_year }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 w-100 text-uppercase">
                                Etudiants
                                    <span class="float-right text-muted text-primary">{{ $classe->students()->count() }}</span>
                            </h6>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 w-100 text-uppercase">
                                Semestres
                                <span class="float-right text-muted text-primary">{{ $classe->semesters()->count() }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 col-right">
                    <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="first-tab" data-toggle="tab" href="#students-tab" role="tab" aria-controls="first" aria-selected="true">Etudiants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#semesters-tab" role="tab" aria-controls="second" aria-selected="false">Semestres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#marks-tab" role="tab" aria-controls="second" aria-selected="false">Notes des étudiants</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="students-tab" role="tabpanel" aria-labelledby="students-tab">
                            <div class="row">
                                @forelse ($classe->students as $student)
                                    <div class="col-12 col-md-6">
                                        <div class="card d-flex flex-row mb-4">
                                            <a class="d-flex" href="#">
                                                <img alt="Profile" src="{{ $student->user->picture_path }}" class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
                                            </a>
                                            <div class="d-flex flex-grow-1 min-width-zero">
                                                <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                    <div class="min-width-zero">
                                                        <a href="{{ route('students.show', ['id' => $student->id]) }}">
                                                            <p class="list-item-heading mb-1 truncate">{{ $student->user->full_name }}</p>
                                                        </a>
                                                        <p class="mb-3 text-muted text-small">{{ $student->apogee_number }}</p>
                                                        {!! $student->user->is_active_badge !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {{-- empty expr --}}
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="semesters-tab" role="tabpanel" aria-labelledby="semesters-tab">
                            <div class="sortable-survey">
                                @foreach ($classe->semesters as $semester)
                                    <div class="sub-level">
                                        <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                            <div class="d-flex flex-grow-1 min-width-zero">
                                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                    <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                        <span class="text-uppercase">
                                                            {{ $semester->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class=" pl-1 align-self-center pr-4">
                                                    <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate" type="button" data-toggle="collapse" data-target="#{{ $semester->id }}" aria-expanded="true" aria-controls="{{ $semester->id }}">
                                                        <i class="simple-icon-arrow-down with-rotate-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="question-collapse collapse" id="{{ $semester->id }}">
                                                <div class="card-body pt-0">
                                                    <div id="accordion">
                                                        @foreach ($semester->modules as $module)
                                                            <div class="border mb-2">
                                                                <div class="alert alert-dark mb-0">
                                                                    <span class="cursor-pointer" data-toggle="collapse" data-target="#collapse-{{ $module->id }}" aria-expanded="true" aria-controls="collapse-{{ $module->id }}">{{ $module->name }}</span>
                                                                    <span class="float-right">
                                                                        <button class="header-icon btn btn-empty text-primary p-0 mr-2 btn-add-exam"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-module-name="{{ $module->name }}"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-classe-name="{{ $classe->name }}"
                                                                                data-classe-id="{{ $classe->id }}"
                                                                                type="button">
                                                                            <i class="iconsminds-add"></i>
                                                                        </button>
                                                                        <button class="header-icon btn btn-empty text-bold text-primary p-0 btn-edit-exam"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-module-name="{{ $module->name }}"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-classe-name="{{ $classe->name }}"
                                                                                data-classe-id="{{ $classe->id }}"
                                                                                type="button">
                                                                            <i class="simple-icon-settings"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                                <div id="collapse-{{ $module->id }}" class="collapse" data-parent="#accordion" style="">
                                                                    <ul class="list-group b-rad-0">
                                                                        @foreach ($classe->examsByModuleId($module->id)->get() as $exam)
                                                                            <li class="list-group-item">
                                                                                <span>{{ $exam->name }}</span>
                                                                                <span class="float-right">
                                                                                    <button class="header-icon btn btn-empty text-danger p-0 btn-edit-exam"
                                                                                            data-exam-id="{{ $exam->id }}"
                                                                                            data-exam-name="{{ $exam->name }}"
                                                                                            data-exam-url-update="{{ route('exams.update', ['id' => $exam->id]) }}"
                                                                                            data-exam-url-delete="{{ route('exams.destroy', ['id' => $exam->id]) }}"
                                                                                            type="button">
                                                                                        {{-- <i class="simple-icon-settings"></i> --}}
                                                                                    </button>
                                                                                </span>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="marks-tab" role="tabpanel" aria-labelledby="marks-tab">
                            <div class="sortable-survey">
                                @foreach ($classe->students as $student)
                                    <div class="sub-level">
                                        <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                            <div class="d-flex flex-grow-1 min-width-zero">
                                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                    <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                        <span class="text-uppercase">
                                                            {{ $student->user->full_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class=" pl-1 align-self-center pr-4">
                                                    <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate" type="button" data-toggle="collapse" data-target="#tab-marks-{{ $student->id }}" aria-expanded="true" aria-controls="tab-marks-{{ $student->id }}">
                                                        <i class="simple-icon-arrow-down with-rotate-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="question-collapse collapse" id="tab-marks-{{ $student->id }}">
                                                <div class="card-body pt-0">
                                                   <div id="accordion">
                                                        @foreach ($semester->modules as $module)
                                                            <div class="border mb-2">
                                                                <div class="alert alert-danger mb-0">
                                                                    <span class="cursor-pointer" data-toggle="collapse" data-target="#collapse-marks-{{ $module->id . $student->id }}" aria-expanded="true" aria-controls="collapse-marks-{{ $module->id . $student->id }}">{{ $module->name }}</span>
                                                                </div>
                                                                <div id="collapse-marks-{{ $module->id . $student->id }}" class="collapse" data-parent="#accordion" style="">
                                                                    <form action="{{ route('marks.store') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="classe_id" value="{{ $classe->id }}">
                                                                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                                                                        <ul class="list-group b-rad-0">
                                                                            @foreach ($module->exams as $exam)
                                                                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                                                                <li class="list-group-item">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4 pt-2">
                                                                                            <b>{{ $exam->name }}</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="marks[]" placeholder=" Note ...">
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                            <li class="list-group-item">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 pt-2">
                                                                                        <b class="text-danger">Note de module</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text" class="form-control" name="general_note" placeholder=" Note de module ...">
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <button class="btn default btn-danger float-right">Enregistrer</button>
                                                                            </li>
                                                                        </ul>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
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
    </div>
</div>

{{-- Modals --}}
<div class="modal" id="modal-add-exam" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('exams.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nouveau Examen : <span id="module_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Examen</label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Examen">
                    </div>
                    <div class="form-group">
                        <label for="duration">Durée</label>
                        <input type="text" required class="form-control" name="duration" id="duration" placeholder="Durée">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type">
                            @foreach (Constant::EXAM_TYPES as $type)
                                <option {{ old('type') == $type ? 'selected' : '' }} value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="session">Session</label>
                        <select name="session" class="form-control" id="session">
                            @foreach (Constant::EXAM_SESSIONS as $session)
                                <option {{ old('session') == $session ? 'selected' : '' }} value="{{ $session }}">{{ $session }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" required name="module_id" id="module_id">
                    <input type="hidden" required name="classe_id" id="classe_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-stylesheet')
    <style>
        .card-panel .card-body {
            padding: 1.3rem !important;
        }
    </style>
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Events
            $('.btn-add-exam').click(function () {
                var modal = $('#modal-add-exam');
                modal.find('#module_id').val($(this).data('module-id'));
                modal.find('#module_name').text($(this).data('module-name'));
                modal.find('#classe_id').val($(this).data('classe-id'));
                modal.modal();
            });
        });
    </script>
@endsection
