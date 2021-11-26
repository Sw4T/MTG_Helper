<?php
    include_once 'mtg_collection_functions.php';
    
    $sqlSelect = "SELECT nom, type, urlImage FROM cartes LIMIT 20";
    $collection = executeSQLSelect($sqlSelect);
    foreach  ($collection as $row)
    {
        $urlImage = $row['urlImage'];
        echo $urlImage . '/';
    }
?>
