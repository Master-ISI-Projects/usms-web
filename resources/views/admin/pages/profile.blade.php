@extends('layouts.master')

@section('title', 'Mon Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Mon Profile</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Mon Profile</li>
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