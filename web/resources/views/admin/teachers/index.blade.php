@extends('layouts.master')

@section('title', 'Liste des enseignants')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Ensiegnants</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('teachers.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouveau enseignant</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($teachers as $teacher)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex" href="{{ route('teachers.show', ['id' => $teacher->id]) }}">
                                <img src="{{ $teacher->user->picture_path }}" alt="{{ $teacher->user->full_name }}" class="list-thumbnail responsive border-0 card-img-left">
                            </a>
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}" class="w-15 w-sm-100">
                                        <p class="list-item-heading mb-1 truncate">{{ $teacher->user->full_name }}</p>
                                    </a>
                                    <div class="text-center w-15 w-sm-100">
                                        <span class="badge badge-pill badge-primary">{{ $teacher->departement->name }}</span>
                                    </div>
                                    <p class="mb-1 text-muted text-small text-center w-20 w-sm-100">
                                        {{ $teacher->user->email }}
                                    </p>
                                    <p class="mb-1 text-muted text-small text-center w-15 w-sm-100">
                                        {{ $teacher->user->tel }}
                                    </p>
                                    <div class="text-center w-15 w-sm-100">
                                        {!! $teacher->user->is_active_badge !!}
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('teachers.show', ['id' => $teacher->id]) }}">Details</a>
                                            <a class="dropdown-item" href="{{ route('teachers.edit', ['id' => $teacher->id]) }}">Editer</a>
                                            <form method="post" action="{{ route('teachers.destroy', ['id' => $teacher->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer l'enseignant : {{ $teacher->user->full_name }} ?" href="{{ route('teachers.destroy', ['id' => $teacher->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $teachers->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('teachers.index') }}" method="get">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Nom</label>
                        <input type="text" name="full_name" class="form-control" placeholder="John Doe..." value="{{ request()->get('full_name') }}">
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Departement</label>
                        <select name="departement_id" id="departement_id" class="form-control">
                            @foreach ($departements as $departement)
                                <option value="-1">-- All --</option>
                                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary btn-block mt-5">Filtrer</button>
                </div>
            </div>
        </div>
        <a class="app-menu-button d-inline-block d-xl-none" href="#">
            <i class="simple-icon-options"></i>
        </a>
    </div>
    {{-- End filter menu --}}
@endsection
