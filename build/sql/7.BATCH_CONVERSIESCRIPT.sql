USE iproject19
GO

INSERT INTO Country (code, name, startdate, enddate, eer_member)
SELECT GBA_CODE, NAAM_LAND, BEGINDATUM, EINDDATUM, EER_Lid
FROM tblIMAOLand
GO

DROP FUNCTION IF EXISTS dbo.getCountryCode
GO

CREATE FUNCTION dbo.getCountryCode(@Country varchar(40))
RETURNS CHAR(4)
    AS
    BEGIN
        DECLARE @code CHAR(4)
        SET @code = (SELECT Country.code FROM Country WHERE Country.name LIKE @Country)

        IF (@code IS NOT NULL)
            RETURN @code
        ELSE
            RETURN '0000'
        RETURN '0000'
END
GO

INSERT INTO Users (username, email, password, profilepicture, firstname, lastname, phone, address1, address2, postalcode, city, country, trader, complete)
SELECT DISTINCT
                batchUsers.Username,
                batchUsers.Username + '@eenmaalAndermaal.nl',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                batchUsers.Postalcode,
                '',
                dbo.getCountryCode(batchUsers.Location),
                1,
                1
FROM batchUsers
GO

SET IDENTITY_INSERT Categories ON
INSERT INTO Categories (id, name, within)
SELECT Id, Name, Parent
FROM batchCategorieen
SET IDENTITY_INSERT Categories OFF
GO

INSERT INTO Trader (username, bank, bankaccount, controloption, creditcard, activated)
SELECT DISTINCT
                username,
                '',
                '',
                'Creditcard',
                '',
                1
FROM batchUsers
GO

SET IDENTITY_INSERT Items ON
INSERT INTO Items (id, trader, title, description, thumbnail, category, price, paymentname, paymentinstruction, postalcode, city, country, duration, shippinginstructions, closed, hidden, durationbegindate, durationbegintime, durationenddate, durationendtime)
SELECT
    ID,
    Verkoper,
    LEFT(Titel, 255),
    '',
    concat('https://iproject19.icasites.nl/thumbnails/',Thumbnail),
    Categorie,
    Prijs,
    '',
    '',
    '',
    '',
    '0000',
    ABS(CHECKSUM(NEWID()) % (30 - 10 + 1)) + 10,
    '',
    0,
    0,
    getdate(),
    '12:00:00',
    DATEADD(day, 30, getdate()),
    '12:00:00'
FROM batchItems
SET IDENTITY_INSERT Items OFF
GO


INSERT INTO Files (ITEM, FILENAME)
SELECT ItemID,
       concat('https://iproject19.icasites.nl/pics/', IllustratieFile)
FROM batchIllustraties
GO