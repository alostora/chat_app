<div class="box-header with-border">
    <h3 class="box-title">@if(empty($data)) @lang('general.add') @else @lang('general.edit') @endif</h3>
</div>
<form class="form-horizontal" action="{{url('admin/Lang/createLang')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{!empty($data)?$data->id:''}}">
        

        <div class="form-group">
            
            <label for="langName" class="col-sm-2 control-label">@lang('lang.langName')</label>
            <div class="col-sm-4">
                <input type="text" name="langName" class="form-control input-lg" id="langName" placeholder="@lang('lang.langName')" value="{{!empty($data) ? $data->langName :''}}" required>
            </div>

            <label for="langCode" class="col-sm-2 control-label">@lang('lang.langCode')</label>
            <div class="col-sm-4">
                <input type="text" name="langCode" class="form-control input-lg" id="langCode" placeholder="@lang('lang.langCode')" value="{{!empty($data) ? $data->langCode :''}}" required>
            </div>

        </div>

    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
