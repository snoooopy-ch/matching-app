@extends('layouts.admin')

@section('page_css')
<link href="{{asset('admin-assets/custom/css/app.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet">
                    <!--begin::Header-->
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    {{ __('edit_detail') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <input type="hidden" id="id" value="{{ $app->id }}">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>
                                        {{ __('title') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->title }}" id="title">
                                </div>
                                <div class="col-lg-3">
                                    <label class="">
                                        Google Play ID *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->google_play_id }}" id="google_play_id">
                                </div>
                                <div class="col-lg-3">
                                    <label class="">
                                        Apple Store ID *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->apple_store_id }}" id="apple_store_id">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label for="google_play_url">
                                        Google Play URL *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->google_play_url }}" id="google_play_url">
                                </div>
                                <div class="col-lg-4">
                                    <label for="apple_store_url">
                                        Apple Store URL *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->apple_store_url }}" id="apple_store_url">
                                </div>
                                <div class="col-lg-4">
                                    <label for="web_url">
                                        Web URL *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->web_url }}" id="web_url">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>
                                        {{ __('icon') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->icon }}" id="icon">
                                </div>
                                <div class="col-lg-6">
                                    <label class="">
                                        {{ __('genre') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control m-input" value="{{ $app->genre }}" id="genre">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3">
                                    <label class="">
                                        {{ __('price') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control m-input" value="{{ $app->price }}" id="price">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="">
                                        {{ __('currency') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control m-input" id="currency">
                                            <option value="USD" @if($app->currency == 'USD') {{ 'selected' }} @endif>USD</option>
                                            <option value="JPY" @if($app->currency == 'JPY') {{ 'selected' }} @endif>JPY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="google_score">
                                        Google {{ __('score') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->google_score }}" id="google_score">
                                </div>
                                <div class="col-lg-3">
                                    <label for="google_ratings">
                                        Google {{ __('ratings') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->google_ratings }}" id="google_ratings">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3">
                                    <label for="apple_score">
                                        Apple {{ __('score') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->apple_score }}" id="apple_score">
                                </div>
                                <div class="col-lg-3">
                                    <label for="score">
                                        Apple {{ __('ratings') }} *
                                    </label>
                                    <input type="number" class="form-control m-input" value="{{ $app->apple_ratings }}" id="apple_ratings">
                                </div>
                                <div class="col-lg-3">
                                    <label>
                                        {{ __('is_free') }} *
                                    </label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio m-radio--solid">
                                            <input type="radio" name="is_free" value="1" @if($app->is_free == 1) {{ 'checked' }} @endif>
                                            {{ __('free') }}
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input type="radio" name="is_free" value="0" @if($app->is_free == 0) {{ 'checked' }} @endif>
                                            {{ __('purchase') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="developer">
                                        {{ __('developer') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->developer }}" id="developer">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="android_version">
                                        Android {{ __('version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->android_version }}" id="android_version">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="android_size">
                                        Android {{ __('size') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->android_size }}" id="android_size">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="android_size">
                                        iOS {{ __('version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->ios_version }}" id="ios_version">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="ios_size">
                                        iOS {{ __('size') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->ios_size }}" id="ios_size">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="content_rating">
                                        {{ __('content_rating') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->content_rating }}" id="content_rating">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="required_android_version">
                                        {{ __('required_android_version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->required_android_version }}" id="required_android_version">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="required_ios_version">
                                        {{ __('required_ios_version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->required_ios_version }}" id="required_ios_version">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="google_install_cnt">
                                        Google {{ __('install_cnt') }}
                                    </label>
                                    <input type="text" class="form-control m-input" value="{{ $app->google_install_cnt }}" id="google_install_cnt">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="release_date">
                                        Google {{ __('release_date') }}
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input"  placeholder="{{ __('select_date') }}" id="google_release_date"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="update_date">
                                        Google {{ __('update_date') }}
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input"  placeholder="{{ __('update_date') }}" id="google_update_date"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="release_date">
                                        Apple {{ __('release_date') }}
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input"  placeholder="{{ __('select_date') }}" id="apple_release_date"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="update_date">
                                        Apple {{ __('update_date') }}
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input"  placeholder="{{ __('update_date') }}" id="apple_update_date"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="scene_ids">
                                        {{ __('scene') }}
                                    </label>
                                    <select class="form-control m-select2" id="scene_ids" multiple="multiple">
                                        @foreach ($scenes as $scene)
                                            <option value="{{ $scene->id }}">{{ $scene->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="category_id">
                                        {{ __('category') }}
                                    </label>
                                    <select class="form-control m-input" id="category_id">
                                        <option value="">{{ __('select_category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if($app->category_id == $category->id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6 col-md-12">
                                <label for="store_review">
                                    {{ __('store_review') }} *
                                </label>
                                <div class="summernote" id="store_review"></div>
                                <div class="m--hide" id="hidden_store_review"></div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="fare_system">
                                    {{ __('fare_system') }} *
                                </label>
                                <div class="summernote" id="fare_system"></div>
                                <div class="m--hide" id="hidden_fare_system"></div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6 col-md-12">
                                <label for="description">
                                    {{ __('description') }} *
                                </label>
                                <div class="summernote" id="description"></div>
                                <div class="m--hide" id="hidden_desc"></div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="admin_note">
                                    {{ __('admin_note') }}
                                </label>
                                <div class="summernote" id="admin_note"></div>
                                <div class="m--hide" id="hidden_admin_note"></div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="status">
                                    {{ __('status') }} *
                                </label>
                                <select class="form-control m-input" id="status">
                                    <option value="0" @if($app->status == 0) {{ 'selected' }} @endif>{{ __('draft') }}</option>
                                    <option value="1" @if($app->status == 1) {{ 'selected' }} @endif>{{ __('published') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-primary" id="btn_update">
                                            {{ __('save') }}
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('admin.app.index') }}'">
                                            {{ __('cancel') }}
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
@endsection

@section('page_js')
<script type="text/javascript">
const sceneIds = "{{ $scene_ids }}";
const googleReleaseDate = "{{ $app->google_release_date }}";
const googleUpdateDate = "{{ $app->google_update_date }}";

const appleReleaseDate = "{{ $app->apple_release_date }}";
const appleUpdateDate = "{{ $app->apple_update_date }}";

const description = `{{ $app->description }}`;
const storeReview = `{{ $app->store_review }}`;
const fareSystem = `{{ $app->fare_system }}`;
const adminNote = `{{ $app->admin_note }}`;

$(document).ready(function(){
    $('.summernote').summernote({
        lang: 'ja-JP',
        height: 250
    });

    // scene_ids
    $('#scene_ids').select2({
        placeholder: "{{ __('select_scene') }}",
    });

    $('#scene_ids').val(sceneIds.split(','));
    $('#scene_ids').change();

    // date picker
    $('#google_release_date, #google_update_date').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
        autoclose: true,
        format: "yyyy-mm-dd",
    });
    if (googleReleaseDate != 'NaN') {
        $('#google_release_date').val(formatDate(googleReleaseDate));
    }
    if (googleUpdateDate != 'NaN') {
        $('#google_update_date').val(formatDate(googleUpdateDate));
    }
    if (appleReleaseDate != 'NaN') {
        $('#apple_release_date').val(formatDate(appleReleaseDate));
    }
    if (appleUpdateDate != 'NaN') {
        $('#apple_update_date').val(formatDate(appleUpdateDate));
    }
    $('#hidden_desc').html(description);
    $('#hidden_admin_note').html(adminNote);
    $('#hidden_fare_system').html(fareSystem);
    $('#hidden_store_review').html(storeReview);

    $('#description').summernote("code", $('#hidden_desc').text());
    $('#fare_system').summernote("code", $('#hidden_fare_system').text());
    $('#store_review').summernote("code", $('#hidden_store_review').text());
    $('#admin_note').summernote("code", $('#hidden_admin_note').text());

    $("#btn_update").click(function(){
        const id = $("#id").val();
        const title = $("#title").val();
        const googlePlayId = $("#google_play_id").val();
        const appleStoreId = $("#apple_store_id").val();
        const googlePlayUrl = $("#google_play_url").val();
        const appleStoreUrl = $("#apple_store_url").val();
        const webUrl = $("#web_url").val();
        const genre = $("#genre").val();
        const icon = $("#icon").val();
        const price = $("#price").val();
        const currency = $("#currency").val();
        const googleScore = $("#google_score").val();
        const appleScore = $("#apple_score").val();
        const googleRatings = $("#google_ratings").val();
        const appleRatings = $("#apple_ratings").val();
        const isFree = $("input[name='is_free']:checked").val();
        const developer = $("#developer").val();
        const androidVersion = $("#android_version").val();
        const iosVersion = $("#ios_version").val();
        const androidSize = $("#android_size").val();
        const iosSize = $("#ios_size").val();
        const contentRating = $("#content_rating").val();
        const requiredAndroidVersion = $("#required_android_version").val();
        const requiredIosVersion = $("#required_ios_version").val();
        const googleInstallCnt = $("#google_install_cnt").val();
        const googleReleaseDate = $("#google_release_date").val();
        const googleUpdateDate = $("#google_update_date").val();

        const appleReleaseDate = $("#apple_release_date").val();
        const appleUpdateDate = $("#apple_update_date").val();
        const description = $("#description").summernote('code');
        const fareSystem = $("#fare_system").summernote('code');
        const storeReview = $("#store_review").summernote('code');

        const sceneIds = $("#scene_ids").val();
        const categoryId = $("#category_id").val();
        const adminNote = $("#admin_note").summernote('code');
        const status = $("#status").val();

        if (!title || !googlePlayId || !appleStoreId || !googlePlayUrl || !appleStoreUrl || !webUrl || !genre || !icon || !price || !currency || 
        !googleScore || !appleScore || !googleRatings || !appleRatings || !description || !categoryId) {
            toastr.error("{{ __('fill_required_fields') }}");
            return;
        }
        $.ajax({
            url: "/admin/app/" + id,
            type: 'PUT',
            data: {
                title: title,
                google_play_id: googlePlayId,
                apple_store_id: appleStoreId,
                google_play_url: googlePlayUrl,
                apple_store_url: appleStoreUrl,
                web_url: webUrl,
                genre: genre,
                icon: icon,
                price: price,
                currency: currency,
                google_score: googleScore,
                apple_score: appleScore,
                google_ratings: googleRatings,
                apple_ratings: appleRatings,
                is_free: isFree,
                developer: developer,
                android_version: androidVersion,
                android_size: androidSize,
                ios_version: iosVersion,
                ios_size: iosSize,
                content_rating: contentRating,
                required_android_version: requiredAndroidVersion,
                required_ios_version: requiredIosVersion,
                google_install_cnt: googleInstallCnt,
                google_release_date: new Date(googleReleaseDate).getTime(),
                google_update_date: new Date(googleUpdateDate).getTime(),
                apple_release_date: new Date(appleReleaseDate).getTime(),
                apple_update_date: new Date(appleUpdateDate).getTime(),
                description: description,
                fare_system: fareSystem,
                store_review: storeReview,
                scene_ids: sceneIds,
                category_id: categoryId,
                admin_note: adminNote,
                status: status
            },
            success: function(resp) {
                if(resp.status) {
                    toastr.success("{{ __('update_success') }}");
                    setTimeout(() => {
                        location.href="{{ route('admin.app.index') }}";
                    }, 1000);
                } else {
                    toastr.error(resp.msg);
                    return;
                }
            }
        })
    });
})
</script>
@endsection
