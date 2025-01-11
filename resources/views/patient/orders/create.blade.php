@extends('layouts.patient')
@section('title',trans('global.show') .' '. trans('cruds.orders.title_singular'))
@section('style')
    <style>
        button.btn.btn-outline-primary.btn-sm.hour-btn.selected{
            color: #f6f5f5;
            font-family: bold;
            font-size: 18px;
            background-color: #8f2223;
        }
        button.btn.btn-outline-primary.btn-sm.hour-btn{
            color: #020000;
            font-family: bold;
            font-size: 14px;
            background-color: #969595;
        }
    </style>
@endsection
@section('content')
    @include('includes.lab.toolbar')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إنشاء الطلب</h3>
                </div>
                <div class="card-body">

                    <form id="addOrderForm"
                        id="addOrderForm" class="form" action="#" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Main Service ID -->


                        <input type="hidden" name="booking_date" id="selected_date">
                        <input type="hidden" name="booking_hour" id="selected_hours">

                        <!-- Lab ID -->
                        <!-- Service Dropdown -->
                        <div class="mb-3">
                            <label for="service_id" class="form-label">{{ trans('cruds.services.title') }}</label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Service
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;"
                                    data-target="service">
                                    @foreach($services as $service)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#"
                                               data-value="{{ $service->id }}">
                                                <img src="{{ $service->photo }}" alt="{{ $service->title }}"
                                                     class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                                {{ $service->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="service_id" id="service_id" required
                                       data-route="{{ route('patient.labs.by.service', ':id') }}">
                                <span class="text-danger errors"
                                      id="service_id_error"> </span>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="lab_id" class="form-label">{{ trans('cruds.lab.title') }} (سوف يتم تعيين الطبيب المناسب من قبل ادارة المختبر)</label>
                            <br>
                             <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                        id="labDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Lab
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="labDropdownButton" style="width: 100%;"
                                    data-target="lab">

                                </ul>
                                <input type="hidden" name="lab_id" id="lab_id" required>
                                 <span class="text-danger errors"
                                       id="lab_id_error"> </span>
                            </div>
                        </div>
                        <span class="text-danger errors" id="booking_date_error"> </span>
                        <span class="text-danger errors" id="booking_hour_error"> </span>


                        <div id="scheduleContainer" class="mt-3"></div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address_id" class="form-label mb-5">{{trans('global.select_the')}}{{trans('cruds.orders.fields.address_id')}}</label>
                            <label class="mb-1"> <a style="font-size: 13px;font-weight: bolder" href="{{route('patient.address.index')}}">{{trans('global.create')}}{{trans('cruds.orders.fields.address_id')}}</a></label>

                            <select class="form-control" id="address_id" name="address_id">
                                @foreach($address as $addres)
                                <option value="{{$addres->id}}" >{{$addres->title}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="address_id_error"> </span>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">{{trans('cruds.orders.fields.comment')}} </label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                            <span class="text-danger errors"
                                  id="comment_error"> </span>
                        </div>
                        <!-- Voice -->
                        <div class="mb-3">
                            <label for="voice" class="form-label">{{trans('global.voice')}}</label>
                            <input type="file" class="form-control" id="voice" name="voice" accept=".mp3">
                            <span class="text-danger errors"
                                  id="voice_error"> </span>
                        </div>
                        <!-- Attachment -->
                        <div class="mb-3">
                            <label for="attachment_file" class="form-label">{{trans('global.attachment')}}</label>
                            <input type="file" class="form-control" id="attachment_file" name="attachment_file"
                                   accept=".jpeg,.png,.jpg,.pdf">
                            <span class="text-danger errors"
                                  id="attachment_file_error"> </span>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary mr-2" type="button"
                            id="btn_save_order"> {{ trans('global.save') }}</button>
                </div>

            </div>
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

        $(document).on('click', '#btn_save_order', function (e) {
            $('#btn_save_order').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#addOrderForm')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("patient.orders.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_order').html('save');
                    if (data.status == true) {

                        document.getElementById("addOrderForm").reset();
                        setTimeout(function () {
                            location.reload();
                         }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_order').html("save");

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle service selection
            document.querySelectorAll('.dropdown-menu[data-target="service"] .dropdown-item').forEach((item) => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const serviceId = this.getAttribute('data-value');
                    const serviceText = this.textContent.trim();

                    // Update the button text
                    const dropdownButton = this.closest('.dropdown').querySelector('button');
                    dropdownButton.textContent = serviceText;

                    // Update the hidden input
                    document.getElementById('service_id').value = serviceId;

                    // Fetch labs via AJAX
                    const route = document.querySelector('#service_id').getAttribute('data-route');
                    fetchLabsByService(route.replace(':id', serviceId));
                });
            });
        });

        // Function to fetch labs
        function fetchLabsByService(url) {
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status) {
                        resetEveryThing();
                        updateLabDropdown(data.labs);
                    } else {
                        resetEveryThing();
                        alert(data.message || 'Failed to fetch labs.');
                    }
                })
                .catch((error) => {
                    console.error('Error fetching labs:', error);
                });
        }

        function resetEveryThing() {
            const labDropdown = document.querySelector('.dropdown-menu[data-target="lab"]');
            labDropdown.innerHTML = ''; // Clear existing labs
            document.getElementById('scheduleContainer').innerHTML = '';

            document.getElementById('selected_date').value = null;
            document.getElementById('selected_hours').value = null;
            document.getElementById('lab_id').value = null;

        }

        // Function to update the lab dropdown
        function updateLabDropdown(labs) {
            const labDropdown = document.querySelector('.dropdown-menu[data-target="lab"]');

            if (!labDropdown) {
                console.error('Lab dropdown menu not found in the DOM.');
                return;
            }

            labDropdown.innerHTML = ''; // Clear existing labs

            labs.forEach((lab) => {
                const labItem = `
            <li>
                <a class="dropdown-item d-flex align-items-center lab-item" href="#" data-id="${lab.id}" >
                    <img src="${lab.photo}" alt="${lab.lab_name}" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                    ${lab.lab_name}
                </a>
            </li>
        `;
                labDropdown.insertAdjacentHTML('beforeend', labItem);

            });

            // Attach event listeners to new lab items
            attachLabClickHandlers();
        }

        // Function to handle lab selection
        function attachLabClickHandlers() {
            document.querySelectorAll('.dropdown-menu[data-target="lab"] .dropdown-item').forEach((item) => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const labId = this.getAttribute('data-id');
                    const labText = this.textContent.trim();

                    // Update the button text
                    const dropdownButton = this.closest('.dropdown').querySelector('button');
                    dropdownButton.textContent = labText;

                    // Update the hidden input
                    document.getElementById('lab_id').value = labId;

                });    updateScheduleContainer();
            });
        }

    </script>






    <script>

        function updateScheduleContainer() {
            const labItems = document.querySelectorAll('.lab-item');

            const scheduleContainer = document.getElementById('scheduleContainer');
            const selectedDateInput = document.getElementById('selected_date');  // Hidden input for the selected date
            const selectedHoursInput = document.getElementById('selected_hours');  // Hidden input for selected hours

            labItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    // Set the selected lab ID in the hidden input field
                    const labId = this.getAttribute('data-id');

                    document.getElementById('lab_id').value = labId;

                    // Send AJAX request to fetch the schedule
                    fetch(`{{ route('patient.lab.schedule', ['id' => ':id']) }}`.replace(':id', labId))

                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                displaySchedule(data.labs);
                            } else {
                                scheduleContainer.innerHTML = `<div class="alert alert-warning">${data.msg}</div>`;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            scheduleContainer.innerHTML = `<div class="alert alert-danger">Failed to fetch schedule.</div>`;
                        });
                });

            });

            // Display schedule with clickable days and hours
            function displaySchedule(schedule) {
                let html = '<div class="list-group">';
                schedule.forEach(item => {
                    html += `
                <div class="list-group-item">
                    <h5>${item.label}</h5>
                    <p>Date: ${item.date} | Day: ${item.day}</p>
                    <div class="hours-list">
                        ${item.hours.length ? item.hours.map(hour => `
                            <button type="button" class="btn btn-outline-primary btn-sm hour-btn mb-5" data-date="${item.date}" data-hour="${hour}">
                                ${hour}
                            </button>
                        `).join('') : 'No available hours'}
                    </div>
                </div>
            `;
                });
                html += '</div>';
                scheduleContainer.innerHTML = html;

                // Add click event to each hour button
                const hourButtons = document.querySelectorAll('.hour-btn');
                hourButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const date = this.getAttribute('data-date');
                        const hour = this.getAttribute('data-hour');

                        // Set the selected date and hour in the hidden inputs
                        selectedDateInput.value = date;
                        selectedHoursInput.value = hour;

                        // Optionally, highlight the selected button
                        hourButtons.forEach(btn => btn.classList.remove('selected'));
                        this.classList.add('selected');
                    });
                });
            }
        }

    </script>

@endsection

