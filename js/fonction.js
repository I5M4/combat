
document.addEventListener("DOMContentLoaded", function () {
    
    
   setInterval(verifJeu, 500);
   setInterval(verifJeu, 3000, "restaureAgil", "personnage");
    
})

function affichePerso(action, classe ){

    let url = "routeur.php?action="+action+"&class="+classe
    $.ajax(url,{
        method: "GET",
        success: finaliseAffichePers,
        error: function() {console.error( "erreur de communication")},
        complete:afficheHistorique("affiche_historique", "evenement"),
    })
    
}

function afficheHistorique(action, classe){

    let url = "routeur.php?action="+action+"&class="+classe

    $.ajax(url,{
        method: "GET",
        success: finaliseAfficheHist,
        error: function() {console.error( "erreur de communication")},
        
    })
}

function finaliseAffichePers(donnees){

    $("#arrive").remove();
    $("#affichage-form").remove();
    $(".personnage").empty();
    $(".personnage").prepend(donnees);
}
function finaliseAfficheHist(donnees){

    $("#arrive").remove();
    $(".historique").empty();
    $(".historique").prepend(donnees);
    
}

function execute(action, classe ,autreParam){
    //rôle: appeler le programme 
    //paramêtre 
    //          : $action, l'action qu'on appel
    //          : $class, l'objet sur lequel on fait l'action
    //          : autrePram, pour passer d'autres parametres au besoin
    //if(action == "attaque" && classe == "personnage" && autreParam == undefined){clearInterval();}
   
    if(autreParam == undefined){ autreParam="";}else{autreParam = "&"+autreParam}

    let url = "routeur.php?action="+action+"&class="+classe+autreParam;

    $.ajax(url,{
        method: "GET",
        success: affiche_resultat,
        error: function() {console.error( "erreur de communication")},
        
    })
}


function verifJeu(action, classe){
    //role: verifier si la div jeu est presente si c'est le cas lancer le set interval
    //param: néant
    //retour: néant
    if($("#affichage-form").length < 1){

        if(action == "restaureAgil"){;
        
            execute(action,classe);

        }else{
            affichePerso("affiche_perso", "personnage");
        }
    }
   
}




function envoieFormPerso(action, classe, form ){
    //role: envoie les données du formulaire de creation de perso
      //paramêtre 
    //          : $action, l'action qu'on appel
    //          : $class, l'objet sur lequel on fait l'action
    $(".form_creation").submit( function(e) {
        e.preventDefault();
    });
    let url = "routeur.php?action="+action+"&class="+classe;

    let formdata = $("."+form).serialize();

    $.ajax(url,{
        method: "POST",
        data: formdata,
        success: affiche_resultat,
        error: function() {console.error( "erreur de communication")},
        complete: affichePerso("affiche_perso", "personnage"),
        async : false,
    })
    location.reload();
    
}
function affiche_resultat(donnees){
    //rôle: traite les données a afficher 
    //retour : néant
    // parametre: donnees, les donnees reçu par le serveur
    $("#arrive").remove();
    $(".form_connexion").remove();
    $("#affichage-form").prepend(donnees);
    
}
 


function verifPointCreationPerson(){
    //role : verifie les points de stat donner au perso
    //param : néant
    //retour : néant
    
    if ($(".form_creation").length > 0){

        if($("[name='force']").val() == ""){$("[name='force']").val(0)}
        if($("[name='resistance']").val() == ""){$("[name='resistance']").val(0)}
        if($("[name='agilite']").val() == ""){$("[name='agilite']").val(0)}

        var statAloue = parseFloat($("[name='force']").val())+parseFloat($("[name='resistance']").val())+parseFloat($("[name='agilite']").val());
    
        let statRest = 15 - statAloue;
        $(".pointStat").html(parseFloat(statRest)); 
    }
    if($(".pointStat").html() > 0){

        $("[name='force']").attr("max", 10)
        $("[name='resistance']").attr("max",10)
        $("[name='agilite']").attr("max", 10)
    }
    if($(".pointStat").html() <= 0){

        $("[name='force']").attr("max",$("[name='force']").val())  ;
        $("[name='resistance']").attr("max",$("[name='resistance']").val()) ;
        $("[name='agilite']").attr("max",$("[name='agilite']").val()) ;
       
    }

    if(statAloue > 15){

        $("#creer-perso").attr("onclick" , "");
        $("#creer-perso").css("opacity" , "50%");

    }if(statAloue <= 15){
       
        $("#creer-perso").attr("onclick" , "envoieFormPerso('creer_perso', 'personnage','form_creation')");
        $("#creer-perso").css("opacity" , "100%");
    }  
    
}





