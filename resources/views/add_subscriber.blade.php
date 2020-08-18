@extends('welcome')
@section('content')

<section id="content" class="container">

    <div class="card-group">
        <div class="card">
            <div class="card-header card-primary">Add Subscriber</div>
            <div class="card-body">
                <form action=" {!! url('/subscriber/save') !!} " method="POST">
                @csrf 
                <!-- <div class="form-group">
                    <label class="col-md-12 control-label"> Select Employee </label>
                    <div class="col-md-12">
                        <select class="select2-multiple form-control select-primary" name="emp_id" required>
                            <option value="" selected>Select One</option>
                            @foreach($subscriber_columns as $column)
                                <option value="{{$column}}">{{$column}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="col-md-12 control-label">First Name </label>
                    <div class="col-md-12">
                        <input type="text" name="first_name" class=" form-control" placeholder="Enter First Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label">Last Name </label>
                    <div class="col-md-12">
                        <input type="text" name="last_name" class=" form-control" placeholder="Enter Last Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label"> Email</label>
                    <div class="col-md-12">
                        <input type="text" name="email" id="input002" class=" form-control" placeholder="Enter Email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="datepicker1" class="col-md-12 control-label"> Date of Birth </label>
                    <div class="col-md-12">
                        <div class="input-group date" id='datetimepicker'>
                            <div class="input-group-addon">
                                <i class="fa fa-calendar text-alert pr11"></i>
                            </div>

                            <input type="text" class="select2-single form-control" name="birth_day" placeholder="yyyy-mm-dd" required>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Birth Day</th>
                </tr>
            @foreach($all_subscribers as $subscriber)
                <tr>
                    <td>{{$subscriber->first_name}}</td>
                    <td>{{$subscriber->last_name}}</td>
                    <td>{{$subscriber->email}}</td>
                    <td>{{$subscriber->birth_day}}</td>
                </tr>
            @endforeach
        </div>
    </div>
    
</section>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>

@endsection