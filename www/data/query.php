<?php

$getAllMapPinInfoQuery = "
    SELECT * FROM (
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, CONCAT(firstName, ' ', middleName, ' ', lastName) AS name, pinDesign, T.idTypeFilter, concat(CAST(HF.idHistoricFilter AS CHAR)) AS idHistoricFilter FROM Grave G JOIN TrackableObject T ON G.idGrave = T.idGrave JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter JOIN HistoricFilter HF on G.idHistoricFilter = HF.idHistoricFilter
	    UNION
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, name, pinDesign, T.idTypeFilter, CONCAT(CAST(0 AS CHAR)) AS idHistoricFilter FROM MiscObject M JOIN TrackableObject T ON M.idMisc = T.idMisc JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter
	    UNION
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, commonName, pinDesign, T.idTypeFilter, CONCAT(CAST(0 AS CHAR)) AS idHistoricFilter FROM NaturalHistory NM JOIN  TrackableObject T ON NM.idNaturalHistory = T.idNaturalHistory JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter) AS `Map Pins`;
    ";

$getAllWideAreaMapPinInfoQuery = "";

$loginUserQuery = "SELECT idUser FROM `User` WHERE email=:email AND password=:pwd";

$userInfoQuery = "SELECT email, CONCAT(firstName, ' ', lastName) AS name FROM User WHERE idUser=:idUser";

$miscInfoQuery = "SELECT miscobject.name, miscobject.description, miscobject.isHazard
FROM  miscobject 
INNER JOIN trackableobject 
ON miscobject.idMisc = trackableobject.idMisc
WHERE miscobject.idMisc = trackableobject.idMisc;";

$graveInfoQuery = "SELECT grave.firstName, grave.middleName, grave.lastName, 
DATE_FORMAT(grave.birth, '%b %d %Y') AS birth, DATE_FORMAT(grave.death, '%b %d %Y') AS death, 
grave.description
FROM grave 
INNER JOIN trackableobject 
ON grave.idGrave = trackableobject.idGrave
WHERE grave.idGrave = trackableobject.idGrave;
";

$naturalHistoryInfoQuery = "SELECT naturalhistory.commonName, naturalhistory.scientificName, naturalhistory.description
FROM naturalhistory 
INNER JOIN trackableobject
ON naturalhistory.idNaturalHistory = trackableobject.idNaturalHistory
WHERE naturalhistory.idNaturalHistory = trackableobject.idNaturalHistory;";

$filterTypeQuery = "SELECT typefilter.type
FROM typefilter
INNER JOIN trackableobject
ON typefilter.idTypeFilter = trackableobject.idTypeFilter
WHERE trackableobject.idTrackableObject = :idTrackableObject";

$filterBarQuery = "
SELECT  idHistoricFilter AS filterID, historicFilterName as filterName, buttonColor, concat('historicFilter') as `table` FROM HistoricFilter 
UNION
SELECT idTypeFilter, type, buttonColor, concat('typeFilter') as `Table` FROM TypeFilter;
";