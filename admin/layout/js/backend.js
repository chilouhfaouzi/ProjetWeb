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
   $('input').each(function(){
     if($(this).attr('required') === 'required'){
      $(this).after('<span class="astresk">*<span>');
     }
   });
  
   
});//End window.ready();