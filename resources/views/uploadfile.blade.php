<form id="form_uploadfile" enctype="multipart/form-data">
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
            <img src="{{ old('path') ? old('path') : asset("img/no-image.png") }}" id="img_logo" alt="profile-picture" class="img-thumbnail">
        </div>
    </div>
    <div class="form-group row">
        <div class="col  d-flex justify-content-center">
            @csrf
            <input type="hidden" name="path" value="{{ old('path') }}">
            <input type="hidden" name="file_code" value="{{ old('file_code') }}">
            <div class="btn-group upload-file" role="group">
                <label for="fileToUpload" class="btn btn-warning"><i class="fa fa-camera"></i> เลือกรูปสมาชิก
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" style="display:none;">
                </label>
                <label for="submitFile" class="btn btn-dark"><i class="fas fa-upload"></i>
                    <input type="submit"  id="submitFile" style="display:none;" >
                </label>
            </div>
        </div>
    </div>
</form>
@section("script_upload")
<script type="text/javascript">

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
                console.log(data);
                var form = $('#form_uploadfile');
                if(data.result) {
                    form.find('.d-none').css('visibility','visible').hide().fadeIn().removeClass('d-none');
                    form.find("strong").html(data.messages);
                    form.find("#img_logo").attr("src", data.path);
                    form.find("input[name='path']").val(data.path);
                    form.find("input[name='file_code']").val(data.file_code);
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