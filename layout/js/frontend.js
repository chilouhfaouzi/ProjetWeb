/* global $  */
$(function() { 
   'use strict';
   //hide and show placeholder in focus and blur
   $('[placeholder]').focus(function(){
   $(this).attr('data-text',$(this).attr('placeholder'));  //assign to data-text the content of placeholder 
   $(this).attr('placeholder','');
   }).blur(function(){
      $(this).attr('placeholder',$(this).attr('data-text'));
   });

   //Add astrex on required Feilds
   $('input:not([type="checkbox"])').each(function(){
     if($(this).attr('required') === 'required'){
      $(this).after('<span class="astresk">*<span>');
     }
   });
   //Add ANd Remove selcted for Login
   $('.h-log span').click(function(){
      $(this).addClass('selected').siblings().removeClass('selected');
      $('.log form').hide();
      $('.' + $(this).data('class')).fadeIn(100);
  });       

  //Nice scroll
  $('html').niceScroll();
 $('body').niceScroll({
 cursorcolor:'#343a40', // Color Of the navbar
 cursorborder: "1px solid #343a40"        
         });
  
   
});//End window.ready();