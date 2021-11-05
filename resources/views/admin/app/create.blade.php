@extends('layouts.admin')

@section('page_css')
<link href="{{asset('admin-assets/custom/css/app.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet" id="create_app_form">
                    <!--begin::Header-->
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{ __('new_app') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label for="google_play_id">
                                        Google Play ID *
                                    </label>
                                    <input type="text" class="form-control m-input" id="google_play_id">
                                    <span class="m-form__help">
                                        jp.eure.android.pairs
                                    </span>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-info" style="margin-top: 27px" id="btn_google_scrape">{{ __('scraping') }}</button>
                                </div>
                                <div class="col-lg-4">
                                    <label for="apple_store_id">
                                        Apple Store ID *
                                    </label>
                                    <input type="text" class="form-control m-input" id="apple_store_id">
                                    <span class="m-form__help">
                                        1012791734
                                    </span>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-info" style="margin-top: 27px" id="btn_apple_scrape">{{ __('scraping') }}</button>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="title">
                                        {{ __('title') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" id="title">
                                </div>
                                <div class="col-lg-6">
                                    <label for="web_url">
                                        Web URL *
                                    </label>
                                    <input type="text" class="form-control m-input" id="web_url">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="google_play_url">
                                        Google Play URL *
                                    </label>
                                    <input type="text" class="form-control m-input" id="google_play_url">
                                </div>
                                <div class="col-lg-6">
                                    <label for="apple_store_url">
                                        Apple Store URL *
                                    </label>
                                    <input type="text" class="form-control m-input" id="apple_store_url">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label class="">
                                        {{ __('genre') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control m-input" id="genre">
                                        <span class="m-form__help">
                                            Dating, Social Networking
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>
                                        {{ __('icon') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" id="icon">
                                    <span class="m-form__help">
                                        {{ __('enter_app_icon') }}
                                    </span>
                                </div>
                                <div class="col-lg-2">
                                    <label class="">
                                        {{ __('price') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control m-input" id="price">
                                        <span class="m-form__help">
                                            f.g. 0 or 10.99
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="">
                                        {{ __('currency') }} *
                                    </label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control m-input" id="currency">
                                            <option value="USD">USD</option>
                                            <option value="JPY">JPY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3">
                                    <label for="google_score">
                                        Google {{ __('score') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" id="google_score">
                                </div>
                                <div class="col-lg-3">
                                    <label for="google_ratings">
                                        Google {{ __('ratings') }} *
                                    </label>
                                    <input type="number" class="form-control m-input" id="google_ratings">
                                </div>
                                <div class="col-lg-3">
                                    <label for="apple_score">
                                        Apple {{ __('score') }} *
                                    </label>
                                    <input type="text" class="form-control m-input" id="apple_score">
                                </div>
                                <div class="col-lg-3">
                                    <label for="apple_ratings">
                                        Apple {{ __('ratings') }} *
                                    </label>
                                    <input type="number" class="form-control m-input" id="apple_ratings">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3">
                                    <label>
                                        {{ __('is_free') }} *
                                    </label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio m-radio--solid">
                                            <input type="radio" name="is_free" value="1" checked id="free">
                                            {{ __('free') }}
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid">
                                            <input type="radio" name="is_free" value="0" id="purchase">
                                            {{ __('purchase') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="developer">
                                        {{ __('developer') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="developer">
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="android_version">
                                        Android {{ __('version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="android_version">
                                    <span class="m-form__help">
                                        6.6.3
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="android_size">
                                        Android {{ __('size') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="android_size">
                                    <span class="m-form__help">
                                        124.5M
                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="ios_version">
                                        iOS {{ __('version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="ios_version">
                                    <span class="m-form__help">
                                        6.6.3
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="ios_size">
                                        iOS {{ __('size') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="ios_size">
                                    <span class="m-form__help">
                                        124.5M
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="required_android_version">
                                        {{ __('required_android_version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="required_android_version">
                                    <span class="m-form__help">
                                        12.0 or 6.0 以上
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="required_ios_version">
                                        {{ __('required_ios_version') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="required_ios_version">
                                    <span class="m-form__help">
                                        11.0
                                    </span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="content_rating">
                                        {{ __('content_rating') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="content_rating">
                                    <span class="m-form__help">
                                        17+
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="google_install_cnt">
                                        {{ __('install_cnt') }}
                                    </label>
                                    <input type="text" class="form-control m-input" id="google_install_cnt">
                                    <span class="m-form__help">
                                        1,000,000+
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="google_release_date">
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
                                    <label for="google_update_date">
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
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="apple_release_date">
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
                                    <label for="apple_update_date">
                                        Apple {{ __('update_date') }}
                                    </label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control m-input"  placeholder="{{ __('select_date') }}" id="apple_update_date"/>
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="fare_system">
                                    {{ __('fare_system') }} *
                                </label>
                                <div class="summernote" id="fare_system"></div>
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
                            </div>
                        </div>
                        <div class="form-group m-form__group row">    
                            <div class="col-lg-6 col-md-12">
                                <label for="status">
                                    {{ __('status') }} *
                                </label>
                                <select class="form-control m-input" id="status">
                                    <option value="0">{{ __('draft') }}</option>
                                    <option value="1">{{ __('published') }}</option>
                                </select>
                            </div>
                        </div>
                        <input hidden id="developer_website" value="">
                        <input hidden id="developer_url" value="">
                        <input hidden id="screenshots" value="">
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-primary" id="btn_save">
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
$(document).ready(function(){
    $('#scene_ids').select2({
        placeholder: "{{ __('select_scene') }}",
    });

    $('.summernote').summernote({
        lang: 'ja-JP',
        height: 250
    });

    $('#google_release_date, #google_update_date, #apple_release_date, #apple_update_date').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
        autoclose: true,
        format: "yyyy-mm-dd",
    });

    $('#btn_google_scrape').click(function(){
        const googlePlayId = $("#google_play_id").val();
        if (googlePlayId) {
            mApp.block('#btn_google_scrape', {
                overlayColor: '#000000',
                type: 'loader',
                state: 'success',
                message: 'お待ちください...'
            });

            $.ajax({
                url: "{{ env('GOOGLE_STORE_API') }}" + googlePlayId + '?lang=ja',
                type: 'GET',
                success: function(resp, txtStatus, xhr) {
                    if (xhr.status == 200) {
                        $("#title").val(resp.title);
                        $("#google_play_url").val(resp.playstoreUrl);
                        $("#genre").val(resp.genre);
                        $("#icon").val(resp.icon);
                        $("#price").val(resp.price);
                        $("#currency").val(resp.currency);
                        $("#google_score").val(resp.score.toFixed(1));
                        $("#google_ratings").val(resp.ratings);
                        if(resp.free) {
                            $("#free").prop('checked', true);
                        } else {
                            $("#free").removeAttr('checked');
                        }
                        $("#developer").val(resp.developer.devId);
                        $("#android_version").val(resp.version);
                        $("#android_size").val(resp.size);
                        $("#content_rating").val(resp.contentRating);
                        $("#required_android_version").val(resp.androidVersionText);
                        $("#google_install_cnt").val(resp.installs);

                        $('#hidden_desc').html(resp.descriptionHTML);
                        $('#description').summernote("code", $('#hidden_desc').text());
                        
                        if (resp.updated) {
                            $('#google_update_date').val(formatDate(resp.updated));
                        }
                        $('#developer_website').val(resp.developerWebsite);
                        $('#screenshots').val(resp.screenshots.join());
                    }
                    mApp.unblock('#btn_google_scrape');
                },
                error: function(xhr, txtStatus, err) {
                    if (xhr.status != 200) {
                        toastr.error("{{ __('app_not_found') }}");
                    }
                    mApp.unblock('#btn_google_scrape');
                }
            });
        } else {
            toastr.error("{{ __('store_id_required') }}");
            return;
        }
    });

    $('#btn_apple_scrape').click(function(){
        const appleStoreId = $("#apple_store_id").val();
        if (appleStoreId) {
            mApp.block('#btn_apple_scrape', {
                overlayColor: '#000000',
                type: 'loader',
                state: 'success',
                message: 'お待ちください...'
            });
            $.ajax({
                url: "{{ env('APPLE_STORE_API') }}" + appleStoreId,
                type: 'GET',
                success: function(resp, txtStatus, xhr) {
                    if (xhr.status == 200) {
                        $("#apple_store_url").val(resp.url);
                        $("#apple_score").val(resp.score.toFixed(1));
                        $("#apple_ratings").val(resp.reviews);
                        $("#developer").val(resp.developer);
                        $("#ios_version").val(resp.version);
                        const sizeM = (parseInt(resp.size)/1000000).toFixed(1) + 'M';
                        $("#ios_size").val(sizeM);
                        $("#required_ios_version").val(resp.requiredOsVersion);

                        $('#hidden_desc').html(resp.description);
                        $('#description').summernote("code", $('#hidden_desc').text());
                        if (resp.released) {
                            const unixTime = new Date(resp.released).getTime();
                            $('#apple_release_date').val(formatDate(unixTime));
                        }
                        if (resp.updated) {
                            const unixTime = new Date(resp.updated).getTime();
                            $('#apple_update_date').val(formatDate(unixTime));
                        }
                        if (resp.developerWebsite) {
                            $('#developer_website').val(resp.developerWebsite);
                        }
                        $('#developer_url').val(resp.developerUrl);
                        $('#screenshots').val(resp.screenshots.join());
                    }
                    mApp.unblock('#btn_apple_scrape');
                },
                error: function(xhr, txtStatus, err) {
                    if (xhr.status != 200) {
                        toastr.error("{{ __('app_not_found') }}");
                    }
                    mApp.unblock('#btn_apple_scrape');
                }
            });
        } else {
            toastr.error("{{ __('store_id_required') }}");
            return;
        }
    })

    $("#btn_save").click(function(){
        const title = $("#title").val();
        const googlePlayId = $("#google_play_id").val();
        const appleStoreId = $('#apple_store_id').val();
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
        const developerWebsite = $("#developer_website").val();
        const developerUrl = $("#developer_url").val();
        const androidVersion = $("#android_version").val();
        const iosVersion = $('#ios_version').val();
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
        const screenshots = $("#screenshots").val();
        const description = $("#description").summernote('code');
        const fareSystem = $("#fare_system").summernote('code');
        const storeReview = $("#store_review").summernote('code');

        const sceneIds = $("#scene_ids").val();
        const categoryId = $("#category_id").val();
        const adminNote = $("#admin_note").summernote('code');
        const status = $("#status").val();
        if (!title || !googlePlayId || !appleStoreId || !googlePlayUrl || !appleStoreUrl || !genre || !icon || !price || !currency || !googleScore || 
        !appleScore || !googleRatings || !appleRatings || !description || !categoryId) {
            toastr.error("{{ __('fill_required_fields') }}");
            return;
        }
        $.ajax({
            url: "{{ route('admin.app.store') }}",
            type: 'POST',
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
                developer_website: developerWebsite,
                developer_url: developerUrl,
                screenshots: screenshots,
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
                    toastr.success("{{ __('create_success') }}");
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
