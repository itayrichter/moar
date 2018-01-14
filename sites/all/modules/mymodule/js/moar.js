jQuery(document).ready(function ($) { 
    if($("body").hasClass("front")){
       $.each($("h2.title"),function(){
           var h2 = $(this);
           var txt = h2.text();
           h2.text('');
           h2.append($("<span></span>").text(txt));
       });
       $.each($(".views-field-created"),function(){
           var created = $(this);
           created.parent().find(".views-field-field-image a").append(created);
       });
       $.each($(".view-mt-events .view-event-wrapper .views-field-field-mt-event-date"),function(){
           var date = $(this);
           date.parent().find(".views-field-body").prepend(date);
       });
   }
   
});
