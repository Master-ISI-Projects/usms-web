@extends('layouts.master')

@section('title', 'Ajouter nouveau etudiant')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-12">
                <h1>Nouveau etudiant</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('students.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des etudiants</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Etudiants</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Nouveau etudiant</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

		<form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
			@csrf
		    <div class="row">
		    	<div class="col-md-3">
		    		<div class="card mb-4">
	                    <div class="card-body text-center">
	                        <h5 class="text-left">Photo</h5>
	                        <div class="separator mb-4"></div>
	                    	<img id="user-picture" class="img-circle" style="width: 150px; height: 150px;" src="{{ asset('assets/img/profile-pic-l.png') }}" >
	                    	<input type="file" class="hide" name="picture" id="file-user-picture">
	                    </div>
	                    <div class="card-footer bg-white">
	                    	<button id="select-user-picture" type="button" class="btn btn-primary btn-block">Choisir une image</button>
	                    </div>
	                </div>

	                <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Etat</h6>
							<div class="form-group position-relative mb-0">
			            		<div class="custom-switch custom-switch-primary-inverse mt-2">
			                        <input class="custom-switch-input" id="is-active" name="is_active" type="checkbox" checked="{{ old('is_active') ? 'on' : 'off' }}">
			                        <label class="custom-switch-btn" for="is-active"></label>
			                    </div>
					        </div>
                        </div>
                    </div>
		    	</div>

		    	<div class="col-md-9">
		    		<div class="card mb-4">
	                    <div class="card-body">
	                        <h5>Informations personnel</h5>
	                    	<div class="separator mb-4"></div>
	                        <div class="row">
	                        	<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="registration_number">N° d'apogee</label>
		                                <input type="text" class="form-control @error('apogee_number') is-invalid @enderror" name="apogee_number" id="apogee_number" value="{{ old('apogee_number') }}" placeholder="N° d'apogee">
		                            	@error('apogee_number')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        	<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="gender">Civilité</label>
		                                <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
		                                	@foreach (Constant::USERS_GENDERS as $gender)
		                                		<option {{ old('gender') == $gender ? 'selected' : '' }} value="{{ $gender }}">{{ $gender }}</option>
		                                	@endforeach
		                                </select>
		                            	@error('gender')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="first_name">Nom</label>
		                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Nom">
		                            	@error('first_name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        	<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="last_name">Prénom</label>
		                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Prénom">
		                            	@error('last_name')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        	<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="birth_date">Date de naissance</label>
		                                <input type="text" class="form-control datepicker @error('birth_date') is-invalid @enderror" name="birth_date" readonly autocomplete="off" id="birth_date" value="{{ old('birth_date') }}" placeholder="Date de naissance">
		                            	@error('birth_date')
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
		                                <label for="email">E-mail</label>
		                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="E-mail">
		                            	@error('email')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                    		</div>
	                        	<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="tel">N° Tel</label>
		                                <input type="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" id="tel" value="{{ old('tel') }}" placeholder="N° Tel">
		                            	@error('tel')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        </div>
                            <div class="form-group">
                                <label for="address">Adresse</label>
                                <textarea class="form-control" name="address" id="address" value="{{ old('address') }}" cols="30" rows="3" placeholder="Adresse"></textarea>
                            </div>

	                        <h5 class="mt-4">Affectation</h5>
	                        <div class="separator mb-4"></div>
	                        <div class="row">
	                        	<div class="col-md-3">
			                        <div class="form-group">
		                                <label for="scholar_year_id">Annee scolaire</label>
		                                <select name="scholar_year_id" class="form-control @error('scholar_year_id') is-invalid @enderror" id="scholar_year_id">
		                                	@foreach ($allScholarYears as $scholarYear)
		                                		<option {{ (old('scholar_year_id') == $scholarYear->id || config('scholaryear.current_scholar_year') == $scholarYear->scholar_year) ? 'selected' : '' }} value="{{ $scholarYear->id }}">{{ $scholarYear->scholar_year }}</option>
		                                	@endforeach
		                                </select>
		                            	@error('scholar_year_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        	<div class="col-md-3">
			                    	<div class="form-group">
		                                <label for="departement_id">Departement</label>
		                                <select name="departement_id" class="form-control select2 @error('departement_id') is-invalid @enderror" id="departement_id">
		                                	<option value="-1">----</option>
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
	                        	</div>
	                        	<div class="col-md-3">
									<div class="form-group mb-0">
		                                <label for="option_id">Option</label>
		                                <select name="option_id" class="form-control @error('option_id') is-invalid @enderror" id="option_id">
		                                </select>
		                            	@error('option_id')
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
@endsection

@section('plugin-javascript')
	<script src="{{ asset('assets/js/vendor/bootstrap-datepicker.js') }}"></script>
@endsection

@section('custom-javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			//init
			var allLevels = @json($departements);
			var allOptions = @json($options);
			var allClasses = @json($classes);

			// Events
			$('#departement_id').change(function () {
				$('#option_id, #classe_id').html('');
				var departement = $(this).val();
				var options = allOptions.filter(function (subLevel) {
					return departement == subLevel.departement_id;
				});

				loadSelect('option_id', options);
			});

			$('#option_id, #scholar_year_id').on('change click', function () {
				var subLevel = $('#option_id').val();
				var scholarYear = $('#scholar_year_id').val();
				var classes = allClasses.filter(function (classe) {
					return subLevel == classe.option_id && scholarYear == classe.scholar_year_id;
				});

				loadSelect('classe_id', classes);
			});

			$('#select-user-picture').click(function () {
				$('#file-user-picture').click();
			});

			$('#file-user-picture').change(function () {
				$('#user-picture').attr(
					'src', window.URL.createObjectURL(this.files[0])
				);
			});

			// Helpers :
			function loadSelect(tragetSelectId, items = []) {
				var options = '<option value="-1">----</option>';
				for (var i = 0; i < items.length; i++) {
					options += '<option value="' + items[i].id + '">' + items[i].name + '</option>';
				}

				$('#' + tragetSelectId).html(options);
			}
		})
	</script>
@endsection
