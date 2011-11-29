(function($){
  // Pega todas as tabs e as divs conteúdo da página
  var tabListItems;
  var tabLinks = [];
  var contentDivs = [];

  $(document).ready(function () {

    if($('ul.direction-tabs').length > 0) {
      DirectionTripTabs();
    }
    
    $('#nj_route_filters_nj_transport_mode_id').change(function(e){
      $.ajax({
        url: 'routes/filter?transport_mode_id='+$(this).find("option:selected").val(),
        success: function(data) {
          $('div#routes_filter>ul#routes').remove();
          $('div#notifications_filter>div#notifications').remove();
          $('div#routes_filter').append($(data).find('ul#routes'));
          $('div#notifications_filter').append($(data).find('div#notifications'));
        }
      });
    });

    $('a#subscribe').click(function(e){
      $.ajax({
        url: 'subscribe?nj_route_id='+$('#nj_route_id').val(),
        error: function(data) {
          alert('Ops! there was an error, subscription canceled... If you see that please, fixes the problems and then change this alert');
        },
        success: function(data) {
          alert('HellYeah! subscribed... If you see that please change this alert');
          $('a#subscribe').hide();
          $('a#unsubscribe').show();
        }
      });
    });

    $('a#unsubscribe').click(function(e){
      $.ajax({
        url: 'unsubscribe?nj_route_id='+$('#nj_route_id').val(),
        error: function(data) {
          alert('Ops! there was an error, you still subscribed... If you see that please, fixes the problems and then change this alert');
        },
        success: function(data) {
          alert('HellYeah! unsubscribed... If you see that please change this alert');
          $('a#subscribe').show();
          $('a#unsubscribe').hide();
        }
      });
    });
  });

  function DirectionTripTabs() {
    var tabListItems = document.getElementById('tabs').childNodes;

    for ( var i = 0; i < tabListItems.length; i++ ) {
      if ( tabListItems[i].nodeName == "LI" ) {
        var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
        var id = getHash( tabLink.getAttribute('href') );
        tabLinks[id] = tabLink;
        contentDivs[id] = document.getElementById( id );
      }
    }

    // Adiciona eventos onclick as tabs e destaca a primeira aba
    var i = 0;

    for ( var id in tabLinks ) {
      tabLinks[id].onclick = showTab;
      tabLinks[id].onfocus = function() {this.blur()};
      if ( i == 0 ) {
        tabLinks[id].className = 'link medium selected';
        tabLinks[id].parentNode.className='selected';
      }
      i++;
    }

    // Oculta todas as divs conteúdo, exceto a primeira
    var i = 0;

    for ( var id in contentDivs ) {
      if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
      i++;
    }
  }

  function showTab() {
    var selectedId = getHash( this.getAttribute('href') );

    // Destaca a tab selecionada e remove o destaque das outras
    // Mostra a div com o conteúdo relacionado e oculta as outras
    for ( var id in contentDivs ) {
      if ( id == selectedId ) {
        tabLinks[id].className = 'link medium selected';
        tabLinks[id].parentNode.className='selected';
        contentDivs[id].className = 'tabContent';
      } else {
        tabLinks[id].className = 'link medium';
        tabLinks[id].parentNode.className='';
        contentDivs[id].className = 'tabContent hide';
      }
    }

    // Faz com que o browser não siga o link
    return false;
  }

  function getFirstChildWithTagName(element, tagName) {
    for ( var i = 0; i < element.childNodes.length; i++ ) {
      if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
    }
        
    return false;
  }

  function getHash( url ) {
    var hashPos = url.lastIndexOf ( '#' );
    return url.substring( hashPos + 1 );
  }
})(jQuery);