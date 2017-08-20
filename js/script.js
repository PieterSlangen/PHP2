$("#Add").click("submit", function(e){
    var comment = $("#comment").val();
    var taskID = $("#taskID").val();
    var userID = $("#userID").val();
    var userEmail = $("#userEmail").val();

    $.ajax({
        type:"POST",
        url:"comment.php",
        data:{comment: comment, taskID: taskID, userID: userID},
        success: function(response){
            if(comment == ""){
                var error = $("<div></div>");
                error.html("<p class='alert-warning'>Please fill in all fields</p>");

                $("#error").prepend(error);
            }else{
                /*alert(comment);
                 alert(taskID);
                 alert(userID);
                 alert(response);*/
                var div = $("<div></div>");
                div.html("<p class='text-danger'>" + userEmail + "</p><p>" + comment + "</p><hr>");

                $("#comment-box").prepend(div);
                $("#comment").val("").focus();
            }
        }
    });
    e.preventDefault();
});

$("#todo").click("submit", function(e){
    var todo = $("#todo").val();
    var taskID = $("#taskID").val();

    $.ajax({
        type:'POST',
        url:'todo.php',
        data:{todo: todo, taskID: taskID},
        success: function(response){
            if($("#todo").val() == 0){
                $("#todo").val(1);
            }else{
                $("#todo").val(0);
            }
            /*alert(todo);
             alert(taskID);
             alert(response);*/
        }
    });
});