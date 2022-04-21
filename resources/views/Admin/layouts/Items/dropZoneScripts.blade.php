
<script>
Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  autoProcessQueue: true,
  uploadMultiple: false,
  addRemoveLinks: true,
  createImageThumbnails: true,
  parallelUploads: 100,
  maxFiles: 5,
  paramName: 'images',

  dictDefaultMessage: '{{Lang::get("item.uploadImages")}}',
  //previewTemplate : document.querySelector('#tpl').innerHTML,
  //previewsContainer: defaultPreviewTemplate,
  //disablePreviews: true,
  dictRemoveFile: '{{Lang::get("item.deleteImage")}}',


  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    @if(!empty($data)&&count($data->images)>0)
    @foreach($data->images as $img)
      //fid param for delete
      var mock = {name:'{{$img->imageName}}',size:50,fid:'{{$img->id}}'};
      this.emit('addedfile',mock);
      this.emit('thumbnail',mock, "{{url('Admin_uploads/items/'.$img->imageName)}}");
    @endforeach
    @endif
    
    // this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    //   // Make sure that the form isn't actually being sent.
    //   e.preventDefault();
    //   e.stopPropagation();
    //   myDropzone.processQueue();
    // });
    
    //single file
    this.on("sending", function(file, xhr, data) {
      console.log("sending");
    });

    //single file
    this.on("success", function(file, response) {
      file.fid = response.image.id;
      console.log("success");
      console.log(response.image);
    });

    //multiple files
    this.on("sendingmultiple", function(file, xhr, data) {
      console.log("sendingmultiple");
    });

    //multiple files
    this.on("successmultiple", function(files, response) {
      console.log("successmultiple");
      console.log(response);

      // for (var i = response.images.length - 1; i >= 0; i--) {
      //   console.log(response.images[i]);
      //   var mock = {name:response.images[i].imageName,size:50,fid:response.images[i].id};
      //   this.emit('addedfile',mock);
      //   this.emit('thumbnail',mock, "{{url('Admin_uploads/items')}}/"+response.images[i].imageName);
      // }
      //return false;
      //location.reload();
    });

    this.on("addedfile", function(files) {
      console.log("addedfile");
    });

    this.on("drop", function(files, response) {
      console.log("drop");
    });

    this.on("removedfile", function(files) {

         $.ajax({
            url:"{{url('admin/Item/removedFile')}}/"+files.fid,
            type:"get",
            success : function(res){
              if(res.status){
                console.log('image deleted');
              }
            }
        });
        console.log("removedfile");
    });

    this.on("errormultiple", function(files, response) {
      //console.log(JSON.parse(JSON.stringify(response.errors))['itemName']);
      //console.log(JSON.parse(JSON.stringify(response.errors))['itemName']);

      let errors = JSON.parse(JSON.stringify(response.errors));
      console.log(errors);
      $("div").removeClass('has-error');
      for(var key in errors){
        //$('input[name='+key+']').addClass('has-error');
        // $('.'+key).addClass('has-error');
        // $("span."+key).show();
        // $("span."+key).text(errors[key]);
      }

    });



  }
 
}

</script>