<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} | {{ __('login') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="{{asset('admin-assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin-assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->
        <!--begin: Custom Styles-->
        <link href="{{asset('admin-assets/custom/css/main.css')}}" rel="stylesheet" type="text/css" />
        <!--end: Custom Styles-->
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin-assets/custom/img/favicon-96x96.png') }}">
    </head>
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
        <!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url({{ asset('admin-assets/app/media/img/bg/bg-2.jpg') }});">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<img src="{{ asset('admin-assets/custom/img/login-logo.png') }}">
                        </div>
                        <div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									{{ __('signin_to_admin') }}
								</h3>
                            </div>
                            <form class="m-login__form m-form" method="POST" action="{{url('admin/login')}}">
                                {{ csrf_field() }}
                                <div class="form-group m-form__group has-danger">
                                    <input class="form-control m-input" type="email" value="{{ old('email') }}" placeholder="{{ __('email') }}" name="email">
                                    @error('email')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group has-danger">
                                    <input class="form-control m-input m-login__form-input--last" value="{{ old('password') }}" type="password" placeholder="{{ __('password') }}" name="password" autocomplete="off">
                                    @error('password')
                                        <div class="form-control-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="m-login__form-action">
									<button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
										{{ __('sign_in') }}
									</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <!--begin::Global Theme Bundle -->
        <script src="{{asset('admin-assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin-assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
        <!--end::Global Theme Bundle -->
    </body>
</html>
