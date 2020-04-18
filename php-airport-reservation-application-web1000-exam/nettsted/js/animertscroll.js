function scrollToAnchor(aid){
    var aTag = $("a[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');

}

$("#finnledigbilletter").click(function() {
   scrollToAnchor('finnbilett');
});
