<div class="box-header with-border">
    <h3 class="box-title">
      {{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}
    </h3>
</div>
<form class="form-horizontal" action="{{url('admin/State/createState')}}" method="post" enctype="multipart/form-data">
    <div class="box-body">
      @csrf
      <input type="hidden" name="id" value="{{!empty($data) ? $data->id : ''}}">
      
      <div class="form-group">
          <label for="stateName" class="col-sm-2 control-label">@lang('state.stateName')</label>
          <div class="col-sm-4">
              <input type="text" name="stateName" class="form-control input-lg" id="stateName" placeholder="@lang('state.stateName')" value="{{!empty($data) ? $data->stateName : ''}}" required>
          </div>
        
          <label for="stateNameAr" class="col-sm-2 control-label">@lang('state.stateNameAr')</label>
          <div class="col-sm-4">
              <input type="text" name="stateNameAr" class="form-control input-lg" placeholder="@lang('state.stateNameAr')" value="{{!empty($data) ? $data->stateNameAr : ''}}" required id="stateNameAr">
          </div>
      </div>


      <div class="form-group">
            <label for="country_id" class="col-sm-2 control-label">@lang('state.country_id')</label>
            <div class="col-sm-4">
                <select name="country_id" class="form-control input-lg select2" id="country_id" onchange="return getCities(this.value)">
                  <option value="">@lang('general.choose')</option>
                    @if(!empty($countries))
                        @foreach($countries as $country)
                            {{$selected = !empty($data) && $data->country_id == $country->id ? 'selected' : ''}}
                            <option value="{{$country->id}}" {{$selected}}>{{$country->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>


            <label for="city_id" class="col-sm-2 control-label">@lang('state.city_id')</label>
            <div class="col-sm-4">
                <select name="city_id" class="form-control input-lg select2" id="city_id">
                  <option value="">@lang('general.choose')</option>
                  @if(!empty($data))
                    <?php
                      $city = App\Models\City::find($data->city_id)->name;
                    ?>
                    <option value="{{$data->city_id}}" selected>{{$city}}</option>
                  @endif
                </select>
            </div>
        </div>



    <div class="box-footer">
        <input type="submit" class="btn btn-info" value="{{empty($data) ? Lang::get('general.add') : Lang::get('general.edit')}}">
    </div>
</form>

<script type="text/javascript">

  function getCities(country_id){
    $.ajax({
      url:"{{url('admin/State/getCities')}}/"+country_id,
      type:"get",
      success : function(res){
        if (res.status){
          if(res.cities.length > 0){
            $('#city_id').html('');
            for (var i = res.cities.length - 1; i >= 0; i--) {
              $('#city_id').append($('<option>',
               {
                  value: res.cities[i].id,
                  text : res.cities[i].name
              }));
            }
          }
        }else{
          location.href = "{{url('admin/City/viewCreateCity')}}";
        }
      }
    });
  }

</script>
  