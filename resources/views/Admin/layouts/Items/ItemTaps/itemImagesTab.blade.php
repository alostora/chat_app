<div class="tab-pane {{empty($data)?'':'active'}}" id="itemImagesTab">

    <form class="form-horizontal dropzone" action="{{url('admin/Item/createItemImages')}}" method="post" id="my-awesome-dropzone" onsubmit="return false">
        <div class="box-body">
            @csrf
            <input type="hidden" name="id" value="{{(!empty($data))?$data->id:''}}">
        </div>
    </form>
</div>




