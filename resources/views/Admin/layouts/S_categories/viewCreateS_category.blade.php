<div class="box-header with-border">
    <h3 class="box-title">
      {{empty($cat) ? Lang::get('general.add') : Lang::get('general.edit')}}
    </h3>
</div>
<form class="form-horizontal" action="{{url('admin/S_category/createS_category')}}" method="post" enctype="multipart/form-data">
    <div class="box-body">
      @csrf
      <input type="hidden" name="id" value="{{!empty($data) ? $data->id : ''}}">
      <div class="form-group">
          <label for="categoryName" class="col-sm-2 control-label">@lang('s_category.categoryName')</label>
          <div class="col-sm-4">
              <input type="text" name="categoryName" class="form-control input-lg" id="categoryName" placeholder="@lang('s_category.categoryName')" value="{{!empty($data) ? $data->categoryName : ''}}" required>
          </div>
        
          <label for="categoryNameAr" class="col-sm-2 control-label">@lang('s_category.categoryNameAr')</label>
          <div class="col-sm-4">
              <input type="text" name="categoryNameAr" class="form-control input-lg" placeholder="@lang('s_category.categoryNameAr')" value="{{!empty($data) ? $data->categoryNameAr : ''}}" required id="categoryNameAr">
          </div>
      </div>
      <div class="form-group">
          <label for="categoryImage" class="col-sm-2 control-label">@lang('s_category.categoryImage')</label>
          <div class="col-sm-4">
              <input type="file" name="categoryImage" class="form-control input-lg" placeholder="@lang('s_category.categoryImage')" >
              @if(!empty($data) && !empty($data->categoryImage)) 
                {!! $data->image_url !!}
              @endif
          </div>

          <label for="cat_id" class="col-sm-2 control-label">@lang('s_category.cat_id')</label>
          <div class="col-sm-4">
              <select name="cat_id" class="form-control input-lg select2" placeholder="@lang('s_category.cat_id')" required id="cat_id">
                @if(!empty($categories))
                  @foreach($categories as $cat)
                    <option value="{{$cat->id}}" {{!empty($data) && $data->cat_id == $cat->id ? 'selected' : ''}}>
                      {{$cat->name}}
                    </option>
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
  