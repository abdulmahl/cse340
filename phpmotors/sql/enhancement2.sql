-- Query one.
INSERT INTO `clients` (clientFirstName, clientLastName, clientEmail, clientPassword, clientLevel, comment) VALUES ('Tony', 'Stark', 'Iam1ronM@n', 'tony@starkent.com', 1, 'I am the real Iron Man');
-- Query two.
UPDATE `clients` SET clientLevel=3 WHERE clientid=1;
-- Query three.
UPDATE `inventory` SET invDescription = REPLACE ( invDescription, 'small', 'spacious' ) WHERE invMake = 'GM' AND invModel = 'Hummer';
-- Query four.
SELECT inventory.invModel, carclassification.classificationName FROM `inventory` INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId WHERE carclassification.classificationName = 'SUV';
-- Query five.
DELETE FROM `inventory` WHERE invMake = 'Jeep' AND invModel = 'Wrangler';
-- Query six.
UPDATE `inventory` SET invImage = CONCAT ( '/phpmotors', invImage ), invThumbnail = CONCAT ( '/phpmotors', invThumbnail ); 