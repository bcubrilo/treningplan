@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="form" >
           <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="E-Mail Address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <p class="message">{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Lozinka">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <p class="message">{{ $errors->first('password') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                    placeholder="Potvrdi lozinku">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <p class="message">{{ $errors->first('password_confirmation') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Resetuj šifru
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
