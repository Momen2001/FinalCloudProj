<!DOCTYPE html>

@if(session('locale') == 'en')
    <html direction="ltr" dir="ltr" style="direction: ltr">
    @else
        <html direction="rtl" dir="rtl" style="direction: rtl">
        @endif
<!--begin::Head-->
@include('includes.patient.head')
<!--end::Head-->


<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
    @include('includes.patient.sidebar')
    <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
        @include('includes.patient.header')
        <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
            <!--end::Toolbar-->
                @yield('content')
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
        @include('includes.patient.footer')
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>


<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/create-account.js')}}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

<script src="{{ asset('assets/js/custom/documentation/general/datatables/basic.js')}}"></script>
<script src="{{ asset('assets/js/custom/documentation/documentation.js')}}"></script>

<script src="{{ asset('assets/js/custom/apps/customers/list/export.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/list/list.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/add.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>

<script>
    function Confirm_Delete(event) {

        var token = '{{csrf_token()}}';
        var url = $(event).data('url');
        var tr = $(event).parent();
        Swal.fire({
            title: "{{trans('global.areYouSure')}}",
            text: "❗❗",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('global.yes')}}",
            cancelButtonText: "{{trans('global.no')}} {{trans('global.cancel')}}",
            reverseButtons: true
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire(
                                response.msg,
                                "--",
                                "success"
                            )
                            tr.parent().remove();
                        } else {
                            Swal.fire(response.msg, "...", "error");
                        }
                    }
                });
            } else {
                Swal.fire(
                    response.msg,
                    "{{trans('global.undone')}}",
                    "error"
                )
            }
        });
    }

    function Change_Status(event) {
        var token = '{{csrf_token()}}';
        var url = $(event).data('url');
        var id = $(event).data('id');
        var tr = $(event).parent();
        $.ajax({
            url: url,
            type: 'get',
            data: {
                '_token': token,
                'id': id
            },
            success: function (response) {
                if (response.status == true) {

                    Swal.fire({
                        title: response.msg,
                        text: "{{trans('global.update_success')}}",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "{{trans('global.confirmation')}}",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    $('.StatusRow' + response.id).text(response.active);

                    //  location.reload();
                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", response.msg, "error");

                }
            }
        });
    }
</script>
@yield('script')
<script>
    $(document).on('change', '#country_id', function (e) {
        e.preventDefault();
        let country_id = $(this).val();
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("admin.filterCities") }}",
            data: {'country_id': country_id}, // send this data to controller
            dataType: 'json',
            success: function (data) {
                $('select[name="city_id"]').empty();
                $('select[name="city_id"]').append('<option value="">{{trans('cruds.hospital.fields.city')}}</option>');
                $.each(data.cities, function (key, value) {
                    $('select[name="city_id"]').append(`<option value="${value.id}">${value.title}</option>`);
                });

            }
        });
    });

</script>

@if(session('locale') == 'en')
    <script src="{{ asset('assets/plugins/custom/datatables/datatablesEn.bundle.js')}}"></script>

@else
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

@endif

<script>
    $("#kt_datatable_dom_positioning").DataTable({
        "language": {
            "lengthMenu": "Show _MENU_",
        },
        "dom":
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });


</script>
<script>
    $(window).on('load', function () {
        $('#loading').hide();
    })
</script>
</body>
</html>

