<div class="box-header with-border">
    <h3 class="box-title">@if(empty($data)) @lang('general.add') @else @lang('general.edit') @endif</h3>
</div>
<form class="form-horizontal" action="{{url('admin/Measur_unit/createMeasurUnit')}}" method="post">
    <div class="box-body">
        @csrf
        <input type="hidden" name="id" value="{{!empty($data)?$data->id:''}}">
        

        <div class="form-group">
            
            <label for="unitName" class="col-sm-2 control-label">@lang('measur_unit.unitName')</label>
            <div class="col-sm-4">
                <input type="text" name="unitName" class="form-control input-lg" id="unitName" placeholder="@lang('measur_unit.unitName')" value="{{!empty($data) ? $data->unitName :''}}" required>
            </div>
          
            <label for="unitNameAr" class="col-sm-2 control-label">@lang('measur_unit.unitNameAr')</label>
            <div class="col-sm-4">
                <input type="text" name="unitNameAr" class="form-control input-lg" placeholder="@lang('measur_unit.unitNameAr')" value="{{!empty($data) ? $data->unitNameAr :''}}" required id="unitNameAr">
            </div>

        </div>


        <div class="form-group">
            
            <label for="unitCode" class="col-sm-2 control-label">@lang('measur_unit.unitCode')</label>
            <div class="col-sm-4">
                <input type="text" name="unitCode" class="form-control input-lg" id="unitCode" placeholder="@lang('measur_unit.unitCode')" value="{{!empty($data) ? $data->unitCode :''}}" required>
            </div>
            <?php 
                $unitType = !empty($data) ? $data->unitType :'';
            ?>
            <label for="unitType" class="col-sm-2 control-label">@lang('measur_unit.unitType')</label>
            <div class="col-sm-4">
                <select name="unitType" class="form-control input-lg select2" required id="unitType">
                    <option value="">@lang('general.choose')</option>
                    <option value="tall" {{$unitType == 'tall' ? 'selected' : ''}}>@lang('general.tall')</option>
                    <option value="weight" {{$unitType == 'weight' ? 'selected' : ''}}>@lang('general.weight')</option>
                    <option value="liquid" {{$unitType == 'liquid' ? 'selected' : ''}}>@lang('general.liquid')</option>
                </select>
            </div>

        </div>

        
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>
