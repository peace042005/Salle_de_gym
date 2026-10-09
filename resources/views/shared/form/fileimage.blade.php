@php
    $label ??= null;
    $name ??= null;
    $value ??= null;
@endphp

<div class="mb-3">
    <div class="imgUp">
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <div class="imagePreview"></div>
        <label class="btn btn-load-image">
            Choisissez une image
            <input name="{{ $name }}" value="{{ old($name, $value) }}" type="file"
                class="uploadFile img @error($name) is-invalid @enderror" id="{{ $name }}"
                style="width: 0px;height: 0px;overflow: hidden;">
        </label>
    </div>
</div>
<span class="text-danger">
    @error($name)
        <small class="text-tiny">{{ $message }}</small>
    @enderror
</span>


{{-- script & style relate to component --}}
@push('style')
    <style>
        body {
            background-color: #f5f5f5;
        }

        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-load-image {
            background: var(--primary);
            color: #fff;
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .imgUp {
            margin-bottom: 15px;
        }

        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4bd7ef;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(".imgAdd").click(function() {
            $(this).closest(".row").find('.imgAdd').before(
                '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-load-image">Choisissez une image<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>'
            );
        });
        $(document).on("click", "i.del", function() {
            $(this).parent().remove();
        });
        $(function() {
            $(document).on("change", ".uploadFile", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image",
                            "url(" + this.result + ")");
                    }
                }

            });
        });
    </script>
@endpush
