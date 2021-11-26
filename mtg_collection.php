<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="collection.css">
		<title>Ma Collection MTG</title>
        
        <!-- Fonctions JavaScript appellées ensuite par des éléments HTML de ce fichier -->
        <script>

            // Colorise la bordure des cartes en fonction de l'id de la checkbox en paramètre
            function setFilterSelection(checkbox) 
            {
                let checkboxId = checkbox.id;
                let filterCards = document.querySelectorAll(checkboxId);
                let colorFilter;

                if (checkbox.name == 'creature') {
                    colorFilter = '#D5D10F'; 
                } else if (checkbox.name == 'instant') {
                    colorFilter = '#3399FF'; 
                } else if (checkbox.name == 'sorcery') {
                    colorFilter = '#00CC00'; 
                } else if (checkbox.name == 'artifact') {
                    colorFilter = '#853966'; 
                }

                // On modifie l'attribut CSS de tout nos éléments en fonction de si la checkbox a été cochée ou décochée
                if (document.getElementById(checkboxId).checked == true) 
                {
                    filterCards.forEach(element => {
                        element.style.border = '5px solid ' + colorFilter;
                    });
                } 
                else {
                    filterCards.forEach(element => {
                        element.style.border = 'none';
                    });
                }   
            }

            // On utilise une pratique AJAX pour venir récupérer le contenu d'un fichier PHP qui est chargé d'afficher les
            // images en fonction de l'extension passée en paramètre
             function changeExtension(extensionId)
             {
                var xhttp = new XMLHttpRequest();   
                xhttp.onreadystatechange = function() { //Fonction qui est appellée dès que le serveur renvoie une réponse
                    if (this.readyState == 4 && this.status == 200) { // Code de réponse HTTP 200 OK
                        var imagesFromExtension = this.responseText; // On reçoit le résultat des "echo" du fichier PHP                        
                        document.getElementById("collection").innerHTML = imagesFromExtension; // On change le contenu de la div collection avec les nouvelles images
                        document.getElementById(".creature").checked = false;
                        document.getElementById(".instant").checked = false;
                        document.getElementById(".sorcery").checked = false;
                        document.getElementById(".artifact").checked = false;
                    }
                };  
                xhttp.open("GET", "showExtensionImages.php?codeExtension=" + extensionId, true); // On appelle le fichier showExtensionImages.php en GET avec le paramètre extensionId 
                xhttp.send();
             }

        </script> 
	</head>

	<body>
		<h1><u>Ma collection v2</u></h1>
        
        <!-- Dropdown list des extensions possédées dans la collection locale -->
        <div style="text-align: center;">
            <u>Extension sélectionée</u> : 
            <select name="extensionCode" onchange="changeExtension(this.value)">
                    <option value="defaut">Par défaut</option>
                    <?php
                        include_once 'mtg_collection_functions.php';
                        getSelectExtensionsList();
                    ?>
            </select>
        </div>
        <br>

        <!-- Filtres de sélection via checkbox -->
        <div class="filtres">
            <label for=".creature" style="color: #D5D10F;"><b>Filtre Créature :</b></label>
            <input type="checkbox" id=".creature" name="creature" onchange=setFilterSelection(this)>

            <label for=".instant" style="color: #3399FF;"><b>Filtre Ephémère :</b></label>
            <input type="checkbox" id=".instant" name="instant" onchange=setFilterSelection(this)>

            <label for=".sorcery" style="color: #00CC00;"><b>Filtre Rituel :</b></label>
            <input type="checkbox" id=".sorcery" name="sorcery" onchange=setFilterSelection(this)>

            <label for=".artifact" style="color: #853966;"><b>Filtre Artefact : </b></label>
            <input type="checkbox" id=".artifact" name="artifact" onchange=setFilterSelection(this)>
        </div>
        <br><br>
             
        <!-- div qui contient toutes les cartes affichées pour l'extension courante -->
        <div id="collection">
            <?php
                getMyCollection(250); # On récupère les 250 premières cartes de la collection (table cartes)
            ?>
        </div>      
	</body>
</html>