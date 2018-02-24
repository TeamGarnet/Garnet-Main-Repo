var currentFilters = [];

function filterMapPins(table, referenceID) {
    var filter = {
        table: table,
        id: referenceID
    };
    //only add if not already in the array.
    //if in the array then take it out
    var isfilterApplied = currentFilters.filter(function (mapFilter) {
        mapFilter.table == filter.table;
        mapFilter.id == filter.id;
    });

    //if the filter is already applied remove it
    if (isfilterApplied != []) {
        for (var i = 0; i < currentFilters.length; i++)
            if (currentFilters[i].table === filter.table && currentFilters[i].id === filter.id) {
                currentFilters.splice(i, 1);
                break;
            }
    } else {
        currentFilters.push(filter);
    }
    refreshFilters(table, referenceID);

}

function refreshFilters(table, referenceID) {
    // Loop through markers and set map to null for each
    for (var i = 0; i < activeMarkerObjects.length; i++) {
        activeMarkerObjects[i].setMap(null);
    }

    // Reset the markers array
    activeMarkerObjects = [];

    //Loop through the currentFilters
    //For each filter loop through allMarkerObjects and check to see if they fit the filter
    //If they do add it to the activeMarkerObjects
    //Loop through and set the map for the map as well

    for (var currFilterIndex = 0; currFilterIndex < currentFilters.length; currFilterIndex++) {
        for (var currMarkerIndex = 0; currMarkerIndex < allMarkerObjects.length; currMarkerIndex++) {
            if (currentFilters[currFilterIndex].table == "historicFilter"  && allMarkerObjects[currMarkerIndex].idHistoricFilter == currentFilters[currFilterIndex].id) {
                activeMarkerObjects.push(allMarkerObjects[currMarkerIndex]);
                allMarkerObjects[currMarkerIndex].setMap(map);

            } else if (currentFilters[currFilterIndex].table == "typeFilter"  && allMarkerObjects[currMarkerIndex].idTypeFilter == currentFilters[currFilterIndex].id) {
                activeMarkerObjects.push(allMarkerObjects[currMarkerIndex]);
                allMarkerObjects[currMarkerIndex].setMap(map);

            } else {
                alert("there is a problem");
            }
        }
    }


    // Call set markers to re-add markers
    //setMarkers(beaches);
}