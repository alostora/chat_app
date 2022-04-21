<div class="box-header with-border">
    <h3 class="box-title">{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}</h3>
</div>
<form class="form-horizontal" action="{{url('admin/City/createCity')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{(!empty($data))?$data->id:''}}">
        <div class="form-group">
            <label for="cityName" class="col-sm-2 control-label">@lang('city.cityName')</label>
            <div class="col-sm-4">
                <input type="text" name="cityName" class="form-control input-lg" id="cityName" placeholder="@lang('city.cityName')" value="{{(!empty($data)) ? $data->cityName :''}}" required>
            </div>
          
            <label for="cityNameAr" class="col-sm-2 control-label">@lang('city.cityNameAr')</label>
            <div class="col-sm-4">
                <input type="text" name="cityNameAr" class="form-control input-lg" placeholder="@lang('city.cityNameAr')" value="{{(!empty($data)) ? $data->cityNameAr :''}}" required id="cityNameAr">
            </div>
        </div>
        <div class="form-group">
            <label for="country_id" class="col-sm-2 control-label">@lang('city.country_id')</label>
            <div class="col-sm-4">
                <select name="country_id" class="form-control input-lg select2" id="country_id">
                    @if(!empty($countries))
                        @foreach($countries as $country)
                            <option value="{{$country->id}}"  {{!empty($data) && $data->country_id == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
