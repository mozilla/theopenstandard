$(document).foundation();

$(document).ready(function() {

  /*  
    Insert user agent
  */
  $('body').attr('data-useragent', navigator.userAgent);

  /*
    Featured articles carousel
  */
 
  $("#featuredArticles").owlCarousel({
    itemsCustom: [
      [0, 1],
      [460, 3],
      [1024, 5]
    ],
    pagination: true
  });

  /*
    Story In-Context carousel
  */
  
  $("#featuredArticlesStory").owlCarousel({
    itemsCustom: [
      [0, 1],
      [460, 2],
      [1024, 3]
    ],
    pagination: true
  });

  /*
    Around the Web carousel
  */

  var $aroundTheWeb = $('#aroundTheWeb');

  $(window).resize(function() {
    if (window.innerWidth <= 640) {
      if (typeof $aroundTheWeb.data('owlCarousel') === 'undefined') {
        $aroundTheWeb.addClass('owl-carousel').owlCarousel();
      }
    }
    else {
      if (typeof $aroundTheWeb.data('owlCarousel') !== 'undefined') {
        $aroundTheWeb.data('owlCarousel').destroy();
        $aroundTheWeb.removeClass('owl-carousel');
      }
    }
  }).trigger('resize');

  /*
  */

  var $featuredTopicArticles = $('#featuredTopicArticles');

  $(window).resize(function() {
    if (window.innerWidth <= 640) {
      if (typeof $featuredTopicArticles.data('owlCarousel') === 'undefined') {
        $featuredTopicArticles.addClass('owl-carousel').owlCarousel();
      }
    }
    else {
      if (typeof $featuredTopicArticles.data('owlCarousel') !== 'undefined') {
        $featuredTopicArticles.data('owlCarousel').destroy();
        $featuredTopicArticles.removeClass('owl-carousel');
      }
    }
  }).trigger('resize');
 
});