USE iproject19
GO

DROP FUNCTION IF EXISTS dbo.udf_StripHTML
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

INSERT INTO Land (code, naam, begindatum, einddatum, eer_lid)
SELECT GBA_CODE, NAAM_LAND, BEGINDATUM, EINDDATUM, EER_Lid
FROM [batch-iproject19].dbo.tblIMAOLand
GO

INSERT INTO Rubriek (rubrieknummer, rubrieknaam, rubriek)
SELECT Id, Name, Parent
FROM [batch-iproject19].dbo.Categorieen
GO

INSERT INTO Gebruiker (gebruikersnaam, emailadres, wachtwoord, profielfoto, voornaam, achternaam, geboortedag, adresregel1, adresregel2, postcode, plaatsnaam, landnaam)
SELECT Username, Username + '@eenmaalAndermaal.nl', '', '', '', '', '', '', '', Postalcode, '', Country
FROM [batch-iproject19].dbo.Users
GO