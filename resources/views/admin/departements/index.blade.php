@extends('layouts.master')

@section('title', 'Departements')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid library-app">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Departements</h1>
                    <div class="top-right-button-container">
                        <button type="button" data-toggle="modal" data-target="#modal-add-departement" class="btn btn-primary btn-lg top-right-button">Nouvelle departement</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                    <div class="row">
                        @foreach ($departements as $departement)
                            <div class="col-md-4">
                                <div class="card d-flex flex-row mb-4 media-thumb-container pr-2">
                                    <a class="d-flex align-self-center media-thumbnail-icon" href="{{ route('departements.show', ['id' => $departement->id]) }}">
                                        <i class="iconsminds-museum"></i>
                                    </a>
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
                                            <a href="{{ route('departements.show', ['id' => $departement->id]) }}" class="w-100 mb-1">
                                                <p class="list-item-heading mb-1 truncate">{{ $departement->name }}</p>
                                            </a>
                                            <p class="mb-1 text-muted text-small w-100 truncate">{{ $departement->options()->count() }} - Option(s)</p>
                                        </div>
                                        <div class="pl-1 align-self-center">
                                            <button class="header-icon btn btn-empty text-danger open-modal-edit-departement"
                                                    data-departement-id="{{ $departement->id }}"
                                                    data-departement-title="{{ $departement->name }}"
                                                    data-departement-chef-departement="{{ $departement->teacher_id }}"
                                                    data-departement-url-update="{{ route('departements.update', ['id' => $departement->id]) }}"
                                                    data-departement-url-delete="{{ route('departements.destroy', ['id' => $departement->id]) }}"
                                                    type="button">
                                                <i class="simple-icon-settings"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Modals --}}
    <div class="modal" id="modal-add-departement" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('departements.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Nouvelle departement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de departement</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Nom de departement">
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Chef de departement</label>
                            <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id">
                                <option value="-1">----</option>
                                @foreach ($teachers as $teacher)
                                    <option {{ old('teacher_id') == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

    <div class="modal" id="modal-edit-departement" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <label for="name">Nom de departement</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Nom de departement">
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Chef de departement</label>
                            <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id">
                                <option value="-1">----</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-confirmation-message="Voulez vous vraiment supprimer cette departement ?" data-form-id="form-delete-level" id="btn-delete-level" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer</button>
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
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.open-modal-edit-departement').click(function () {
                var modal = $('#modal-edit-departement');
                modal.find('#modal-title').text('Departement: ' + $(this).data('departement-title'));
                modal.find('input[type="text"]').val($(this).data('departement-title'));
                modal.find("#teacher_id").val($(this).data('departement-chef-departement') != '' ? $(this).data('departement-chef-departement') : -1);
                modal.find('form').attr('action', $(this).data('departement-url-update'));
                modal.find('#form-delete-departement').attr('action', $(this).data('departement-url-delete'));
                modal.modal();
            });
        });
    </script>
@endsection
