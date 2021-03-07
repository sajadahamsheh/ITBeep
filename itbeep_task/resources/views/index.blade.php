@extends("layouts.app")
@section("content")
<form id="services_form" onsubmit="event.preventDefault()"
    style="margin-left: 150px;border: 1px solid black;margin-right: 150px;margin-top: 150px; padding: 15px; ">
    {{csrf_field()}}
    <div class="form-group justify-content-end">
        <label> الاسم</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم">
    </div>
    <div class="form-group">
        <label>الجوال </label>
        <input type="number" class="form-control " id="number" name="number" placeholder="الجوال">
    </div>
    <div class="form-group ">
        <label>البريد الالكتروني</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="البريد الالكتروني">
    </div>
    <input type="hidden" id="service" name="service">
    <input type="hidden" id="interest" name="interest">

    <button type="button" class=" d-grid gap-2 col-12 mx-auto btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter" style="background: rgb(86, 38, 138) !important;"> ارسال
    </button>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  d-flex justify-content-around" style="">
                    @foreach($services as $service)
                    <button class="btn " name="services" style="background: rgb(86, 38, 138); color: white !important;"
                        onclick="setServices('{{$service->name}}',event)">
                        {{$service->name}}
                    </button>
                    @endforeach
                </div>
                <div class="modal-footer ">

                    <button style="background: rgb(86, 38, 138); color: white !important;" type="button"
                        class="d-grid gap-2 col-12 mx-auto btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalCenter2" id="firstModalButton" onclick="nextButton()">Next1</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-around">
                    @foreach($interests as $interest)
                    <button class="btn" name="interests" style="background: rgb(86, 38, 138); color: white !important;"
                        onclick="setInterests('{{$interest->name}}',event)">
                        {{$interest->name}}
                    </button>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section("scripts")
<script>
    $("#firstModalButton").click(e => {
        e.preventDefault();
        $('#exampleModalCenter').modal('hide')
    });

    var services = [];

    function setServices(name, event) {
        if (event.target.style.background == "red") {
            event.target.style.background = "green";
            services.push(name);
        } else {
            event.target.style.background = "red";
            services.splice(services.indexOf(name), 1);
        }
    }

    function setInterests(name, event) {
        $("#interest").val(name);
        $.ajax({
            url: '{{ url("/addToSession") }}',
            method: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData($("#services_form").get(0)),
            success: function (response) {
                console.log(response);
            }
        });
    }


    function nextButton() {
        $("#service").val(services);
    }

</script>
@endsection
