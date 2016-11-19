$(function(){
  $("a").click(function(){
    var $d1 = $("#d1"); //little optimization because we will use it more than once
    $d1.removeClass("spinEffect");
    setTimeout(function(){$d1.addClass("spinEffect")},0);
  });
});