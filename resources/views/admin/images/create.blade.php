@extends('admin.homepage')
@section('styles')
<style>
    input[type="file"] {
    display: block;
    }
    .imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
    }
    .pip {
    display: inline-block;
    margin: 10px 10px 0 0;
    }
    .remove {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
    }
    .remove:hover {
    background: white;
    color: black;
    }
    #label{
        border: 1px solid black;

    }
    #label div{
        cursor: pointer;
        padding: 5px;
    }
</style>
@endsection
@section('content')
<div class="field" align="left">
    <form action="{{route('admin.image.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Upload your images</h3>
        <div>
            <input type="file" id="files" name="images[]" multiple hidden />
            <label id="label" for="files" class="rounded">
                <div>Upload files</div>
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('script')
<script>
  var selectedfiles;
    var selectedfile;
    var fileIndex;
    $(document).ready(function () {

        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function (e) {
                var files = e.target.files,
                    selectedfiles = files;
                console.log(selectedfiles);
                filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    selectedfile = files[i]
                    fileIndex = i;
                    // console.log(i, f);

                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + selectedfile.name + "\"/>" +
                            "<br/><span class=\"remove\" onclick=\"removeImage('" +
                            selectedfile.name + "')\">Remove image</span>" +
                            "</span>").insertAfter("#files");

                        $(".remove").click(function () {
                            $(this).parent(".pip").remove();
                        });



                    });
                    fileReader.readAsDataURL(selectedfile);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

    function removeImage(name) {
        selectedfiles = document.getElementById("files").files;
        var final = [];
        $.each(selectedfiles, function (index, value) {
            if (value.name !== name) {
                console.log(value);
                final.push(value);
            }
        });
        console.log('List', final);
        document.getElementById("files").files = new FileListItem(final);
    }

    function FileListItem(a) {
        a = [].slice.call(Array.isArray(a) ? a : arguments)
        for (var c, b = c = a.length, d = !0; b-- && d;) d = a[b] instanceof File
        if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
        for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(a[c])
        return b.files
    }
</script>
@endsection