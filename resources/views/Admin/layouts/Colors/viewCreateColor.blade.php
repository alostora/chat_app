<div class="box-header with-border">
    <h3 class="box-title">@if(empty($data)) @lang('general.add') @else @lang('general.edit') @endif</h3>
</div>
<form class="form-horizontal" action="{{url('admin/Color/createColor')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{(!empty($data))?$data->id:''}}">
        

        <div class="form-group">
            
            <label for="colorName" class="col-sm-2 control-label">@lang('color.colorName')</label>
            <div class="col-sm-4">
                <input type="text" name="colorName" class="form-control input-lg" id="colorName" placeholder="@lang('color.colorName')" value="{{(!empty($data)) ? $data->colorName :''}}" required>
            </div>
          
            <label for="colorNameAr" class="col-sm-2 control-label">@lang('color.colorNameAr')</label>
            <div class="col-sm-4">
                <input type="text" name="colorNameAr" class="form-control input-lg" placeholder="@lang('color.colorNameAr')" value="{{(!empty($data)) ? $data->colorNameAr :''}}" required id="colorNameAr">
            </div>

        </div>

        <div class="form-group">
            
            <label for="colorCode" class="col-sm-2 control-label">@lang('color.colorCode')</label>
            <div class="col-sm-4">
                <input type="color" name="colorCode" class="form-control input-lg" id="colorCode" placeholder="@lang('color.colorCode')" value="{{(!empty($data)) ? $data->colorCode :''}}" required>
            </div>
        </div>
        
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
