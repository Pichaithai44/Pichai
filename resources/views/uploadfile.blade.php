{{ Form::open(['route' => 'uploadfile', 'method' => 'POST', 'id' => 'form_uploadfile', 'enctype' => 'multipart/form-data']) }}
    <div class="form-group row">
        <div class="col d-flex justify-content-center">
            <div class="alert alert-success alert-block d-none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong></strong>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col  d-flex justify-content-center">
            <img src="{{ !empty($result['data']->path) ? $result['data']->path : (old('path') ? old('path') : asset("img/no-image.png")) }}" alt="profile-picture" class="img-thumbnail">
        </div>
    </div>
    <div class="form-group row">
        <div class="col  d-flex justify-content-center">
            {{ Form::hidden('path', !empty($result['data']->path) ? $result['data']->path : old('path'), []) }}
            {{ Form::hidden('file_code', !empty($result['data']->file_code) ? $result['data']->file_code : old('file_code'), []) }}
            <div class="btn-group upload-file" role="group">
                <label for="fileToUpload" class="btn btn-warning"><i class="fa fa-camera"></i> เลือกรูป
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" style="display:none;">
                </label>
                <label for="submitFile" class="btn btn-dark"><i class="fas fa-upload"></i>
                    <input type="submit"  id="submitFile" style="display:none;" >
                </label>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <small class="col-md-12 label-control"><i>- เลือกรูปและกดปุ่มอัพโหลด</i></small>
    </div>
{{ Form::close() }}

@section("script_upload")
<script type="text/javascript">

    $("input[name='fileToUpload']").change(function() {
        var fileToUpload = $(this).prop('files');
        if(fileToUpload.length > 0 ) {
            Object.keys(fileToUpload).forEach(file => {
                var lastModified = fileToUpload[file].lastModified;
                var lastModifiedDate = fileToUpload[file].lastModifiedDate;
                var name = fileToUpload[file].name;
                var size = fileToUpload[file].size;
                var type = fileToUpload[file].type;
                var fileReader = new FileReader();
                    fileReader.readAsDataURL(fileToUpload[file]);
                    fileReader.onload = function(fileLoadedEvent){
                        var img = new Image();
                            img.src = fileReader.result;
                        var path_img = (window.URL || window.webkitURL || window || {}).createObjectURL(fileToUpload[file]);
                        var MAX_WIDTH = 200;
                        var MAX_HEIGHT = 200;
                            
                        img.onload = function() {
                            var width = this.width;
                            var height = this.height;
                            var width_bg = 0;
                            var height_bg = 0;
                            var canvas = document.createElement("canvas");
                            var ctx = canvas.getContext("2d");
                                ctx.drawImage(img, 0, 0);

                            var ctx = canvas.getContext("2d");

                            if (width > height) {
                                if (width > MAX_WIDTH) {
                                    height *= MAX_WIDTH / width;
                                    width = MAX_WIDTH;
                                    height_bg = (MAX_HEIGHT - height) / 2;

                                    canvas.width = MAX_WIDTH;
                                    canvas.height = MAX_HEIGHT;
                             
                                    ctx.fillStyle = "000000";
                                    ctx.fillRect(0, 0, MAX_WIDTH, MAX_HEIGHT);
                                    ctx.drawImage(img, 0, height_bg, width, height);
                                }
                            } else {
                                if (height > MAX_HEIGHT) {
                                    width *= MAX_HEIGHT / height;
                                    height = MAX_HEIGHT;
                                    width_bg = (MAX_WIDTH - width) / 2;

                                    canvas.width = MAX_WIDTH;
                                    canvas.height = MAX_HEIGHT;
                             
                                    ctx.fillStyle = "000000";
                                    ctx.fillRect(0, 0, MAX_WIDTH, MAX_HEIGHT);
                                    ctx.drawImage(img, width_bg, 0, width, height);
                                }
                            }

                            var dataurl = canvas.toDataURL(type);
                            fetch(dataurl).then(res => res.blob()).then(blob => {
                                var blobUrl = (window.URL || window.webkitURL || window || {}).createObjectURL(blob);
                                var form = $("#form_uploadfile");
                                    form.find("img").attr("src", blobUrl);
                            });
                        };
                    };
                });
        }
    });

    $('#form_uploadfile').on('submit', function(e) {
        
        e.preventDefault();
        var method 		= "POST";
        var url 		= "{{ route('uploadfile') }}";
        var data 		= new FormData(this);
     
        $.ajax({
            url			: url,
            type		: method,
            dataType	: "json",
            data		: data,
            mimeTypes	: "multipart/form-data",
            contentType	: false,
            cache		: false,
            processData	: false,
            success		: function(data) {
                var form = $('#form_uploadfile');
                var form2 = $('#my_form');
                if(data.result) {
                    form.find('.d-none').css('visibility','visible').hide().fadeIn().removeClass('d-none');
                    form.find("strong").html(data.messages);
                    form.find("img").attr("src", data.path);
                    form.find("input[name='path']").val(data.path);
                    form.find("input[name='file_code']").val(data.file_code);
                    form2.find("input[name='path']").val(data.path);
                    form2.find("input[name='file_code']").val(data.file_code);
                    setTimeout(() => {
                        form.find( "div.alert-success" ).slideUp(600);
                    }, 1000);
                } else {
                    if($(data.errors.fileToUpload).size() > 0) {
                        $(data.errors.fileToUpload).each(function (i, e) {
                            
                        });
                    }
                    form.find("strong").html(data.errors.message);
                }
            }, statusCode: {
                400: function(data) {alert("400");},
                403: function(data) {alert("403");},
                404: function(data) {alert("404");},
                500: function(data) {alert("500");}			
            }
        });
    });
</script>
@endsection