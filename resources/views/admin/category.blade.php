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
                                        <input type="text" class="form-control m-input" placeholder="{{ __('search') }}..." id="category_search">
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
                            <a href="javascript:;" data-toggle="modal" data-target="#category_modal" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="new_category">
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
                <table class="m-datatable" id="category_table" width="100%">
                    <thead>
                        <tr>
                            <th>
                                {{ __('no') }}
                            </th>
                            <th>
                                {{ __('name') }}
                            </th>
                            <th>
                                {{ __('num_of_apps') }}
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->num_of_apps }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#category_modal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                        class="btn-edit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("edit") }}">
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
<div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">
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
                    <input hidden id="category_id">
                    <div class="form-group">
                        <label for="category_name" class="form-control-label">
                            {{ __('name') }} *
                        </label>
                        <input type="text" class="form-control" id="category_name">
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
	$('#category_table').mDatatable({
        data: {
            saveState: {cookie: false},
        },
        search: {
            input: $('#category_search'),
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

    $('#category_table').on('click', '.btn-edit', function(){
        $('.modal-title').html("{{ __('edit_category') }}");
        const categoryId = $(this).data('id');
        const categoryName = $(this).data('name');
        $('#category_id').val(categoryId);
        $('#category_name').val(categoryName);
    })

    $('#category_table').on('click', '.btn-delete', function(){
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
                    url: "/admin/category/" + deleteId,
                    type: 'DELETE',
                    success: function(resp) {
                        if(resp.status) {
                            toastr.error("{{ __('delete_success') }}");
                            location.href="{{ route('admin.category.index') }}";
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
        $('#category_id').val('');
        $('#category_name').val('');
    })

    $('#btn_save').click(function(){
        const categoryId = $('#category_id').val();
        const categoryName = $('#category_name').val();
        if (!categoryName) {
            toastr.error("{{ __('category_name_required') }}");
        }
        if (categoryId) { // edit
            $.ajax({
                url: "/admin/category/" + categoryId,
                type: 'PUT',
                data: {
                    name: categoryName
                },
                success: function(resp) {
                    if(resp.status) {
                        $('#category_modal').modal('hide');
                        toastr.success("{{ __('update_success') }}");
                        setTimeout(() => {
                            location.href="{{ route('admin.category.index') }}";
                        }, 1000);
                    } else {
                        return;
                    }
                }
            })
        } else { // new
            $.ajax({
                url: "{{ route('admin.category.store') }}",
                type: 'POST',
                data: {
                    name: categoryName
                },
                success: function(resp) {
                    if(resp.status) {
                        $('#category_modal').modal('hide');
                        toastr.success("{{ __('create_success') }}");
                        setTimeout(() => {
                            location.href="{{ route('admin.category.index') }}";
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
