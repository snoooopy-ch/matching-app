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
                                    {{ __('app_detail') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Content-->
                    <div class="m-portlet__body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
