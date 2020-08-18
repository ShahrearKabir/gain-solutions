@extends('welcome')
@section('content')

<section id="content" class="container">

    <div class="card-group">
        <div class="card">
            <div class="card-header card-primary">Add Segment</div>
            <div class="card-body">
                <form action=" {!! url('/segment/save') !!} " method="POST">
                    @csrf



                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label class="sr-only" for="field-name">Field Name</label>
                                        <input type="text" class="form-control" id="field-name" placeholder="Field Name">
                                    </div>
                                    <span>-</span>
                                    <div class="form-group">
                                        <label class="sr-only" for="field-value">Field Value</label>
                                        <input type="text" class="form-control" id="field-value" placeholder="Field Value">
                                    </div>
                                    <button class="btn btn-danger" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-primary" data-role="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div> 
                            </div> 
                        </div> 
                    </div>  -->



                    <div class="form-group">
                        <label class="col-md-12 control-label">Segment Name </label>
                        <div class="col-md-12">
                            <input type="text" name="name" class=" form-control" placeholder="Enter First Name" required>
                        </div>
                    </div>

                    <div class="col-12 row">
                        <div class="col-2">
                            <label class="col-md-12 control-label">Segment Logic </label>
                        </div>
                        <div class="col-10">
                            <div class="form-group" data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <!-- <input type="text" name="itemid[]" hidden /> -->
                                            <select class="form-control" name="logic_field[]" onchange="getLogiFieldValue(this)">
                                                <option value="" selected>Select One</option>
                                                @foreach($subscriber_columns as $column)
                                                    <option value="{{$column}}">{{$column}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <select class="form-control" name="date_type[]">
                                                <option value="" selected>Select One</option>
                                                @foreach($date_type_conditions as $date_type_condition)
                                                    <option value="{{$date_type_condition}}">{{$date_type_condition}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 date" data-provide="datepicker">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar text-alert pr11"></i>
                                                </div>

                                                <input type="text" class="select2-single form-control" name="date_from[]" placeholder="yyyy-mm-dd" autocomplete="off">
                                            </div>
                                        </div>

                                        <!-- <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div> -->

                                        <div class="col-md-2" id="text_type">
                                            <input type="text" name="text_type[]" class=" form-control" placeholder="Enter Text Type">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary " data-role="add">+ Or</button>
                                            <!-- </div>
                                    <div class="col-md-3"> -->
                                            <button class="btn btn-danger " data-role="remove">-</button>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-12 control-label"></label>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-bordered btn-info btn-block" value="Submit">
                        </div>
                    </div>
                    </from>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 p-5">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>logic_field</th>
                    <th>text_type</th>
                    <th>date_type</th>
                    <th>date_from</th>
                </tr>
                @foreach($all_segments as $segment)
                <tr>
                    <td>{{$segment->name}}</td>
                    <td>{{$segment->logic_field}}</td>
                    <td>{{$segment->text_type}}</td>
                    <td>{{$segment->date_type}}</td>
                    <td>{{$segment->date_from}}</td>
                </tr>
                @endforeach
        </div>
    </div>

</section>

<script type="text/javascript">
    $(function() {

        $('.datepicker').datepicker();

        $('#datetimepicker').datepicker({
            format: 'yyyy-mm-dd'
        });




        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
            function(e) {
                e.preventDefault();
                $(this).closest('.form-inline').remove();
            }
        );
        // Add button click
        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
            function(e) {
                e.preventDefault();
                var container = $(this).closest('[data-role="dynamic-fields"]');
                new_field_group = container.children().filter('.form-inline:first-child').clone();
                new_field_group.find('input').each(function() {
                    $(this).val('');
                });
                container.append(new_field_group);
            }
        );


    });

    // let dateField = document.getElementById('datetimepicker')
    // let textField = document.getElementById('text_type')

    // dateField.style.display = 'none'
    // textField.style.display = 'none'

    // getLogiFieldValue = (e) => {
    //     var x = (e.value || e.options[e.selectedIndex].value);
    //     console.log(x)
    //     if (x == 'first_name' || x == 'last_name' || x == 'email') {
    //         dateField.style.display = 'none'
    //         textField.style.display = 'block'
    //     } else {
    //         textField.style.display = 'none'
    //         dateField.style.display = 'block'
    //     }
    // }

    // var max_fields = 10;
    // var wrapper = $(".container1");
    // var add_button = $(".add_form_field");

    // $(document).ready(function() {


    //     let html = wrapper[0].innerHTML

    //     var x = 1;
    //     $(add_button).click(function(e) {
    //         e.preventDefault();
    //         if (x < max_fields) {
    //             x++;
    //             console.log('wrapper', html);
    //             // $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="btn btn-danger delete">Delete</a></div>'); //add input box
    //             $(wrapper).append(html + '<a href="#" class="delete" style="float: left">Delete</a>'); //add input box
    //         } else {
    //             alert('You Reached the limits')
    //         }
    //     });

    //     $(wrapper).on("click", ".delete", function(e) {
    //         e.preventDefault();
    //         $(this).parent('div').remove();
    //         x--;
    //     })
    // });
</script>

@endsection