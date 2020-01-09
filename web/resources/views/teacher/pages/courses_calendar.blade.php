@extends('layouts.master')

@section('title', 'Mon emploi de temps')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Mon emploi de temps</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Mon emploi de temps</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <course-calendar :teacher-id="{{ auth()->user()->teacher->id }}"></course-calendar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugin-stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fullcalendar.min.css') }}">
@endsection

@section('plugin-javascript')
    <script src="{{ asset('assets/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/locale-all.js') }}"></script>
@endsection