function send() {
    event.preventDefault();
    let donnes = {
        nom: $("#nom").val(),
        editeur: $("#editeur").val(),
        prix: $("#prix").val(),
        description: $("#description").val(),
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/api/jeux/add",
        data: donnes,
        dataType: "json"
    })
        .done(function (data) {
            affichage(data);
        })
        .fail(function (status) {
            if (status.status === 422) {
                let error = status.responseJSON.errors;
                console.log(error);
                console.log(donnes);

            }
        })
};

/**
 * 
 * @param {*} data les données
 */
function affichage(data) {
    $('#donnees').append(
        '<p id=jeu_' + data.id + '>' +
        'Titre : ' + data.nom +
        '. Éditeur : ' + data.editeur +
        '. Prix : ' + data.prix +
        ' €. description : ' + data.description + '. '
        + "<button onclick='suppression( " + data.id + " )'>Supprimer</button>"
        + "</p>"
    );
}

function getList() {
    $.ajax({
        method: "GET",
        url: "/api/jeux/all",
        dataType: "json"
    })
        .done(function (datas) { // fais apparaitre les element de la BDD
            $.each(datas, function (index, data) { // each -> fais apparaitre à la chaine
                affichage(data); // les données 
            });
        })
        .fail(function (status) {
            if (status.status === 422) {
                let error = status.responseJSON.errors;
                console.log(error);
                console.log(donnes);
            }
        })
}

getList();

function suppression(id) {
    event.preventDefault(); //empeche le raffranchissement
    console.log(id);

    $.ajax({
       method: "GET", // la methode utilise par le forumalaire
       url: "/api/jeux/del", //la cible du formulaire pour traitre
       data: { 
           id : id
       },
       dataType: "json" // le type de données qu'on envoi
     })
    .done(function(datas) {
        console.log(datas);
        // $("#jeu_"+data.id).fadeOut("slow"); //fais disparaitre les elements
    })
    .fail(function() {
       alert("erreur 404 - js");
    })
} 
