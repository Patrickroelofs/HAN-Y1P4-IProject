USE iproject19
GO

INSERT INTO [iproject19].dbo.Country (code, name, startdate, enddate, eer_member)
SELECT GBA_CODE, NAAM_LAND, BEGINDATUM, EINDDATUM, EER_Lid
FROM [batch-iproject19].dbo.tblIMAOLand
GO

INSERT INTO [iproject19].dbo.Users (username, email, password, profilepicture, firstname, lastname, phone, address1, address2, postalcode, city, country, trader, complete)
SELECT Username, Username + '@eenmaalAndermaal.nl', '', '', '', '', '', '', '', '', '', '0000', 1, 1
FROM [batch-iproject19].dbo.Users
GO

SET IDENTITY_INSERT [iproject19].dbo.Categories ON
INSERT INTO [iproject19].dbo.Categories (id, name, within)
SELECT Id, Name, Parent
FROM [batch-iproject19].dbo.Categorieen
SET IDENTITY_INSERT [iproject19].dbo.Categories OFF
GO

INSERT INTO [iproject19].dbo.Trader (username, bank, bankaccount, controloption, creditcard)
SELECT username, '', '', 'Creditcard', ''
FROM [iproject19].dbo.Users


-- SET IDENTITY_INSERT Items ON
-- INSERT INTO [iproject19].dbo.Items (id, title, description, category, postalcode, city, country, trader, price, paymentname, thumbnail)
-- SELECT id,
--     LEFT(Titel, 255),
--     '',
--     Categorie,
--     Postcode,
--     '',
--     '0000',
--     Verkoper,
--     Prijs,
--     '',
--     concat('pics/dt_1_',RIGHT(Thumbnail, 16))
-- FROM [batch-iproject19].dbo.Items
-- SET IDENTITY_INSERT Items OFF
-- GO