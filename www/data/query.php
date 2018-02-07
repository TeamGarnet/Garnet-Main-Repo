<?php

$getAllMapPinInfoQuery = "
    SELECT * FROM (
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, CONCAT(firstName, ' ', middleName, ' ', lastName) AS name, type, pinDesign FROM Grave G JOIN TrackableObject T ON G.idGrave = T.idGrave JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter) AS `Map Pins`
	    UNION
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, name, type, pinDesign FROM MiscObject M JOIN TrackableObject T ON M.idMisc = T.idMisc JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter
	    UNION
	    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, commonName, type, pinDesign FROM NaturalHistory NM JOIN  TrackableObject T ON NM.idNaturalHistory = T.idNaturalHistory JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter;
    ";

$getAllWideAreaMapPinInfoQuery = "";

$loginUserQuery = "SELECT idUser FROM User WHERE email=:email AND password=:password";

$userInfoQuery = "SELECT email, CONCAT(firstName, ' ', lastName) AS name FROM User WHERE idUser=:idUser";