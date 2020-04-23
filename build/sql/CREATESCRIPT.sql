/* ***************************** */
/** CREATE SCRIPT: TABLES        */
/* ***************************** */
USE iproject19
GO

/* Vraag */
create table Vraag
(
    vraagnummer     INT         NOT NULL    PRIMARY KEY,
    tekstvraag      CHAR(21)    NOT NULL
);
GO

/* TABLE: Gebruiker */
CREATE TABLE Gebruiker (
    id              INT             NOT NULL    IDENTITY,
    gebruikersnaam  VARCHAR(255)    NOT NULL    PRIMARY KEY,
    emailadres      VARCHAR(255)    NOT NULL,
    wachtwoord      VARCHAR(255)    NOT NULL,

    voornaam        VARCHAR(255)    NOT NULL,
    achternaam      VARCHAR(255)    NOT NULL,
    geboortedag     DATE            NOT NULL,

    adresregel1     VARCHAR(255)    NOT NULL,
    adresregel2     VARCHAR(255)    NULL,
    postcode        VARCHAR(255)    NOT NULL,
    plaatsnaam      VARCHAR(255)    NOT NULL,
    landnaam        VARCHAR(255)    NOT NULL,

    vraagnummer     INT             NOT NULL,
    antwoordtekst   VARCHAR(255)    NOT NULL,

    verkoper        BIT             NOT NULL,

    CONSTRAINT fk_vraagnummer FOREIGN KEY (vraagnummer) REFERENCES Vraag(vraagnummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

/* TABLE: Verkoper */
create table Verkoper
(
    gebruiker       VARCHAR(255)   NOT NULL    PRIMARY KEY,
    bank            CHAR(8)         NULL,
    bankrekening    INT             NULL,
    controleoptie   CHAR(10)        NOT NULL,
    creditcard      CHAR(19)        NULL,

    CONSTRAINT fk_gebruiker FOREIGN KEY (gebruiker) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
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
    verkopersgebruikersnaam VARCHAR(255)    NOT NULL,
    kopersgebruikersnaam    VARCHAR(255)    NOT NULL,
    looptijdeindedag        DATE            NOT NULL,
    looptijdeindetijdstip   TIME(0)         NOT NULL    DEFAULT CONVERT(TIME, GETDATE()),
    veilinggesloten         BIT             NOT NULL,
    verkoopprijs            NUMERIC(8, 2)   NOT NULL,

    CONSTRAINT fk_verkoper FOREIGN KEY (verkopersgebruikersnaam) REFERENCES Verkoper(gebruiker)
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    CONSTRAINT fk_koper FOREIGN KEY (kopersgebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GO

/* TABLE: Bestand */
CREATE TABLE Bestand
(
    filenaam    CHAR(13)        NOT NULL    PRIMARY KEY,
    voorwerp    NUMERIC(10)     NOT NULL,

    CONSTRAINT fk_voorwerp FOREIGN KEY (voorwerp) REFERENCES Voorwerp(voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

/* TABLE: Bod */
CREATE TABLE Bod
(
    voorwerp    NUMERIC(10)     NOT NULL,
    bodbedrag   NUMERIC(8, 2)   NOT NULL    DEFAULT '0.00',
    gebruiker   VARCHAR(255)    NOT NULL,
    boddag      DATE            NOT NULL    DEFAULT GETDATE(),
    bodtijdstip TIME(0)         NOT NULL    DEFAULT CONVERT(TIME, GETDATE()),

    CONSTRAINT pk_Voorwerp_bodBedrag PRIMARY KEY(voorwerp, bodbedrag),
    CONSTRAINT fk_bod_voorwerp FOREIGN KEY (voorwerp) REFERENCES Voorwerp(voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    CONSTRAINT fk_bod_gebruiker FOREIGN KEY (gebruiker) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
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
    CONSTRAINT fk_feedback_voorwerp FOREIGN KEY (voorwerp) REFERENCES Voorwerp(voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

/* TABLE: Gebruikerstelefoon */
create table Gebruikerstelefoon
(
    volgnr      INT             NOT NULL,
    gebruiker   VARCHAR(255)    NOT NULL,
    telefoon    CHAR(11)        NOT NULL,

    CONSTRAINT pk_volgnr_gebruiker PRIMARY KEY(volgnr, Gebruiker),
    CONSTRAINT fk_gebruikerstelefoon_gebruiker FOREIGN KEY (gebruiker) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

/* TABLE: Rubriek */
create table Rubriek
(
    rubrieknummer   INT         NOT NULL    PRIMARY KEY,
    rubrieknaam     CHAR(24)    NOT NULL,
    rubriek         INT         NULL,
    volgnr          INT         NOT NULL,

    CONSTRAINT fk_rubriek FOREIGN KEY (rubriek) REFERENCES Rubriek(rubrieknummer)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
GO

/*TABLE: Voorwerp in Rubriek*/
create table VoorwerpInRubriek
(
    voorwerp                    NUMERIC(10)     NOT NULL,
    rubriekoplaagsteniveau      INT             NOT NULL,

    CONSTRAINT pk_Voorwerp_rubriekOpLaagsteNiveau PRIMARY KEY(voorwerp, rubriekoplaagsteniveau),
    CONSTRAINT fk_voorwerpInRubriek_voorwerp FOREIGN KEY (voorwerp) REFERENCES Voorwerp(voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    CONSTRAINT fk_rubriekOpLaagsteNiveau FOREIGN KEY (rubriekoplaagsteniveau) REFERENCES Rubriek(rubrieknummer)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

