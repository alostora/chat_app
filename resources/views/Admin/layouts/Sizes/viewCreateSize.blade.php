<div class="box-header with-border">
    <h3 class="box-title">@if(empty($data)) @lang('general.add') @else @lang('general.edit') @endif</h3>
</div>
<form class="form-horizontal" action="{{url('admin/Size/createSize')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{!empty($data)?$data->id:''}}">
        

        <div class="form-group">
            
            <label for="sizeName" class="col-sm-2 control-label">@lang('size.sizeName')</label>
            <div class="col-sm-4">
                <input type="text" name="sizeName" class="form-control input-lg" id="sizeName" placeholder="@lang('size.sizeName')" value="{{!empty($data) ? $data->sizeName :''}}" required>
            </div>
          
            <label for="sizeNameAr" class="col-sm-2 control-label">@lang('size.sizeNameAr')</label>
            <div class="col-sm-4">
                <input type="text" name="sizeNameAr" class="form-control input-lg" placeholder="@lang('size.sizeNameAr')" value="{{!empty($data) ? $data->sizeNameAr :''}}" required id="sizeNameAr">
            </div>

        </div>


        <div class="form-group">
            
            <label for="sizeValue" class="col-sm-2 control-label">@lang('size.sizeValue')</label>
            <div class="col-sm-4">
                <input type="text" name="sizeValue" class="form-control input-lg" id="sizeValue" placeholder="@lang('size.sizeValue')" value="{{!empty($data) ? $data->sizeValue :''}}" required>
            </div>
            
            <label for="type_id" class="col-sm-2 control-label">@lang('size.type_id')</label>
            <div class="col-sm-4">
                <?php $type_id = !empty($data) ? $data->type_id :'';?>
                <select name="type_id" class="form-control input-lg select2" required id="type_id">
                    <option value="">@lang('general.choose')</option>
                    @if(!empty($types))
                      @foreach($types as $type)
                        <option value="{{$type->id}}" {{$type_id == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
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
