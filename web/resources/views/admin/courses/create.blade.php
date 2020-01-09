@extends('layouts.master')

@section('title', 'Ajouter nouveau cours')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-12">
                <h1>Nouveau cours</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('courses.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des cours</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('courses.index') }}">Cours</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Nouveau cours</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

		<form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
			@csrf
		    <div class="row">
		    	<div class="col-md-3">
	                <div class="card mb-4">
	                    <div class="card-body">
	                    	<h5>Reference</h5>
	                    	<div class="separator mb-4"></div>
	                    	<div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control input-small @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" placeholder="Titre">
                            	@error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="duration">Durée estimé</label>
                                <input type="number" name="duration" class="form-control" value="{{ old('duration') }}" placeholder="Durée estimé">
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Annee scolaire</label>
                                <input type="text" disabled class="form-control" value="{{ config('scholaryear.current_scholar_year') }}">
                            </div>
	                    </div>
	                </div>
		    	</div>

		    	<div class="col-md-9">
		    		<div class="card mb-4">
	                    <div class="card-body">
	                        <h5>Cours details</h5>
	                    	<div class="separator mb-5"></div>
                            <div class="row">
                            	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="level_id">Niveau scolaire</label>
		                                <select name="level_id" class="form-control select2 @error('level_id') is-invalid @enderror" id="level_id">
		                                	<option value="-1"> ---- </option>	
		                                	@foreach ($levels as $level)
		                                		<option {{ old('level_id') == $level->id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->title }}</option>
		                                	@endforeach
		                                </select>
		                            	@error('level_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="sub_level_id">Section</label>
		                                <select name="sub_level_id" class="form-control @error('sub_level_id') is-invalid @enderror" id="sub_level_id">
		                                </select>
		                            	@error('sub_level_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="classe_id">Classe</label>
		                                <select name="classe_id" class="form-control @error('classe_id') is-invalid @enderror" id="classe_id">
		                                </select>
		                            	@error('classe_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="module_id">Module</label>
		                                <select name="module_id" class="form-control @error('module_id') is-invalid @enderror" id="module_id">
		                                </select>
		                            	@error('module_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="teacher_id">Enseignant</label>
		                                <select name="teacher_id" class="form-control select2 @error('teacher_id') is-invalid @enderror" id="teacher_id">
		                                	@foreach ($teachers as $teacher)
		                                		<option {{ old('teacher_id') == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->user->full_name }}</option>
		                                	@endforeach
		                                </select>
		                            	@error('teacher_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            	<div class="col-md-6">
                            		<div class="form-group">
		                                <label for="published_at">Date de publication</label>
		                                <input type="text" class="form-control datepicker @error('published_at') is-invalid @enderror" name="published_at" readonly autocomplete="off" id="published_at" value="{{ old('published_at') }}" placeholder="Date de publication">
		                            	@error('published_at')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
                            	</div>
                            </div>
                            <div class="form-group">
                                <label for="video_content">Live source</label>
                                <textarea name="video_content" class="form-control @error('video_content') is-invalid @enderror" cols="30" rows="10" placeholder="Live source">{{ old('video_content') }}</textarea>
                            	@error('video_content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
							<div class="mt-4"></div>
                            <button type="submit" class="float-right btn btn-primary mb-0">Enregistrer</button>
	                    </div>
	                </div>
		    	</div>
		    </div>
			
		</form>
	</div>
@endsection

@section('plugin-stylesheet')
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-datepicker3.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}">
@endsection

@section('custom-stylesheet')
	<style>
		.table .btn-colner {
			margin-top: 3px;
			margin-bottom: 0px;
		}
	</style>
@endsection

@section('plugin-javascript')
	<script src="{{ asset('assets/js/vendor/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
@endsection

@section('custom-javascript')
	<script>
		$(document).ready(function () {
			//init 
			var allLevels = @json($levels);
			var allSubLevels = @json($subLevels);
			var allClasses = @json($classes);
			var allModules = @json($modules);
			var currentScholarYearId = "{{ config('scholaryear.current_scholar_year_id') }}";

			// Events
			$('#level_id').change(function () {
				$('#sub_level_id').html('');
				$('#classe_id').html('');
				$('#module_id').html('');
				var level = $(this).val();
				if(level != -1) {
					var subLevels = allSubLevels.filter(function (subLevel) {
						return level == subLevel.level_id;
					});
					
					loadSelect('sub_level_id', subLevels);
				}
			});

			$('#sub_level_id').on('change click', function () {
				$('#module_id').html('');
                var subLevel = $('#sub_level_id').val();
                var scholarYear = currentScholarYearId;
                if(subLevel != -1) {
                    var classes = allClasses.filter(function (classe) {
                        return subLevel == classe.sub_level_id && scholarYear == classe.scholar_year_id;
                    });
                    
                    loadSelect('classe_id', classes);
                }
            });

            $('#classe_id').on('change click', function () {
                var classeId = $(this).val();
                if(classeId != -1) {
                    var modules = allModules.filter(function (module) {
                        return classeId == module.classe_id;
                    });
                    
                    loadSelect('module_id', modules);
                }
            });

            // Helpers : 
			function loadSelect(tragetSelectId, items = []) {
				var options = '';
				for (var i = 0; i < items.length; i++) {
					options += '<option value="' + items[i].id + '">' + items[i].title + '</option>';
				}

				$('#' + tragetSelectId).html(options);
			}
		})
	</script>
@endsection