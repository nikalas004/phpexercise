function getUserId(element) {
    var classes = $(element).parent().attr("class").split(" ");
    var userId = classes[classes.length-1];
    return userId.substr(userId.length-2);
}

$(document).ready(function() {
    $(".add-user").click(function() {
       location.href = "user/add";
    });

    $(".view").click(function () {
        var userId = getUserId(this);
        location.href = "user/" + userId;
    });

    $(".edit").click(function () {
        var userId = getUserId(this);
        location.href = "user/update/" + userId;
    });

    $(".delete").click(function () {
        var userId = getUserId(this);
        $("body").append(
            '<div class="delete-dialog">' +
            "<p> Are you sure you want to delete this user?" +
            "<br>You won't be able to restore it.</p>" +
            "</div>"
        );
        $(".delete-dialog").dialog({
            resizeable: false,
            modal: true,
            draggable: false,
            title: "Delete conformation",
            buttons: [
                {
                    text: "Yes",
                    "class": "bg-danger text-white",
                    click: function () {
                        $.ajax({
                            type: "POST",
                            url: "request",
                            dataType: "json",
                            data: {
                                target: "User",
                                action: "deleteUser",
                                id: userId
                            },
                            success: function (data) {
                                location.href = "users";
                            }
                        });
                    }
                },
                {
                    text: "No",
                    click: function() {
                        $(this).dialog("close");
                        $(".delete-dialog").remove();
                    }
                }
            ],
            close: function () {
                $(".delete-dialog").remove();
            }
        });
    });

    $(".user-col").mouseover(function() {
        $(this).addClass("bg-secondary");
    })
        .mouseleave(function() {
            $(this).removeClass("bg-secondary");
        });

    $(".user-col").click(function() {
        var col = $(this).attr("id");
        if($(this).hasClass("dropup")) {
            location.href = "users";
        } else if($(this).children().length > 0) {
            location.href = "users?way=desc&col=" + col;
        } else {
            location.href = "users?col=" + col;
        }
    });
});
