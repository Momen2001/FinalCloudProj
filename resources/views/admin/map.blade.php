<!DOCTYPE html>
<html>
<head>
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <title>Google Maps Event Listener Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.5.1.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    <style>
        #map {
            height: 550px;
            width: 100%;
        }

        [aria-label="Undo last edit"] {
            visibility: hidden;
        }


        #btn_save_location {
            background-color: #4CAF50; /* Set the background color */
            background-image: linear-gradient(to bottom, #4476d2, #455ca0); /* Add a gradient background */
            background-size: 100% auto; /* Adjust the background size */
            color: white; /* Set the text color */
            padding: 10px 20px; /* Add padding for better spacing */
            border: none; /* Remove the default button border */
            border-radius: 4px; /* Apply border-radius for rounded corners */
            cursor: pointer; /* Add a pointer cursor on hover */
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzi6RgGZgv7kJKDkMtpNP9ORfFnuEUz2o"></script>
    <script>
        function initializeMap() {
            var mapOptions = {
                // center: {lat: 25.04100727451999, lng: 48.17362707031248}, // New York City coordinates
                center: {{zoomHospitalMainServiceLocations($mainServiceId)}}, // New York City coordinates
                zoom: 7,
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Create a polygon
            var polygon = new google.maps.Polygon({
                map: map,
                paths: [
                    //default locations
                    // {lat: 25.04100727451999, lng: 48.17362707031248},
                    // {lat: 25.911241453461287, lng: 46.36921714135743},
                    // {lat: 25.942499771443867, lng: 46.25964091564945},
                    // {lat: 24.317966550335626, lng: 45.85343383056642}
                    {{hospitalMainServiceLocations($hospitalMainServiceLocations)}}
                ],
                editable: true
            });

            // Add event listener to the polygon
            google.maps.event.addListener(polygon, 'mouseup', updateCoordinates);
            google.maps.event.addListener(polygon, 'mousedown', updateCoordinatesMousedown);
        }

        function updateCoordinatesMousedown() {
            // $('#formContainer').html("");
            var elements = document.getElementsByClassName("className");
            while (elements.length > 0) {
                elements[0].parentNode.removeChild(elements[0]);
            }
        }

        function updateCoordinates() {
            var path = this.getPath(); // Get the polygon's path

            // Iterate over the vertices and log their latitudes and longitudes
            const formContainer = document.getElementById("myForm");

            for (var i = 0; i < path.getLength(); i++) {

                var vertex = path.getAt(i);
                console.log('Vertex ' + i + ': Lat = ' + vertex.lat() + ', Lng = ' + vertex.lng());

                // const label = document.createElement("label");
                // label.textContent = vertex.lat() + ": " + vertex.lng();
                // label.className = "className";

                const input = document.createElement("input");
                input.type = "text";
                input.className = "className";
                input.name = `lat[${i}]`;
                input.id = `lat[${i}]`;
                input.value = vertex.lat();
                input.required = true;
                input.hidden = true;

                const input2 = document.createElement("input");
                input2.type = "text";
                input2.className = "className";
                input2.name = `lng[${i}]`;
                input2.id = `lng[${i}]`;
                input2.value = vertex.lng();
                input2.required = true;
                input2.hidden = true;

                // formContainer.appendChild(label);
                formContainer.appendChild(input);
                formContainer.appendChild(input2);
                formContainer.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body onload="initializeMap()">
<div id="map"></div>

<div id="formContainer">
    <form id="myForm" class="form" action="#" method="post"
          enctype="multipart/form-data">
        @csrf
        @if(count($hospitalMainServiceLocations) != 0)
            @foreach($hospitalMainServiceLocations as $index => $value )
                <input type="hidden" class="className" name="lat[{{$index}}]" id="lat[{{$index}}]"
                       value="{{$value->lat}}">
                <input type="hidden" class="className" name="lng[{{$index}}]" id="lng[{{$index}}]"
                       value="{{$value->lng}}">
            @endforeach
        @else
            <input type="hidden" class="className" name="lat[0]" id="lat[0]" value="25.04100727451999">
            <input type="hidden" class="className" name="lng[0]" id="lng[0]" value="48.17362707031248">

            <input type="hidden" class="className" name="lat[1]" id="lat[1]" value="25.911241453461287">
            <input type="hidden" class="className" name="lng[1]" id="lng[1]" value="46.36921714135743">

            <input type="hidden" class="className" name="lat[2]" id="lat[2]" value="25.942499771443867">
            <input type="hidden" class="className" name="lng[2]" id="lng[2]" value="46.25964091564945">

            <input type="hidden" class="className" name="lat[3]" id="lat[3]" value="24.317966550335626">
            <input type="hidden" class="className" name="lng[3]" id="lng[3]" value="45.85343383056642">
        @endif

        @if(count($hospitalMainServiceLocations) == 0)
            {{--not have any location--}}
            <p style="text-align: center;color: #c40303">{{trans('global.noteـthis_selection_is_a_default_selection_map')}}</p>
        @endif
        <button class="btn btn-primary mr-2" type="button" style="margin-top: 10px;width: 100%"
                id="btn_save_location"> {{ trans('global.save') }}</button>
    </form>
</div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#btn_save_location', function (e) {
        $('#btn_save_location').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#myForm')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("hospital.adjustLocationMainService",$mainServiceId) }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_save_location').html('save');
                if (data.status == true) {
                    document.getElementById("myForm").reset();
                    setTimeout(function () {
                        var url = "{{ route('hospital.main-service.index') }}"; //the url I want to redirect to
                        $(location).attr('href', url);
                    }, 0);

                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                }
            }, error: function (reject) {
                $('#btn_save_location').html("save");

                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });
</script>
</html>
