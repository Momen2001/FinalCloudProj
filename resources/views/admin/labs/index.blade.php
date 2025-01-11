@extends('layouts.main')
@section('title',trans('global.show',[],session('locale')) .' '. trans('cruds.lab.title',[],session('locale')))

@section('content')
    @include('includes.toolbar')
    @include('admin.labs.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.lab.title',[],session('locale')) }}</span>
            </h3>
            <div class="card-toolbar">

                <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_create_account">
                    <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add',[],session('locale')) }} {{ trans('cruds.lab.title_singular',[],session('locale')) }}</a>

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">

            <table id="kt_datatable_dom_positioning"
                   class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th class="w-25px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                        </div>
                    </th>
                    <th class="min-w-80px"> {{ trans('cruds.lab.fields.id',[],session('locale')) }}</th>
                    <th class="min-w-140px">{{ trans('cruds.lab.fields.name',[],session('locale')) }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.lab.fields.email',[],session('locale')) }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.lab.fields.phone',[],session('locale')) }}</th>
                    <th class="min-w-120px">{{ trans('cruds.lab.fields.verified',[],session('locale')) }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions',[],session('locale')) }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($labs  as $key => $lab)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $lab->id }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{   $lab->getProviderName()?? '' }}</a>
                            <span
                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $lab->getFullPhone() ?? ''}}+</span>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $lab->email ?? '' }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $lab->intro ?? '' }}
                                -{{ $lab->phone ?? '' }}</a>
                        </td>

                        <td>
                                    <span
                                        class="badge badge-light-success">  {{ $lab->verified ?trans('cruds.verified',[],session('locale')) : trans('cruds.un_verified',[],session('locale')) }} </span>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('admin.lab.show', $lab->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.show')
                                </a>

                                <a href="{{ route('admin.lab.edit', $lab->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                                <button category_id_attr="{{$lab->id}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        onclick="Confirm_Delete(this)"
                                        data-url="{{ route('admin.lab.destroy', $lab->id) }}">
                                    @include('partials.icons.delete')
                                </button>
                            @canImpersonate($guard = null)
                            <a href="{{ route('impersonate', $lab->id) }}"
                               class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                <i class="fa-fw nav-icon fas @if(session('locale') == 'en') fa-arrow-right @else fa-arrow-left @endif "></i>
                            </a>
                            @endCanImpersonate
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#btn_save_user', function (e) {
            $('#btn_save_user').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route('admin.lab.store') }}",
                data: formData, // send this data to the controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_user').html('save');
                    if (data.status === true) {
                        document.getElementById("formSaveUser").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.lab.index') }}"; // the URL to redirect to
                            $(location).attr('href', url);
                        }, 0);
                    } else {
                        Swal.fire(
                            "{{trans('global.sorry_some_error')}}",
                            data.msg,
                            "error"
                        );
                    }
                },
                error: function (reject) {
                    $('#btn_save_user').html("save");

                    if (reject.responseJSON && reject.responseJSON.errors) {
                        var response = reject.responseJSON.errors;
                        $.each(response, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                            Swal.fire(val[0],);
                        });
                    }
                }
            });
        });
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDje8daAdjUdiSeVmJM9uWPTM3mhz67Y0g&callback=initMap">
    </script>

    <script>
        let map;
        let marker;

        function initMap() {
            const defaultLocation = { lat: 23.8859, lng: 45.0792 }; // Center in Saudi Arabia
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 8,
            });

            // Add a click listener to get latitude and longitude
            map.addListener("click", (e) => {
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();

                // Update marker position
                if (marker) {
                    marker.setPosition(e.latLng);
                } else {
                    marker = new google.maps.Marker({
                        position: e.latLng,
                        map: map,
                    });
                }

                // Pass latitude and longitude to your form
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
            });
        }
    </script>

@endsection

