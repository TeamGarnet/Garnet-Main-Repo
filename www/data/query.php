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



$miscInfoQuery = "SELECT T.imageLocation, T.imageDescription, MiscObject.name, MiscObject.description, MiscObject.isHazard
FROM  MiscObject 
INNER JOIN TrackableObject T
ON MiscObject.idMisc = T.idMisc
WHERE T.idTrackableObject =:idTrackableObject";

$graveInfoQuery = "SELECT T.imageLocation, T.imageDescription,  Grave.firstName, Grave.middleName, Grave.lastName, 
DATE_FORMAT(Grave.birth, '%b %d %Y') AS birth, DATE_FORMAT(Grave.death, '%b %d %Y') AS death, 
Grave.description
FROM Grave 
INNER JOIN TrackableObject T
ON Grave.idGrave = T.idGrave
WHERE T.idTrackableObject =:idTrackableObject";

$naturalHistoryInfoQuery = "SELECT T.imageLocation, T.imageDescription,  NaturalHistory.commonName, NaturalHistory.scientificName, NaturalHistory.description
FROM NaturalHistory 
INNER JOIN TrackableObject T
ON NaturalHistory.idNaturalHistory = T.idNaturalHistory
WHERE T.idTrackableObject =:idTrackableObject";

$filterTypeQuery = "SELECT TypeFilter.type
FROM TypeFilter
INNER JOIN TrackableObject
ON TypeFilter.idTypeFilter = TrackableObject.idTypeFilter
WHERE TrackableObject.idTrackableObject = :idTrackableObject";



$filterBarQuery = "
SELECT  idHistoricFilter AS filterID, historicFilterName as filterName, buttonColor, concat('historicFilter') as `table` FROM HistoricFilter 
UNION
SELECT idTypeFilter, type, buttonColor, concat('typeFilter') as `Table` FROM TypeFilter;
";

$allTrailLocationQuery = "SELECT * FROM RapidsCemetery.WiderAreaMap";


//Admin Page Queries
$getAllGraveEntriesQuery = "SELECT idTrackableObject, G.idGrave, longitude, latitude, imageDescription, imageLocation, firstName, middleName, lastName, birth, death, G.description, HF.idHistoricFilter, HF.historicFilterName, T.idTypeFilter, TF.type FROM Grave G 
JOIN TrackableObject T ON G.idGrave = T.idGrave 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter 
LEFT OUTER JOIN HistoricFilter HF ON G.idHistoricFilter = HF.idHistoricFilter";

$getAllMiscEntriesQuery = "SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, name, T.idTypeFilter, TF.type, M.idMisc, M.name, M.description FROM MiscObject M 
JOIN TrackableObject T ON M.idMisc = T.idMisc 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter
";

$getAllNaturalHistoryEntriesQuery = "SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, commonName, scientificName, description, T.idTypeFilter, TF.type FROM NaturalHistory NM 
JOIN TrackableObject T ON NM.idNaturalHistory = T.idNaturalHistory 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter
";

$createTrackableObjectQuery = "INSERT INTO TrackableObject (idTrackableObject,longitude,latitude,qrCode,hint,imageDescription,imageLocation,idTypeFilter,idGrave,idNaturalHistory,idMisc,idGroup)
VALUES (:idTrackableObject,:longitude,:latitude,:qrCode,:hint,:imageDescription, '../pages/images/pins/default.png',:idTypeFilter,:idGrave,:idNaturalHistory,:idMisc,:idGroup)";

$createGraveObjectQuery = "INSERT INTO Grave (idGrave,firstName,middleName,lastName,birth,death,description,idHistoricFilter)
VALUES (:idGrave,:firstName,:middleName,:lastName,:birth,:death,:description,:idHistoricFilter)";

$createMiscObjectQuery  = "INSERT INTO MiscObject (idMisc,name,description,isHazard)
VALUES (:idMisc,:name, description,:isHazard)";

$createHanturalHistoryObjectQuery = "INSERT INTO NaturalHistory (idNaturalHistory,commonName,scientificName,description)
VALUES  (:idNaturalHistory,:commonName,:scientificName,:description)";

$updateTrackableObjectConnectionQuery = "UPDATE TrackableObject SET
idGrave = :idGrave, idNaturalHistory = :idNaturalHistory, idMisc = :idMisc, idGroup = :idGroup
WHERE idTrackableObject = :idTrackableObject";