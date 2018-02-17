INSERT INTO Image (id, imageURL, imageDescription)
VALUES ('1', 'https://imgur.com/r/spongebob/zHNB3RB', 'This is the description of the image'),
  ('2', 'http://spongebob.wikia.com/wiki/File:Char_squidward.jpg', 'this is the desc of another image');

INSERT INTO War (id, name, dateStarted, dateEnded, description, imageID)
VALUES ('1', 'Civil War', '1861-04-12', '1865-05-13', 'The civil was fought in the US over slavery', '2'),
  ('2', 'American Revolutionary War', '1775-04-19', '1783-09-03',
   'This was was also known as the american war of independence', '1');

INSERT INTO Map (id, latitude, longitude, type)
VALUES ('1', '43.129362', '-77.639403', 'Grave'),
  ('2', '43.129434', '-77.639395', 'Grave'),
  ('3', '43.129518', '-77.639398', 'Grave'),
  ('4', '43.129617', '-77.638936', 'HazardousArea'),
  ('5', '43.129539', '-77.639636', 'NaturalHistory'),
  ('6', '43.129545', '-77.639701', 'NaturalHistory'),
  ('7', '43.129607', '-77.639348', 'NaturalHistory');

INSERT INTO NaturalHistory (id, name, description, hint, pointValue, imageID, mapID)
VALUES
  ('1', 'Forget-Me-Not', 'grows on tall, hairy stems which reach two feet in height', 'Blue blooms with yellow centers',
   '1', '2', '5'),
  ('2', 'Black Raspberries', 'This plant is native to eastern North America', 'Black seeded looking fruit', '1', '1',
   '6'),
  ('3', 'Walnut Trees', 'These trees grow walnuts, a walnut is the seed of a drupe or drupaceous nut',
   'these fall from up high', '1', '2', '7');

INSERT INTO HazardousArea (id, description, mapID)
VALUES ('1', 'This is a large and steep hill', '4');

INSERT INTO Grave (id, name, birthDate, deathDate, description, pointValue, hint, mapID, imageID, warID)
VALUES ('1', 'Spongebob', '1962-02-21', '1989-02-21', 'he lived in a pineapple under the sea', '2',
        'He is under the rock! -bad hint', '1', '1', NULL),
  ('2', 'Squidward', '1755-02-23', '1777-12-02', 'he lived next to Spongebob', '2', 'smallest grave in the cemetery',
   '2', '2', '2'),
  ('3', 'Patrick', '1845-11-11', '1869-01-14', 'he lived under a rock', '2', 'A pair of graves near the vegetation',
   '3', '1', '1');

INSERT INTO Contact (id, name, email, phone)
VALUES ('1', 'Jake Fanelli', 'jxf6552@rit.edu', '111-111-1111');

INSERT INTO Event (id, name, description)
VALUES ('1', 'Spring Festival Picnic',
        'The Spring Festival Picnic is a tradition we have where we have people enjoy the day with others');

INSERT INTO Permission (id, name, description)
VALUES ('1', 'admin', 'An admin has full access to do anything'),
  ('2', 'viewer', 'A viewer is only able to view data - no editting');

INSERT INTO User (id, email, password, permissionID)
VALUES ('1', 'jxf6552@rit.edu', 'randomletters', '1'),
  ('2', 'jxf6551@rit.edu', 'randomletters2', '2');