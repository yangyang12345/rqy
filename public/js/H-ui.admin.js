/*创建iframe*/
function creatIframe(href,titleName){
    var topWindow=$(window.parent.document),
        show_nav=topWindow.find('#min_title_list'),
        iframe_box=topWindow.find('#iframe_box'),
        iframeBox=iframe_box.find('.show_iframe'),
        $tabNav = topWindow.find(".acrossTab"),
        $tabNavWp = topWindow.find(".Hui-tabNav-wp"),
        $tabNavmore =topWindow.find(".Hui-tabNav-more");
    var taballwidth=0;

    show_nav.find('li').removeClass("active");
    show_nav.append('<li class="active"><span data-href="'+href+'">'+titleName+'</span><i></i><em></em></li>');
    if('function'==typeof $('#min_title_list li').contextMenu){
        $("#min_title_list li").contextMenu('Huiadminmenu', {
            bindings: {
                'closethis': function(t) {
                    var $t = $(t);
                    if($t.find("i")){
                        $t.find("i").trigger("click");
                    }
                },
                'closeall': function(t) {
                    $("#min_title_list li i").trigger("click");
                },
            }
        });
    }else {

    }
    var $tabNavitem = topWindow.find(".acrossTab li");
    if (!$tabNav[0]){return}
    $tabNavitem.each(function(index, element) {
        taballwidth+=Number(parseFloat($(this).width()+60))
    });
    $tabNav.width(taballwidth+25);
    var w = $tabNavWp.width();
    if(taballwidth+25>w){
        $tabNavmore.show()}
    else{
        $tabNavmore.hide();
        $tabNav.css({left:0})
    }
    iframeBox.hide();
    iframe_box.append('<div class="show_iframe"><div class="loading"></div><iframe frameborder="0" src='+href+'></iframe></div>');
    var showBox=iframe_box.find('.show_iframe:visible');
    showBox.find('iframe').load(function(){
        showBox.find('.loading').hide();
    });
}



/*关闭iframe*/
function removeIframe(){
    var topWindow = $(window.parent.document),
        iframe = topWindow.find('#iframe_box .show_iframe'),
        tab = topWindow.find(".acrossTab li"),
        showTab = topWindow.find(".acrossTab li.active"),
        showBox=topWindow.find('.show_iframe:visible'),
        i = showTab.index();
    tab.eq(i-1).addClass("active");
    tab.eq(i).remove();
    iframe.eq(i-1).show();
    iframe.eq(i).remove();
}