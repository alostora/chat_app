<div class="box-header with-border">
    <h3 class="box-title">
      {{empty($cat) ? Lang::get('general.add') : Lang::get('general.edit')}}
    </h3>
</div>
<form class="form-horizontal" action="{{url('admin/Brand/createBrand')}}" method="post" enctype="multipart/form-data">
    <div class="box-body">
      @csrf
      <input type="hidden" name="id" value="{{!empty($data) ? $data->id : ''}}">
      <div class="form-group">
          <label for="brandName" class="col-sm-2 control-label">@lang('brand.brandName')</label>
          <div class="col-sm-4">
              <input type="text" name="brandName" class="form-control input-lg" id="brandName" placeholder="@lang('brand.brandName')" value="{{!empty($data) ? $data->brandName : ''}}" required>
          </div>
        
          <label for="brandNameAr" class="col-sm-2 control-label">@lang('brand.brandNameAr')</label>
          <div class="col-sm-4">
              <input type="text" name="brandNameAr" class="form-control input-lg" placeholder="@lang('brand.brandNameAr')" value="{{!empty($data) ? $data->brandNameAr : ''}}" required id="brandNameAr">
          </div>
      </div>
      <div class="form-group">
          <label for="brandImage" class="col-sm-2 control-label">@lang('brand.brandImage')</label>
          <div class="col-sm-4">
              <input type="file" name="brandImage" class="form-control input-lg" placeholder="@lang('brand.brandImage')" >
              @if(!empty($data) && !empty($data->brandImage)) 
                <img src="{{url('Admin_uploads/brands/'.$data->brandImage)}}" style="height:100px;width:100px"> 
              @endif
          </div>
      </div>
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
  