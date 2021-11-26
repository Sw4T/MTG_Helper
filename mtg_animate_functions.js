const ARRAY_BITMAPS = new Array();
const EXTENSION_ID_TEST = "AFR";
const SCRYFALL_URL = "https://api.scryfall.com/cards/";
const TICKER = null;
var stageCollection;

// Initialise le canvas HTML
// IMPORTANT : copier <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script> avant d'importer ce script
function init() 
{
    stageCollection = new createjs.Stage("canvasCollection");
    var circle = new createjs.Shape();
    var command = circle.graphics.beginFill("red").command;

    circle.graphics.drawCircle(0, 0, 50);
    circle.x = 900;
    circle.y = 100;

    stageCollection.addChild(circle);  
    stageCollection.update();

    circle.on("click", function() {
        getAndDrawCollection(stageCollection);  
        command.style = "green";      
        stageCollection.update();
        createjs.Ticker.on("tick", tick);
        createjs.Ticker.setFPS(30);	
    });	
}

function tick(event) {
    var randomCoord; 
    ARRAY_BITMAPS.forEach(image => {
        randomCoord = Math.random() * 25;
        image.x += randomCoord;
        image.y += randomCoord;
        if (image.x > stageCollection.canvas.width) {
            image.x = 0;
        }
        if (image.y > stageCollection.canvas.height) {
            image.y = 0;
        }
    });
    stageCollection.update(event); 
}

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
                    var image = new createjs.Bitmap(SCRYFALL_URL + urlImage + "?format=image");          
                    image.x = xCoord;
                    image.y = xCoord;
                    image.scale = 0.3;   
                    xCoord += 100;

                    ARRAY_BITMAPS.push(image);
                    stage.addChild(image); 
                }
            });
            return arrayUrls;
        }
    };  
    xhttp.open("GET", "getImagesUrlFromExtension.php", true); // On appelle le fichier showExtensionImages.php en GET avec le paramètre extensionId 
    xhttp.send();
}
