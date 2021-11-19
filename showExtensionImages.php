<!DOCTYPE html>
<html>
    <body>
    <?php
        include_once 'mtg_collection_functions.php';
        
        $codeExt = $_GET["codeExtension"];
        $sqlSelect = "SELECT nom, type, urlImage FROM cartes WHERE codeExtension = '{$codeExt}'";
        $collection = executeSQLSelect($sqlSelect);
        showImagesFromCollection($collection); # Affiche toutes les images en fonction de l'extension passée en paramètres
    ?>
    </body>
</html>