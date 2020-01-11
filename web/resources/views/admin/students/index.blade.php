@extends('layouts.master')

@section('title', 'Liste des etudiants')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Etudiants</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('students.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouveau etudiant</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($students as $student)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex" href="{{ route('students.show', ['id' => $student->id]) }}">
                                <img src="{{ $student->user->picture_path }}" alt="{{ $student->user->full_name }}" class="list-thumbnail responsive border-0 card-img-left">
                            </a>
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('students.show', ['id' => $student->id]) }}" class="w-20 w-sm-100">
                                        <p class="list-item-heading mb-1 truncate">{{ $student->user->full_name }}</p>
                                    </a>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {{ $student->registration_number }}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {!! '<span class="text-danger">###</span>' !!}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {!! '<span class="text-danger">###</span>' !!}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {!! '<span class="text-danger">###</span>' !!}
                                    </p>
                                    <div class="text-center w-15 w-sm-100">
                                        {!! $student->user->is_active_badge !!}
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                            <a class="dropdown-item" href="{{ route('students.show', ['id' => $student->id]) }}">Details</a>
                                            <a class="dropdown-item" href="{{ route('students.edit', ['id' => $student->id]) }}">Editer</a>
                                            <form method="post" action="{{ route('students.destroy', ['id' => $student->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer l'etudiant : {{ $student->user->full_name }} ?" href="{{ route('students.destroy', ['id' => $student->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $students->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('students.index') }}">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Nom ou/et Prénom</label>
                        <input type="text" name="full_name" class="form-control" placeholder="John Doe..." value="{{ request()->get('full_name') }}">
                    </div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="departement_id">Departement</label>
                        <select name="departement_id" class="form-control departement_id select2" id="departement_id">
                            <option value="-1">-- Tout --</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="option_id">Option</label>
                        <select name="option_id" class="form-control option_id" id="option_id">
                            <option value="-1">-- Tout --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="class_id">Classe</label>
                        <select name="class_id" class="form-control class_id" id="class_id">
                            <option value="-1">-- Tout --</option>
                        </select>
                    </div>

                    <button class="btn btn-primary btn-block mt-5">Filtrer</button>
                </form>
            </div>
        </div>
        <a class="app-menu-button d-inline-block d-xl-none" href="#">
            <i class="simple-icon-options"></i>
        </a>
    </div>
    {{-- End filter menu --}}
@endsection
