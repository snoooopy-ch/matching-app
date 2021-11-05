@extends('layouts.admin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    {{ __('my_profile') }}
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                {{ __('my_profile') }}
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{ asset('admin-assets/custom/img/default-avatar.png') }}" alt="Admin Avatar"/>
                                </div>
                            </div>
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">
                                   {{ Auth::user()->name }}
                                </span>
                                <a href="" class="m-card-profile__email m-link">
                                    {{ Auth::user()->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#update_profile" role="tab">
                                        {{ __('update_profile') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#change_password" role="tab">
                                        {{ __('change_password') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="update_profile">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <label for="name" class="col-2 col-form-label">
                                            {{ __('username') }} *
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="{{ Auth::user()->name }}" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="email" class="col-2 col-form-label">
                                            {{ __('email') }} *
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="email" value="{{ Auth::user()->email }}" id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="button" class="btn btn-accent m-btn m-btn--air m-btn--custom" id="btn_save">
                                                    {{ __('save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane " id="change_password">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <label for="current_password" class="col-3 col-form-label">
                                            {{ __('current_password') }} *
                                        </label>
                                        <div class="col-6">
                                            <input class="form-control m-input" type="password" id="current_pwd">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="new_password" class="col-3 col-form-label">
                                            {{ __('new_password') }} *
                                        </label>
                                        <div class="col-6">
                                            <input class="form-control m-input" type="password" id="new_pwd">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="new_password" class="col-3 col-form-label">
                                            {{ __('confirm_password') }} *
                                        </label>
                                        <div class="col-6">
                                            <input class="form-control m-input" type="password" id="confirm_pwd">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="button" class="btn btn-info m-btn m-btn--air m-btn--custom" id="btn_change_pwd">
                                                    {{ __('update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_save').click(function(){
            const name = $('#name').val();
            const email = $('#email').val();
            if (!name || !email) {
                toastr.error("{{ __('fill_required_fields') }}");
                return;
            }
            $.ajax({
                url: "{{ route('admin.profile.update') }}",
                type: 'POST',
                data: {
                    name: name,
                    email: email
                },
                success: function(resp) {
                    if(resp.status) {
                        toastr.success("{{ __('update_success') }}");
                        location.reload();
                    } else {
                        return;
                    }
                }
            })
        });
        $('#btn_change_pwd').click(function(){
            const currentPwd = $('#current_pwd').val();
            const newPwd = $('#new_pwd').val();
            const confirmPwd = $('#confirm_pwd').val();
            if (!currentPwd || !newPwd || !confirmPwd) {
                toastr.error("{{ __('fill_required_fields') }}");
                return;
            }
            if (newPwd !== confirmPwd) {
                toastr.error("{{ __('password_not_match') }}");
                return;
            }
            $.ajax({
                url: "{{ route('admin.profile.password.change') }}",
                type: 'POST',
                data: {
                    current_pwd: currentPwd,
                    new_pwd: newPwd,
                    confirm_pwd: confirmPwd
                },
                success: function(resp) {
                    if(resp.status) {
                        toastr.success("{{ __('update_success') }}");
                        location.reload();
                    } else {
                        toastr.error(resp.error_msg);
                        return;
                    }
                }
            })
        });
    });
</script>
@endsection
