/* BATCH CREATESCRIPT
   Converts supplied database to EenmaalAndermaal database */
USE iproject19
GO

/* ***************************** */
/**  DROP TABLES AND FUNCTIONS   */
/* ***************************** */
alter table batchItems drop constraint FK_BatchItems_In_Categorie
GO
alter table batchIllustraties drop constraint [ItemsVoorPlaatje]
GO
drop index IX_Items_Categorie on batchItems
GO
drop index IX_Categorieen_Parent on batchCategorieen
GO
drop table if exists batchUsers
GO
drop table if exists batchCategorieen
GO
drop table if exists batchItems
GO
drop table if exists batchIllustraties
GO
drop table if exists tblIMAOLand
GO

/* ***************************** */
/**        CREATE TABLES         */
/* ***************************** */
CREATE TABLE batchUsers
(
  Username VARCHAR(200),
  Postalcode VARCHAR(9),
  Location VARCHAR(MAX),
  Country VARCHAR(100),
  Rating NUMERIC(4,1)
)
GO

CREATE TABLE batchCategorieen
(
	ID int NOT NULL,
	Name varchar(100) NULL,
	Parent int NULL,
	CONSTRAINT PK_BatchCategorieen PRIMARY KEY (ID)
)
GO

CREATE TABLE batchItems
(
	ID bigint NOT NULL,
	Titel varchar(max) NULL,
	Beschrijving nvarchar(max) NULL,
	Categorie int NULL,
	Postcode varchar(max) NULL,
	Locatie varchar(max) NULL,
	Land varchar(max) NULL,
	Verkoper varchar(max) NULL,
	Prijs varchar(max) NULL,
	Valuta varchar(max) NULL,
	Conditie varchar(max) NULL,
	Thumbnail varchar(max) NULL,
	CONSTRAINT PK_BatchItems PRIMARY KEY (ID),
	CONSTRAINT FK_BatchItems_In_Categorie FOREIGN KEY (Categorie) REFERENCES batchCategorieen (ID)
)
GO

CREATE TABLE batchIllustraties
(
	ItemID bigint NOT NULL,
	IllustratieFile varchar(100) NOT NULL,
    CONSTRAINT PK_BatchItemPlaatjes PRIMARY KEY (ItemID, IllustratieFile),
	CONSTRAINT [ItemsVoorPlaatje] FOREIGN KEY(ItemID) REFERENCES batchItems (ID)
)
GO

CREATE TABLE tblIMAOLand
(
  GBA_CODE CHAR(4) NOT NULL,
  NAAM_LAND VARCHAR(40) NOT NULL,
  BEGINDATUM DATE NULL,
  EINDDATUM DATE NULL,
  EER_Lid BIT NOT NULL DEFAULT 0,
  CONSTRAINT PK_tblIMAOLand PRIMARY KEY (NAAM_LAND),
  CONSTRAINT UQ_tblIMAOLand UNIQUE (GBA_CODE),
  CONSTRAINT CHK_CODE CHECK ( LEN(GBA_CODE) = 4 ),
  CONSTRAINT CHK_DATUM CHECK ( BEGINDATUM < EINDDATUM )
)
GO

CREATE INDEX IX_Items_Categorie ON batchItems (Categorie)
GO

CREATE INDEX IX_Categorieen_Parent ON batchCategorieen (Parent)
GO