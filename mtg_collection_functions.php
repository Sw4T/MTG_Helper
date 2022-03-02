<?php

    // Retourne un tableau avec données de la base locale en fonction de la requête SQL exécuté
    function executeSQLSelect($sqlQuery)
    {
        // Connexion à la base de données locale avec mySQL et les identifiants utilisateurs configurés au préalable dans phpMyAdmin (onglet Utilisateurs)
        $mysql_user = 'root';
        $mysql_password = '';  
        $databaseName = 'mtg_helper';
        $results = null;
        try {
            $db = new PDO("mysql:host=localhost;dbname={$databaseName}", $mysql_user, $mysql_password); // Création de l'objet représentant la BDD, on passe les identifiants en paramètres
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définit le mode exception sur cette base de données (utilisation du bloc try/catch)
            $results = $db->query($sqlQuery);

        } catch (Exception $exception) {
            echo 'Erreur lors de la connexion à la base de données mtg_helper : ' . $exception->getMessage() . '<br>'; // On affiche l'erreur et on arrête l'exécution du code du script
            return null;
        }        
        return $results;
    }

    function showImagesFromCollection($collection) 
    {
        foreach  ($collection as $row)
        {
            $name = $row['nom'];
            $type = $row['type'];
            $urlImage = $row['urlImage'];

            // On configure la chaine de caractère qui sera l'attribut class de notre <img>
            if (strpos($type, "Creature") !== false) { // Est-ce que le type de la carte contient "Creature"
                $type = "creature"; // On simplifie pour éviter d'avoir des classes d'img "Creature - Dryad" (pour l'creature hehe)
            } else if (strpos($type, "Instant") !== false) {
                $type = "instant";
            } else if (strpos($type, "Artifact") !== false) {
                $type = "artifact";
            } else if (strpos($type, "Sorcery") !== false) {
                $type = "sorcery";
            }
            // Attention les yeux la ligne magique...
            echo "<img src=\"https://api.scryfall.com/cards/{$urlImage}?format=image\" class=\"{$type}\" id=\"{$name}\" alt=\"IMG\">";
        } 
    }

    // Code PHP pour afficher les images de la collection avec les bons attributs HTML pour ensuite utiliser les filtres
    function getMyCollection($nbLimitCard)
    {
       $sql = "SELECT nom, type, urlImage FROM cartes LIMIT {$nbLimitCard}";
       $collection = executeSQLSelect($sql);
       if ($collection == null) {
            echo "<b>Vous ne disposez d'aucune carte dans votre collection locale</b>";
       } else {
            showImagesFromCollection($collection);
       }
    }

    // Affiche le HTML nécessaire pour remplir une liste <select> avec les valeurs des codes extensions présents en base locale
    function getSelectExtensionsList()
    {
       $sql = "SELECT DISTINCT codeExtension FROM cartes";
       $results = executeSQLSelect($sql);
       foreach ($results as $codeExt) {
           $code = $codeExt['codeExtension'];
           echo "<option value=\"{$code}\">{$code}</option>";
       }
    }

?>
