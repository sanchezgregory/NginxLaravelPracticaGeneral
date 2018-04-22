@extends('layouts.appLogin')

@section('content')

    @include('partials.status')

    <div class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">

                    <h2 class="blog-post-title">@lang('auth.resetPassword')</h2>

                    <p class="blog-post-meta">{{ \Carbon\Carbon::now() }}</p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('auth.email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.sendPassword')
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.blog-post -->

            </div><!-- /.blog-main -->


        </div><!-- /.row -->

    </div><!-- /.container -->

@endsection
