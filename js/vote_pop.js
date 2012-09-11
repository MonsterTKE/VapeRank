(function ($) {
 
  $.fn.voteModal = function(element, name, id, voteSelector, direction)
  {
  	var $this = $(this);
  	var vote_url = "/dynamic/vote";
  	var comment_url = "/dynamic/comment"

  	$(element).on("click", function() {
      $("#chars-left").hide();
      $('#progress_bar').hide();
      $('#modal_form').hide();
      $('#mod_alert').hide();

      $.ajaxSetup ({  
        cache: false  
      });
      var to_server = "juice_id=" + id + "&vote_direction=votes_" + direction;
      $.ajax({  
        type: "POST",  
        url: vote_url,
        timeout: 1000,  
        data: to_server,
        dataType: 'json',
        beforeSend: function() { $('#voteModal').modal('show'); $('#progress_bar').fadeIn('slow'); },
        complete: function() { $('#progress_bar').fadeOut('fast'); },
        error: function() {var output = "sorry we broke something"; $('#modalH3').text(output); $('#mod_alert').addClass("alert-error"); $('#mod_alert').fadeIn('fast');
        $('#voteModal').on('hidden', function () 
        {
         $('#modalH3').text('You just voted for  ');
         $('#mod_alert').removeClass("alert-success");
        });
      },
      success: function(phpReturn)
      { 
       if (phpReturn["username"])
       {
        
        if(!phpReturn["has_voted"])
        {
         
         var output = 'You just voted for "' + name + '", ' + phpReturn["username"] + '.';
         $('#modalH3').text(output);
         $('#mod_alert').addClass("alert-success");
         $('#progress_bar').fadeOut('fast', function() {$('#mod_alert').fadeIn('fast'); $('#modal_form').show('slide', 'slow', function() 
          {$("textarea#f_textarea").focus(); $("#chars-left").fadeIn('fast');});});
         
         $("#f_submit").bind("click", function()
         {
          var comment = $("textarea#f_textarea").val(); 
          if(comment == '' || comment == null)
          {
            $('#modalH3').text('This field cannot be blank, try again?');
            $('#mod_alert').removeClass("alert-success").addClass("alert-error").fadeIn('slow');
            return(false);
          }
          else
          {
            comment = "comment=" +comment + "&juice_id=" + id;
            $.ajax({  
              type: "POST",  
              url: comment_url,
              timeout: 1000,  
              data: comment,
              dataType: 'json',
              complete: function() { $('#modal_form').fadeOut('slow'); },
              error: function() {var output = "sorry we broke something"; $('#modalH3').text(output); $('#mod_alert').addClass("alert-error"); $('#mod_alert').fadeIn('fast');
              $('#voteModal').on('hidden', function () 
              {
               $('#modalH3').text('You just voted for  ');
               $('#mod_alert').removeClass("alert-success");
               voteSelector = null;
               id = null;
               name = null;
             });
            },
            success: function(commentReturn)
            {
             console.debug(commentReturn);
             if(commentReturn)
             {
              var output = "Thanks for the comment!"; 
              $('#modalH3').text(output); 
              $('#mod_alert').addClass("alert-info"); 
              $('#mod_alert').fadeIn('fast');
              $("#chars-left").fadeOut('fast');
              //$('#voteModal').delay(4000, function() {$(this).modal('hide'); $("#chars-left").fadeOut('fast');});
             }
             else
             {
              var output = "Sorry something went wrong."; $('#modalH3').text(output); $('#mod_alert').addClass("alert-error"); $('#mod_alert').fadeIn('fast');
             };
                $('#voteModal').on('hidden', function () 
                {
                  $('#modalH3').text('You just voted for  ');
                  $('#mod_alert').removeClass("alert-error");
                  $('#mod_alert').removeClass("alert-info");
                  $("#chars-left").fadeOut('fast');
                  commentReturn = null;
                });
           }
          });
          };
          console.debug(comment);
          $("#f_submit").unbind("click");
          return(false);
        });


$('#voteModal').on('hidden', function () 
{
  $('#modalH3').text('You just voted for  ');
  $(voteSelector).fadeOut(1000, function() {$(this).html(phpReturn["new_votes"]).fadeIn(1000);});
  $('#mod_alert').removeClass("alert-success");
  $(element).off("click");
  $("textarea#f_textarea").val('');


});
}
else
{
 console.debug("user already voted");
 var output = 'Sorry. You already voted for "' + name + '", ' + phpReturn["username"] + '.';
 $('#modalH3').text(output);
 $('#mod_alert').addClass("alert-error");
 $('#progress_bar').fadeOut('fast', function() {$('#mod_alert').fadeIn('fast');}); 
 $('#voteModal').on('hidden', function () 
 {
  $('#modalH3').text('You just voted for  ');
  $('#mod_alert').removeClass("alert-error");
  $(element).off("click");
});
};
}
else
{
  console.debug("user is not logged in");
  var output = 'Sorry you need to be logged in to do that';
  $('#modalH3').text(output);
  $('#mod_alert').addClass("alert-info");
  $('#progress_bar').fadeOut('fast', function() {$('#mod_alert').fadeIn('fast');}); 
  $("#voteModalBody").load("/auth/login #login_wrapper");   		
  $('#voteModal').on('hidden', function () 
  {
    $('#modalH3').text('You just voted for  ');
    $('#mod_alert').removeClass("alert-info");
    $(element).off("click");
  });   		
};
}
});
});
console.debug("loaded voteModal on id " + element);
};

$.fn.loginModal = function(element, modalBody)
{

 var $this = $(this);
 $(element).on("click", function() {
  $("#loginModal").modal('show');
  $(modalBody).load("/auth/login #login_wrapper");
});
 console.debug("loaded loginModal on id " + element);
 console.debug("loginModal ready to load content in " + modalBody);
};

$.fn.textAreaLimit = function( limit, element ) {
  return this.each( function () {
    var $this = $(this);
    var displayCharactersLeft = function(charactersLeft) {
      if( element ) {
        $(element).html( (charactersLeft <= 0) ? '0' : charactersLeft );
      }
    };

    $this.bind('focus keypress blur click', function() {
      var val = $this.val();
      var length = val.length;
      if(length > limit) {
        $this.val( $this.val().substring(0, limit) );
      }
      displayCharactersLeft( limit-length );
    });

    displayCharactersLeft( limit-$this.val().length );
  });
};
})(jQuery);