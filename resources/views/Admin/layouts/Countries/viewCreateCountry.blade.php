<div class="box-header with-border">
    <h3 class="box-title">
      {{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}
    </h3>
</div>
<form class="form-horizontal" action="{{url('admin/Country/createCountry')}}" method="post" enctype="multipart/form-data">
    <div class="box-body">
      @csrf
      <input type="hidden" name="id" value="{{!empty($data) ? $data->id : ''}}">
      
      <div class="form-group">
          <label for="countryName" class="col-sm-2 control-label">@lang('country.countryName')</label>
          <div class="col-sm-4">
              <input type="text" name="countryName" class="form-control input-lg" id="countryName" placeholder="@lang('country.countryName')" value="{{!empty($data) ? $data->countryName : ''}}" required>
          </div>
        
          <label for="countryNameAr" class="col-sm-2 control-label">@lang('country.countryNameAr')</label>
          <div class="col-sm-4">
              <input type="text" name="countryNameAr" class="form-control input-lg" placeholder="@lang('country.countryNameAr')" value="{{!empty($data) ? $data->countryNameAr : ''}}" required id="countryNameAr">
          </div>
      </div>

      <div class="form-group">
          <label for="countryPhoneKey" class="col-sm-2 control-label">@lang('country.countryPhoneKey')</label>
          <div class="col-sm-4">
              <input type="text" name="countryPhoneKey" class="form-control input-lg" id="countryPhoneKey" placeholder="@lang('country.countryPhoneKey')" value="{{!empty($data) ? $data->countryPhoneKey : ''}}" required>
          </div>
        
          <label for="countryCode" class="col-sm-2 control-label">@lang('country.countryCode')</label>
          <div class="col-sm-4">
              <input type="text" name="countryCode" class="form-control input-lg" placeholder="@lang('country.countryCode')" value="{{!empty($data) ? $data->countryCode : ''}}" required id="countryCode">
          </div>
      </div>


      <div class="form-group">
          <label for="countryFlag" class="col-sm-2 control-label">@lang('country.countryFlag')</label>
          <div class="col-sm-4">
              <input type="file" name="countryFlag" class="form-control input-lg" placeholder="@lang('country.countryFlag')" >
              @if(!empty($data) && !empty($data->countryFlag)) 
                {!! $data->image_url !!}
              @endif
          </div>
          
          <label for="countryCurrency" class="col-sm-2 control-label">@lang('country.countryCurrency')</label>
          <div class="col-sm-4">
              <input type="text" name="countryCurrency" class="form-control input-lg" placeholder="@lang('country.countryCurrency')" value="{{!empty($data) ? $data->countryCurrency : ''}}" required id="countryCurrency">
          </div>
          
      </div>
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
  