@extends('layouts.master')

@section('title', 'Ajouter nouvelle actualité')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-12">
                <h1>Nouvelle Actualité</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('news.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des actualités</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('news.index') }}">Actualités</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Nouvelle Actualité</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

		<form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
			@csrf
		    <div class="row">
		    	<div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-left">Image</h5>
                            <div class="separator mb-4"></div>
                            <img id="user-picture" style="width: 100%; height: 200px;" src="{{ asset('assets/img/profile-pic-l.png') }}" >
                            <input type="file" class="hide" name="image" id="file-user-picture">
                        </div>
                        <div class="card-footer bg-white">
                            <button id="select-user-picture" type="button" class="btn btn-primary btn-block">Choisie une image</button>
                        </div>
                    </div>
                </div>

		    	<div class="col-md-9">
		    		<div class="card mb-4">
	                    <div class="card-body">
	                        <h5>Actualité details</h5>
	                    	<div class="separator mb-5"></div>
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" placeholder="Titre">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="published_at">Date de publication</label>
                                <input type="text" class="form-control datepicker @error('published_at') is-invalid @enderror" name="published_at" readonly autocomplete="off" id="published_at" value="{{ old('published_at') }}" placeholder="Date de publication">
                                @error('published_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Contenu</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Contenu">{{ old('description') }}</textarea>
                            	@error('description')
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
@endsection

@section('plugin-javascript')
	<script src="{{ asset('assets/js/vendor/bootstrap-datepicker.js') }}"></script>
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#select-user-picture').click(function () {
                $('#file-user-picture').click();
            });

            $('#file-user-picture').change(function () {
                $('#user-picture').attr(
                    'src', window.URL.createObjectURL(this.files[0])
                );
            });
        })
    </script>
@endsection
