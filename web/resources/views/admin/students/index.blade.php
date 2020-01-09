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
                        @php
                            $currentStudent = ['name' => $student->user->full_name, 'level' => optional($student->currentLevel)->id, 'subLevel' => optional($student->currentSubLevel)->id, 'classe' => optional($student->currentClasse)->id, 'updateUrl' => route('students.update_classe', ['id' => $student->id]), 'deleteUrl' => route('students.delete_classe', ['id' => $student->id])];
                        @endphp
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
                                        {!! optional($student->currentLevel)->title ?? '<span class="text-danger">###</span>' !!}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {!! optional($student->currentSubLevel)->title ?? '<span class="text-danger">###</span>' !!}
                                    </p>
                                    <p class="mb-1 text-small text-muted text-center w-15 w-sm-100">
                                        {!! optional($student->currentClasse)->title ?? '<span class="text-danger">###</span>' !!}    
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
                                            <a class="dropdown-item btn-show-modal-edit-student-classe" href="#" data-student='@json($currentStudent)'>Affection de classe</a>
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
                        <label class="text-muted text-small" for="level_id">Nom ou/et prenom</label>
                        <input type="text" name="full_name" class="form-control" placeholder="John Doe..." value="{{ request()->get('full_name') }}">
                    </div>
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

    {{-- Start Modals --}}
    <div class="modal" id="modal-edit-student-classe" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="form-update-classe">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Affectation de classe pour l'etudiant : <span id="student-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="text-muted text-small" for="level_id">Niveau scolaire</label>
                            <select name="level_id" class="form-control level_id select2" id="level_id">
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-muted text-small" for="sub_level_id">Section</label>
                            <select name="sub_level_id" class="form-control sub_level_id" id="sub_level_id">
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-muted text-small" for="class_id">Classe</label>
                            <select name="class_id" class="form-control class_id" id="class_id">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-delete-classe" data-confirmation-message="Voulez vous vraiment supprimer cette affectation ?" data-form-id="form-delete-classe" class="btn btn-sm btn-outline-danger mr-auto btn-delete-resource redirect-after-confirmation">Supprimer l'affectation</button>
                        <button data-confirmation-message="Voulez vous vraiment effectuer l'affectation ?" data-form-id="form-update-classe" class="btn btn-sm btn-primary btn-delete-resource redirect-after-confirmation">Modifier l'affectation</button>
                    </div>
                </form>
                <form id="form-delete-classe" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
    {{-- End Modals --}}
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            //init 
            var allLevels = @json($levels);
            var allSubLevels = @json($subLevels);
            var allClasses = @json($classes);
            var scholarYear = "{{ config('scholaryear.current_scholar_year_id') }}";

            // Events
            $('.btn-show-modal-edit-student-classe').click(function () {
                var student = $(this).data('student');
                var levels = allLevels;
                var subLevels = allSubLevels.filter(function (subLevel) {
                    return student.level == subLevel.level_id;
                });
                var classes = allClasses.filter(function (classe) {
                    return student.subLevel == classe.sub_level_id && scholarYear == classe.scholar_year_id;
                });
                if(student.classe == null) {
                    $('#modal-edit-student-classe #btn-delete-classe').hide();
                } else {
                    $('#modal-edit-student-classe #btn-delete-classe').show();
                    $('#modal-edit-student-classe #form-delete-classe').attr('action', student.deleteUrl);
                }
                $('#modal-edit-student-classe #student-name').text(student.name);
                $('#modal-edit-student-classe #form-update-classe').attr('action', student.updateUrl);
                loadSelect('#modal-edit-student-classe .level_id', levels, student.level);
                loadSelect('#modal-edit-student-classe .sub_level_id', subLevels, student.subLevel);
                loadSelect('#modal-edit-student-classe .class_id', classes, student.classe);

                $('#modal-edit-student-classe').modal();
            });

            $('.level_id').change(function () {
                var level = $(this).val();
                if(level != -1) {
                    $('.sub_level_id, .class_id').html('');
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
                    console.log(classes)
                    loadSelect('.class_id', classes);
                }
            });

            // Helpers : 
            function loadSelect(tragetSelectSelector, items = [], selectedItem = '') {
                var options = '';
                for (var i = 0; i < items.length; i++) {
                    options += '<option ' + (items[i].id == selectedItem ? 'selected' : '') + ' value="' + items[i].id + '">' + items[i].title + '</option>';
                }

                $(tragetSelectSelector).html(options);
            }
        })
    </script>
@endsection