@extends('layouts.master')

@section('title', 'Classes')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Classes</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('classes.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouvelle classe</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($classes as $classe)
                        <div class="card d-flex flex-row mb-3">
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('classes.show', ['id' => $classe->id]) }}" class="w-20 w-sm-100">
                                        <p class="list-item-heading mb-1 truncate">{{ $classe->name }}</p>
                                    </a>
                                    <div class="text-center text-muted w-15 w-sm-100">
                                        <a class="text-muted" href="{{ route('departements.show', ['id' => $classe->option->departement_id]) }}">{{ $classe->option->departement->name }}</a>
                                    </div>
                                    <div class="text-center text-muted w-35 w-sm-100">
                                        {{ $classe->option->name }}
                                    </div>
                                    <p class="mb-1 text-muted text-small text-center w-15 w-sm-100">
                                        <span class="badge badge-primary">{{ $classe->students()->count() }} Etudiants</span>
                                    </p>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('classes.show', ['id' => $classe->id]) }}">Details</a>
                                            <form method="post" action="{{ route('classes.destroy', ['id' => $classe->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer cette classe ?" href="{{ route('classes.destroy', ['id' => $classe->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $classes->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('classes.index') }}" method="get">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="name">Titre</label>
                        <input type="text" name="name" class="form-control" placeholder="Classe 1..." value="{{ request()->get('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="departement_id">Departement</label>
                        <select name="departement_id" class="form-control select2" id="departement_id">
                            <option value="-1">-- Tout --</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="option_id">Option</label>
                        <select name="option_id" class="form-control" id="option_id">
                            <option value="-1">-- Tout --</option>
                        </select>
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
            //init
            var allLevels = @json($departements);
            var allOptions = @json($options);

            // Events
            $('#departement_id').change(function () {
                var departement = $(this).val();
                if(departement != -1) {
                    $('#option_id').html('');
                    var options = allOptions.filter(function (option) {
                        return departement == option.departement_id;
                    });

                    loadSelect('option_id', options);
                }
            });

            // Helpers :
            function loadSelect(tragetSelectId, items = []) {
                var options = '<option value="-1">-- Tout --</option>';
                for (var i = 0; i < items.length; i++) {
                    options += '<option value="' + items[i].id + '">' + items[i].name + '</option>';
                }

                $('#' + tragetSelectId).html(options);
            }
        })
    </script>
@endsection
