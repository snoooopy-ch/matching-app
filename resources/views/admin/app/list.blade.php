@extends('layouts.admin')
@section('page_css')
<style>
    .app-title {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .app-icon {
        width: 80px;
        border-radius: 10px;
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-search__field {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('list_of_app') }}
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
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="m-label m-label--single">
                                                {{ __('status') }}:
                                            </label>
                                        </div>
                                        <div class="m-form__control" style="width: 60%">
                                            <select class="form-control m-bootstrap-select" id="app_status">
                                                <option value="">
                                                    {{ __('all') }}
                                                </option>
                                                <option value="0">
                                                    {{ __('draft') }}
                                                </option>
                                                <option value="1">
                                                    {{ __('published') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="{{ __('search_by_title') }}..." id="app_search">
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
                            <a href="{{ route('admin.app.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        {{ __('new_app') }}
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="app_table"></div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
<!--begin::Set Scene Modal-->
<div class="modal fade" id="set_scene_modal" tabindex="-1" role="dialog" aria-labelledby="sceneModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sceneModalLabel">
                    {{ __('set_scene') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input hidden name="app_id">
                    <div class="form-group">
                        <label for="scene" class="form-control-label">
                            {{ __('scene') }} *
                        </label>
                        <div>
                            <select class="form-control m-select2" id="scene_ids" multiple="multiple">
                                @foreach ($scenes as $scene)
                                    <option value="{{ $scene->id }}">{{ $scene->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('close') }}
                </button>
                <button type="button" class="btn btn-primary" id="btn_save_scene">
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
<!--begin::Set Category Modal-->
<div class="modal fade" id="set_category_modal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">
                    {{ __('set_category') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input hidden name="app_id">
                    <div class="form-group">
                        <label for="category" class="form-control-label">
                            {{ __('category') }} *
                        </label>
                        <select class="form-control m-input" id="category_id">
                            <option value="">{{ __('select_category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('close') }}
                </button>
                <button type="button" class="btn btn-primary" id="btn_save_category">
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Category Modal-->
<!--begin::Status Modal-->
<div class="modal fade" id="set_status_modal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">
                    {{ __('change_status') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input hidden name="app_id">
                    <div class="form-group">
                        <label for="status" class="form-control-label">
                            {{ __('status') }} *
                        </label>
                        <select class="form-control m-input" id="status">
                            <option value="0">{{ __('draft') }}</option>
                            <option value="1">{{ __('published') }}</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('close') }}
                </button>
                <button type="button" class="btn btn-primary" id="btn_change_status">
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!--end:: Status Modal-->
@endsection

@section('page_js')
<script type="text/javascript">
    var datatable = $('#app_table').mDatatable({
      // datasource definition
      data: {
        type: 'remote',
        source: {
          read: {
            // sample GET method
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '{{ route("admin.app.list") }}',
            map: function(raw) {
              // sample data mapping
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
      },

      // layout definition
      layout: {
        scroll: false,
        footer: false
      },

      // column sorting
      sortable: true,

      pagination: true,

      toolbar: {
        // toolbar items
        items: {
          // pagination
          pagination: {
            // page size select
            pageSizeSelect: [10, 20, 30, 50, 100],
          },
        },
      },

      search: {
        input: $('#app_search'),
      },

      // columns definition
      columns: [
        {
          field: 'no',
          title: 'No',
          sortable: false, // disable sort for this column
          width: 40,
          selector: false,
          template: function(row, index, datatable) {
            return (datatable.getCurrentPage() - 1) * datatable.getPageSize() + index + 1;
          }
        }, {
          field: 'title',
          title: '{{ __("title") }}',
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          width: 150,
          template: function(row) {
            return '<span class="app-title" title="'+ row.title +'">' + row.title + '</span>';
          }
        }, {
          field: 'icon',
          title: '{{ __("icon") }}',
          sortable: false,
          width: 100,
          template: function(row) {
            // callback function support for column rendering
            return `<a href="`+ row.google_play_url +`" target="_blank">
                        <img src="`+ row.icon +`" alt="{{ __("alt_icon") }}" class="app-icon">
                    </a>`;
          },
        }, {
          field: 'genre',
          title: '{{ __("genre") }}',
        }, {
          field: 'price',
          title: '{{ __("price") }}',
        }, {
          field: 'status',
          title: "{{ __('status') }}",
          template: function(row) {
            var status = {
              0: {'title': '{{ __("draft") }}', 'state': 'danger'},
              1: {'title': '{{ __("published") }}', 'state': 'primary'},
            };
            return '<span class="m-badge m-badge--' + status[row.status].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.status].state + '">' +
                status[row.status].title + '</span>';
          }
        }, {
          field: 'created_at',
          title: '{{ __("created_at") }}',
          type: 'date',
          template: function(row) {
              return moment(row.created_at).format('YYYY-MM-DD');
          }
        }, {
          field: 'Actions',
          width: 110,
          title: '{{ __("actions") }}',
          sortable: false,
          overflow: 'visible',
          template: function (row, index, datatable) {
            var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
            var detailDropdownItem = '';
            if (row.status == 1) { // published
                detailDropdownItem = '<a class="dropdown-item" href="/apps/'+ row.id +'" target="_blank"><i class="la la-eye"></i> {{ __("view_detail") }}</a>';
            }
            return '\
						<div class="dropdown ' + dropup + '">\
							<a href="#" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">'+ detailDropdownItem +'\
						    	<a class="dropdown-item set-scene" href="javascript:;" data-id="'+ row.id +'"><i class="la la-leaf"></i> {{ __("set_scene") }}</a>\
						    	<a class="dropdown-item set-category" href="javascript:;" data-id="'+ row.id +'" data-category_id="'+ row.category_id +'"><i class="la la-leaf"></i> {{ __("set_category") }}</a>\
                                <a class="dropdown-item change-status" href="javascript:;" data-id="'+ row.id +'" data-status="'+ row.status +'"><i class="la la-leaf"></i> {{ __("change_status") }}</a>\
						  	</div>\
						</div>\
						<a href="/admin/app/'+ row.id +'/edit" class="btn-edit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("edit") }}">\
							<i class="la la-edit"></i>\
						</a>\
						<a href="javascript:;" data-id="'+ row.id +'" class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("delete") }}">\
							<i class="la la-trash"></i>\
						</a>\
					';
          },
        }],
    });

    $('#app_table').on('click', '.btn-delete', function(){
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
                    url: "/admin/app/" + deleteId,
                    type: 'DELETE',
                    success: function(resp) {
                        if(resp.status) {
                            toastr.error("{{ __('delete_success') }}");
                            location.href="{{ route('admin.app.index') }}";
                        } else {
                            return;
                        }
                    }
                })
            }
        });
    });

    $('#app_type, #app_status').selectpicker();

    $('#app_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'type');
    });

    $('#app_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'status');
    });

    $('#scene_ids').select2({
        placeholder: "{{ __('select_scene') }}",
    });

    $("#app_table").on('click', '.set-scene', function(){
        const id = $(this).data('id');
        $.ajax({
            url: "/admin/app/get-scenes",
            type: 'POST',
            data: {
                app_id: id
            },
            success: function(resp) {
                if(resp.status) {
                    $('#set_scene_modal input[name="app_id"]').val(id);
                    $('#scene_ids').val(resp.scene_ids);
                    $('#scene_ids').change();
                    $('#set_scene_modal').modal('show');
                }
            }
        })
    });

    $("#app_table").on('click', '.set-category', function(){
        const id = $(this).data('id');
        const categoryId = $(this).data('category_id');
        $('#set_category_modal input[name="app_id"]').val(id);
        $('#category_id').val(categoryId);
        $('#set_category_modal').modal('show');
    });

    $("#app_table").on('click', '.change-status', function(){
        const id = $(this).data('id');
        const status = $(this).data('status');
        $('#set_status_modal input[name="app_id"]').val(id);
        $('#status').val(status);
        $('#set_status_modal').modal('show');
    });

    $('#btn_save_scene').click(function(){
        const id = $('#set_scene_modal input[name="app_id"]').val();
        const sceneIds = $('#scene_ids').val();
        $.ajax({
            url: "/admin/app/set-scenes",
            type: 'POST',
            data: {
                app_id: id,
                scene_ids: sceneIds
            },
            success: function(resp) {
                if(resp.status) {
                    toastr.success("{{ __('update_success') }}");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    })

    $('#btn_save_category').click(function(){
        const id = $('#set_category_modal input[name="app_id"]').val();
        const categoryId = $('#category_id').val();
        if (!categoryId) {
            toastr.error("{{ __('select_category') }}");
            return;
        }
        $.ajax({
            url: "/admin/app/set-category",
            type: 'POST',
            data: {
                app_id: id,
                category_id: categoryId
            },
            success: function(resp) {
                if(resp.status) {
                    toastr.success("{{ __('update_success') }}");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    })

    $('#btn_change_status').click(function(){
        const id = $('#set_status_modal input[name="app_id"]').val();
        const status = $('#status').val();
        $.ajax({
            url: "/admin/app/change-status",
            type: 'POST',
            data: {
                app_id: id,
                status: status
            },
            success: function(resp) {
                if(resp.status) {
                    toastr.success("{{ __('update_success') }}");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    })

</script>
@endsection
