@if(count($errors->all()))
    <div class="col-sm-12">
        <div class="alert alert-danger">
            <ul>
                <li><h4>{{$errors->all()[0]}}</h4></li>
            </ul>
        </div>
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        <h4>{{session('success')}}</h4>
    </div>
@endif
@if(session()->has('warning'))
    <div class="alert alert-warning">
        <h4>{{session('warning')}}</h4>
    </div>
@endif
@if(session()->has('danger'))
    <div class="alert alert-danger">
        <h4>{{session('danger')}}</h4>
    </div>
@endif