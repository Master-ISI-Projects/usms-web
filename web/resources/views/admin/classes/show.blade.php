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
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="4-tab" data-toggle="tab" href="#notifications-tab" role="tab" aria-controls="second" aria-selected="false">Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="4-tab" data-toggle="tab" href="#attachements-tab" role="tab" aria-controls="second" aria-selected="false">Documents Attachées</a>
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
                                                                        <button class="header-icon btn btn-empty text-primary p-0 btn-add-exam"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-module-name="{{ $module->name }}"
                                                                                data-module-id="{{ $module->id }}"
                                                                                data-classe-name="{{ $classe->name }}"
                                                                                data-classe-id="{{ $classe->id }}"
                                                                                type="button">
                                                                            <i class="iconsminds-add"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                                <div id="collapse-{{ $module->id }}" class="collapse" data-parent="#accordion" style="">
                                                                    <ul class="list-group b-rad-0">
                                                                        @foreach ($classe->examsByModuleId($module->id)->get() as $exam)
                                                                            <li class="list-group-item">
                                                                                <div class="row">
                                                                                    <span class="col-md-3"><b>{{ $exam->name }}</b></span>
                                                                                    <span class="col-md-3"><b>Durée</b>: {{ $exam->duration }}</span>
                                                                                    <span class="col-md-2"><b>Type</b>: {{ $exam->type }}</span>
                                                                                    <span class="col-md-3"><b>Session</b>: {{ $exam->session }}</span>
                                                                                    <span class="col-md-1">
                                                                                        <button class="header-icon btn btn-empty text-danger p-0 btn-edit-exam"
                                                                                                data-exam-id="{{ $exam->id }}"
                                                                                                data-exam-name="{{ $exam->name }}"
                                                                                                data-exam-type="{{ $exam->type }}"
                                                                                                data-exam-duration="{{ $exam->duration }}"
                                                                                                data-exam-session="{{ $exam->session }}"
                                                                                                data-exam-url-update="{{ route('exams.update', ['id' => $exam->id]) }}"
                                                                                                data-exam-url-delete="{{ route('exams.destroy', ['id' => $exam->id]) }}"
                                                                                                type="button">
                                                                                            <i class="simple-icon-settings"></i>
                                                                                        </button>
                                                                                    </span>
                                                                                </div>
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
                                                        @foreach ($classe->semesters as $semester)
                                                            <h3 class="border-bottom mb-3 {!! $loop->first ? '' : 'mt-4' !!}">Notes la semestre : {{ $semester->name }}</h3>
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
                                                                                                <input type="text" class="form-control" name="marks[]" placeholder="Note ...">
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
                                                                                            <input type="text" class="form-control" name="general_note" placeholder="Note de module ...">
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
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notifications-tab" role="tabpanel" aria-labelledby="notifications-tab">
                            <div class="sortable-survey">
                                <div class="sub-level">
                                    <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                    <span class="text-uppercase">
                                                        Notifications
                                                    </span>
                                                </div>
                                            </div>
                                            <div class=" pl-1 align-self-center pr-4">
                                                <button class="btn btn-outline-theme-3 icon-button" data-toggle="modal" data-target="#modal-add-notification">
                                                    <i class="iconsminds-add"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="question-collapse collapse show" id="notifications-tab-content">
                                            <div class="card-body pt-0">
                                                <div class="border-bottom mb-3"></div>
                                                @foreach ($classe->notifications as $notification)
                                                    <div class="d-flex flex-row pb-3 {!! $loop->last ? '' : 'border-bottom mb-3' !!} justify-content-between align-items-center">
                                                        <div class="pl-3 flex-fill">
                                                            <p class="font-weight-semibold text-primary mb-0">{{ $notification->title }}</p>
                                                            <p class="text-muted mb-3 mt-1 text-small">
                                                                {{ $notification->content }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-link text-success btn-xs btn-edit-notification"
                                                                    data-notification-id="{{ $notification->id }}"
                                                                    data-notification-title="{{ $notification->title }}"
                                                                    data-notification-content="{{ $notification->content }}"
                                                                    data-notification-url-update="{{ route('notifications.update', ['id' => $notification->id]) }}"
                                                                    data-notification-url-delete="{{ route('notifications.destroy', ['id' => $notification->id]) }}">
                                                                <i class="simple-icon-pencil"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="question-collapse collapse show" id="notifications-tab-content">
                                            <div class="card-body pt-0">
                                                <div class="border-bottom mb-3"></div>
                                                @foreach ($classe->attachements as $attachement)
                                                    <div class="d-flex flex-row pb-3 {!! $loop->last ? '' : 'border-bottom mb-3' !!} justify-content-between align-items-center">
                                                        <div class="pl-3 flex-fill">
                                                            <p class="font-weight-semibold text-primary mb-0">{{ $attachement->title }}</p>
                                                            <p class="text-muted mb-3 mt-1 text-small">
                                                                {{ $attachement->content }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-link text-success btn-xs btn-edit-attachement"
                                                                    data-attachement-id="{{ $attachement->id }}"
                                                                    data-attachement-title="{{ $attachement->title }}"
                                                                    data-attachement-content="{{ $attachement->content }}"
                                                                    data-attachement-url-update="{{ route('attachements.update', ['id' => $attachement->id]) }}"
                                                                    data-attachement-url-delete="{{ route('attachements.destroy', ['id' => $attachement->id]) }}">
                                                                <i class="simple-icon-pencil"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="attachements-tab" role="tabpanel" aria-labelledby="attachements-tab">
                            <div class="sortable-survey">
                                <div class="sub-level">
                                    <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                    <span class="text-uppercase">
                                                        Documents Attachées
                                                    </span>
                                                </div>
                                            </div>
                                            <div class=" pl-1 align-self-center pr-4">
                                                <button class="btn btn-outline-theme-3 icon-button" data-toggle="modal" data-target="#modal-add-document">
                                                    <i class="iconsminds-add"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="question-collapse collapse show" id="attachements-tab-content">
                                            <div class="card-body">
                                                <div class="scroll ps ps--active-y" style="max-height: 200px">
                                                    @forelse ($classe->attachements as $file)
                                                        <div class="d-flex flex-row pb-3 justify-content-between {!! $loop->last ?: 'border-bottom mb-3' !!}">
                                                            <div class="flex-grow-1">
                                                                <a href="{{ asset('storage/' . $file->url) }}" data-document-url="{{ asset('storage/' . $file->url) }}" data-document-name="{{ $file->name }}" class="btn-show-document">
                                                                    <p class="font-weight-medium mb-0">
                                                                        <i class="simple-icon-doc text-primary"></i>
                                                                        &nbsp; {{ $file->name }}
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <div class="comment-likes">
                                                                <form method="post" action="{{ route('attachements.delete', ['id' => $file->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <span data-confirmation-message="Voulez vous vraiment supprimer ce document ?" class="post-icon pointer-cursor btn-delete-file btn-delete-resource redirect-after-confirmation">
                                                                        <i class="simple-icon-trash text-danger ml-2"></i>
                                                                    </span>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="text-center">Aucune documents...</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<div class="modal" id="modal-edit-exam" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edite Exam</h5>
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
                    <button type="button" data-confirmation-message="Voulez vous vraiment supprimer ?" data-form-id="form-delete-exam" id="btn-delete-exam" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-exam" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-add-notification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('notifications.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nouvelle Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" required class="form-control" name="title" id="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="Contenu"></textarea>
                    </div>
                    <input type="hidden" name="classe_id" id="classe_id" value="{{ $classe->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-notification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edite Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" required class="form-control" name="title" id="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="Contenu"></textarea>
                    </div>
                    <input type="hidden" name="classe_id" id="classe_id" value="{{ $classe->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" data-confirmation-message="Voulez vous vraiment supprimer ?" data-form-id="form-delete-notification" id="btn-delete-notification" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-notification" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-show-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-1rem">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-1rem">

            </div>
            <div class="modal-footer p-1rem">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-add-document" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('classes.save_attachement', ['id' => $classe->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ajouter un document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" required class="form-control" name="name" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="title">Document</label>
                        <input type="file" required class="form-control" name="classe_attachement">
                    </div>
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
            $('.btn-edit-notification').click(function () {
                var modal = $('#modal-edit-notification');
                modal.find('#modal-title').text('Notification: ' + $(this).data('notification-title'));
                modal.find('#title').val($(this).data('notification-title'));
                modal.find('#content').val($(this).data('notification-content'));
                modal.find('form').attr('action', $(this).data('notification-url-update'));
                modal.find('#form-delete-notification').attr('action', $(this).data('notification-url-delete'));
                modal.modal();
            });

            $('.btn-add-exam').click(function () {
                var modal = $('#modal-add-exam');
                modal.find('#module_id').val($(this).data('module-id'));
                modal.find('#module_name').text($(this).data('module-name'));
                modal.find('#classe_id').val($(this).data('classe-id'));
                modal.modal();
            });

            $('.btn-edit-exam').click(function () {
                var modal = $('#modal-edit-exam');
                modal.find('#modal-title').text('Examen: ' + $(this).data('exam-name'));
                modal.find('#name').val($(this).data('exam-name'));
                modal.find('#type').val($(this).data('exam-type'));
                modal.find('#duration').val($(this).data('exam-duration'));
                modal.find('#session').val($(this).data('exam-session'));
                modal.find('form').attr('action', $(this).data('exam-url-update'));
                modal.find('#form-delete-exam').attr('action', $(this).data('exam-url-delete'));
                modal.modal();
            });

            $('.btn-show-document').click(function (event) {
                event.preventDefault($(this).data('document-url'));
                console.log()
                $('#modal-show-document #modal-name').text($(this).data('document-name'));
                $('#modal-show-document #pdf-viewer').attr('data', $(this).data('document-url'));
                $('#modal-show-document .modal-body').html('<object type="application/pdf" id="pdf-viewer" data="' + $(this).data('document-url') + '" width="100%" style="height: 60vh;">No Support</object>');
                $('#modal-show-document').modal();
            });
        });
    </script>
@endsection
