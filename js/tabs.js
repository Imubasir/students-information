$(function() {
  $(".head_li").on("click", function(e) {
    $(".head_nav .active").removeClass("active");
    $(this).addClass("active");
  });
})