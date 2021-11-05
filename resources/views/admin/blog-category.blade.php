@extends('layouts.admin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{  __('list_of_category') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="{{ __('search') }}..." id="blog_category_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="javascript:;" data-toggle="modal" data-target="#blog_category_modal" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="new_blog_category">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        {{ __('new_category') }}
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <table class="m-datatable" id="blog_category_table" width="100%">
                    <thead>
                        <tr>
                            <th>
                                {{ __('no') }}
                            </th>
                            <th>
                                {{ __('name') }}
                            </th>
                            <th>
                                {{ __('slug') }}
                            </th>
                            <th>
                                {{ __('created_at') }}
                            </th>
                            <th>
                                {{ __('actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blog_categories as $category)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#blog_category_modal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                        data-slug="{{ $category->slug }}" class="btn-edit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("edit") }}">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="javascript:;" data-id="{{ $category->id }}" class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("delete") }}">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="blog_category_modal" tabindex="-1" role="dialog" aria-labelledby="blogCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogCategoryModalLabel">
                    {{ __('new_category') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input hidden id="blog_category_id">
                    <div class="form-group">
                        <label for="blog_category_name" class="form-control-label">
                            {{ __('name') }} *
                        </label>
                        <input type="text" class="form-control" id="blog_category_name">
                    </div>
                    <div class="form-group">
                        <label for="blog_category_name" class="form-control-label">
                            {{ __('slug') }} *
                        </label>
                        <input type="text" class="form-control" id="blog_category_slug">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('close') }}
                </button>
                <button type="button" class="btn btn-primary" id="btn_save">
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection

@section('page_js')
<script type="text/javascript">
jQuery(document).ready(function() {
	$('#blog_category_table').mDatatable({
        data: {
            saveState: {cookie: false},
        },
        search: {
            input: $('#blog_category_search'),
        },
        columns: [
            {
                field: "{{ __('created_at') }}",
                type: 'date',
                format: 'YYYY-MM-DD'
            },
            {
                field: "{{ __('actions') }}",
				// width: 110,
				sortable: false,
                overflow: 'visible'
			}
        ],
    });

    $('#blog_category_table').on('click', '.btn-edit', function(){
        $('.modal-title').html("{{ __('edit_category') }}");
        const blogCategoryId = $(this).data('id');
        const blogCategoryName = $(this).data('name');
        const blogCategorySlug = $(this).data('slug');
        $('#blog_category_id').val(blogCategoryId);
        $('#blog_category_name').val(blogCategoryName);
        $('#blog_category_slug').val(blogCategorySlug);
    })

    $('#blog_category_table').on('click', '.btn-delete', function(){
        const deleteId = $(this).data('id');
        swal({
            title: "{{ __('are_you_sure') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "{{ __('yes') }}",
            cancelButtonText: "{{ __('cancel') }}"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "/admin/blog-category/" + deleteId,
                    type: 'DELETE',
                    success: function(resp) {
                        if(resp.status) {
                            toastr.error("{{ __('delete_success') }}");
                            location.href="{{ route('admin.blog-category.index') }}";
                        } else {
                            return;
                        }
                    }
                })
            }
        });
    })

    $('#new_category').click(function(){
        $('.modal-title').html("{{ __('new_category') }}");
        $('#blog_category_id').val('');
        $('#blog_category_name').val('');
        $('#blog_category_slug').val('');
    })

    $('#btn_save').click(function(){
        const blogCategoryId = $('#blog_category_id').val();
        const blogCategoryName = $('#blog_category_name').val();
        const blogCategorySlug = $('#blog_category_slug').val();
        if (!blogCategoryName || !blogCategorySlug) {
            toastr.error("{{ __('fill_required_fields') }}");
            return;
        }
        if (blogCategoryId) { // edit
            $.ajax({
                url: "/admin/blog-category/" + blogCategoryId,
                type: 'PUT',
                data: {
                    name: blogCategoryName,
                    slug: blogCategorySlug
                },
                success: function(resp) {
                    if(resp.status) {
                        $('#blog_category_modal').modal('hide');
                        toastr.success("{{ __('update_success') }}");
                        setTimeout(() => {
                            location.href="{{ route('admin.blog-category.index') }}";
                        }, 1000);
                    } else {
                        return;
                    }
                }
            })
        } else { // new
            $.ajax({
                url: "{{ route('admin.blog-category.store') }}",
                type: 'POST',
                data: {
                    name: blogCategoryName,
                    slug: blogCategorySlug
                },
                success: function(resp) {
                    if(resp.status) {
                        $('#blog_category_modal').modal('hide');
                        toastr.success("{{ __('create_success') }}");
                        setTimeout(() => {
                            location.href="{{ route('admin.blog-category.index') }}";
                        }, 1000);
                    } else {
                        return;
                    }
                }
            })
        }
    })
});
</script>
@endsection