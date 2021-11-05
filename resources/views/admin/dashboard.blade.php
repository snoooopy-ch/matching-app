@extends('layouts.admin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    {{ __('dashboard') }}
                </h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin:: Widgets/Stats-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('total_apps') }}
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    {{ __('all_app_registered') }}
                                </span>
                                <span class="m-widget24__stats m--font-brand">
                                    {{ $total_app_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    100%
                                </span>
                            </div>
                        </div>
                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Feedbacks-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('new_apps') }}
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    {{ __('from_this_month') }}
                                </span>
                                <span class="m-widget24__stats m--font-brand">
                                    {{ $new_app_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{ $new_app_progress }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    {{ $new_app_progress }}%
                                </span>
                            </div>
                        </div>
                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Blogs-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('blog') }}数
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    {{ __('published') }}
                                </span>
                                <span class="m-widget24__stats m--font-danger">
                                    {{ $blog_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    0%
                                </span>
                            </div>
                        </div>
                        <!--end::Blogs-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Blog Categories-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('blog_category') }}数
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    
                                </span>
                                <span class="m-widget24__stats m--font-success">
                                    {{ $blog_category_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-success" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    0%
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats-->
        <!--begin:: Widgets/Stats-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Total Users-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('total_users') }}
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    {{ __('all_user_registered') }}
                                </span>
                                <span class="m-widget24__stats m--font-info">
                                    {{ $total_user_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    100%
                                </span>
                            </div>
                        </div>
                        <!--end::Total Users-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Users-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('new_users') }}
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    {{ __('from_this_month') }}
                                </span>
                                <span class="m-widget24__stats m--font-info">
                                    {{ $new_user_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-info" role="progressbar" style="width: {{ $new_user_progress }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    {{ $new_user_progress }}%
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Scenes-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('scene') }}数
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    
                                </span>
                                <span class="m-widget24__stats m--font-warning">
                                    {{ $scene_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    100%
                                </span>
                            </div>
                        </div>
                        <!--end::Scenes-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Scenes-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    {{ __('category') }}数
                                </h4>
                                <br>
                                <span class="m-widget24__desc">
                                    
                                </span>
                                <span class="m-widget24__stats m--font-secondary">
                                    {{ $category_cnt }}
                                </span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-secondary" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget24__number">
                                    100%
                                </span>
                            </div>
                        </div>
                        <!--end::Scenes-->
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats-->
    </div>
</div>
@endsection
