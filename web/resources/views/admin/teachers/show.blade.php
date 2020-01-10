@extends('layouts.master')

@section('title', 'Enseignant : ' . $teacher->user->full_name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Enseignant : {{ $teacher->user->full_name }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('teachers.edit', ['id' => $teacher->id]) }}">Editer</a>
                        <form method="post" action="{{ route('teachers.destroy', ['id' => $teacher->id]) }}">
                            @csrf
                            @method('DELETE')
                            <a class="dropdown-item btn-delete-resource redirect-after-confirmation" data-confirmation-message="Voulez vous vraiment supprimer l'enseignant : {{ $teacher->user->full_name }} ?" href="{{ route('teachers.destroy', ['id' => $teacher->id]) }}">Supprimer</a>
                        </form>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('teachers.index') }}">Enseignants</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $teacher->user->full_name }}</li>
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
                            <img id="user-picture" class="img-circle border-gray" style="width: 150px; height: 150px;" src="{{ $teacher->user->picture_path }}" >
                            <input type="file" class="hide" name="picture" id="file-user-picture">
                        </div>
                        <div>
                            <div class="text-center pt-2">
                                <p class="list-item-heading pt-2 text-bold">
                                    <strong>{{ $teacher->user->full_name }}</strong>
                                </p>
                            </div>
                            <p class="text-center">
                                {!! $teacher->user->is_active_badge !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 w-100">
                            <span class="text-uppercase">Departement</span>
                            <span class="float-right text-muted text-primary">{{ $teacher->departement->name }}</span>
                        </h6>
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
                            <a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#history-tab" role="tab" aria-controls="second" aria-selected="false">Modules</a>
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
                                                <td>{!! $teacher->user->gender_badge !!}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Prénom & Nom</th>
                                                <td>{{ $teacher->user->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">Date de naissance</th>
                                                <td>{{ Helper::formatDate($teacher->birth_date) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">N° Tel</th>
                                                <td>{{ $teacher->user->tel }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-gray">E-mail</th>
                                                <td>{{ $teacher->user->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="history-tab" role="tabpanel" aria-labelledby="history-tab">
                            <div class="row">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h5>Historique</h5>
                                        <div class="separator mb-4"></div>
                                        <table class="table table-bordered responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Titre</th>
                                                    <th>Module</th>
                                                    <th>Classe</th>
                                                    <th>Date publication</th>
                                                    <th>Durée</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($teacher->courses as $course)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('courses.show', ['id' => $course->id]) }}">
                                                                {{ $course->title }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $course->module->title }}</td>
                                                        <td>
                                                            <a href="{{ route('classes.show', ['id' => $course->module->classe_id]) }}">{{ $course->module->classe->title }}</a>
                                                        </td>
                                                        <td>{{ Helper::formatDate($course->published_at, 'd-m-Y à h:i') }}</td>
                                                        <td>
                                                            <span class="badge badge-primary">{{ $course->duration }} Minutes</span>
                                                        </td>
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
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin-stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection

@section('plugin-javascript')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
@endsection

@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-delete-resource').click(function (event) {
                event.preventDefault();
                $(this).parent().submit();
            });
        });
    </script>
@endsection
