(function($){
  /* Objeto que armazena estado inicial do menu */
  var menu = function menu(){
    var menu = {
      li: null,
      cssClass: ''
    };

    return menu;
    };
    
  function menuLinkHoverIn() {
    $('ul.main_menu > li').removeClass('current current_ancestor');
    $(this).parent('li').addClass('current');
  }

  function menuLinkHoverOut(e) {
    $('ul.main_menu > li').removeClass('current current_ancestor');

    menu.li.addClass(menu.cssClass);
  }

  $(document).ready(function() {
    /* Armazena estado inicial do menu ao carregar a página*/
    if ($('ul.main_menu > li.current_ancestor').length > 0) {
      menu.li = $('ul.main_menu > li.current_ancestor');
      menu.cssClass = 'current_ancestor';
    } else {
      menu.li = $('ul.main_menu > li.current');
      menu.cssClass = 'current';
    }

    $('.main_menu > li > a.link').hover(menuLinkHoverIn);
    $('.main_menu').mouseleave(menuLinkHoverOut);

    $('.dropdown-menu').click(function(){
      $(this).children('ul').toggle()
    });
  });
})(jQuery);
