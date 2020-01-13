@extends('layouts.master')

@section('title', 'Etudiant : ' . $student->user->full_name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Etudiant : {{ $student->user->full_name }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('students.edit', ['id' => $student->id]) }}">Editer</a>
                        <form method="post" action="{{ route('students.destroy', ['id' => $student->id]) }}">
                            @csrf
                            @method('DELETE')
                            <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer l'etudiant : {{ $student->user->full_name }} ?" href="{{ route('students.destroy', ['id' => $student->id]) }}">Supprimer</a>
                        </form>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('students.index') }}">Etudiants</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $student->user->full_name }}</li>
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
                            <img id="user-picture" class="img-circle border-gray" style="width: 150px; height: 150px;" src="{{ $student->user->picture_path }}" >
                            <input type="file" class="hide" name="picture" id="file-user-picture">
                        </div>
                        <div>
                            <div class="text-center pt-2">
                                <p class="list-item-heading pt-2 text-bold">
                                    <strong>{{ $student->user->full_name }}</strong>
                                </p>
                            </div>
                            <p class="mb-4 text-center">
                                {!! $student->user->is_active_badge !!}
                            </p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-2">N° de l'etudiant</p>
                            <p class="mb-2">{{ $student->registration_number }}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-2">Niveau scolaire</p>
                            <p class="mb-2">{!! optional($student->currentLevel)->title ?? '<span class="text-danger">###</span>' !!} / {!! optional($student->currentSubLevel)->title ?? '<span class="text-danger">###</span>' !!}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-2">Classe</p>
                            <p class="mb-2">{!! optional($student->currentClasse)->title ?? '<span class="text-danger">###</span>' !!}</p>
                            <div class="separator"></div>
                            <p class="text-muted text-small mb-2 mt-2">Annee scolaire</p>
                            <p class="mb-0">{!! optional(optional($student->currentClasse)->scholarYear)->scholar_year ?? '<span class="text-danger">###</span>' !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="col-12 col-right">
                    <ul class="nav nav-tabs separator-tabs ml-0 mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="first-tab" data-toggle="tab" href="#informations-tab" role="tab" aria-controls="first" aria-selected="true">Plus d'informations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#history-tab" role="tab" aria-controls="second" aria-selected="false">Historique</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="informations-tab" role="tabpanel" aria-labelledby="informations-tab">
                            <div class="row mb-3">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h5>Informations personnel</h5>
                                        <div class="separator mb-4"></div>
                                        <table class="table table-bordered table-show mb-0"> 
                                            <tr>
                                                <th class="bg-gray">Civilité</th>
                                                <td>{!! $student->user->gender_badge !!}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">N° de l'etudiant</th>
                                                <td>{{ $student->registration_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Prénom & Nom</th>
                                                <td>{{ $student->user->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Date de naissance</th>
                                                <td>{{ Helper::formatDate($student->birth_date) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">N° Tel</th>
                                                <td>{{ $student->user->tel }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Adresse</th>
                                                <td>{{ $student->address }}</td>
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
                                                <td>{{ $student->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Mot de passe</th>
                                                <td>{{ $student->user->visible_password }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="history-tab" role="tabpanel" aria-labelledby="history-tab">
                            <div class="row">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h5>Historique</h5>
                                        <div class="separator mb-4"></div>
                                        <table class="table table-bordered responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Année scolaire</th>
                                                    <th>Niveau</th>
                                                    <th>Section</th>
                                                    <th>Classe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($student->classes as $classe)
                                                    <tr>
                                                        <td>{{ $classe->scholarYear->scholar_year }}</td>
                                                        <td>{{ $classe->subLevel->level->title }}</td>
                                                        <td>{{ $classe->subLevel->title }}</td>
                                                        <td>{{ $classe->title }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Aucune donnée disponible...</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection