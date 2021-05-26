$(document).ready(function() {

    $('.order').click(function(){

        $('#orderLine').html("")
        $('.order').css("background-color","#dcdcdc"  );
        var order = $(this).data("idorder");
        var baseUrl = $(this).data("url");     

        $(this).css("background-color","#FBC02D"  );

        if(order!=""){
       // POST to usersController
            $.post(baseUrl + 'users/orderline', {
                "order": order
              
            }, function(response)  {
       
                 let Arraytab = JSON.parse(response);
                
                 for ( tab in Arraytab){
                    var orderline = " - "+ Arraytab[tab] + "<br>";

                    $('#orderLine').append(orderline);
                 

                 }
            });

            // $.post( "ajax/test.html", function( data ) {
            //     $( ".result" ).html( data );
            //   });
        }
    })
});
