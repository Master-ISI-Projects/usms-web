@extends('layouts.master')

@section('title', 'Événements')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Événements</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('events.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouvel événement</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($events as $event)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex" href="{{ route('events.show', ['id' => $event->id]) }}">
                                <img src="{{ $event->image_path }}" alt="{{ $event->title }}" class="list-thumbnail responsive border-0 card-img-left">
                            </a>
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('events.show', ['id' => $event->id]) }}" class="w-20 w-sm-100">
                                        <p class="list-item-heading mb-1 truncate mb-1">{{ $event->title }}</p>
                                    </a>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {{ Helper::formatDate($event->published_at, 'd-m-Y à h:i') }}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {{ $event->duration }}
                                    </p>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                            <a class="dropdown-item" href="{{ route('events.show', ['id' => $event->id]) }}">Details</a>
                                            <a class="dropdown-item" href="{{ route('events.edit', ['id' => $event->id]) }}">Editer</a>
                                            <form method="post" action="{{ route('events.destroy', ['id' => $event->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer ?" href="{{ route('events.destroy', ['id' => $event->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $events->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('events.index') }}">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="title">Titre de l'actualité</label>
                        <input type="text" name="title" class="form-control" placeholder=".." value="{{ request()->get('title') }}">
                    </div>

                    <button class="btn btn-primary btn-block mt-5">Filter</button>
                </form>
            </div>
        </div>
        <a class="app-menu-button d-inline-block d-xl-none" href="#">
            <i class="simple-icon-options"></i>
        </a>
    </div>
    {{-- End filter menu --}}
@endsection
