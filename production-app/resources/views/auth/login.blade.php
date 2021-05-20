@extends('layouts.app')

@section('content')

    <div class="login-page">

        <div class="form" >
            <p style="display:none;" class="message" @if($errors->has('email') || $errors->has('password')) {{ 'has-error'}} @endif>Logovanje nije uspjelo!</p>
            <form method="POST" action="{{ route('login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div>
                        <input id="email" type="email" placeholder="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div>
                        <input id="password" type="password" placeholder="lozinka" name="password" required>

                    </div>
                </div>

                <div>
                    <label>
                        <input style="max-width: 10px;text-align: left" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamti Me
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="message" href="{{ route('password.request') }}">
                            Zaboravili ste lozinku?
                        </a>
                    </div>
                </div>
                <div>
                    <p class="message">Niste registrovani? <a href="{{ route('register') }}">Napravite nalog</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection
