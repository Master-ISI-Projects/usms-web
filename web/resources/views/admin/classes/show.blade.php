@extends('layouts.master')

@section('title', 'Classe')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>{{ $classe->title }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-add-module">Ajouter Nouveau Module</a>
                        <a class="dropdown-item" href="#">Affecter Etudiant</a>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="mb-2"></div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-4 col-left">
                    <div class="card mb-4">
                        <div class="position-absolute card-top-buttons">
                            <button class="btn btn-outline-primary btn-sm icon-button" data-toggle="modal" data-target="#modal-edit-classe">
                                <i class="simple-icon-pencil"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <h4>{{ $classe->title }}</h4>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Niveau scolaire</p>
                            <p class="mb-3">{{ $classe->subLevel->level->title }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Section</p>
                            <p class="mb-3">{{ $classe->subLevel->title }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-3">Annee scolaire</p>
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
                                Modules 
                                <span class="float-right text-muted text-primary">{{ $classe->modules()->count() }}</span>
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
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#modules-tab" role="tab" aria-controls="second" aria-selected="false">Modules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#calendar-tab" role="tab" aria-controls="second" aria-selected="false">Emploi du temps</a>
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
                                                        <p class="mb-3 text-muted text-small">{{ $student->registration_number }}</p>
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
                        <div class="tab-pane fade" id="modules-tab" role="tabpanel" aria-labelledby="modules-tab">
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
                                                    <button class="btn btn-outline-theme-3 icon-button btn-edit-module" 
                                                            data-module-id="{{ $module->id }}" 
                                                            data-module-title="{{ $module->title }}"
                                                            data-module-color="{{ $module->color }}"
                                                            data-module-url-update="{{ route('modules.update', ['id' => $module->id]) }}"
                                                            data-module-url-delete="{{ route('modules.destroy', ['id' => $module->id]) }}">
                                                        <i class="simple-icon-pencil"></i>
                                                    </button>
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
                                                                <a href="{{ route('courses.show', ['id' => $course->id]) }}">
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
                                                                <a class="btn btn-outline-success btn-xs" href="{{ route('courses.show', ['id' => $course->id]) }}">Details</a>
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
                        <div class="tab-pane fade" id="calendar-tab" role="tabpanel" aria-labelledby="calendar-tab">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <course-calendar :class-id="{{ $classe->id }}"></course-calendar>
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
<div class="modal" id="modal-edit-classe" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('classes.update', ['id' => $classe->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Classe : {{ $classe->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" required class="form-control" name="title" id="title" placeholder="Titre" value="{{ $classe->title }}">
                    </div>
                    <div class="form-group">
                        <label for="level_id">Niveau scolaire</label>
                        <select name="level_id" required class="form-control select2" id="level_id">
                            @foreach ($levels as $level)
                                <option {{ $classe->subLevel->level->id == $level->id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="sub_level_id">Section</label>
                        <select name="sub_level_id" class="form-control" id="sub_level_id">
                            @foreach ($classe->subLevel->level->subLevels as $subLevel)
                                <option {{ $subLevel->id == $classe->subLevel->id ? 'selected' : '' }} value="{{ $subLevel->id }}">{{ $subLevel->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-delete-sublevel" class="btn btn-sm btn-outline-danger mr-auto">Supprimer</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary">Enregistrer</button>
                </div>
            </form>
            <form id="form-delete-sublevel" method="post">
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
                    <h5 class="modal-title" id="modal-title">Nouveau module</h5>
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
                        <label for="title">Coleur</label>
                        <input type="color" required name="color">
                    </div>
                    <input type="hidden" required name="classe_id" value="{{ $classe->id }}">
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
                    <h5 class="modal-title" id="modal-title">Edite Module</h5>
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
                        <label for="title">Coleur</label>
                        <input type="color" required name="color" id="color">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-delete-module" class="btn btn-sm btn-outline-danger mr-auto">Supprimer</button>
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
            //init 
            var allLevels = @json($levels);
            var allSubLevels = @json($subLevels);

            // Events
            $('#level_id').on('change click', function () {
                $('#sub_level_id').html('');
                var level = $(this).val();
                var subLevels = allSubLevels.filter(function (subLevel) {
                    return level == subLevel.level_id;
                });
                
                loadSelect('sub_level_id', subLevels);
            });

            $('.btn-edit-module').click(function () {
                var modal = $('#modal-edit-module');
                modal.find('#modal-title').text('Module: ' + $(this).data('module-title'));
                modal.find('#title').val($(this).data('module-title'));
                modal.find('#color').val($(this).data('module-color'));
                modal.find('form').attr('action', $(this).data('module-url-update'));
                modal.find('#form-delete-module').attr('action', $(this).data('module-url-delete'));
                modal.modal();
            });

            $('#btn-delete-module').click(function () {
                $('#form-delete-module').submit();
            });

            // Helpers : 
            function loadSelect(tragetSelectId, items = []) {
                var options = '';
                for (var i = 0; i < items.length; i++) {
                    options += '<option value="' + items[i].id + '">' + items[i].title + '</option>';
                }

                $('#' + tragetSelectId).html(options);
            }
        })
    </script>
@endsection