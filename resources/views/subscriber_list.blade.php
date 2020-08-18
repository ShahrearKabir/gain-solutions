@extends('welcome')
@section('content')

<section id="content" class="container">

    <div class="row">
        <div class="col-12 p-5">
            <form action=" {!! url('/subscriber/list') !!} " method="POST">
                @csrf 

                <div class="form-group">
                    <label class="col-md-12 control-label">Segment </label>
                    
                        <select class="select2-multiple form-control select-primary" name="logic_field" onchange="getLogiFieldValue(this)">
                            <option value="" selected>Select One</option>
                            @foreach($all_segments as $segment)
                                <option value="{{$segment}}">{{$segment->name}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-bordered btn-info btn-block" value="Submit">
                </div>

            </form>
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