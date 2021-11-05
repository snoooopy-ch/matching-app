@extends('layouts.admin')

@section('page_css')
<style>
    .blog-title {
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
                            {{ __('list_of_blog') }}
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
                                                {{ __('status') }}
                                            </label>
                                        </div>
                                        <div class="m-form__control" style="width: 65%">
                                            <select class="form-control m-bootstrap-select" id="blog_status">
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
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="m-label m-label--single">
                                                {{ __('category') }}
                                            </label>
                                        </div>
                                        <div class="m-form__control" style="width: 65%">
                                            <select class="form-control m-bootstrap-select" id="blog_category_id">
                                                <option value="">
                                                    {{ __('all') }}
                                                </option>
                                                @foreach($blog_categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="{{ __('search_by_title') }}..." id="blog_search">
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
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        {{ __('new_blog') }}
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="blog_table"></div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script type="text/javascript">
    var datatable = $('#blog_table').mDatatable({
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
            url: '{{ route("admin.blog.list") }}',
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
        input: $('#blog_search'),
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
            filterable: false,
            template: function(row) {
                return '<a href="/blog/'+ row.id +'" target="_blank"><span class="blog-title" title="'+ row.title +'">' + row.title + '</span></a>';
            }
        }, {
            field: 'name',
            title: '{{ __("category") }}',
            filterable: false
        }, {
            field: 'status',
            title: "{{ __('status') }}",
            template: function(row) {
                var status = {
                    0: {'title': '{{ __("draft") }}', 'class': 'm-badge--brand'},
                    1: {'title': '{{ __("published") }}', 'class': 'm-badge--success'}
                };
                return '<span class="m-badge ' + status[row.status].class + ' m-badge--wide">' + status[row.status].title + '</span>';
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
            width: 80,
            title: '{{ __("actions") }}',
            sortable: false,
            overflow: 'visible',
            template: function (row, index, datatable) {
                return '\
                        <a href="/admin/blog/'+ row.id +'/edit" class="btn-edit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("edit") }}">\
                            <i class="la la-edit"></i>\
                        </a>\
                        <a href="javascript:;" data-id="'+ row.id +'" class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("delete") }}">\
                            <i class="la la-trash"></i>\
                        </a>\
                    ';
            },
        }],
    });

    $('#blog_status').selectpicker();

    $('#blog_category_id').selectpicker();

    $('#blog_status').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'status');
    });

    $('#blog_category_id').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'blog_category_id');
    });

    $('#blog_table').on('click', '.btn-delete', function(){
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
                    url: "/admin/blog/" + deleteId,
                    type: 'DELETE',
                    success: function(resp) {
                        if(resp.status) {
                            toastr.error("{{ __('delete_success') }}");
                            location.href="{{ route('admin.blog.index') }}";
                        } else {
                            return;
                        }
                    }
                })
            }
        });
    });
</script>
@endsection
