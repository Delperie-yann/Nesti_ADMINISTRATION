
$(document).ready(function () {

    var base_url = "https://127.0.0.1/www/PHP_Nesti_Site/";
   //  var base_url = "https://delperie.needemand.com/realisations/PHP_Nesti_Site/"; 
    $('#ingAdd').click(function (e) {
        e.preventDefault();

        // Controle value of input product
        let name = $("#ingName").val();
        let error = 0;
        if (name == "" || !name.match(/^[a-zA-Z]+$/)) {
            error = 1;

            alert('Erreur de la saisi :  Produit ');
        }
        // Controle value of input qunantity
        let quant = $("#ingQty").val();
        if (quant == "" || !quant.match(/^\d+$/)) {
            error = 1;
            alert('Erreur de la saisi : quantité ');
        }
        // Controle value of input unit
        let unit = $("#ingUnit").val();
        if (unit == "" || !unit.match(/^[a-zA-Z]+$/)) {
            error = 1;
            alert('Erreur de la saisi : unité ');
        }
        if (error == 0) {
            let id_recipe = $('#ingAdd').data('id');
            $.post(base_url + "recipes/adding/" + id_recipe, { name: name, quant: quant, unit: unit }).done(function (data) {
                if (data.success == true) {
                    // create a ingredient line
                    $('#ingCtn').append(
                        '<li class="flex justify-between">'
                        + quant + " " + unit + " de " + name
                        + '   <a href="' + base_url + 'recipes/editing/' + data.recipe + '/supp/' + data.idProduct + '">Supprimer</a>'
                        + '</li>');
                } else {
                    alert("erreur ajout ingredient");
                }
            }, "json");
        }
    })

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

