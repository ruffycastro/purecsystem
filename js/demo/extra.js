$(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
        });
$(document).on("click", "#open-payment", function () {
             var drId = $(this).data('id');
             $(".modal-body #drId").val( drId );
        });

$("#modepayment").change(function(){
           if($(this).val()=="check")
           {    
               $("div#check").show();
           }
            else
            {
                $("div#check").hide();
            }
            if($(this).val()=="online")
           {    
               $("div#online").show();
           }
            else
            {
                $("div#online").hide();
            }
        });