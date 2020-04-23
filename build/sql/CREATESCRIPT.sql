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

/*TABLE: Feedback */
create table tbl_Feedback
(
    voorwerp        NUMERIC(10)     NOT NULL,
    soortGebruiker  CHAR(8)         NOT NULL,
    feedbacksoort   CHAR(8)         NOT NULL,
    dag             CHAR(10)        NOT NULL,
    tijdstip        CHAR(8)         NOT NULL,
    commentaar      CHAR(12),

    CONSTRAINT pk_voorwerp_soortGebruiker PRIMARY KEY(Voorwerp, SoortGebruiker),
)
GO

/* TABLE: Gebruikerstelefoon */
create table tbl_Gebruikerstelefoon
(
    volgnr      INTEGER         NOT NULL,
    gebruiker   CHAR(10)        NOT NULL,
    telefoon    CHAR(11)        NOT NULL,

    CONSTRAINT pk_volgnr_gebruiker PRIMARY KEY(Volgnr, Gebruiker)
)
GO

/* TABLE: Rubriek */
create table tbl_Rubriek
(
    rubrieknummer   INTEGER      NOT NULL    PRIMARY KEY,
    rubrieknaam     CHAR(24)     NOT NULL,
    rubriek         INTEGER,
    volgnr          INTEGER      NOT NULL
)
GO

/* TABLE: Verkoper */
create table tbl_Verkoper
(
    gebruiker       CHAR(10)    NOT NULL    PRIMARY KEY,
    bank            CHAR(8),
    bankrekening    INTEGER,
    controleOptie   CHAR(10)    NOT NULL,
    creditcard      CHAR(19)
)
GO

/*TABLE: Voorwerp in Rubriek*/
create table tbl_VoorwerpInRubriek
(
    voorwerp                    NUMERIC(10)     NOT NULL,
    rubriekOpLaagsteNiveau      INTEGER         NOT NULL,

    CONSTRAINT pk_Voorwerp_rubriekOpLaagsteNiveau PRIMARY KEY(voorwerp, rubriekOpLaagsteNiveau)
)
GO

/* Vraag */
create table tbl_Vraag
(
    vraagnummer     INTEGER     NOT NULL    PRIMARY KEY,
    tekstVraag      CHAR(21)    NOT NULL
)
GO

