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
                                        <p class="list-item-heading mb-1 truncate">{{ $classe->title }}</p>
                                    </a>
                                    <div class="text-center text-muted w-15 w-sm-100">
                                        {{ $classe->subLevel->level->title }}
                                    </div>
                                    <div class="text-center text-muted w-15 w-sm-100">
                                        {{ $classe->subLevel->title }}
                                    </div>
                                    <p class="mb-1 text-muted text-small text-center w-15 w-sm-100">
                                        {{ $classe->scholarYear->scholar_year }}
                                    </p>
                                    <p class="mb-1 text-muted text-small text-center w-15 w-sm-100">
                                        {{ $classe->students()->count() }} Etudiants
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
                        <label class="text-muted text-small" for="level_id">Titre</label>
                        <input type="text" name="title" class="form-control" placeholder="Classe 1..." value="{{ request()->get('title') }}">
                    </div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Niveau scolaire</label>
                        <select name="level_id" class="form-control select2" id="level_id">
                            <option value="-1">-- Tout --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="sub_level_id">Section</label>
                        <select name="sub_level_id" class="form-control" id="sub_level_id">
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
            var allLevels = @json($levels);
            var allSubLevels = @json($subLevels);

            // Events
            $('#level_id').change(function () {
                var level = $(this).val();
                if(level != -1) {
                    $('#sub_level_id').html('');
                    var subLevels = allSubLevels.filter(function (subLevel) {
                        return level == subLevel.level_id;
                    });
                    
                    loadSelect('sub_level_id', subLevels);
                }
            });

            // Helpers : 
            function loadSelect(tragetSelectId, items = []) {
                var options = '<option value="-1">-- Tout --</option>';
                for (var i = 0; i < items.length; i++) {
                    options += '<option value="' + items[i].id + '">' + items[i].title + '</option>';
                }

                $('#' + tragetSelectId).html(options);
            }
        })
    </script>
@endsection