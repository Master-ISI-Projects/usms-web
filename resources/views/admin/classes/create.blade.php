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
                                <label for="name">Nom</label>
                                <input type="text" class="form-control input-small @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Titre">
                            	@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="departement_id">Departement</label>
                                <select name="departement_id" class="form-control select2 @error('departement_id') is-invalid @enderror" id="departement_id">
                                	<option value="-1"> ---- </option>
                                	@foreach ($departements as $departement)
                                		<option {{ old('departement_id') == $departement->id ? 'selected' : '' }} value="{{ $departement->id }}">{{ $departement->name }}</option>
                                	@endforeach
                                </select>
                            	@error('departement_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="option_id">Option</label>
                                <select name="option_id" class="form-control @error('option_id') is-invalid @enderror" id="option_id">
                                </select>
                            	@error('option_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="scholar_year">Annee scolaire</label>
                                <input type="text" disabled id="scholar_year" class="form-control" value="{{ config('scholaryear.current_scholar_year') }}">
                            </div>
	                    </div>
	                </div>
		    	</div>

		    	<div class="col-md-9">
		    		<div class="card mb-4">
	                    <div class="card-body">
	                        <h5>Afféctation du semestres / étudiants</h5>
	                    	<div class="separator mb-5"></div>
	                    	<h5>Etudiants</h5>
	                    	<div class="separator mb-2"></div>
	                    	<table class="table table-bordered">
	                    		<tbody>
		                    		<tr>
		                    			<td width="80%">
		                    				<select name="students[]" class="form-control select2-single">
		                    					@foreach ($students as $student)
		                    						<option value="{{ $student->id }}">{{ $student->apogee_number . ' / ' . $student->user->full_name }}</option>
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
                            <h5>Semestres</h5>
                            <div class="separator mb-2"></div>
                            <table class="table table-bordered" id="semesters-table">
                                <tbody>
                                    <tr id="semester-row">
                                        <td width="80%">
                                            <select name="semesters[]" class="form-control semester-select">
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="20%">
                                            <button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button">
                                                <i class="simple-icon-minus btn-group-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon-xxs btn-primary btn-colner add-new-semester icon-button">
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
            var allDepartements = @json($departements);
            var allOptions = @json($options);
            var allSemesters = @json($semesters);
            var semesterSelectValues = @json($semesters);
            loadSelect('.semester-select', semesterSelectValues);

            // Events
            $('#departement_id').change(function () {
                $('#option_id').html('');
                var departement = $(this).val();
                if(departement != -1) {
                    var options = allOptions.filter(function (option) {
                        return departement == option.departement_id;
                    });

                    loadSelect('#option_id', options);
                }
            });

            $('#option_id, #departement_id').change(function () {
                $('.semester-select').html('');
                var option = $("#option_id").val();

                semesterSelectValues = allSemesters.filter(function (semester) {
                    return option == semester.option_id;
                });

                loadSelect('.semester-select', semesterSelectValues);
            });

			$('.add-new-student').click(function () {
				var row = '<tr> <td width="80%"> <select name="students[]" class="form-control select2-single"> @foreach ($students as $student) <option value="{{ $student->id }}">{{ $student->apogee_number . " / " . $student->user->full_name }}</option> @endforeach </select> </td> <td width="20%"> <button type="button"  class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button"> <i class="simple-icon-minus btn-group-icon"></i> </button> </td> </tr>';
				$(this).parent().parent().parent().append(row);
                $(".select2-single").last().select2({"width": "100%", "theme":"bootstrap"});
			});

            $('.add-new-semester').click(function () {
                var row = '<tr> <td width="80%"> <select name="semesters[]" class="form-control semester-select select2-single"></select> </td> <td width="20%"> <button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button"> <i class="simple-icon-minus btn-group-icon"></i> </button> </td> </tr>';
                $(this).parent().parent().parent().append(row);
                loadSelect('.semester-select:last', semesterSelectValues);
            });

            $('body').on("click", ".btn-remove-row", function(e) {
                if(confirm("Voulez vous vraiment supprimé ce ligne")) {
                    $(this).parent().parent().remove();
                }
            });

            // Helpers :
			function loadSelect(tragetSelectSelector, items = []) {
				var options = '<option value="-1">----</option>';
				for (var i = 0; i < items.length; i++) {
					options += '<option value="' + items[i].id + '">' + items[i].name + '</option>';
				}

				$(tragetSelectSelector).html(options);
			}
		})
	</script>
@endsection
