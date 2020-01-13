@extends('layouts.master')

@section('title', 'Liste des administrateurs')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Administrateurs</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('admins.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouveau administrateur</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($admins as $admin)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex" href="Pages.Details.html">
                                <img src="{{ $admin->picture_path }}" alt="{{ $admin->full_name }}" class="list-thumbnail responsive border-0 card-img-left">
                            </a>
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('admins.show', ['id' => $admin->id]) }}" class="w-15 w-sm-100">
                                        <p class="list-item-heading mb-1 truncate">{{ $admin->full_name }}</p>
                                    </a>
                                    <p class="mb-1 text-small text-muted text-center w-20 w-sm-100">
                                        {{ $admin->tel }}    
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-20 w-sm-100">
                                        {{ $admin->email }}    
                                    </p>
                                    <div class="text-center w-15 w-sm-100">
                                        {!! $admin->is_active_badge !!}
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                            <a class="dropdown-item" href="{{ route('admins.show', ['id' => $admin->id]) }}">Details</a>
                                            <a class="dropdown-item" href="{{ route('admins.edit', ['id' => $admin->id]) }}">Editer</a>
                                            <form method="post" action="{{ route('admins.destroy', ['id' => $admin->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer ce l'administrateur : {{ $admin->full_name }} ?" href="{{ route('admins.destroy', ['id' => $admin->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $admins->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div> 
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('admins.index') }}" method="get">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Chercher par nom</label>
                        <input type="text" name="full_name" class="form-control" placeholder="John Doe..." value="{{ request()->get('full_name') }}">
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

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Events
            $('.btn-delete-resource').click(function (event) {
                event.preventDefault();
                $(this).parent().submit();
            });
        });
    </script>
@endsection