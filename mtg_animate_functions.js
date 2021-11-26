const ARRAY_BITMAPS = [];
const SCRYFALL_URL = "https://api.scryfall.com/cards/";
var stageCollection;

// Initialise le canvas HTML
// IMPORTANT : copier <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script> avant d'importer ce script
function init() 
{
    stageCollection = new createjs.Stage("canvasCollection"); // ID du canvas HTML en paramètres
    var circle = new createjs.Shape();
    var circleCommand = circle.graphics.beginFill("red").command;

    circle.graphics.drawCircle(0, 0, 50);
    circle.x = 900;
    circle.y = 100;

    stageCollection.addChild(circle); // On ajoute notre cercle à notre canvas
    stageCollection.update();

    circle.on("click", function() {
        getAndDrawCollection(stageCollection);  
        stageCollection.update();
        circleCommand.style = "green"; // On actualise la couleur du bouton         
        createjs.Ticker.on("tick", tick); // Définit la fonction de rafraichissement temps réel
        createjs.Ticker.setFPS(30);	
    });	
}

// Fonction qui actualise l'interface en temps réel
function tick(event) 
{
    var randomX, randomY; 
    ARRAY_BITMAPS.forEach(image => {
        randomX = Math.random() * 25;
        randomY = Math.random() * 20;
        image.x += randomX;
        image.y += randomY;

        if (image.x > stageCollection.canvas.width) {
            image.x = 0;
        }
        if (image.y > stageCollection.canvas.height) {
            image.y = 0;
        }
    });
    stageCollection.update(event); 
}

// Récupères la liste des URLs d'images via AJAX et créer de nouvelles images avant de les ajouter à la scène
function getAndDrawCollection(stage) 
{
    var xhttp = new XMLHttpRequest();   
    xhttp.onreadystatechange = function() { //Fonction qui est appellée dès que le serveur renvoie une réponse
        if (this.readyState == 4 && this.status == 200) // Code de réponse HTTP 200 OK
        { 
            var urlImagesString = this.responseText; // On reçoit le résultat des "echo" du fichier PHP                        
            var arrayUrls = urlImagesString.split("/");
            var xCoord = 0;
            arrayUrls.forEach(urlImage => {
                if (urlImage != null && urlImage != "") 
                {
                    console.log(SCRYFALL_URL + urlImage + "?format=image");
                    let image = new createjs.Bitmap(SCRYFALL_URL + urlImage + "?format=image");          
                    image.x = xCoord;
                    image.y = xCoord;
                    image.scale = 0.3; // Mise à l'échelle 30% de la taille d'origine  
                    xCoord += 100;

                    ARRAY_BITMAPS.push(image); // Sauvegarde de la référence de l'image
                    stage.addChild(image); // Ajoute l'image à la scène
                }
            });
            return arrayUrls;
        }
    };  
    xhttp.open("GET", "getImagesUrlFromExtension.php", true); //AJAX OP
    xhttp.send();
}