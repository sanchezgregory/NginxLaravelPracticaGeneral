@extends('layouts.appLogin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @include('partials/errors')
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">

                        <h2 class="blog-post-title">@lang('auth.login')</h2>
                        <p class="blog-post-meta">{{ \Carbon\Carbon::now() }}</p>

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-sm-4 col-form-label text-md-right">@lang('auth.email')</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">@lang('auth.username')</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('auth.remember')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.login')
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('auth.forgot')
                                </a>
                            </div>
                        </div>
                    </form>
                </div><!-- /.blog-post -->

            </div><!-- /.blog-main -->


        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection