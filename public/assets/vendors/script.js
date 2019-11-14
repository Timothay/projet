/* Indication de l'actuelle page dans la barre de navigation */
$(function() {
    $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});


/* Génération d'une fenêtre de pop-up avec comportement */
$(document).ready(function() {
  
  //check to see if the submited cookie is set, if not check if the popup has been closed, if not then display the popup
  if( getCookie('popupCookie') != 'submited'){ 
    if(getCookie('popupCookie') != 'closed' ){
      $('#cookieConsent').css("display", "flex").hide().fadeIn();
    }
  }
  
  $('div#closeCookieConsent').click(function(){
    $('#cookieConsent').fadeOut();
    //sets the coookie to one minute if the popup is closed (whole numbers = days)
    setCookie( 'popupCookie', 'closed', .00011574074 );
  });
  
  $('a.cookieConsentOK').click(function(){
    $('#cookieConsent').fadeOut();
    //sets the coookie to ever if the popup is submited
    setCookie( 'popupCookie', 'submited');
  });

  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  
});
