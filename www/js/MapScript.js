function refreshFilters(table, referenceID) {
    // Loop through markers and set map to null for each
    for (var i = 0; i < allMarkerObjects.length; i++) {
        allMarkerObjects[i].setVisible(false);

        if (table == "historicFilter" && allMarkerObjects[i].idHistoricFilter == referenceID) {
            allMarkerObjects[i].setVisible(true);
        } else if (table == "typeFilter" && allMarkerObjects[i].idTypeFilter == referenceID){
            allMarkerObjects[i].setVisible(true);
        } else {
            console.log(allMarkerObjects[i]);
        }
    }
}

function resetFilters() {
    for (var i = 0; i < allMarkerObjects.length; i++) {
        allMarkerObjects[i].setVisible(true);
    }
}


/*Abdols Code */

$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
$("#flip").on('click',function(){
    $(this).children('i.fa-sort-down').toggleClass('i.fa-sort-up');
});
function openup() {
    $(".popup-overlay, .popup-content").show("fast");
}
function shutdown() {
    $(".popup-overlay, .popup-content").hide("fast");
}
/*
infoWindow.setContent(
    "<div><div class='first' style = 'width:250px;height:auto;text-align:center'><img src="
        .$pin -> getImage()
    ." style=width:100px;height:100px;/></br><h4>"
        .$pin -> getName()
        ."</h4>"
    .$pin -> getDescription()
    . "</br></br><button onclick='openup()' class='btn' style='border-radius:25px;color:#ec5e07;background-color: #fff;border-color: #ec5e07;padding:5px !important;'>Learn More</button>" +"</div>" +"<div class='popup-overlay' style='display:none;'>" +"<div class='popup-content'>" + data.desc +"</br>" +"<button onclick='shutdown()' class='btn' style='border-radius:25px;color: #ec5e07; background-color: #fff;border-color: #ec5e07;padding:5px !important; margin-top:15px;'>Return To Map</button>" +"</div>" + "</div>" +"</div>");
    */