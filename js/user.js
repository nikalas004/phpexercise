$(document).ready(function() {
    $(".update").click(function() {
        var id = $(this).val();
        location.href = "update/" + id;
    });
});
