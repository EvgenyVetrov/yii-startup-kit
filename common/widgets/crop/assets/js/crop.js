function readFile(selector, options){
    var reader = new FileReader();
    var file = document.getElementById(selector + "-crop");
    var image = document.getElementById(selector + "-crop-image");

    if (file.files.length == 1){
        reader.onload = function (event){
            image.src = reader.result;

            image.onload = function (){
                $("#" + selector + "-crop-modal").modal("show");
                $("#" + selector + "-crop-image").Jcrop(options);
            }
        };

        reader.readAsDataURL(file.files[0]);
    }
}

function destroyJcrop(selector)
{
    var img = $("#" + selector);
    img.data("Jcrop").destroy();
    img.removeAttr("style");
}

function setCoords(selector, c)
{
    $("#" + selector + "-crop-x").val(c.x);
    $("#" + selector + "-crop-w").val(c.w);
    $("#" + selector + "-crop-y").val(c.y);
    $("#" + selector + "-crop-h").val(c.h);
}