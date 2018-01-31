SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `RapidsCemetery`.`HistoricFilter`
(`idHistoricFilter`,
`historicFilterName`,
`dateStart`,
`dateEnd`,
`description`)
VALUES
('1','Civil War','1861-04-12','1865-05-13','The civil was fought in the US over slavery'),
('2','American Revolutionary War','1775-04-19','1783-09-03','This was was also known as the american war of independence');

INSERT INTO `RapidsCemetery`.`Contact`
(`idContact`,
`name`,
`email`,
`description`,
`phone`)
VALUES
('1',
'Test Human',
'test@human.com',
'I am a test human.',
'750285028'),
('2',
'Test Person',
'test@person.com',
'I am a test person.',
'750285020');

INSERT INTO `RapidsCemetery`.`Event`
(`idEvent`,
`name`,
`description`,
`startTime`,
`endTime`)
VALUES
('1','Spring Festival Picnic','The Spring Festival Picnic is a tradition we have where we have people enjoy the day with others','9999-12-31 23:59:59', '9999-12-31 23:59:59');

INSERT INTO `RapidsCemetery`.`FAQ`
(`idFAQ`,
`question`,
`answer`)
VALUES
('1', 'How do I ask a question on this?', ' I don\'t know how do I get an anwser.'),
('2', 'What do I need to remember to escape?', 'Apsotophes can be an issue at times');

INSERT INTO `RapidsCemetery`.`Grave`
(`idGrave`,
`firstName`,
`middleName`,
`lastName`,
`birth`,
`death`,
`description`,
`idHistoricFilter`)
VALUES
('1','Spongebob', 'Something', 'Squarepants', '1962-02-21','1989-02-21','he lived in a pineapple under the sea', '2'),
('2','Squidward', 'Something', 'Nopants', '1755-02-23','1777-12-02','smallest grave in the cemetery', '1'),
('3','Patrick', 'Something', 'Star', '1845-11-11','1869-01-14','A pair of graves near the vegetation','2');

INSERT INTO `RapidsCemetery`.`MiscObject`
(`idMisc`,
`name`,
`description`,
`isHazard`)
VALUES
('1',
'Bee Hive',
'Oh boy, don\'t get stunnggg',
'No'),
('2',
'Random Hole',
'Disclaimer: There is a hole around this area. Now you cant sue',
'Yes');

INSERT INTO `RapidsCemetery`.`NaturalHistory`
(`idNaturalHistory`,
`commonName`,
`scientificName`,
`description`)
VALUES
('1','Forget-Me-Not', 'scientificName', 'grows on tall, hairy stems which reach two feet in height. Blue blooms with yellow centers'),
('2','Black Raspberries','scientificName', 'This plant is native to eastern North America. Black seeded looking fruit'),
('3','Walnut Trees','scientificName', 'These trees grow walnuts, a walnut is the seed of a drupe or drupaceous nut these fall from up high');

INSERT INTO `RapidsCemetery`.`Group`
(`idGroup`,
`name`,
`description`)
VALUES
('1',
'Doctor Lady',
'Big grave that show the doctor lady'),
('2',
'Oakley Family',
'Oakley family is here. Not the sun glasses people.'),
('3',
'Ballintine Family',
'The had a lot of sick children');

INSERT INTO `RapidsCemetery`.`TypeFilter`
(`idTypeFilter`,
`type`)
VALUES
('1',
'Grave'),
('2',
'Natural History'),
('3',
'Other');

INSERT INTO `RapidsCemetery`.`User`
(`idUser`,
`firstName`,
`lastName`,
`email`,
`password`)
VALUES
('1', 'Brianna', 'Jones','bfj5889@g.rit.edu', 'hashedPWD'),
('2', 'Cole', 'Johnson','cj3421@g.rit.edu', 'hashedPWD'),
('3', 'Daniel', 'Quackenbush','dqvcdsv9@g.rit.edu', 'hashedPWD');

INSERT INTO `RapidsCemetery`.`WiderAreaMap`
(`idWiderAreaMap`,
`name`,
`description`,
`url`,
`longitude`,
`latitude`,
`address`,
`city`,
`state`,
`zipcode`)
VALUES
('1', 'Susan B Anthony Home', 'Home girl lived here', 'www.google.com', '43.1532', '77.6281', '17 Madison St, Rochester','Rochester', 'NY', '14608'),
('2', 'Fredick Duglass Home', 'Home boy lived here', 'www.google.com', '43.1287', '77.6207', '1133 Mt Hope Ave, Rochester','Rochester', 'NY', '14620'),
('3', 'Highland Park', 'People run here', 'www.google.com', '43.1287', '77.6207', '180 Reservoir Ave, Rochester','Rochester', 'NY', '14620');

INSERT INTO `RapidsCemetery`.`TrackableObject`
(`idTrackableObject`,
`latitude`,
`longitude`,
`qrCode`,
`hint`,
`imageDescription`,
`imageLocation`,
`idTypeFilter`,
`idGrave`,
`idNaturalHistory`,
`idMisc`,
`idGroup`)
VALUES
('1', '43.129362','-77.639403', 'qrCode', 'He was #1','imageDescription', 'imageLocation', '1', '1', null, null, '3'),
('2', '43.129434','-77.639395', 'qrCode', 'He was always angry', 'imageDescription', 'imageLocation', '1' ,'2', null, null, '2'),
('3', '43.129518','-77.639398', 'qrCode', 'I guess Ill eat it know.', 'imageDescription', 'imageLocation', '1' ,'3', null, null, '3'),
('4', '43.129539','-77.639636', 'qrCode', 'Look at allllll those flowerrss', 'imageDescription', 'imageLocation', '2' , null, '1', null, '2'),
('5', '43.129545','-77.639701', 'qrCode', 'Look at allllll those treessss', 'imageDescription', 'imageLocation', '2' , null, '2', null, '2'),
('6', '43.129607','-77.639348', 'qrCode', 'Look at allllll thattt grassss', 'imageDescription', 'imageLocation', '2' , null, '3', null, '2'),
('7', '43.129617','-77.638936', 'qrCode', '3', 'imageDescription', 'imageLocation', '2' , null, null, '2', '1'),
('8', '43.129617','-77.639403', 'qrCode', '3', 'imageDescription', 'imageLocation', '1' , null, null, '1', '2');


SET FOREIGN_KEY_CHECKS=1;