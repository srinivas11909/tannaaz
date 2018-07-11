
$(function(){
     $('.flex_navbar li.flex_li').each(function(){
        $(this).find('.nav-title').on({
          mouseover: function(event) {
            event.preventDefault();
            var self = $(this).closest('.flex_li');
            $(self).addClass('active')
            $('.bgLayer').addClass('show');
            setTimeout(function(){
              var CategoryShow = $(self).find('.categeory_block');
              $(CategoryShow).addClass('show');
              $(CategoryShow).on({
                 mouseover: function(){
                   $(self).addClass('active')
                   $(this).addClass('show');
                 },
                 mouseout: function(){
                   $(self).removeClass('active');
                   $(this).removeClass('show');
                 }
              })
            }, 200);
          },
          mouseout: function(event){
            event.preventDefault();
            var self = $(this).closest('.flex_li');
            $(self).removeClass('active');
            $('.bgLayer').removeClass('show');
            setTimeout(function(){
              $(self).find('.categeory_block').removeClass('show');
            }, 200);
          }
        });
    });

    //contact page tabs

   // $('.about_title').each(function(){
   //   var self = $(this).find('a');
   //   $(self).on('click', function(e){
   //     e.preventDefault();
   //     if ($(self).closest('.about_title').hasClass('active')) {
   //       $(self).closest('.about_title').siblings().removeClass('active');
   //     }else {
   //         $(self).closest('.about_title').siblings().addClass('active')
   //     }
   //
   //   });
   // });

   $('.about_title > .sub_cat').on('click', function(e){
     e.preventDefault();
     $(this).closest('.about_title').toggleClass('active');
   });

   //mobile menu
   $('.ham').on('click', function(){
     $('.mobile_drop').toggleClass('active');
     $('.sub_li').removeClass('active');
     $('.child_ul').removeClass('ac');
   });

       $('.sub_li > a').on('click', function(e){
         e.stopPropagation();
         var self = $(this).closest('.sub_li');
         $(self).toggleClass('active');
         if ($(self).hasClass("active")) {
           $(self).find('.child_ul').addClass('ac');
           $(self).find('.inner_ul').addClass('ac');
         }else {
            $(self).find('.child_ul').removeClass('ac');
            $(self).find('.inner_ul').removeClass('ac');
         }
   });
});
