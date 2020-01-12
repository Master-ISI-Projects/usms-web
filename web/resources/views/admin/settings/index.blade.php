@extends('layouts.master')

@section('title', 'Paramétrage')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Paramétrage</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Paramétrage</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Paramétrage</h5>
                            <div class="separator mb-5"></div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Contenu</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="key" id="key" value="{{ old('key') }}" placeholder="Nom">
                                            </div>
                                        </td>
                                        <td width="70%">
                                            <div class="form-group">
                                                <textarea class="form-control" name="value" id="value" placeholder="Contenu" cols="30" rows="3">{{ old('value') }}</textarea>
                                            </div>
                                        </td>
                                        <td width="10%">
                                            <button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button">
                                                <i class="simple-icon-minus btn-group-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon-xxs btn-primary btn-colner add-new-row icon-button">
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

@section('custom-javascript')
    <script>
        $(document).ready(function () {
            $('.add-new-row').click(function () {
                var row = '<tr> <td width="20%"> <div class="form-group"> <input type="text" class="form-control" name="key" id="key" value="{{ old('key') }}" placeholder="Nom"> </div> </td> <td width="70%"> <div class="form-group"> <textarea class="form-control" name="value" id="value" placeholder="Contenu" cols="30" rows="3">{{ old('value') }}</textarea> </div> </td> <td width="10%"> <button type="button" class="mr-1 btn btn-icon-xxs btn-danger btn-remove-row btn-colner icon-button"> <i class="simple-icon-minus btn-group-icon"></i> </button> </td> </tr>';
                $(this).parent().parent().parent().append(row);
            });

            $('body').on("click", ".btn-remove-row", function(e) {
                if(confirm("Voulez vous vraiment supprimé ce ligne")) {
                    $(this).parent().parent().remove();
                }
            });

            $('body').on("keyup", ".key-input", function(e) {
                $(this).val(stringToSlug($(this).val()));
            });

            function stringToSlug (str) {
                str = str.replace(/^\s+|\s+$/g, '');
                str = str.toLowerCase();
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";
                for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }
                str = str.replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                return str;
            }
        });
    </script>
@endsection
