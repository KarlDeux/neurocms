$("table a").click(function() {
    var button = $(this).attr('id').split('_');
    var method = button[0];
    var id = button[1];
    if (method === "delete") {
        var r = confirm("You are going to delete the article, are you sure?");
        if (r === true) {
            $.get('helper/delete_article.php', {id: id}, function() {
                window.location.href = "edit-delete-articles.php";
            });
        }
    } else {
        window.location.href = "new-article.php?article=" + id;
    }
});