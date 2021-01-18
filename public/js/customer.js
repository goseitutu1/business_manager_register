$(document).ready(function () {
    // set select2 theme
    $.fn.select2.defaults.set("theme", "bootstrap");

    $('#apply').on('click', function (e) {
        e.preventDefault();
        $('#save_and_apply').val(true);
        $('#form').submit();
    });
    $('#save').on('click', function (e) {
        e.preventDefault();
        $('#save_and_apply').val(false);
        $('#form').submit();
    });

});

function filePreview(input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadForm + img').remove();
            img.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
