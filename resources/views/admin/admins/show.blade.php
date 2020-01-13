@extends('layouts.master')

@section('title', 'Administrateur : ' . $admin->full_name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Administrateur : {{ $admin->full_name }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('admins.edit', ['id' => $admin->id]) }}">Editer</a>
                        <form method="post" action="{{ route('admins.destroy', ['id' => $admin->id]) }}">
                            @csrf
                            @method('DELETE')
                            <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer ce l'administrateur : {{ $admin->full_name }} ?" href="{{ route('admins.destroy', ['id' => $admin->id]) }}">Supprimer</a>
                        </form>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.index') }}">Administrateurs</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $admin->full_name }}</li>
                    </ol>
                </nav>
                <div class="separator mb-4"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center">
                            <img id="admin-picture" class="img-circle border-gray" style="width: 150px; height: 150px;" src="{{ $admin->picture_path }}" >
                            <input type="file" class="hide" name="picture" id="file-admin-picture">
                        </div>
                        <div>
                            <div class="text-center pt-2">
                                <p class="list-item-heading pt-2 text-bold">
                                    <strong>{{ $admin->full_name }}</strong>
                                </p>
                            </div>
                            <p class="text-center">
                                {!! $admin->is_active_badge !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="col-12 col-right">
                    <div class="row mb-3">
                        <div class="card w-100">
                            <div class="card-body">
                                <h5>Informations personnel</h5>
                                <div class="separator mb-4"></div>
                                <table class="table table-bordered table-show mb-0"> 
                                    <tr>
                                        <th class="bg-gray">Civilité</th>
                                        <td>{!! $admin->gender_badge !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray">Prénom & Nom</th>
                                        <td>{{ $admin->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray">N° Tel</th>
                                        <td>{{ $admin->tel }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card w-100">
                            <div class="card-body">
                                <h5>Accès à la plateforme</h5>
                                <div class="separator mb-4"></div>
                                <table class="table table-bordered table-show mb-0"> 
                                    <tr>
                                        <th class="bg-gray">E-mail</th>
                                        <td>{{ $admin->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gray">Mot de passe</th>
                                        <td>{{ $admin->visible_password }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection