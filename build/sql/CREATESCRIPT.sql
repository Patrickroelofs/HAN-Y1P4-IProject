/* ***************************** */
/** TEMPORARY CREATESCRIPT FOR DEVELOPMENT */
/** (DOES NOT HAVE FULL FUNCTIONALITY UNLESS DEVELOPED) */
/* ***************************** */
USE iproject19
GO

/* ***************************** */
/**  DROP TABLES AND FUNCTIONS   */
/* ***************************** */
DROP FUNCTION IF EXISTS udf_StripHTML
GO

DROP TABLE IF EXISTS Land
GO

DROP TABLE IF EXISTS Bod
GO

DROP TABLE IF EXISTS Bestanden
GO

DROP TABLE IF EXISTS VoorwerpInRubriek
GO

DROP TABLE IF EXISTS Rubriek
GO

DROP TABLE IF EXISTS Feedback
GO

DROP TABLE IF EXISTS Voorwerp
GO

DROP TABLE IF EXISTS Verkoper
GO

DROP TABLE IF EXISTS Gebruiker
GO

/* ***************************** */
/**        CREATE TABLES         */
/* ***************************** */

/* LAND */
CREATE TABLE Land
(
  code          CHAR(4)         NOT NULL,
  naam          VARCHAR(40)     NOT NULL,
  begindatum    DATE            NULL,
  einddatum     DATE            NULL,
  eer_lid       BIT             NOT NULL    DEFAULT 0,


  CONSTRAINT PK_landnaam        PRIMARY KEY (naam),
  CONSTRAINT UQ_code            UNIQUE (code),
  CONSTRAINT CHK_code           CHECK (LEN(code) = 4),
  CONSTRAINT CH_datum           CHECK (BEGINDATUM < EINDDATUM)
);
GO



/* Gebruiker */
CREATE TABLE Gebruiker
(
    id              INT             NOT NULL UNIQUE IDENTITY,
    gebruikersnaam  VARCHAR(255)    NOT NULL,
    emailadres      VARCHAR(255)    NOT NULL,
    wachtwoord      VARCHAR(255)    NOT NULL,

    profielfoto     VARCHAR(255)    NULL,
    voornaam        VARCHAR(255)    NULL,
    achternaam      VARCHAR(255)    NULL,
    telefoonnummer  VARCHAR(255)    NULL,
    geboortedag     DATE            NULL,

    adresregel1     VARCHAR(255)    NULL,
    adresregel2     VARCHAR(255)    NULL,
    postcode        VARCHAR(255)    NULL,
    plaatsnaam      VARCHAR(255)    NULL,
    landnaam        VARCHAR(255)    NULL,

    verkoper        BIT             NULL    DEFAULT 0,
    compleet        BIT             NULL    DEFAULT 0,

    CONSTRAINT PK_gebruiker PRIMARY KEY (gebruikersnaam),
    CONSTRAINT UQ_emailadres UNIQUE (emailadres)
);
GO


/* Rubriek */
CREATE TABLE Rubriek
(
    rubrieknummer INT          NOT NULL,
    rubrieknaam   VARCHAR(255) NOT NULL,
    rubriek       INT          NULL,

    CONSTRAINT PK_rubriek PRIMARY KEY (rubrieknummer),

    --CONSTRAINT:: TODO: Look up if this one is needed :)
    CONSTRAINT FK_rubriekRubrieknummer FOREIGN KEY (rubriek) REFERENCES Rubriek (rubrieknummer)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
);
GO

/* Verkoper */
create table Verkoper
(
    gebruikersnaam  VARCHAR(255)        NOT NULL,
    bank            VARCHAR(255)        NULL,
    bankrekening    VARCHAR(255)        NULL,
    controleoptie   VARCHAR(255)        NOT NULL,
    creditcard      VARCHAR(255)        NULL,

    CONSTRAINT PK_verkoper PRIMARY KEY (gebruikersnaam),

    CONSTRAINT FK_gebruiker FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
        --TODO: 4:35
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,

    --TODO: ADD Controleopties
    CONSTRAINT CHK_controloptie CHECK (controleoptie = 'Creditcard' OR controleoptie = 'Post')
);
GO


/* Voorwerp */
CREATE TABLE Voorwerp
(
    voorwerpnummer          BIGINT              NOT NULL IDENTITY,
    titel                   VARCHAR(255)        NOT NULL,
    beschrijving            VARCHAR(MAX)        NOT NULL,
    thumbnail               VARCHAR(255)        NOT NULL,
    rubriek                 INT                 NOT NULL,
    startprijs              DECIMAL(18,2)       NOT NULL,
    betalingswijzenaam      VARCHAR(255)        NOT NULL,
    betalingsinstructies    VARCHAR(255)        NULL,
    postcode                VARCHAR(255)        NOT NULL,
    plaatsnaam              VARCHAR(255)        NOT NULL,
    landnaam                VARCHAR(40)         NOT NULL,
    looptijd                INT                 NOT NULL DEFAULT 7,
    looptijdbegindag        DATE                NOT NULL DEFAULT GETDATE(),
    looptijdbegintijdstip   TIME                NOT NULL DEFAULT CURRENT_TIMESTAMP,
    verzendkosten           DECIMAL(18,2)       NULL,
    verzendinstructies      VARCHAR(MAX)        NULL,
    verkoper                VARCHAR(255)        NOT NULL,
    koper                   VARCHAR(255)        NULL,
    looptijdeindedag        DATE                NULL, --TODO: Function looptijdbegindag + looptijd
    looptijdeindetijdstip   TIME                NULL,
    gesloten                BIT                 NOT NULL DEFAULT 0,
    verkoopprijs            DECIMAL(18,2)       NULL,

    CONSTRAINT PK_voorwerp PRIMARY KEY (voorwerpnummer),

--     CONSTRAINT FK_verkoperGebruiker FOREIGN KEY (verkoper) REFERENCES Verkoper (gebruikersnaam)
--         ON UPDATE NO ACTION
--         ON DELETE NO ACTION,

    --CONSTRAINT:: TODO: Look up if this one is needed :)
    CONSTRAINT FK_koperGebruiker FOREIGN KEY (koper) REFERENCES Gebruiker (gebruikersnaam)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,

);
GO

/* Voorwerp in Rubriek */
CREATE TABLE VoorwerpInRubriek
(
    voorwerpnummer  BIGINT  NOT NULL,
    rubrieknummer   INT     NOT NULL,

    CONSTRAINT PK_voorwerpnummerRubrieknummer PRIMARY KEY (voorwerpnummer, rubrieknummer),

    CONSTRAINT FK_voorwerpInRubriekVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    --CONSTRAINT:: TODO: Look up if this one is needed :)
    CONSTRAINT FK_rubriekVoorwerpInRubriekRubrieknummer FOREIGN KEY (rubrieknummer) REFERENCES Rubriek (rubrieknummer)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
);
GO

/* Feedback */
CREATE TABLE Feedback
(
    voorwerpnummer      BIGINT          NOT NULL,
    verkoper            BIT             NOT NULL    DEFAULT 0,
    feedbacksoortnaam   VARCHAR(50)     NOT NULL,
    datum               DATE            NOT NULL    DEFAULT GETDATE(),
    tijdstip            TIME            NOT NULL    DEFAULT CURRENT_TIMESTAMP,
    commentaar          VARCHAR(255)    NOT NULL,

    CONSTRAINT PK_feedback PRIMARY KEY (voorwerpnummer),

    CONSTRAINT  CHK_verkoper            CHECK (verkoper = 0 OR verkoper = 1),
    CONSTRAINT  CHK_feedbacksoortnaam   CHECK (feedbacksoortnaam = 'negatief' OR feedbacksoortnaam = 'neutraal' OR feedbacksoortnaam = 'positief'),

    CONSTRAINT  FK_FeedbackvoorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

);
GO

/* Bestanden */
CREATE TABLE Bestanden
(
    bestandnaam     VARCHAR(255)    NOT NULL    PRIMARY KEY,
    voorwerpnummer  BIGINT          NOT NULL,

    CONSTRAINT FK_bestandVoorwerp FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
);
GO

/* Bod */
CREATE TABLE Bod
(
    id              INT                 NOT NULL IDENTITY,
    voorwerpnummer  BIGINT              NOT NULL,
    -- CONSTRAINT:: Bodbedrag MUST be higher than an existing one
    bodbedrag       DECIMAL(18,2)       NOT NULL,
    gebruikersnaam  VARCHAR(255)        NULL,
    boddag          DATE                NOT NULL    DEFAULT     GETDATE(),
    bodtijd         TIME                NOT NULL    DEFAULT     CURRENT_TIMESTAMP,

    CONSTRAINT PK_bod PRIMARY KEY (voorwerpnummer, bodbedrag),

    CONSTRAINT FK_voorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp(voorwerpnummer)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    --CONSTRAINT:: TODO: 2:29PM NOT WORKING
    CONSTRAINT FK_gebruikerGebruikersnaam FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
);
GO