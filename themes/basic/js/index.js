function isScrolledIntoView(){
    return ($(window).scrollTop() + 1 >= $(document).height() - $(window).height());
}

$(document).scroll(function(){
  if (isScrolledIntoView($('#show_more'))){
        $.get('load-more.php', {last_article: $(".li-loader").last().attr('id')}, function(data) {
            $('.grid').append(data);
            new CBPGridGallery( document.getElementById("grid-gallery"));
        });
    }
});

var $loading = $('#ajax-load').hide();

$(document)
  .ajaxStart(function () {
    $loading.show();
  })
  .ajaxStop(function () {
    $loading.hide();
  });