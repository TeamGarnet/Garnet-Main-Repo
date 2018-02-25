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



$miscInfoQuery = "SELECT MiscObject.name, MiscObject.description, MiscObject.isHazard
FROM  MiscObject 
INNER JOIN TrackableObject 
ON MiscObject.idMisc = TrackableObject.idMisc
WHERE MiscObject.idTrackableObject =:idTrackableObject";

$graveInfoQuery = "SELECT Grave.firstName, Grave.middleName, Grave.lastName, 
DATE_FORMAT(Grave.birth, '%b %d %Y') AS birth, DATE_FORMAT(Grave.death, '%b %d %Y') AS death, 
Grave.description
FROM Grave 
INNER JOIN TrackableObject 
ON Grave.idGrave = TrackableObject.idGrave
WHERE Grave.idTrackableObject =:idTrackableObject";

$naturalHistoryInfoQuery = "SELECT NaturalHistory.commonName, NaturalHistory.scientificName, NaturalHistory.description
FROM NaturalHistory 
INNER JOIN TrackableObject
ON NaturalHistory.idNaturalHistory = TrackableObject.idNaturalHistory
WHERE NaturalHistory.idTrackableObject =:idTrackableObject";

$filterTypeQuery = "SELECT TypeFilter.type
FROM TypeFilter
INNER JOIN TrackableObject
ON TypeFilter.idTypeFilter = TrackableObject.idTypeFilter
WHERE TrackableObject.idTrackableObject = :idTrackableObject";



$filterBarQuery = "
SELECT  idHistoricFilter AS filterID, historicFilterName as filterName, buttonColor, concat('historicFilter') as `table` FROM HistoricFilter 
UNION
SELECT idTypeFilter, typeName, buttonColor, concat('typeFilter') as `Table` FROM TypeFilter;
";