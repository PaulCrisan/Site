$(document).ready(function() {

  headerWords();

  $(".menu-el").click(function() {
    menuLogic(this)
  });
  menuColor();


  function menuLogic(element) {
    $('.menu-el span').first().removeClass('addColor');
    $('.menu-el').removeClass("no-border colored-border");
    $('.hide').hide();
    if ($(element).children().length > 0) {
      $(element).children().show(1000);
      $(element).addClass("no-border");
    } else {
      $(element).addClass('colored-border');
    }
  }

  function menuColor() {
    var flag = false;
    $('.menu-el span').each(function(i, obj) {
      if (window.location.href.toLowerCase().indexOf($(this).html().toLowerCase()) != -1) {
        $(this).addClass('addColor');
        flag = true;
      }

    });
    if(!flag)$('.menu-el span').first().addClass('addColor');
  }

  function headerWords() {

    var element = $("#traits");
    var words = isJason(element.html()) ? JSON.parse(element.html()) : "";
    if (Array.isArray(words) && words != "") {
      var nr = 0;
      loop();

      function loop() {
        element.html(words[nr]);
        element.fadeIn(1000, function() {
          $(this).animate({
            'right': '+=30%'
          }, 2000, function() {
            element.fadeOut(2000, function() {
              element.css({
                right: "20px"
              });
              nr++;
              if (nr < words.length) {
                loop();
              }
            });
          });
        });
      }
    } else element.html("Welcome");

    function isJason(text) {
      try {
        JSON.parse(text);
        return true;
      } catch (e) {
        return false;
      }
    }
  }


});
