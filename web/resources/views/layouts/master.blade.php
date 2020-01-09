<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/font/iconsmind-s/css/iconsminds.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font/simple-line-icons/css/simple-line-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.rtl.only.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sweetalert.css') }}"/>
    
    <link href="{{ asset("assets/css/app.css") }}" rel="stylesheet"/>

    @yield('plugin-stylesheet')

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script>
        window.assetsUrl = "{{ asset('/') }}";
        window.baseUrl = "{{ url('/') }}";
        window.currentScolarYear = "{{ config('scholaryear.current_scholar_year') }}";
    </script>

    @yield('custom-stylesheet')
</head>

<body id="app-container" class="menu-default show-spinner">

    @include('layouts.includes.navbar')

    @include('layouts.includes.sidebar')

    <main id="app-root">
        @yield('content')
    </main>

    <script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/mousetrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/sweetalert.js') }}" type="text/javascript"></script>
    
    @yield('plugin-javascript')
    
    <script src="{{ asset('assets/js/dore.script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.link-type').click(function () {
                window.location.href = $(this).data('url');
            });

            try {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                });
            } catch (e) {
                // console.log(e)
            }

            $('.btn-delete-resource').click(function (event) {
                event.preventDefault();
                var form = $(this).data('form-id') != null ? $('#' + $(this).data('form-id')) : $(this).parent();
                if($(this).hasClass('redirect-after-confirmation')) {
                    swal.queue([{
                        title: 'Etes-vous sûr?',
                        text: $(this).data('confirmation-message'),
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Supprimer!',
                        showLoaderOnConfirm: true,
                        preConfirm:()  => {
                            return new Promise((resolve) =>  {
                                form.submit();
                            })
                        }
                    }])
                }
            });
        })
    </script>

    @yield('custom-javascript')
    
    <script src="{{ asset("assets/js/app.js") }}" defer></script>

    @include('layouts.includes.messages')
</body>

</html>