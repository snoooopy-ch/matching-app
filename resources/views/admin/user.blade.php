@extends('layouts.admin')

@section('page_css')
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('list_of_user') }}
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
                                        <input type="text" class="form-control m-input" placeholder="{{ __('search') }}..." id="user_search">
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
                            <a href="javascript:;" data-toggle="modal" data-target="#user_modal" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="new_user">
                                <span>
                                    <i class="la la-plus-circle"></i>
                                    <span>
                                        {{ __('new_user') }}
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="user_table"></div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">
                    {{ __('new_user') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input hidden id="user_id">
                    <div class="form-group">
                        <label for="email" class="form-control-label">
                            {{ __('email') }} *
                        </label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-control-label">
                            {{ __('username') }} *
                        </label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">
                            {{ __('password') }}
                        </label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="form-control-label">
                            {{ __('confirm_password') }}
                        </label>
                        <input type="password" class="form-control" id="password_confirm">
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
    var datatable = $('#user_table').mDatatable({
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
            url: '{{ route("admin.user.list") }}',
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
        input: $('#user_search'),
      },

      // columns definition
      columns: [
        {
          field: 'no',
          title: 'No.',
          sortable: false, // disable sort for this column
          width: 50,
          selector: false,
          template: function(row, index, datatable) {
            return (datatable.getCurrentPage() - 1) * datatable.getPageSize() + index + 1;
          }
        }, {
          field: 'email',
          title: '{{ __("email") }}'
        }, {
          field: 'name',
          title: '{{ __("username") }}'
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
						<a href="javascript:;" data-id="'+ row.id +'" data-name="'+ row.name +'" data-email="'+ row.email +'" class="btn-edit m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("edit") }}">\
							<i class="la la-edit"></i>\
						</a>\
						<a href="javascript:;" data-id="'+ row.id +'" class="btn-delete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="{{ __("delete") }}">\
							<i class="la la-trash"></i>\
						</a>\
					';
          },
        }],
    });

    $('#user_table').on('click', '.btn-delete', function(){
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
                    url: "/admin/user/" + deleteId,
                    type: 'DELETE',
                    success: function(resp) {
                        if(resp.status) {
                            toastr.error("{{ __('delete_success') }}");
                            location.href="{{ route('admin.user.index') }}";
                        } else {
                            return;
                        }
                    }
                })
            }
        });
    });

    $('#new_user').click(function(){
        $('.modal-title').html("{{ __('new_user') }}");
        $('#user_id').val('');
        $('#username').val('');
        $('#password').val('');
        $('#password_confirm').val('');
    });

    $('#user_table').on('click', '.btn-edit', function(){
        $('.modal-title').html("{{ __('edit_user') }}");
        const userId = $(this).data('id');
        const username = $(this).data('name');
        const email = $(this).data('email');
        $('#user_id').val(userId);
        $('#username').val(username);
        $('#email').val(email);
        $('#password').val('');
        $('#password_confirm').val('');
        $('#user_modal').modal('show');
    });

    $('#btn_save').click(function(){
        const userId = $('#user_id').val();
        const username = $('#username').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const passwordConfirm = $('#password_confirm').val();

        if (!username || !email) {
            toastr.error("{{ __('fill_required_fields') }}");
            return;
        }

        if (userId) {
            if ((password || passwordConfirm) && password !== passwordConfirm) {
                toastr.error("{{ __('password_not_match') }}");
                return;
            }
            $.ajax({
                url: "/admin/user/" + userId,
                type: 'PUT',
                data: {
                    name: username,
                    email: email,
                    password: password
                },
                success: function(resp) {
                    if(resp.status) {
                        $('#user_modal').modal('hide');
                        toastr.success("{{ __('update_success') }}");
                        setTimeout(() => {
                            location.href="{{ route('admin.user.index') }}";
                        }, 1000);
                    } else {
                        return;
                    }
                }
            })
        } else {
            if (!password) {
                toastr.error("{{ __('fill_required_fields') }}");
                return;
            } else if (password !== passwordConfirm) {
                toastr.error("{{ __('password_not_match') }}");
                return;
            } else {
                $.ajax({
                    url: "{{ route('admin.user.store') }}",
                    type: 'POST',
                    data: {
                        name: username,
                        email: email,
                        password: password
                    },
                    success: function(resp) {
                        if(resp.status) {
                            $('#user_modal').modal('hide');
                            toastr.success("{{ __('create_success') }}");
                            setTimeout(() => {
                                location.href="{{ route('admin.user.index') }}";
                            }, 1000);
                        } else {
                            return;
                        }
                    }
                })
            }
        }
    });
</script>
@endsection
