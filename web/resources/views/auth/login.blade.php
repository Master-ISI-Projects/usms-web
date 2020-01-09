@extends('layouts.master_auth')

@section('title', 'Authentification')

@section('content')
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side">

                            <p class="text-white h2">Accéder à votre compte</p>

                            <p class="white mb-0">
                                Veuillez utiliser vos identifiants pour vous connecter.
                            </p>
                        </div>
                        <div class="form-side">
                            {{-- <a href="Dashboard.Default.html">
                                <span class="logo-single"></span>
                            </a> --}}
                            <h6 class="mb-4">Login</h6>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span>E-mail</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                                    <span>Mot de passe</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">CONNECTER</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
