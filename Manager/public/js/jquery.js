$(document).ready(function() {

    // auto slug ===================
    $("#name").keyup(function() {
      var str = $(this).val()
      var trims = $.trim(str)
      var slug = trims.replace(/a-z A-Z 0-9 -/, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
      $("#slug").val(slug.toLowerCase())
    });
});