$(document).ready(function(){

  $("#join-family-btn").click(function(){
        $("#create-family-form").slideUp();
    $("#join-family-form").slideToggle();
  });
  $("#create-family-btn").click(function(){
    $("#create-family-form").slideToggle();
    $("#join-family-form").slideUp();
});


});
