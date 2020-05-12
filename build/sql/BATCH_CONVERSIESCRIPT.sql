USE iproject19
GO

DROP FUNCTION IF EXISTS dbo.udf_StripHTML
GO

DROP FUNCTION IF EXISTS dbo.get_id
GO

CREATE FUNCTION dbo.get_id (@gebruikersnaam varchar(255))
RETURNS int
AS
BEGIN
RETURN (SELECT id
		FROM Gebruiker
		WHERE voornaam = @gebruikersnaam)
	END

GO

CREATE FUNCTION dbo.udf_StripHTML (@HTMLText VARCHAR(MAX))
RETURNS VARCHAR(MAX) AS
BEGIN
    DECLARE @Start INT
    DECLARE @End INT
    DECLARE @Length INT
    SET @Start = CHARINDEX('<',@HTMLText)
    SET @End = CHARINDEX('>',@HTMLText,CHARINDEX('<',@HTMLText))
    SET @Length = (@End - @Start) + 1
    WHILE @Start > 0 AND @End > 0 AND @Length > 0
    BEGIN
        SET @HTMLText = STUFF(@HTMLText,@Start,@Length,'')
        SET @Start = CHARINDEX('<',@HTMLText)
        SET @End = CHARINDEX('>',@HTMLText,CHARINDEX('<',@HTMLText))
        SET @Length = (@End - @Start) + 1
    END
    RETURN LTRIM(RTRIM(@HTMLText))
END
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