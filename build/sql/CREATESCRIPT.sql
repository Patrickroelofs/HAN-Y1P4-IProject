/* ***************************** */
/** CREATE SCRIPT: TABLES        */
/* ***************************** */
USE iproject19
GO

/* TABLE: Bestand */
CREATE TABLE Bestand
(
    filenaam    CHAR(13)        NOT NULL    PRIMARY KEY,
    voorwerp    NUMERIC(10)     NOT NULL
);
GO

/* TABLE: Bod */
CREATE TABLE Bod
(
    voorwerp    NUMERIC(10)     NOT NULL,
    bodbedrag   NUMERIC(8, 2)   NOT NULL    DEFAULT '0.00',
    gebruiker   CHAR(10)        NOT NULL,
    boddag      DATE            NOT NULL    DEFAULT GETDATE(),
    bodtijdstip TIME(0)         NOT NULL    DEFAULT CONVERT(TIME, GETDATE()),

    CONSTRAINT pk_Voorwerp_bodBedrag PRIMARY KEY(voorwerp, bodbedrag)
);
GO

/* TABLE: Gebruiker */
CREATE TABLE Gebruiker (
    gebruikersnaam  CHAR(10)    NOT NULL    PRIMARY KEY,
    voornaam        CHAR(5)     NOT NULL,
    achternaam      CHAR(8)     NOT NULL,
    adresregel1     CHAR(15)    NOT NULL,
    adresregel2     CHAR(15)    NULL,
    postcode        CHAR(7)     NOT NULL,
    plaatsnaam      CHAR(12)    NOT NULL,
    landnaam        CHAR(9)     NOT NULL,
    geboortedag     CHAR(10)    NOT NULL,
    emailadres      CHAR(18)    NOT NULL,
    wachtwoord      CHAR(9)     NOT NULL,
    vraagnummer     INT         NOT NULL,
    antwoordtekst   CHAR(9)     NOT NULL,
    verkoper        BIT         NOT NULL
);
GO

/* TABLE: Voorwerp */
CREATE TABLE Voorwerp (
    voorwerpnummer          NUMERIC(10)     NOT NULL    PRIMARY KEY,
    titel                   CHAR(18)        NOT NULL,
    beschrijving            CHAR(10)        NOT NULL,
    startprijs              CHAR(5)         NOT NULL,
    betalingswijzenaam      CHAR(9)         NOT NULL,
    betalingsinstructie     VARCHAR(255)    NULL,
    plaatsnaam              CHAR(12)        NOT NULL,
    landnaam                CHAR(9)         NOT NULL,
    looptijd                INT             NOT NULL,
    looptijdbegindag        DATE            NOT NULL,
    looptijdbegintijdstip   TIME(0)         NOT NULL    DEFAULT CONVERT(TIME, GETDATE()),
    verzendkosten           CHAR(27)        NULL,
    verzendinstructies      CHAR(27)        NULL,
    verkopersgebruikersnaam CHAR(10)        NOT NULL,
    kopersgebruikersnaam    CHAR(10)        NOT NULL,
    looptijdeindedag        DATE            NOT NULL,
    looptijdeindetijdstip   TIME(0)         NOT NULL    DEFAULT CONVERT(TIME, GETDATE()),
    veilinggesloten         BIT             NOT NULL,
    verkoopprijs            NUMERIC(8, 2)   NOT NULL
);
GO

/*TABLE: Feedback */
create table Feedback
(
    voorwerp        NUMERIC(10)     NOT NULL,
    soortgebruiker  CHAR(8)         NOT NULL,
    feedbacksoort   CHAR(8)         NOT NULL,
    dag             CHAR(10)        NOT NULL,
    tijdstip        CHAR(8)         NOT NULL,
    commentaar      CHAR(12)        NULL,

    CONSTRAINT pk_voorwerp_soortGebruiker PRIMARY KEY(voorwerp, soortgebruiker),
);
GO

/* TABLE: Gebruikerstelefoon */
create table Gebruikerstelefoon
(
    volgnr      INT             NOT NULL,
    gebruiker   CHAR(10)        NOT NULL,
    telefoon    CHAR(11)        NOT NULL,

    CONSTRAINT pk_volgnr_gebruiker PRIMARY KEY(volgnr, Gebruiker)
);
GO

/* TABLE: Rubriek */
create table Rubriek
(
    rubrieknummer   INT         NOT NULL    PRIMARY KEY,
    rubrieknaam     CHAR(24)    NOT NULL,
    rubriek         INT         NULL,
    volgnr          INT         NOT NULL
);
GO

/* TABLE: Verkoper */
create table Verkoper
(
    gebruiker       CHAR(10)    NOT NULL    PRIMARY KEY,
    bank            CHAR(8)     NULL,
    bankrekening    INT         NULL,
    controleoptie   CHAR(10)    NOT NULL,
    creditcard      CHAR(19)    NULL
);
GO

/*TABLE: Voorwerp in Rubriek*/
create table VoorwerpInRubriek
(
    voorwerp                    NUMERIC(10)     NOT NULL,
    rubriekoplaagsteniveau      INT             NOT NULL,

    CONSTRAINT pk_Voorwerp_rubriekOpLaagsteNiveau PRIMARY KEY(voorwerp, rubriekoplaagsteniveau)
);
GO

/* Vraag */
create table Vraag
(
    vraagnummer     INT         NOT NULL    PRIMARY KEY,
    tekstvraag      CHAR(21)    NOT NULL
);
GO