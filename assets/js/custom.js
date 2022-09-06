var izeScript = {};
var js_plugins = JSON.parse(jQuery('#js-plugins').val());
var isSticky = false;
(function($) {
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
  $(document).ready(function() {
    console.time('JS Performance Check izeScript.init(): ');
    izeScript.init();
    if($('a.so-nav[data-target="no_cat"]').length > 0){
      $('a.so-nav[data-target="no_cat"]').trigger('click');
    }
    console.timeEnd('JS Performance Check izeScript.init(): ');
  });
  /* all function goes here */
  izeScript = {
    init: function() {
      var ize = this;

      ize.carousel();
      ize.clickFunction();
      ize.wowjs();
      ize.gallery().init();
      ize.gallery().lightbox();
      ize.menumobile.init();
      ize.menumobile.resizes();
      //UPDATE
      ize.stickyMenu();
      ize.setHeaderDate();
      ize.promoCodeToggle();
      ize.smoothScroll();
      ize.scrollToTop();
      ize.resizeBanner();


      var fixBannerHeader = function() {
        if ($('body').hasClass('home') && $(window).width() < 991) {
          var windowHeight = $(window).height(),
            menuHeight = $('.header-menu-mobile').height(),
            bookButton = 41,
            actualHeight = windowHeight - menuHeight - bookButton;
          $('.home .banner-homepage.owl-carousel .image-slider').height(actualHeight);
        } else {
          $('.home .banner-homepage.owl-carousel .image-slider').css({
            'height': ''
          });
        }
      };
      $(window).resize(function() {
        fixBannerHeader();
      });

      $(window).load(function() {
        ize.menuactive();
        fixBannerHeader();
        ize.masonry().gallerygrid();
        ize.mapFunction.initMap();
        $("#share").jsSocials({
          showLabel: false,
          showCount: false,
          shares: ["email", "facebook", "googleplus", "linkedin", ]
        });
      });

    },
    resizeBanner() {
      console.log("woww");
      
      var headerHeight = $('#headerMenu').height();
      var bannerHeight = $('header.banner-header').height();
      var adminbar = $('#wpadminbar');
      console.log(headerHeight);
      console.log(bannerHeight);
      
      
      
      if ($('#wpadminbar')) {
        height += $('#wpadminbar').height();
      }

      var height = headerHeight;

      $('.image-slider').css({
        height: "280px!important"
      });


    },
    lazyLoadImages: function() { // not used for now
      if (js_plugins.lazy_load == '1') {
        $('.lazy').lazy({
          effect: 'fadeIn',
          effectTime: 300,
          threshold: 0
        });
      }
    },
    // UPDATE
    stickyMenu() {
      console.log('sticky coyy');
      var menu = $('#bottomMenu');
      window.onscroll = function(e){
        var offsetTop = menu.offset().top;
        if (this.pageYOffset > offsetTop && isSticky === false) {
          menu.addClass('is-sticky');
          $('.arrow-top').css({visibility: 'visible', opacity: 1});
          isSticky = true;
        }
        if (this.pageYOffset < 84 && isSticky === true) {
          menu.removeClass('is-sticky');
          $('.arrow-top').css({visibility: 'hidden', opacity: 0});
          isSticky = false;
        }
      }
    },
    carousel: function() {
      if ($('.run-carousel').length > 0) {
        var navigationtext = ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'];
        $('.run-carousel').each(function() {
          izeScript.oc[$(this).attr('id')] = $(this);
        });
        $.each(izeScript.oc, function(index, value) {
          if (value.attr('data-banner-carousel') == 'true') {
            $(window).load(function() {
              value.owlCarousel({
                loop: true,
                nav: true,
                autoplay: false,
                autoplayTimeout: 10000,
                autoplayHoverPause: false,
                items:1,
                navText: navigationtext,
                animateIn: 'fadeIn', // add this
                animateOut: 'fadeOut' // and this
              });
            });
          } else if (value.attr('data-owl') == 'image-slider') {
            $(window).load(function() {
              value.owlCarousel({
                loop: true,
                nav: true,
                itemsMobile: [300, 1],
                responsive: {
                  0: {
                    items: 1
                  }
                },
                navText: navigationtext,
              });
            });
          } else {
            $(window).load(function() {
              value.owlCarousel({
                loop: false,
                nav: true,
                invinite: false,
                margin:10,
                responsive: {
                  0: {
                    items: 1
                  },
                  640: {
                    items: 2
                  },
                  991: {
                    items: 3
                  }
                },
                navText: navigationtext,
              });
            });
          }
        });
      }
    },
    menumobile: {
      init: function() {
        $('.header-menu-mobile button#toggle-menu').click(function(e) {
          e.preventDefault();
          var ww = $(window).width(),
            wh = $(window).height();
          if (ww < 1101) {
            if ($('.header-menu-mobile .mobile-menu-wrapper').hasClass('active')) {
              $('.header-menu-mobile .mobile-menu-wrapper').height(0).removeClass('active');
              $(this).removeClass('active');
            } else {
              $('.header-menu-mobile .mobile-menu-wrapper').height((wh - 90)).addClass('active');
              $(this).addClass('active');
            }
          }
          return false;
        });
      },
      resizes: function() {
        $(window).resize(function() {
          var ww = $(window).width();
          if (ww > 1100 && $('.header-menu-mobile .mobile-menu-wrapper').hasClass('active')) {
            $('.header-menu-mobile .mobile-menu-wrapper').height(0).removeClass('active');
            $('.header-menu-mobile button#toggle-menu').removeClass('active');
          }
        });
      }
    },
    // UPDATE
    parseDate(date){
      var dt = date.toString().split(' ');
      var newDt = '<span>'+dt[2]+'</span> '+dt[1]+' '+dt[3];
      return newDt;
    },
    // UPDATE
    parseFormatDate(date){
      return date.getFullYear()+'/'+date.getMonth()+'/'+date.getDate();
    },
    // UPDATE
    setHeaderDate(){
      var checkin = $('input[name="entrada"]');
      var checkout = $('input[name="salida"]');
      var dt = new Date();

      checkin.val(this.parseFormatDate(dt));
      checkin.datepicker('setDate', dt);
      $('#'+checkin.attr('data-id')).html(this.parseDate(dt));

      dt.setDate(dt.getDate()+1);
      checkout.val(this.parseFormatDate(dt));
      checkout.datepicker('setDate', dt);
      $('#'+checkout.attr('data-id')).html(this.parseDate(dt));
    },
    // UPDATE
    promoCodeToggle(){
      var promoCode = $('#promoCode');
      $('a.promotion-code').on('click', function(e){
        e.preventDefault();
        $(this).fadeOut(200);
        promoCode.fadeIn(200);
      });
      $('#closeFormCode').on('click', function(e){
        promoCode.fadeOut(200);
        $('a.promotion-code').fadeIn(200);
      });
    },
    clickFunction: function() {
      // UPDATE
      var context = this;
      $('input.datepicker-header').datepicker({
        format: 'yyyy/mm/dd',
        startDate: 'today',
        autoclose: true
      }).on('changeDate', function(date){
        var id = $(this).attr('data-id');
        $('#'+id).html(context.parseDate(date.date));
        if (id == 'checkinVal') {
          var tomorrow = date.date;
          var next = $('input[name="salida"]');
          tomorrow.setDate(tomorrow.getDate()+1);
          $('#checkoutVal').html(context.parseDate(tomorrow));
          next.val(context.parseFormatDate(tomorrow));
          next.datepicker('setDate', tomorrow);
          next.datepicker('setStartDate', tomorrow);
        }
      });
      // END UPDATE

      $('input.datepicker').each(function() {
        var id = $(this).attr('data-id');
        $('#txtStartDate-' + id).datepicker({
          format: 'dd/mm/yyyy',
          startDate: 'today',
          autoclose: true
        }).on('changeDate', function(e) {
          var newstart = $('#txtStartDate-' + id).datepicker('getDate');
          newstart.setDate(newstart.getDate() + 1);
          $('#txtEndDate-' + id).datepicker('setStartDate', newstart);
          $('#txtEndDate-' + id).datepicker('setDate', newstart);
        });;
        $('#txtEndDate-' + id).datepicker({
          format: "dd/mm/yyyy",
          startDate: 'today',
          autoclose: true
        });
      });

      $('input.datepicker').each(function() {
        var id = $(this).attr('data-id');
        $('#txtStartDate-m' + id).datepicker({
          format: 'dd/mm/yyyy',
          startDate: 'today',
          autoclose: true
        }).on('changeDate', function(e) {
          var newstart = $('#txtStartDate-m' + id).datepicker('getDate');
          newstart.setDate(newstart.getDate() + 1);
          $('#txtEndDate-m' + id).datepicker('setStartDate', newstart);
          $('#txtEndDate-m' + id).datepicker('setDate', newstart);
        });;
        $('#txtEndDate-m' + id).datepicker({
          format: "dd/mm/yyyy",
          startDate: 'today',
          autoclose: true
        });
      });

      $('span.welcome-text').click(function() {
        $('html, body').animate({
          scrollTop: $('.jardine-container').offset().top - 55
        }, 1000);
      });
      // $('#postCar-740b0185db a.button-link').click(function(e) {
      //   e.preventDefault();
      //   var title = $(this).closest('.content').find('h3').text();
      //   // $('#specialOfferModal .modal-title').text(title);
      //   $('#specialOfferModal input[name="subject"]').val(title).prop("disabled", true);
      //   $('#specialOfferModal').modal('show');
      //   return false;
      // });
      // $('#postCar-740b0185db a.button-image').click(function(e) {
      //   e.preventDefault();
      //   var title = $(this).closest('.wrapper-item-carousel').find('.content h3').text();
      //   // $('#specialOfferModal .modal-title').text(title);
      //   $('#specialOfferModal input[name="subject"]').val(title).prop("disabled", true);
      //   $('#specialOfferModal').modal('show');
      //   return false;
      // });
      // $('.special-offer-content a.button-link').click(function(e) {
      //   e.preventDefault();
      //   var title = $(this).closest('.special-content').find('h2').text();
      //   // $('#specialOfferModal .modal-title').text(title);
      //   $('#specialOfferModal input[name="subject"]').val(title).prop("disabled", true);
      //   $('#specialOfferModal').modal('show');
      //   return false;
      // });http://www.ize-seminyak.com/booking
      $('a.open-modal-special-offer-1').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('page-special')) {
          var title = $(this).closest('.special-offer-loop').find('h2').text();
          $('#specialOfferModal .modal-title').text('Special Offer');
          $('#specialOfferModal .modal-body').html($('input[type="hidden"][data-index="' + $(this).attr('data-index') + '"]').val()).prepend('<h3>' + title + '</h3>').append('<br> ' + $(this).closest('.special-offer-loop').find('a.button-link').prop('outerHTML'));
          $('#specialOfferModal a.button-link').addClass('button-more');
          $('#specialOfferModal').modal('show');
        }

        return false;
      });
      $('a.open-modal-special-offer').click(function(e) {
        e.preventDefault();
        var title = $(this).closest('.wrapper-item-carousel').find('h3').text();
        $('#specialOfferModal .modal-title').text('Special Offer');
        $('#specialOfferModal .modal-body').html($('input[type="hidden"][data-index="' + $(this).attr('data-index') + '"]').val()).prepend('<h3>' + title + '</h3>').append('<br> ' + $(this).closest('.wrapper-item-carousel').find('a.button-link').prop('outerHTML'));
        $('#specialOfferModal a.button-link').addClass('button-more');
        $('#specialOfferModal').modal('show');
        return false;
      });

      $('li.menu-item-has-children>a, #user-menu').click(function(e) {
        e.preventDefault();
        var parent = $(this).parent();
        if (parent.hasClass('clicked')) {
          parent.removeClass('clicked');
          parent.find('ul.sub-menu').removeClass('showed');
          //window.open($(this).attr('href'));
return true;
        } else {
          $('li.menu-item-has-children.clicked').removeClass('clicked');
          $('ul.sub-menu.showed').removeClass('showed');
          $('body').prepend('<div class="sub-menu-overlay"></div>');
          parent.addClass('clicked');
          parent.find('ul.sub-menu').addClass('showed');
return false;
        }
      });
      $(document).delegate('.sub-menu-overlay', 'click', function() {
        $(this).remove();
        $('li.menu-item-has-children.clicked').removeClass('clicked');
        $('ul.sub-menu.showed').removeClass('showed');
      });

      $('a#button-book-now').click(function(e) {
        e.preventDefault();
        $('#bookingModal').modal('show');
      });
      $('a.tab-link.navigation-link').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('href');
        $(this).closest('.homepage-restaurant-layout').find('a.tab-link.navigation-link.active').removeClass('active');
        $(this).closest('.homepage-restaurant-layout').find('.tab-item.active').hide().removeClass('active');
        $(id).fadeIn(300).addClass('active');
        $(this).addClass('active');
        return false;
      });
      // $('button.button-booking').click(function(e) {
      //   e.preventDefault();
      //   window.open('http://www.ize-seminyak.com/booking', '_blank');
      //   return false;
      // });
      // $(document).delegate('#specialOfferModal a.button-link', 'click', function(e) {
      //   e.preventDefault();
      //   window.open('http://www.ize-seminyak.com/booking', '_blank');
      //   return false;
      // });
      // $(document).delegate('a.button-link', 'click', function(e) {
      //   e.preventDefault();
      //   window.open('http://www.ize-seminyak.com/booking', '_blank');
      //   return false;
      // });
      // $('#specialoffer a[href*="#"]:not(.open-modal-special-offer):not(.open-modal-special-offer-1)').click(function(e) {
      //   e.preventDefault();
      //   window.open( 'http://www.ize-seminyak.com/booking' , '_blank');
      //   return false;
      // });
      $('button#button-language').click(function(e) {
        e.preventDefault();
        var target = $(this).closest('.language-selector').find('#ize-language');
        if (target.hasClass('active')) {
          $(this).removeClass('active');
          target.fadeOut().removeClass('active');
        } else {
          $(this).addClass('active');
          target.fadeIn().addClass('active');
        }
      });
      $('a.so-nav').click(function(e) {
        e.preventDefault();
        var target = $(this).attr('data-target');
        if (target == 'all') {
          $('.special-offer-loop').fadeIn().removeClass('hide');
          $('a.so-nav.active').removeClass('active');
          $(this).addClass('active');
        } else {
          $('a.so-nav.active').removeClass('active');
          $(this).addClass('active');
          $('.special-offer-loop').fadeOut().addClass('hide');
          $('.special-offer-loop[data-target="' + target + '"]').fadeIn().removeClass('hide');
        }
        return false;
      });
      $('a.load-more-image').click(function(e) {
        e.preventDefault();
        izeScript.gallery().ajaxloadmore();
        return;
      });

      $('.room-content-wrapper select.room-select').on('change', function() {
        var target = $(this).val();
        if (target == 'all') {
          $('.room-content-wrapper .room-loop-wrapper').fadeIn().removeClass('hide');
          $('a.so-nav.active').removeClass('active');
          $(this).addClass('active');
        } else {
          $('a.so-nav.active').removeClass('active');
          $(this).addClass('active');
          $('.room-content-wrapper .room-loop-wrapper').fadeOut().addClass('hide');
          $('.room-content-wrapper .room-loop-wrapper[data-category*="' + target + '"]').fadeIn().removeClass('hide');
        }
      });
      $('.gallery-wrapper select.room-select').on('change', function() {
        izeScript.gallery().ajaxchangeselect();
      });
      $('.home .mobile-menu-wrapper li>a[href*="#"]').click(function(e) {
        e.preventDefault();
        var ww = $(window).width();
        var target = $(this).attr('href');
        if ($(window).width() <= 1100) {
          if ($('.header-menu-mobile .mobile-menu-wrapper').hasClass('active')) {
            $('.header-menu-mobile .mobile-menu-wrapper').height(0).removeClass('active');
            $('.header-menu-mobile button#toggle-menu').removeClass('active');
            $('.home #headerMenu .menu-wrapper a[href*="#"]').removeClass('active')
            $(this).addClass('active');
            $('html, body').animate({
              scrollTop: $(target).offset().top
            }, 1000);
          }
        }
      });
      $('.home #headerMenu .menu-wrapper a[href*="#"]').click(function(e) {
        e.preventDefault();
        var ww = $(window).width();
        var target = $(this).attr('href');
        if ($(window).width() <= 1100) {
          if ($('.header-menu-mobile .mobile-menu-wrapper').hasClass('active')) {
            $('.header-menu-mobile .mobile-menu-wrapper').height(0).removeClass('active');
            $('.header-menu-mobile button#toggle-menu').removeClass('active');
            $('.home #headerMenu .menu-wrapper a[href*="#"]').removeClass('active')
            $(this).addClass('active');
            $('html, body').animate({
              scrollTop: $(target).offset().top
            }, 1000);
          }
        } else {
          $('.home #headerMenu .menu-wrapper a[href*="#"]').removeClass('active');
          var target = $(this).attr('href');
          $(this).addClass('active');
          $('html, body').animate({
            scrollTop: $(target).offset().top
          }, 1000);
        }

      });
    },
    scrollToTop() {
      $('.arrow-top').on('click', function(e){
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 350);
      });
    },
    menuactive: function() {
      if ($('body').hasClass('home')) {
        var temparray = {};
        $('.home #headerMenu .menu-wrapper a[href*="#"]').each(function() {
          temparray[$(this).attr('href')] = $($(this).attr('href')).offset().top;
        });
        $.each(temparray, function(index, value) {
          $(window).scroll(function() {
            if ($(window).scrollTop() >= (value - 100) && $(window).scrollTop() <= ((value - 100) + $(index).outerHeight(true))) {
              $('.home #headerMenu .menu-wrapper a[href="' + index + '"]').addClass('active');
            } else {
              $('.home #headerMenu .menu-wrapper a[href="' + index + '"]').removeClass('active');
            }
          });
        });
      }

    },
    smoothScroll: function () {
            $('a[href*="#"]')
                .not('[href="#"]')
                .not('[href="#0"]')
                .click(function (event) {
                    if (
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                        &&
                        location.hostname == this.hostname
                    ) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: target.offset().top - 50
                            }, 500, function () {

                            });
                        }
                    }
                });
        },
    gallery: function() {
      var __f = {
        init: function() {
          if ($('#gallery-ajax-offset').length > 0) {
            var countitemgallery = 0;
            $('#gallery-grid').find('a.ms-item').each(function() {
              countitemgallery++;
            });
            $('#gallery-ajax-offset').val(countitemgallery);
          }
        },
        lightbox: function() {

          if ($('#room-gallery').length > 0) {
            $('#room-gallery').click(function(event) {
              event = event || window.event;
              var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {
                  index: link,
                  event: event,
                  onslide: function(index, slide) {
                    var text = this.list[index].getAttribute('data-description'),
                      node = this.container.find('.description');
                    node.empty();
                    if (text) {
                      node[0].appendChild(document.createTextNode(text));
                    }
                  }
                },
                links = $(this).find('a');
              blueimp.Gallery(links, options);
            });
            // document.getElementById('room-gallery').onclick = function() {
            //   event = event || window.event;
            //   var target = event.target || event.srcElement,
            //     link = target.src ? target.parentNode : target,
            //     options = {
            //       index: link,
            //       event: event
            //     },
            //     links = this.getElementsByTagName('a');
            //   blueimp.Gallery(links, options);
            // };
          }
          if ($('#gallery-grid').length > 0) {
            if (!$('body').hasClass('home')) {
              var param = getParameterByName('galery');
              if (param !== '' && param !== null) {
                console.log(param);
                izeScript.gallery().ajaxchangeinit(param);
              }
            }

            $('#gallery-grid').click(function(event) {
              event = event || window.event;
              if ($(event.target).hasClass('last-item') || $(event.target).hasClass('explore-more')) {
                return;
              } else {
                var target = event.target || event.srcElement,
                  link = target.src ? target.parentNode : target,
                  options = {
                    index: link,
                    event: event,
                    onslide: function(index, slide) {
                      var text = this.list[index].getAttribute('data-description'),
                        node = this.container.find('.description');
                      node.empty();
                      if (text) {
                        node[0].appendChild(document.createTextNode(text));
                      }
                    }
                  },
                  links = $(this).find('a:not(.explore-more)');
                blueimp.Gallery(links, options);
              }
            });
            // document.getElementById('gallery-grid').onclick = function() {
            //   event = event || window.event;
            //   if ($(event.target).hasClass('last-item') || $(event.target).hasClass('explore-more')) {
            //     return;
            //   } else {
            //     var target = event.target || event.srcElement,
            //       link = target.src ? target.parentNode : target,
            //       options = {
            //         index: link,
            //         event: event
            //       },
            //       links = this.getElementsByTagName('a');
            //     blueimp.Gallery(links, options);
            //   }
            // };
          }

          // Update
          $('a.floorplan').click(function(event){document.getElementById('myModal').style.display = "block"; });
          $('span.close').click(function(event){ document.getElementById('myModal').style.display = "none"; });

          
        },
        ajaxloadmore: function() {
          $.ajax({
            url: ize_ajax.ajax_url,
            type: 'post',
            data: {
              action: 'show_gallery_ajax',
              data: {
                offset: $('#gallery-ajax-offset').val(),
                type: $('.gallery-wrapper select.room-select').val()
              },
            },
            success: function(response) {
              if(response == ''){
                    $('a.load-more-image').addClass('hidden');
                }else{
                    $('#gallery-grid').append(response);
                  izeScript.masonry().gallerygrid().reloadItems();
                  izeScript.gallery().init();
                }
            }
          });
        },
        ajaxchangeselect: function() {
          $.ajax({
            url: ize_ajax.ajax_url,
            type: 'post',
            data: {
              action: 'show_gallery_ajax',
              data: {
                offset: 0,
                type: $('.gallery-wrapper select.room-select').val()
              },
            },
            success: function(response) {
              $('#gallery-grid').find('.ms-item').remove();
              $('#gallery-grid').append(response);
              izeScript.masonry().gallerygrid().reloadItems();
              izeScript.gallery().init();
            }
          });
        },
        ajaxchangeinit: function(cat) {
          $.ajax({
            url: ize_ajax.ajax_url,
            type: 'post',
            data: {
              action: 'show_gallery_ajax',
              data: {
                offset: 0,
                type: cat
              },
            },
            success: function(response) {
              $('#gallery-grid').find('.ms-item').remove();
              $('#gallery-grid').append(response);
              $('.gallery-wrapper select.room-select').val(cat);
              izeScript.masonry().gallerygrid().reloadItems();
              izeScript.gallery().init();
            }
          });
        }
      };
      return __f;
    },
    masonry: function() {
      var __f = {
        gallerygrid: function() {
          if ($('#gallery-grid').length > 0) {
            var masonry = new Masonry('#gallery-grid', {
              itemSelector: '.ms-item',
              columnWidth: '.ms-sizer',
              percentPosition: true
            });
            return masonry;
          }
          return;
        },
      };
      return __f;
    },
    wowjs: function() {
      new WOW().init();
    },
    oc: {},
    mapsValue: {
      maps: {},
      marker: [],
      markermaster: [],
      bounds: new google.maps.LatLngBounds(),
      theme: [{
          elementType: 'geometry',
          stylers: [{
            color: '#f5f5f5'
          }]
        },
        {
          elementType: 'labels.icon',
          stylers: [{
            visibility: 'on'
          }]
        },
        {
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#616161'
          }]
        },
        {
          elementType: 'labels.text.stroke',
          stylers: [{
            color: '#f5f5f5'
          }]
        },
        {
          featureType: 'administrative.land_parcel',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#bdbdbd'
          }]
        },
        {
          featureType: 'poi',
          elementType: 'geometry',
          stylers: [{
            color: '#eeeeee'
          }]
        },
        {
          featureType: 'poi',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#757575'
          }]
        },
        {
          featureType: 'poi.park',
          elementType: 'geometry',
          stylers: [{
            color: '#e5e5e5'
          }]
        },
        {
          featureType: 'poi.park',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#9e9e9e'
          }]
        },
        {
          featureType: 'road',
          elementType: 'geometry',
          stylers: [{
            color: '#ffffff'
          }]
        },
        {
          featureType: 'road.arterial',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#757575'
          }]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry',
          stylers: [{
            color: '#dadada'
          }]
        },
        {
          featureType: 'road.highway',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#616161'
          }]
        },
        {
          featureType: 'road.local',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#9e9e9e'
          }]
        },
        {
          featureType: 'transit.line',
          elementType: 'geometry',
          stylers: [{
            color: '#e5e5e5'
          }]
        },
        {
          featureType: 'transit.station',
          elementType: 'geometry',
          stylers: [{
            color: '#eeeeee'
          }]
        },
        {
          featureType: 'water',
          elementType: 'geometry',
          stylers: [{
            color: '#c9c9c9'
          }]
        },
        {
          featureType: 'water',
          elementType: 'labels.text.fill',
          stylers: [{
            color: '#9e9e9e'
          }]
        }
      ],
    },
    mapFunction: {
      initMap: function() {
        $('.run-map-custom').each(function() {
          var id = $(this).attr('id').replace('map-', ''),
            masterdata = JSON.parse($('#config-1-' + id).val()),
            masterloc = {
              lat: parseFloat(masterdata.location[0]),
              lng: parseFloat(masterdata.location[1])
            };
          console.log(masterdata);
          izeScript.mapsValue.maps['map-' + id] = new google.maps.Map(document.getElementById('map-' + id), {
            center: masterloc,
            zoom: 17,
            styles: izeScript.mapsValue.theme
          });
          izeScript.mapFunction.createMarkerMaster(id, masterloc, izeScript.mapsValue.maps['map-' + id]);
          izeScript.mapFunction.createNewMarker(id, izeScript.mapsValue.maps['map-' + id], 'all');
          izeScript.mapFunction.fitbounds(izeScript.mapsValue.maps['map-' + id]);

          izeScript.mapFunction.selecOnChange(id, izeScript.mapsValue.maps['map-' + id]);
          izeScript.mapFunction.listOnClick(id);
        });
      },
      selecOnChange: function(id, maps) {
        $('#loc-' + id + ' select[name="location-select"]').change(function() {
          var category = $(this).val();
          izeScript.mapFunction.deleteAllMarker();
          izeScript.mapFunction.createNewMarker(id, maps, category);
          if (category !== 'all') {
            $('ol#list-' + id + ' li').hide();
            $('ol#list-' + id + ' li[data-category*="' + category + '"]').show();
          } else {
            $('ol#list-' + id + ' li').show();
          }
        });
      },
      listOnClick: function(id) {
        $('ol#list-' + id + ' li').on('click', function() {
          izeScript.mapFunction.closeAllInfoWindow();
          izeScript.mapFunction.showInfoWindow($(this).attr('data-id'));
        });
      },
      fitbounds: function(maps) {
        maps.fitBounds(izeScript.mapsValue.bounds);
      },
      clearAllMarker: function() {
        $.each(izeScript.mapsValue.marker, function(index, value) {
          value.marker.setVisible(false);
        });
      },
      clearMarkerById: function(id) {
        izeScript.mapsValue.marker[id].marker.setVisible(false);
      },
      showAllMarker: function() {
        $.each(izeScript.mapsValue.marker, function(index, value) {
          if (value.marker) {
            value.marker.setVisible(true);
          }
        });
      },
      showMarkerById: function(id) {
        izeScript.mapsValue.marker[id].marker.setVisible(true);
      },
      showInfoWindow: function(id) {
        google.maps.event.trigger(izeScript.mapsValue.marker[id].marker, 'click');
      },
      closeInfoWindow: function(id) {
        izeScript.mapsValue.marker[id].infowindow.close();
      },
      closeAllInfoWindow: function() {
        $.each(izeScript.mapsValue.marker, function(index, value) {
          value.infowindow.close();
        });
      },
      deleteMarkerById: function(id) {
        izeScript.mapsValue.marker[id].marker.setMap(null);
        izeScript.mapsValue.marker[id] = [];
      },
      deleteAllMarker: function() {
        if (izeScript.mapsValue.marker.length > 0) {
          console.log(izeScript.mapsValue.marker);
          $.each(izeScript.mapsValue.marker, function(index, value) {
            value.marker.setMap(null);
          });
        }
      },
      createMarkerMaster: function(id, location, maps) {
        var masterdata = JSON.parse($('#config-1-' + id).val());
        var image = {
          url: masterdata.icon,
        };
        var contentString = '<div id="content">' +
          '<div id="siteNotice">' +
          '</div>' +
          '<h3 id="firstHeading" class="firstHeading">' + masterdata.place_name + '</h3>' +
          '<div id="bodyContent">' +
          '<p>' + masterdata.description + '</p>' +
          ((masterdata.dirlink !== '') ? '<a href="' + unescape(masterdata.dirlink) + '" target="_blank">Get Direction</a>' : '') +
          '</div>' +
          '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        var marker = new google.maps.Marker({
          animation: google.maps.Animation.DROP,
          position: location,
          map: maps,
          icon: image
        });
        marker.addListener('click', function() {
          infowindow.open(maps, marker);
        });
        izeScript.mapsValue.bounds.extend(location);
      },
      createNewMarker: function(id, maps, type) {
        var count = 1;
        datas = JSON.parse($('#config-' + id).val());
        $.each(datas, function(index, value) {
          if (type !== 'all' && type == value.category[0]) {

            var loc = {
              lat: parseFloat(value.location[0]),
              lng: parseFloat(value.location[1])
            };
            var image = {
              url: 'https://www.thesantai.com/wp-content/uploads/2017/10/ize-discover-pin.png',
            };
            var contentString = '<div id="content">' +
              '<div id="siteNotice">' +
              '</div>' +
              '<h3 id="firstHeading" class="firstHeading">' + value.place_name + '</h3>' +
              '<div id="bodyContent">' +
              value.description +
              ((value.dirlink !== '') ? '<a href="' + unescape(value.dirlink) + '" target="_blank">Get Direction</a>' : '') +
              '</div>' +
              '</div>';

            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
            var marker = new google.maps.Marker({
              animation: google.maps.Animation.DROP,
              position: loc,
              label: {
                text: count.toString(),
                color: "white"
              },
              map: maps,
              icon: image
            });
            var tempdata = {
              category: value.category,
              marker: marker,
              infowindow: infowindow
            };
            izeScript.mapsValue.marker[index] = tempdata;
            marker.addListener('click', function() {
              izeScript.mapFunction.closeAllInfoWindow();
              infowindow.open(maps, marker);
            });
            count++;
            izeScript.mapsValue.bounds.extend(loc);
          } else if (type == 'all') {
            var loc = {
              lat: parseFloat(value.location[0]),
              lng: parseFloat(value.location[1])
            };
            var image = {
              url: 'https://www.thesantai.com/wp-content/uploads/2017/10/ize-discover-pin.png',
            };
            var contentString = '<div id="content">' +
              '<div id="siteNotice">' +
              '</div>' +
              '<h3 id="firstHeading" class="firstHeading">' + value.place_name + '</h3>' +
              '<div id="bodyContent">' +
              value.description +
              ((value.dirlink !== '') ? '<a href="' + unescape(value.dirlink) + '" target="_blank">Get Direction</a>' : '') +
              '</div>' +
              '</div>';

            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
            var marker = new google.maps.Marker({
              animation: google.maps.Animation.DROP,
              position: loc,
              label: {
                text: count.toString(),
                color: "white"
              },
              map: maps,
              icon: image
            });
            var tempdata = {
              category: value.category,
              marker: marker,
              infowindow: infowindow
            };
            izeScript.mapsValue.marker[index] = tempdata;
            marker.addListener('click', function() {
              izeScript.mapFunction.closeAllInfoWindow();
              infowindow.open(maps, marker);
            });
            count++;
            izeScript.mapsValue.bounds.extend(loc);
          } else {
            return;
          }
        });
      },
      setMapOnAll: function(map) {
        $.each(izeScript.mapsValue.marker, function(index, value) {
          value.marker.setMap(map);
        });
      }
    }
  };
})(jQuery);
