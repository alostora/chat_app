<ul class="nav nav-pills nav-justified">
    <li class="{{empty($data)?'active':''}}">
        <a href="#itemMainInfoTab" data-toggle="tab" class="text text-uppercase">@lang('item.mainInfoTap')</a>
    </li>
    <li style="display:{{empty($data)?'none':''}}"  class="{{empty($data)?'':'active'}}">
        <a href="#itemImagesTab" data-toggle="tab" class="text text-uppercase">@lang('item.image_url')</a>
    </li>
</ul>
<div class="tab-content">
    @include('Admin/layouts/Items/ItemTaps/itemMainInfoTab')
    @include('Admin/layouts/Items/ItemTaps/itemImagesTab')
</div>
