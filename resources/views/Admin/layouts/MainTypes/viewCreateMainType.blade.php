<div class="box-header with-border">
    <h3 class="box-title">@if(empty($data)) @lang('general.add') @else @lang('general.edit') @endif</h3>
</div>
<form class="form-horizontal" action="{{url('admin/Main_type/createMainType')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{(!empty($data))?$data->id:''}}">
        

        <div class="form-group">
            
            <label for="typeName" class="col-sm-2 control-label">@lang('main_type.typeName')</label>
            <div class="col-sm-4">
                <input type="text" name="typeName" class="form-control input-lg" id="typeName" placeholder="@lang('main_type.typeName')" value="{{(!empty($data)) ? $data->typeName :''}}" required>
            </div>
          
            <label for="typeNameAr" class="col-sm-2 control-label">@lang('main_type.typeNameAr')</label>
            <div class="col-sm-4">
                <input type="text" name="typeNameAr" class="form-control input-lg" placeholder="@lang('main_type.typeNameAr')" value="{{(!empty($data)) ? $data->typeNameAr :''}}" required id="typeNameAr">
            </div>

        </div>
        
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
