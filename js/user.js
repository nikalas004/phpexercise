$(document).ready(function() {
    $(".update").click(function() {
        var id = $(this).val();
        location.href = "update/" + id;
    });

    $(".delete").click(function() {
        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: "../request",
            dataType: "json",
            data: {
                target: "User",
                action: "deleteUser",
                id: id
            },
            success: function (data) {
                location.href = "../users";
            }
        });
    });

    $(".back").click(function() {
        location.href = "../users";
    });
});
