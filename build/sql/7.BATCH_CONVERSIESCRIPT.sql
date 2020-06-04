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
    Beschrijving,
    concat('https://iproject19.icasites.nl/thumbnails/',Thumbnail),
    Categorie,
    Prijs,
    'PayPal',
    '',
    '',
    '',
    0000,
    7,
    '',
    0,
    0,
    getdate(),
    '12:00:00',
    CAST(DATEADD(day, 7, GETDATE()) as DATE),
    '12:00:00'
FROM batchItems
SET IDENTITY_INSERT Items OFF
GO

DROP FUNCTION IF EXISTS dbo.stripHTML
GO

CREATE FUNCTION dbo.stripHTML (@HTMLText varchar(MAX))
    RETURNS varchar(MAX)
AS
BEGIN
    DECLARE @Start  int
    DECLARE @End    int
    DECLARE @Length int

    -- **DELETE** everything between <STYLE AND </STYLE>
    SET @Start = CHARINDEX('<STYLE', @HTMLText)
    SET @End = CHARINDEX('</STYLE>', @HTMLText, CHARINDEX('<', @HTMLText)) + 7
    SET @Length = (@End - @Start) + 1

    WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
        SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
        SET @Start = CHARINDEX('<STYLE', @HTMLText)
        SET @End = CHARINDEX('</STYLE>', @HTMLText, CHARINDEX('</STYLE>', @HTMLText)) + 7
        SET @Length = (@End - @Start) + 1
    END

    -- **DELETE** everything between <SCRIPT AND </SCRIPT>
    SET @Start = CHARINDEX('<SCRIPT', @HTMLText)
    SET @End = CHARINDEX('</SCRIPT>', @HTMLText, CHARINDEX('<', @HTMLText)) + 7
    SET @Length = (@End - @Start) + 1

    WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
        SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
        SET @Start = CHARINDEX('<SCRIPT', @HTMLText)
        SET @End = CHARINDEX('</SCRIPT>', @HTMLText, CHARINDEX('</SCRIPT>', @HTMLText)) + 7
        SET @Length = (@End - @Start) + 1
    END

    -- **REPLACE** &bnsp; with a SPACE
    SET @Start = CHARINDEX('&nbsp;', @HTMLText)
    SET @End = @Start + 5
    SET @Length = (@End - @Start) + 1

    WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
        SET @HTMLText = STUFF(@HTMLText, @Start, @Length, ' ')
        SET @Start = CHARINDEX('&nbsp;', @HTMLText)
        SET @End = @Start + 5
        SET @Length = (@End - @Start) + 1
    END

    -- **REPLACE** &amp; with a &
    SET @Start = CHARINDEX('&amp;', @HTMLText)
    SET @End = @Start + 4
    SET @Length = (@End - @Start) + 1

    WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
        SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '&')
        SET @Start = CHARINDEX('&amp;', @HTMLText)
        SET @End = @Start + 4
        SET @Length = (@End - @Start) + 1
    END


    -- **DELETE** everything between < and >
    SET @Start = CHARINDEX('<', @HTMLText)
    SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
    SET @Length = (@End - @Start) + 1

    WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
        SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
        SET @Start = CHARINDEX('<', @HTMLText)
        SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
        SET @Length = (@End - @Start) + 1
    END

    RETURN LTRIM(RTRIM(@HTMLText))

END
GO

update Items
set description = dbo.stripHTML (description)
GO

INSERT INTO Files (ITEM, FILENAME)
SELECT ItemID,
       concat('https://iproject19.icasites.nl/pics/', IllustratieFile)
FROM batchIllustraties
GO