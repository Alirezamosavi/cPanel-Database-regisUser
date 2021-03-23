
<!-- register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

<!-- this is alert, if our code of recaptcha and password confirmation is inCorrect alarm to us -->
            @error('recaptcha_v3')
            <div class="alert alert-danger" role="alert">
               <p>{{ $message }}</p>
            </div>   
            @enderror
            
            
            @error('password')
            <div class="alert alert-primary" role="alert">
               <p>{{ $message }}</p>
            </div>   
            @enderror
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('new') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
<!-- this is input for reCaptcha and is hidden -->
                        <input type="hidden" name="recaptcha_v3" id="recaptcha_v3">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- they are need to relation App with Google -->

    <script src="https://www.google.com/recaptcha/api.js?render={{env('G_RECAPTCHA_SITE_KEY')}}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute("{{env('G_RECAPTCHA_SITE_KEY')}}", {action: 'homepage'}).then(function(token) {
            if(token) {
                //js
                document.getElementById('recaptcha_v3').value = token;
                //if you use jquery library
                $("#recaptcha_v3").val(token);
            }
        });
    });
</script>
</div>
@endsection
