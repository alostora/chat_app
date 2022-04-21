<div class="tab-pane {{empty($data)?'active':''}}" id="itemMainInfoTab">
    
    <form class="form-horizontal" action="{{url('admin/Item/createItem')}}" method="post" >
        <div class="box-body">
            @csrf
            <input type="hidden" name="id" value="{{(!empty($data))?$data->id:''}}">

            <div class="form-group">
                <div class="itemName">
                    <label for="itemName" class="col-sm-2 control-label">@lang('item.itemName')</label>
                    <div class="col-sm-4">
                        <input type="text" name="itemName" class="form-control input-lg" id="itemName" placeholder="@lang('item.itemName')" value="{{(!empty($data)) ? $data->itemName :''}}" required>
                        <span class="help-block itemName" style="display:none;"></span>
                    </div>
                </div>
                <div class="itemNameAr">
                    <label for="itemNameAr" class="col-sm-2 control-label">@lang('item.itemNameAr')</label>
                    <div class="col-sm-4">
                        <input type="text" name="itemNameAr" class="form-control input-lg" id="itemNameAr" placeholder="@lang('item.itemNameAr')" value="{{(!empty($data)) ? $data->itemNameAr :''}}" required>
                        <span class="help-block itemNameAr" style="display:none;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="itemPrice">
                    <label for="itemPrice" class="col-sm-2 control-label">@lang('item.itemPrice')</label>
                    <div class="col-sm-4">
                        <input type="number" name="itemPrice" class="form-control input-lg" id="itemPrice" placeholder="@lang('item.itemPrice')" value="{{(!empty($data)) ? $data->itemPrice :''}}" required>
                        <span class="help-block itemPrice" style="display:none;"></span>
                    </div>
                </div>

                <div class="itemDiscount">
                    <label for="itemDiscount" class="col-sm-2 control-label">@lang('item.itemDiscount')</label>
                    <div class="col-sm-4">
                        <input type="number" name="itemDiscount" class="form-control input-lg" id="itemDiscount" placeholder="@lang('item.itemDiscount')" value="{{(!empty($data)) ? $data->itemDiscount :''}}">
                        <span class="help-block itemDiscount" style="display:none;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="itemCount">
                    <label for="itemCount" class="col-sm-2 control-label">@lang('item.itemCount')</label>
                    <div class="col-sm-4">
                        <input type="number" name="itemCount" class="form-control input-lg" id="itemCount" placeholder="@lang('item.itemCount')" value="{{(!empty($data)) ? $data->itemCount :''}}">
                        <span class="help-block itemCount" style="display:none;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="itemDesc">
                    <label for="itemDesc" class="col-sm-2 control-label">@lang('item.itemDesc')</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="itemDesc" class="form-control input-lg textarea" placeholder="@lang('item.itemDesc')" required id="itemDesc">{{!empty($data) ? $data->itemDesc : ''}}</textarea>
                        <span class="help-block itemDesc" style="display:none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="itemDesc">
                    <label for="itemDescAr" class="col-sm-2 control-label">@lang('item.itemDescAr')</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="itemDescAr" class="form-control input-lg textarea" placeholder="@lang('item.itemDescAr')" required id="itemDescAr">{{!empty($data) ? $data->itemDescAr : ''}}</textarea>
                        <span class="help-block itemDescAr" style="display:none;"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="country_id">
                    <label for="country_id" class="col-sm-2 control-label">@lang('item.country_id')</label>
                    <div class="col-sm-4">
                        <select name="country_id" class="form-control input-lg select2" id="country_id">
                            @if(!empty($countries))
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{!empty($data) && $data->country_id == $country->id ? 'selected':''}} >{{$country->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="help-block country_id" style="display:none;"></span>
                    </div>
                </div>

                <div class="sub_cat_id">
                    <label for="sub_cat_id" class="col-sm-2 control-label">@lang('item.sub_cat_id')</label>
                    <div class="col-sm-4">
                        <select name="sub_cat_id" class="form-control input-lg select2" placeholder="@lang('s_category.sub_cat_id')" required id="sub_cat_id" onchange="return getSizes(this.value)">
                            <option value="">@lang('general.choose')</option>
                            @if(!empty($s_categories))
                              @foreach($s_categories as $cat)
                                <option value="{{$cat->id}}" {{!empty($data) && $data->sub_cat_id == $cat->id ? 'selected':''}}>
                                    {{$cat->name}}
                                </option>
                              @endforeach
                            @endif
                        </select>
                        <span class="help-block sub_cat_id" style="display:none;"></span>
                    </div>
                </div>
            </div>

                   
            <div class="form-group">
                <div class="size_id">
                    <label for="size_id" class="col-sm-2 control-label">@lang('item.size_id')</label>
                    <div class="col-sm-4">
                        <option value="">@lang('general.choose')</option>
                        <select name="size_id[]" class="form-control input-lg select2" id="size_id" multiple>
                            @if(!empty($sizes))
                                @foreach($sizes as $size)
                                    <option value="{{$size->id}}" {{!empty($data) && !empty($selectedSizes) && in_array($size->id, $selectedSizes) ? 'selected' : ''}}>
                                        {{$size->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span class="help-block size_id" style="display:none;"></span>
                    </div>
                </div>

                <div class="color_id">
                    <label for="color_id" class="col-sm-2 control-label">@lang('item.color_id')</label>
                    <div class="col-sm-4">
                        <option value="">@lang('general.choose')</option>
                        <select name="color_id[]" class="form-control input-lg select2" id="color_id" multiple>
                            @if(!empty($colors))
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}" {{!empty($data) && !empty($selectedColors) && in_array($color->id, $selectedColors) ? 'selected' : ''}}>
                                        {{$color->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span class="help-block color_id" style="display:none;"></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">
                {{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}
            </button>
        </div>
    </form>
</div>




<script type="text/javascript">


  function getSizes(sub_cat_id){

    if (sub_cat_id == '') {
        $('#size_id').html('');
        return false;
    }
    $.ajax({
      url:"{{url('admin/Item/getSizes')}}/"+sub_cat_id,
      type:"get",
      success : function(res){
        if (res.status){
          if(res.sizes.length > 0){
            $('#size_id').html('');
            for (var i = res.sizes.length - 1; i >= 0; i--) {
              $('#size_id').append($('<option>',
               {
                  value: res.sizes[i].id,
                  text : res.sizes[i].name
              }));
            }
            console.log(res);
          }
        }/*else{
          location.href = "{{url('admin/viewCreateSize')}}";
        }*/
      }
    });
}

</script>
