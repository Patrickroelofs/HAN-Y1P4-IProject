/* ***************************** */
/** CREATE SCRIPT: TABLES        */
/* ***************************** */
USE iproject19
GO

/* TABLE: Bestand */
create table bestand
(
    filenaam    CHAR(13)        NOT NULL    PRIMARY KEY,
    voorwerp    NUMERIC(10)     NOT NULL
)
GO

/* TABLE: Bod */
create table bod
(
    voorwerp    BIGINT          NOT NULL,
    bodBedrag   NUMERIC(6, 2)   NOT NULL    DEFAULT '0.00',
    gebruiker   CHAR(10)        NOT NULL,
    bodDag      DATE            NOT NULL    DEFAULT GETDATE(),
    bodTijdstip TIME(0)         NOT NULL    DEFAULT convert(TIME, GETDATE()),

    CONSTRAINT pk_voorwerp_bodBedrag PRIMARY KEY(voorwerp, bodBedrag)
)
GO