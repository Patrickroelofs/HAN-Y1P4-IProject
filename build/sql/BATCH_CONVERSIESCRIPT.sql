USE iproject19
GO

INSERT INTO Gebruiker (gebruikersnaam, emailadres, wachtwoord, profielfoto, voornaam, achternaam, geboortedag, adresregel1, adresregel2, postcode, plaatsnaam, landnaam, verkoper)
SELECT Username, Username + '@eenmaalAndermaal.nl', '', '', '', '', '', '', '', Postalcode, '', Country, 1
FROM [batch-iproject19].dbo.Users
GO

INSERT INTO Rubriek (rubrieknummer, rubrieknaam, rubriek)
SELECT Id, Name, Parent
FROM [batch-iproject19].dbo.Categorieen
GO

INSERT INTO Verkoper (gebruikersnaam, bank, bankrekening, controleoptie, creditcard)
SELECT gebruikersnaam, '', '', 'Creditcard', ''
FROM Gebruiker

SET IDENTITY_INSERT Voorwerp ON
INSERT INTO Voorwerp (voorwerpnummer, titel, beschrijving, rubriek, postcode, plaatsnaam, landnaam, verkoper, startprijs, betalingswijzenaam, thumbnail)
SELECT id,
    LEFT(Titel, 255),
    '',
    Categorie,
    Postcode,
    '',
    Land,
    Verkoper,
    Prijs,
    '',
    RIGHT(Thumbnail, 16)
FROM [batch-iproject19].dbo.Items
SET IDENTITY_INSERT Voorwerp OFF

INSERT INTO Land (code, naam, begindatum, einddatum, eer_lid)
SELECT GBA_CODE, NAAM_LAND, BEGINDATUM, EINDDATUM, EER_Lid
FROM [batch-iproject19].dbo.tblIMAOLand
GO