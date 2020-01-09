@extends('layouts.master')

@section('title', 'Ajouter nouvelle classe')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-12">
                <h1>Nouvelle classe</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('classes.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des classes</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('classes.index') }}">Classes</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Nouveau classe</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

		<form action="{{ route('classes.store') }}" method="post" enctype="multipart/form-data">
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
	                        <h5>Affectation du etudiants / modules</h5>
	                    	<div class="separator mb-5"></div>
	                    	<h5>Etudiants</h5>
	                    	<div class="separator mb-2"></div>
	                    	<table class="table table-bordered">
	                    		<tbody>
		                    		<tr>
		                    			<td width="80%">
		                    				<select name="students[]" class="form-control select2-single">
		                    					@foreach ($students as $student)
		                    						<option value="{{ $student->id }}">{{ $student->registration_number . ' / ' . $student->user->full_name }}</option>
		                    					@endforeach
		                    				</select>
		                    			</td>
		                    			<td width="20%">
		                    				<button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button">
				                                <i class="simple-icon-minus btn-group-icon"></i>
				                            </button>
		                    				<button type="button" class="btn btn-icon-xxs btn-primary btn-colner add-new-student icon-button">
				                                <i class="simple-icon-plus btn-group-icon"></i>
				                            </button>
		                    			</td>
		                    		</tr>
	                    		</tbody>
	                    	</table>

	                    	<h5 class="mt-5">Affectation des modules</h5>
	                    	<div class="separator mb-2"></div>
	                        <table class="table table-bordered">
	                    		<tbody>
		                    		<tr>
		                    			<td width="70%">
		                    				<input type="text" name="modules[]" class="form-control" placeholder="Module ...">
		                    			</td>
		                    			<td width="10%">
		                    				<input type="color" name="colors[]">
		                    			</td>
		                    			<td width="20%">
		                    				<button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button">
				                                <i class="simple-icon-minus btn-group-icon"></i>
				                            </button>
		                    				<button type="button" class="btn btn-icon-xxs btn-primary btn-colner add-new-module icon-button">
				                                <i class="simple-icon-plus btn-group-icon"></i>
				                            </button>
		                    			</td>
		                    		</tr>
	                    		</tbody>
	                    	</table>

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
	<script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
@endsection

@section('custom-javascript')
	<script>
		$(document).ready(function () {
			//init 
			var allLevels = @json($levels);
			var allSubLevels = @json($subLevels);

			// Events
			$('#level_id').change(function () {
				$('#sub_level_id').html('');
				var level = $(this).val();
				if(level != -1) {
					var subLevels = allSubLevels.filter(function (subLevel) {
						return level == subLevel.level_id;
					});
					
					loadSelect('sub_level_id', subLevels);
				}
			});

			$('.add-new-student').click(function () {
				var row = '<tr> <td width="80%"> <select name="students[]" class="form-control select2-single"> @foreach ($students as $student) <option value="{{ $student->id }}">{{ $student->registration_number . " / " . $student->user->full_name }}</option> @endforeach </select> </td> <td width="20%"> <button type="button"  class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button"> <i class="simple-icon-minus btn-group-icon"></i> </button> </td> </tr>';
				$(this).parent().parent().parent().append(row);
				$(".select2-single").last().select2({"width": "100%", "theme":"bootstrap"});
			});

			$('.add-new-module').click(function () {
				var row = '<tr> <td width="70%"> <input type="text" name="modules[]" class="form-control" placeholder="Module ..."> </td> <td width="10%"><input type="color" name="colors[]"></td><td width="20%"> <button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button"> <i class="simple-icon-minus btn-group-icon"></i> </button> </td> </tr>';
				$(this).parent().parent().parent().append(row);
			});

            $('body').on("click", ".btn-remove-row", function(e) {
                if(confirm("Voulez vous vraiment supprimé ce ligne")) {
                    $(this).parent().parent().remove();
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