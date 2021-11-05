@extends('layouts.admin')

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
                                <h3 class="m-portlet__head-text">
                                    {{ __('new_blog') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <form class="m-form m-form--label-align-right">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    {{ __('title') }} *
                                </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input" name="title" id="title">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                   {{ __('thumbnail') }} *
                                </label>
                                <div class="col-lg-3 col-md-8 col-sm-12">
                                    <div class="m-dropzone dropzone m-dropzone--info" action="{{ url('/admin/blog/upload-thumb') }}" id="blog-thumbnail">
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <span class="m-dropzone__msg-desc">
                                                {{ __('dropzone_img_upload') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-lg-2 col-form-label">
                                    {{ __('category') }} *
                                 </label>
                                 <div class="col-lg-3">
                                    <select class="form-control m-bootstrap-select" id="blog_category_id">
                                        @foreach($blog_categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    {{ __('content') }} *
                                </label>
                                <div class="col-lg-8">
                                    <div class="summernote" id="content"></div>
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-lg-2 col-form-label">
                                    {{ __('status') }}
                                </label>
                                <div class="col-lg-8">
                                    <label class="m-checkbox m-checkbox--state-success mt-2">
                                        <input type="checkbox" name="status" value="1">
                                        {{ __('publish') }}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        {{-- <button type="button" class="btn btn-info">
                                            {{ __('preview') }}
                                        </button> --}}
                                        <button type="button" class="btn btn-success" id="btn_save">
                                            {{ __('save') }}
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('admin.blog.index') }}'">
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
let blog_thumbnail = null;

Dropzone.options.blogThumbnail = {
    paramName: "thumbnail",
    acceptedFiles: 'image/*',
    maxFiles: 1,
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    dictRemoveFile: "{{ __('remove_file') }}",
    init: function() {
        blog_thumbnail = this;
    },
};

$(document).ready(function() {
    $('#blog_category_id').selectpicker();

    $('#content').summernote({
        lang: 'ja-JP',
        height: 500
    });

    $('#btn_save').click(function(){
        const title = $('#title').val();
        const categoryId = $('#blog_category_id').val();

        let status = $("input[name='status']:checked").val();

        if (!status) {
            status = 0; // draft
        }
        if (!title || $('#content').summernote('isEmpty')) {
            toastr.error("{{ __('fill_required_fields') }}");
            return;
        }

        const content = $('#content').summernote('code');
        if (blog_thumbnail.files.length == 0) {
            toastr.error("{{ __('upload_thumbnail') }}");
            return;
        }

        var formData = new FormData();
        formData.append('title', title);
        formData.append('blog_category_id', categoryId);
        formData.append('content', content);
        formData.append('thumbnail', blog_thumbnail.files[0]);
        formData.append('status', status);

        $.ajax({
            url: "{{ route('admin.blog.store') }}",
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function(resp) {
                if(resp.status) {
                    toastr.success("{{ __('create_success') }}");
                    setTimeout(() => {
                        location.href="{{ route('admin.blog.index') }}";
                    }, 1000);
                } else {
                    toastr.error(resp.msg);
                    return;
                }
            }
        });
    });
})
</script>
@endsection
