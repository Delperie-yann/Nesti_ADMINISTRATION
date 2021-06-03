
$(document).ready(function () {

    var base_url = "http://127.0.0.1/www/PHP_Nesti_Site/";
    // var base_url = "https://delperie.needemand.com/realisations/PHP_Nesti_Site/"; 
    $('#ingAdd').click(function (e) {
        e.preventDefault();
        let name = $("#ingName").val();
        let error = 0;
        if (name == "") {
            error = 1;
            alert('Erreur de la saisi :  Produit');
        }
        let quant = $("#ingQty").val();
        if (quant == "") {
            error = 1;
            alert('Erreur de la saisi : quantité' );
        }
        let unit = $("#ingUnit").val();
        if (unit == "") {
            error = 1;
            alert('Erreur de la saisi : unité ' );
        }
        if (error == 0) {
            let id_recipe = $('#ingAdd').data('id');

            // $.ajax({
            //     method: "POST",
            //     url: base_url + "recipes/adding/" + id_recipe,
            //     data:  { name: name, quant: quant, unit: unit }
            //   })
            //     .done(function( data ) {
            //       console.log( data.name );
            //       if (data.success == true) {
                 

            //         // on a besoin de l'id 

            //         $('#ingCtn').append(
            //             '<li class="flex justify-between">'
            //             + quant + " " + unit + " de " + name
            //             + '<a href="' + base_url + 'recipes/editing/' + data.recipe + '/supp/'+ data.idProduct +'">Supprimer</a>'
            //             + '</li>');


            //     }else {
            //         alert("erreur ajout ingredient");
            //     }
            //     });
       
            $.post(base_url + "recipes/adding/" + id_recipe, { name: name, quant: quant, unit: unit }).done(function (data) {
           
                if (data.success == true) {
                    $('#ingCtn').append(
                        '<li class="flex justify-between">'
                        + quant + " " + unit + " de " + name
                        + '   <a href="' + base_url + 'recipes/editing/' + data.recipe + '/supp/'+ data.idProduct +'">Supprimer</a>'
                        + '</li>');
                }else {
                    alert("erreur ajout ingredient");
                }
            }, "json");

           
        }

    }
    )

    $('.order').click(function () {

        $('#orderLine').html("")
        $('.order').css("background-color", "#dcdcdc");
        var order = $(this).data("idorder");
        var baseUrl = $(this).data("url");

        $(this).css("background-color", "#FBC02D");

        if (order != "") {
            // POST to usersController
            $.post(baseUrl + 'users/orderline', {
                "order": order

            }, function (response) {

                let Arraytab = JSON.parse(response);

                for (tab in Arraytab) {
                    var orderline = " - " + Arraytab[tab] + "<br>";

                    $('#orderLine').append(orderline);


                }
            });

        }
    })
});

