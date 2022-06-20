<!DOCTYPE html>
<html lang="{{ getCurrentLocaleCode() }}">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        @lang('auth.auth')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ mix('_admin/css/material-dashboard.css') }}"/>
    <link rel="stylesheet" href="{{ asset('_admin/css/admin-main.css') }}?{{ assetFilemtime('css/admin-main.css') }}"/>
    <script src="{{ asset( 'js/core/jquery.min.js') }}"></script>
</head>

<body id="login" class="" style="background: url({{asset('_admin/images/staff/auth-bg.jpg')}});">
<div class="wrapper ">
    <div class="main-panel login_panel">
        <div class="content d-flex flex-column justify-content-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-center">@lang('auth.auth')</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.login') }}" class="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                @if ($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p> @endif
                                                <label class="bmd-label-floating">E-mail</label>
                                                <input type="text" class="form-control" name="login" value="{{ old('login') }}" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                @if ($errors->has('password'))
                                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                                @endif
                                                <label class="bmd-label-floating">{{ __('auth.password') }}</label>
                                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">@lang('auth.remember')</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary login_btn col-md-6">@lang('generic.submit')</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>

</body>
</html>
