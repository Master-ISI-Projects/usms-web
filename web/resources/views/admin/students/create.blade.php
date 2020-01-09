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
	                    	<img id="user-picture" class="img-circle" style="width: 150px; height: 150px;" src="http://localhost/lab/school-cours/public/assets/img/profile-pic-l.jpg" >
	                    	<input type="file" class="hide" name="picture" id="file-user-picture">
	                    </div>
	                    <div class="card-footer bg-white">
	                    	<button id="select-user-picture" type="button" class="btn btn-primary btn-block">Choisie une image</button>
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
		                                <label for="registration_number">N° de l'etudiant</label>
		                                <input type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" id="registration_number" value="{{ old('registration_number') }}" placeholder="N° de l'etudiant">
		                            	@error('registration_number')
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
	                        	<div class="col-md-6">
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
	                        	<div class="col-md-6">
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
	                        </div>
	                        <div class="row">
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
		                                <label for="level_id">Niveau scolaire</label>
		                                <select name="level_id" class="form-control select2 @error('level_id') is-invalid @enderror" id="level_id">
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
									<div class="form-group mb-0">
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
		                                <label for="class_id">Classe</label>
		                                <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="class_id">
		                                </select>
		                            	@error('class_id')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
	                        	</div>
	                        </div>

	                        <h5 class="mt-4">Accès à la plateforme</h5>
	                    	<div class="separator mb-4"></div>
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
	                    		<div class="col-md-3">
		                            <div class="form-group">
		                                <label for="password">Mot de passe</label>
		                                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Mot de passe">
		                            </div>
		                        </div>
		                        <div class="col-md-3">
		                            <div class="form-group mb-0">
		                                <label for="password_confirmation">Confirmation</label>
		                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmation">
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
			var allLevels = @json($levels);
			var allSubLevels = @json($subLevels);
			var allClasses = @json($classes);

			// Events
			$('#level_id').change(function () {
				$('#sub_level_id, #class_id').html('');
				var level = $(this).val();
				var subLevels = allSubLevels.filter(function (subLevel) {
					return level == subLevel.level_id;
				});
				
				loadSelect('sub_level_id', subLevels);
			});

			$('#sub_level_id, #scholar_year_id').on('change click', function () {
				var subLevel = $('#sub_level_id').val();
				var scholarYear = $('#scholar_year_id').val();
				var classes = allClasses.filter(function (classe) {
					return subLevel == classe.sub_level_id && scholarYear == classe.scholar_year_id;
				});
				
				loadSelect('class_id', classes);
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
				var options = '';
				for (var i = 0; i < items.length; i++) {
					options += '<option value="' + items[i].id + '">' + items[i].title + '</option>';
				}

				$('#' + tragetSelectId).html(options);
			}
		})
	</script>
@endsection