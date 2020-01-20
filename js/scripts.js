function submitForm(event)
{
    var url = "/PPE/pages/envoie_mail.php";
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.onload = function()
    {
        console.log(request.responseText);
        
    }

    request.onerror = function()
    {
        
    }

    request.send(new FormData(event.target));
    event.preventDefault();
}

function switchResponsive()
{
	var x = document.getElementById("menu");
	if (x.className === "menu")
	{
		x.className += " responsive";
	}
	else
	{
		x.className = "menu";
	}
}

function initOSM()
{
    // On initialise la latitude et la longitude de Paris (centre de la carte)
    var lat = 47.048838;
    var lon =  -0.863627;
    var macarte = null;
    // Fonction d'initialisation de la carte
    function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 16);
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 5,
            maxZoom: 16,
        }).addTo(macarte);
    }
    window.onload = function(){
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap(); 
    };
}