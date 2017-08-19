 alert('ok');

    /*$('#comment-form').submit(function () {
        //var taskID = $(this).find('#taskId').val();
        var comment = $(this).find('#comment').val();
        var lijst = $(this).find().sibling('.comment-list');
        event.preventDefault();
        //console.log(taskID);*/

        $.ajax({
            type:"POST",
            url:"ajax/comment.php",
            data:{data:value},
            succes: function(response){

            }
            });
    //})

/*

$("#add").click("submit", function(e){
    $.post('../ajax/comment.php', $(this).serialize(), function(e){

        var comment = $("<div class='comment_email'>");
        var email = '<?php echo htmlspecialchars($email) ?>';
        comment.html('<div><p>' + email + '</p><p>' + $('#comment').val() + '</p></div>');

        $('#comment_box').prepend(comment);
        $('#comments').val('');
    });
    e.preventDefault();
});*/