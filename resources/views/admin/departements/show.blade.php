@extends('layouts.master')

@section('title', 'Departement : ' . $departement->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ $departement->name }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button" class="btn btn-lg btn-primary top-right-button top-right-button-single" data-toggle="modal" data-target="#modal-add-option">
                    Nouvelle Option
                    </button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('departements.index') }}">Departements</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $departement->name }}</li>
                    </ol>
                </nav>
                <div class="mb-2"></div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-5 col-xl-4 col-left">
                    <div class="card mb-4">
                        <div class="card-body">
                            <p class="text-muted text-small mb-2">Departement</p>
                            <p class="mb-3">{{ $departement->name }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Chef de departement</p>
                            <p class="mb-0">{{ optional($departement->cheif)->fullName ?? "###" }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 w-100 text-uppercase">
                                Options
                                    <span class="float-right text-muted text-primary">{{ $departement->options()->count() }}</span>
                            </h6>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 w-100 text-uppercase">
                                Ensignants
                                <span class="float-right text-muted text-primary">{{ $departement->teachers()->count() }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 col-right">
                    <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="first-tab" data-toggle="tab" href="#options-tab" role="tab" aria-controls="first" aria-selected="true">Options</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#teachers-tab" role="tab" aria-controls="second" aria-selected="false">Ensignants</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="options-tab" role="tabpanel" aria-labelledby="options-tab">
                            @foreach ($departement->options as $option)
                                <div class="sub-level">
                                    <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                    <span class="text-uppercase">
                                                        {{ $option->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class=" pl-1 align-self-center pr-4">
                                                <button class="btn btn-outline-theme-3 icon-button btn-edit-option"
                                                        data-option-id="{{ $option->id }}"
                                                        data-option-name="{{ $option->name }}"
                                                        data-option-url-update="{{ route('options.update', ['id' => $option->id]) }}"
                                                        data-option-url-delete="{{ route('options.destroy', ['id' => $option->id]) }}">
                                                    <i class="simple-icon-pencil"></i>
                                                </button>
                                                <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate btn-add-semester"
                                                        data-option-id="{{ $option->id }}"
                                                        type="button">
                                                    <i class="iconsminds-add with-rotate-icon"></i>
                                                </button>
                                                <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate" type="button" data-toggle="collapse" data-target="#{{ $option->id }}" aria-expanded="true" aria-controls="{{ $option->id }}">
                                                    <i class="simple-icon-arrow-down with-rotate-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="question-collapse collapse" id="{{ $option->id }}">
                                            <div class="card-body pt-0 pb-0">
                                                <div id="accordion">
                                                    @foreach ($option->semesters as $semester)
                                                        <div class="border mb-2">
                                                            <div class="alert alert-dark mb-0">
                                                                <span class="cursor-pointer" data-toggle="collapse" data-target="#collapse-{{ $semester->id }}" aria-expanded="true" aria-controls="collapse-{{ $semester->id }}">{{ $semester->name }}</span>
                                                                <span class="float-right">
                                                                    <button class="header-icon btn btn-empty text-primary p-0 mr-2 btn-add-module"
                                                                            data-semester-id="{{ $semester->id }}"
                                                                            type="button">
                                                                        <i class="iconsminds-add"></i>
                                                                    </button>
                                                                    <button class="header-icon btn btn-empty text-bold text-primary p-0 btn-edit-semester"
                                                                            data-semester-id="{{ $semester->id }}"
                                                                            data-semester-name="{{ $semester->name }}"
                                                                            data-semester-url-update="{{ route('semesters.update', ['id' => $semester->id]) }}"
                                                                            data-semester-url-delete="{{ route('semesters.destroy', ['id' => $semester->id]) }}"
                                                                            type="button">
                                                                        <i class="simple-icon-settings"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            <div id="collapse-{{ $semester->id }}" class="collapse" data-parent="#accordion" style="">
                                                                <ul class="list-group b-rad-0">
                                                                    @foreach ($semester->modules as $module)
                                                                        <li class="list-group-item">
                                                                            <span>{{ $module->name }}</span>
                                                                            <span class="float-right">
                                                                                <button class="header-icon btn btn-empty text-danger p-0 btn-edit-module"
                                                                                        data-module-id="{{ $module->id }}"
                                                                                        data-module-name="{{ $module->name }}"
                                                                                        data-module-url-update="{{ route('modules.update', ['id' => $module->id]) }}"
                                                                                        data-module-url-delete="{{ route('modules.destroy', ['id' => $module->id]) }}"
                                                                                        type="button">
                                                                                    <i class="simple-icon-settings"></i>
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
                        <div class="tab-pane fade" id="teachers-tab" role="tabpanel" aria-labelledby="teachers-tab">
                            <div class="sortable-survey">
                                <div class="row">
                                    @forelse ($departement->teachers as $teacher)
                                        <div class="col-12 col-md-6">
                                            <div class="card d-flex flex-row mb-4">
                                                <a class="d-flex" href="#">
                                                    <img alt="Profile" src="{{ $teacher->user->picture_path }}" class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
                                                </a>
                                                <div class="d-flex flex-grow-1 min-width-zero">
                                                    <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}">
                                                                <p class="list-item-heading mb-1 truncate">{{ $teacher->full_name }}</p>
                                                            </a>
                                                            <p class="mb-3 text-muted text-small">{{ $teacher->user->email }}</p>
                                                            {!! $teacher->user->is_active_badge !!}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals --}}
<div class="modal" id="modal-add-option" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('options.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nouvelle Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom d'option</label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Nom d'option">
                    </div>
                    <input type="hidden" required name="departement_id" value="{{ $departement->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-option" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edite Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom d'option</label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Titre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-confirmation-message="Voulez vous vraiment supprimer cette option ?" data-form-id="form-delete-option" id="btn-delete-option" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-option" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-add-semester" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('semesters.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nouveau Semestre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Semestere</label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Nom d'option">
                    </div>
                    <input type="hidden" required name="option_id" id="option_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-semester" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edite Semester</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Semestre </label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Titre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-confirmation-message="Voulez vous vraiment supprimer cette semester ?" data-form-id="form-delete-semester" id="btn-delete-semester" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-semester" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-add-module" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('modules.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nouveau Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom du module</label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Nom d'option">
                    </div>
                    <input type="hidden" required name="semester_id" id="semester_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-module" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edite Semester</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Module </label>
                        <input type="text" required class="form-control" name="name" id="name" placeholder="Titre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-confirmation-message="Voulez vous vraiment supprimer ce module ?" data-form-id="form-delete-module" id="btn-delete-module" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-module" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
{{-- /.Modals --}}
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

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Events
            $('.btn-edit-option').click(function () {
                var modal = $('#modal-edit-option');
                modal.find('#modal-title').text('Option: ' + $(this).data('option-name'));
                modal.find('input[type="text"]').val($(this).data('option-name'));
                modal.find('form').attr('action', $(this).data('option-url-update'));
                modal.find('#form-delete-option').attr('action', $(this).data('option-url-delete'));
                modal.modal();
            });

            $('.btn-add-semester').click(function () {
                var modal = $('#modal-add-semester');
                modal.find('#option_id').val($(this).data('option-id'));
                modal.modal();
            });

            $('.btn-edit-semester').click(function () {
                var modal = $('#modal-edit-semester');
                modal.find('#modal-title').text('Option: ' + $(this).data('semester-name'));
                modal.find('input[type="text"]').val($(this).data('semester-name'));
                modal.find('form').attr('action', $(this).data('semester-url-update'));
                modal.find('#form-delete-semester').attr('action', $(this).data('semester-url-delete'));
                modal.modal();
            });

            $('.btn-add-module').click(function () {
                var modal = $('#modal-add-module');
                modal.find('#semester_id').val($(this).data('semester-id'));
                modal.modal();
            });

            $('.btn-edit-module').click(function () {
                var modal = $('#modal-edit-module');
                modal.find('#modal-title').text('Option: ' + $(this).data('module-name'));
                modal.find('input[type="text"]').val($(this).data('module-name'));
                modal.find('form').attr('action', $(this).data('module-url-update'));
                modal.find('#form-delete-module').attr('action', $(this).data('module-url-delete'));
                modal.modal();
            });
        });
    </script>
@endsection
