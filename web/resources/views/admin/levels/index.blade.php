@extends('layouts.master')

@section('title', 'Niveau scolaires')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 survey-app">
                <div class="mb-2">
                    <h1>Niveau scolaire</h1>
                    <div class="text-zero top-right-button-container">
                        <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACTIONS
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-add-level">Nouveau Niveau</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-add-sublevel">Nouvelle section</a>
                        </div>
                    </div>
                </div>
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-lg-3 mb-4">
                        <h5 class="mb-2">
                            Niveaux
                            <button class="btn btn-icon-xxs btn-primary mb-1 icon-button float-right" id="open-modal-add-level">
                                <i class="simple-icon-plus btn-group-icon"></i>
                            </button>
                        </h5>
                        <div class="separator mb-4"></div>
                        @foreach ($levels as $level)
                            <div class="row icon-cards-row mb-2">
                                <div class="col-md-12 mb-4">
                                    <a id="level-{{ $level->id }}" class="card card-nav {{ $loop->first ? 'active' : '' }}">
                                        <div class="card-header p-0 position-relative bg-primary">
                                            <div class="position-absolute handle card-icon icon-right open-modal-edit-level"
                                                data-level-id="{{ $level->id }}" data-level-title="{{ $level->title }}"
                                                data-level-url-update="{{ route('levels.update', ['id' => $level->id]) }}"
                                                data-level-url-delete="{{ route('levels.destroy', ['id' => $level->id]) }}">
                                                <i class="simple-icon-options text-primary clickable text-bold"></i>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="mb-0 text-uppercase font-weight-semibold">{{ $level->title }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 col-md-9" id="sections">
                        <h5 class="mb-2">
                            Sections <span id="level-title"></span>
                            <button class="btn btn-icon-xxs btn-primary mb-1 icon-button float-right" data-toggle="modal" data-target="#modal-add-sublevel">
                                <i class="simple-icon-plus btn-group-icon"></i>
                            </button>
                        </h5>
                        <div class="separator mb-3"></div>
                        <div class="sortable-survey">
                            @foreach ($subLevels as $subLevel)
                                <div data-level-id="level-{{ $subLevel->level_id }}" class="sub-level">
                                    <div class="card card-panel question d-flex mb-4 edit-quesiton">
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                <div class="list-item-heading mb-0 truncate w-80 mb-1 mt-1">
                                                    <span class="heading-number d-inline-block">
                                                        <i class="simple-icon-energy"></i>
                                                    </span>
                                                    <span class="text-uppercase">
                                                        {{ $subLevel->title }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class=" pl-1 align-self-center pr-4">
                                                <button class="btn btn-outline-theme-3 icon-button btn-edit-sublevel"
                                                        data-sublevel-id="{{ $subLevel->id }}"
                                                        data-sublevel-title="{{ $subLevel->title }}"
                                                        data-sublevel-level-id="{{ $subLevel->level_id }}"
                                                        data-sublevel-url-update="{{ route('sub-levels.update', ['id' => $subLevel->id]) }}"
                                                        data-sublevel-url-delete="{{ route('sub-levels.destroy', ['id' => $subLevel->id]) }}">
                                                    <i class="simple-icon-pencil"></i>
                                                </button>
                                                <button class="btn btn-outline-theme-3 icon-button rotate-icon-click rotate" type="button" data-toggle="collapse" data-target="#{{ $subLevel->id }}" aria-expanded="true" aria-controls="{{ $subLevel->id }}">
                                                    <i class="simple-icon-arrow-down with-rotate-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="question-collapse collapse" id="{{ $subLevel->id }}">
                                            <div class="card-body pt-0">
                                                <div class="border-bottom mb-3"></div>
                                                @foreach ($subLevel->classes()->currentYear()->get() as $classe)
                                                    <div class="d-flex flex-row pb-3 {!! $loop->last ? '' : 'border-bottom mb-3' !!} justify-content-between align-items-center">
                                                        <div class="pl-3 flex-fill">
                                                            <a href="{{ route('classes.show', ['id' => $classe->id]) }}">
                                                                <p class="font-weight-semibold text-primary mb-0">{{ $classe->title }}</p>
                                                                <p class="text-muted mb-0 mt-1 text-small">{{ $classe->students()->count() }} Etudiants - {{ $classe->modules()->count() }} Modules</p>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-outline-success btn-xs" href="{{ route('classes.show', ['id' => $classe->id]) }}">Details</a>
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
    {{-- Modals --}}
    <div class="modal" id="modal-add-level" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('levels.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Nouveau Niveau</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" required class="form-control" name="title" id="title" placeholder="Titre">
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

    <div class="modal" id="modal-edit-level" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Modal Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" required class="form-control" name="title" id="title" placeholder="Titre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-confirmation-message="Voulez vous vraiment supprimer ce niveau ?" data-form-id="form-delete-level" id="btn-delete-level" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                        <button class="btn btn-sm btn-primary">Enregistrer</button>
                    </div>
                </form>
                <form id="form-delete-level" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-add-sublevel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('sub-levels.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Nouvelle section</h5>
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
                            <label for="level_id">Niveau scolaire</label>
                            <select name="level_id" required class="form-control select2" id="level_id">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->title }}</option>
                                @endforeach
                            </select>
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

    <div class="modal" id="modal-edit-sublevel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Edit SubLevel</h5>
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
                            <label for="level_id">Niveau scolaire</label>
                            <select name="level_id" required class="form-control select2" id="level_id">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-confirmation-message="Voulez vous vraiment supprimer cette section ?" data-form-id="form-delete-sublevel" id="btn-delete-sublevel" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
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
    {{-- /.Modals --}}
@endsection

@section('custom-stylesheet')
    <style>
        .card-nav.active:after {
            content: " ";
            background: #145388;
            color: #fff;
            border-radius: 10px;
            position: absolute;
            width: 5px;
            height: 90%;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
        }
        *, :after, :before {
            box-sizing: border-box;
        }
        .card-nav.active p {
            color: #135388 !important;
        }

        .card-panel .card-body {
            padding: 1.3rem !important;
        }

        .btn-icon-xxs {
            font-size: 14px;
            width: 24px;
            height: 24px;
            line-height: 24px;
        }

        .card-header .icon-right {
            top: -10px !important
        }

        .card-header .icon-right i {
            padding: 10px 5px 10px 10px;
        }

        .clickable {
            cursor: pointer;
        }
    </style>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Init
            toggleLevels($('.card-nav:first').attr('id'));

            // Events
            $('#open-modal-add-level').click(function () {
                var modal = $('#modal-add-level');
                modal.modal();
            });

            $('.open-modal-edit-level').click(function () {
                var modal = $('#modal-edit-level');
                modal.find('#modal-title').text('Niveau: ' + $(this).data('level-title'));
                modal.find('input[type="text"]').val($(this).data('level-title'));
                modal.find('form').attr('action', $(this).data('level-url-update'));
                modal.find('#form-delete-level').attr('action', $(this).data('level-url-delete'));
                modal.modal();
            });

            $('.btn-edit-sublevel').click(function () {
                var modal = $('#modal-edit-sublevel');
                modal.find('#modal-title').text('Section: ' + $(this).data('sublevel-title'));
                modal.find('input[type="text"]').val($(this).data('sublevel-title'));
                modal.find('#level_id').val($(this).data('sublevel-level-id'));
                modal.find('form').attr('action', $(this).data('sublevel-url-update'));
                modal.find('#form-delete-sublevel').attr('action', $(this).data('sublevel-url-delete'));
                modal.modal();
            });

            $('.card-nav').click(function () {
                toggleLevels($(this).attr('id'));
            });

            // Helpers
            function toggleLevels(levelId) {
                $('.card-nav').removeClass('active');
                $('#' + levelId).removeClass('active').addClass('active');
                $('#level-title').text($('#' + levelId).find('p').text());
                var selectedLevelId = $('#' + levelId).attr('id');
                var subLevels = $('#sections .sub-level');
                subLevels.each(function (index, element) {
                    if($(element).data('level-id') == selectedLevelId) {
                        $(element).removeClass('hide');
                    } else {
                        $(element).addClass('hide')
                    }
                });
            }
        });
    </script>
@endsection
