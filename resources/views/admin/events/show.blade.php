@extends('layouts.master')

@section('title', 'Événement: ' . $event->title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{ $event->title }}</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('events.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des événements</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('events.index') }}">Événements</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $event->title }}</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="text-left">Image</h5>
                        <div class="separator mb-4"></div>
                        <img id="user-picture" style="width: 100%; height: 200px;" src="{!! $event->image_path !!}" >
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>
                            <span>Détails</span>
                            <span class="float-right">
                                <a href="{{ route('events.edit', ['id' => $event->id]) }}" class="header-icon btn btn-empty text-success d-contents">
                                    <i class="simple-icon-pencil"></i>
                                </a>
                            </span>
                        </h5>
                        <div class="separator mb-4"></div>
                        <table class="table table-bordered table-show mb-0">
                            <tr>
                                <th class="bg-gray">Titre</th>
                                <td>{{ $event->title }}</td>
                            </tr>
                            <tr>
                                <th class="bg-gray">Date d'événement</th>
                                <td>{{ Helper::formatDate($event->start_at, 'd-m-Y à h:i') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-gray">Durée</th>
                                <td>{{ $event->duration }}</td>
                            </tr>
                            <tr>
                                <th class="bg-gray">Année scolaire</th>
                                <td>{{ $event->scholarYear->scholar_year }}</td>
                            </tr>
                            <tr>
                                <th class="bg-gray">Description</th>
                                <td>{{ $event->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
