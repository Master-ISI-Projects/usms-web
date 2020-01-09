@extends('layouts.master')

@section('title', 'Courses')

@section('content')
    {{-- Start listing of data --}}
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Cours</h1>
                    <div class="top-right-button-container">
                        <button data-url="{{ route('courses.create') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Nouveau cours</button>
                    </div>
                </div>
                <div class="separator mb-5"></div>
                <div class="list disable-text-selection" data-check-all="checkAll">
                    @forelse ($courses as $course)
                        <div class="card d-flex flex-row mb-3">
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="{{ route('courses.show', ['id' => $course->id]) }}" class="w-15 w-sm-100">
                                        <p class="mb-1">{{ $course->title }}</p>
                                    </a>
                                    <a href="{{ route('teachers.show', ['id' => $course->teacher_id]) }}" class="w-15 w-sm-100 text-muted">
                                        <p class="mb-1">{{ $course->teacher->user->full_name }}</p>
                                    </a>
                                    <div class="text-center text-muted w-15 w-sm-100">
                                        {{ $course->module->title }}
                                    </div>
                                    <div class="text-center w-15 w-sm-100">
                                        <a href="{{ route('classes.show', ['id' => $course->module->classe_id]) }}" class="text-muted">{{ $course->module->classe->title }}</a>
                                    </div>
                                    <p class="mb-1 text-danger text-center w-15 w-sm-100">
                                        {{ Helper::formatDate($course->published_at, 'd-m-Y à h:i') }}
                                    </p>
                                    <div class="text-center w-15 w-sm-100">
                                        <span class="badge badge-primary">{{ $course->duration }} Minutes</span>
                                    </div>
                                    <div class="btn-group mb-1">
                                        <button class="btn btn-xs btn-danger dropdown-toggle btn-toggle-without-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('courses.show', ['id' => $course->id]) }}">Details</a>
                                            <a class="dropdown-item" href="{{ route('courses.edit', ['id' => $course->id]) }}">Editer</a>
                                            <form method="post" action="{{ route('courses.destroy', ['id' => $course->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer ce cours ?" href="{{ route('courses.destroy', ['id' => $course->id]) }}">Supprimer</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse
                    {!! $courses->links('vendor.pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End listing of data --}}

    {{-- Start filter menu --}}
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form action="{{ route('courses.index') }}">
                    <h5 class="mb-3 mt-3">Filtrer</h5>
                    <div class="separator mb-4"></div>
                    <div class="form-group">
                        <label class="text-muted text-small" for="level_id">Niveau scolaire</label>
                        <select name="level_id" class="form-control level_id select2" id="level_id">
                            <option value="-1">-- Tout --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="sub_level_id">Section</label>
                        <select name="sub_level_id" class="form-control sub_level_id" id="sub_level_id">
                            <option value="-1">-- Tout --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="class_id">Classe</label>
                        <select name="class_id" class="form-control class_id" id="class_id">
                            <option value="-1">-- Tout --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-muted text-small" for="module_id">Module</label>
                        <select name="module_id" class="form-control module_id" id="module_id">
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
            var allClasses = @json($classes);
            var allModules = @json($modules);
            var scholarYear = "{{ config('scholaryear.current_scholar_year_id') }}";

            // Events
            $('.level_id').change(function () {
                var level = $(this).val();
                if(level != -1) {
                    $('.sub_level_id, .class_id').html('<option value="-1">-- Tout --</option>');
                    var subLevels = allSubLevels.filter(function (subLevel) {
                        return level == subLevel.level_id;
                    });

                    loadSelect('.sub_level_id', subLevels);
                }
            });

            $('.sub_level_id').on('change click', function () {
                var subLevel = $(this).val();
                if(subLevel != -1) {
                    var classes = allClasses.filter(function (classe) {
                        return subLevel == classe.sub_level_id && scholarYear == classe.scholar_year_id;
                    });

                    loadSelect('.class_id', classes);
                }
            });

            $('.class_id').on('change click', function () {
                var classe = $(this).val();
                if(classe != -1) {
                    var modules = allModules.filter(function (module) {
                        return classe == module.classe_id;
                    });

                    loadSelect('.module_id', modules);
                }
            });

            // Helpers :
            function loadSelect(tragetSelectSelector, items = [], selectedItem = '') {
                var options = '<option value="-1">-- Tout --</option>';
                for (var i = 0; i < items.length; i++) {
                    options += '<option ' + (items[i].id == selectedItem ? 'selected' : '') + ' value="' + items[i].id + '">' + items[i].title + '</option>';
                }

                $(tragetSelectSelector).html(options);
            }
        })
    </script>
@endsection
