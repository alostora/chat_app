<div class="content-wrapper">
    <section class="content-header">
        <h1>
          {{config('app.name')}}
          <small>@lang('general.control_panel')</small>  
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{$admins}}</h3>
                        <p>@lang('general.admins')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{url('admin/adminInfo')}}" class="small-box-footer">
                        @lang('general.info')<i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$users}}</h3>
                        <p>@lang('general.users')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{url('admin/userInfo')}}" class="small-box-footer">
                        @lang('general.info')<i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
        </div>
    </section>
</div>