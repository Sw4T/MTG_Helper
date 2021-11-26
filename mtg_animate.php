<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">  
        
        <!-- Dépendances de librairies JS utilisées dans le script JS -->
        <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>  
        
        <!-- Script JS qui va faire joujou avec le canvas -->
        <script src="mtg_animate_functions.js"></script>

        <link rel="stylesheet" href="collection.css">
		<title>Animations Cartes MTG</title>
    </head>    
     
<body onload="init();">
    <h1><u>Animations JavaScript MTG v1</u></h1>    
    <br>
    <canvas id="canvasCollection" width="1850" height="1000"> </canvas>
</body>