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

// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
