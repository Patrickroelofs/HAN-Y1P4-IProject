/* ***************************** */
/** TEMPORARY CREATESCRIPT FOR DEVELOPMENT */
/** (DOES NOT HAVE FULL FUNCTIONALITY UNLESS DEVELOPED) */
/* ***************************** */
USE iproject19
GO

CREATE TABLE Gebruiker
(
    id             INT          NOT NULL UNIQUE IDENTITY,
    gebruikersnaam VARCHAR(255) NOT NULL PRIMARY KEY,
    emailadres     VARCHAR(255) NOT NULL,
    wachtwoord     VARCHAR(255) NOT NULL,

    profielfoto    VARCHAR(255) NULL,
    voornaam       VARCHAR(255) NULL,
    achternaam     VARCHAR(255) NULL,
    geboortedag    DATE         NULL,

    adresregel1    VARCHAR(255) NULL,
    adresregel2    VARCHAR(255) NULL,
    postcode       VARCHAR(255) NULL,
    plaatsnaam     VARCHAR(255) NULL,
    landnaam       VARCHAR(255) NULL,

    verkoper       BIT          NULL    DEFAULT 0,
    compleet       BIT          NULL    DEFAULT 0
);
GO

CREATE TABLE Rubriek
(
    rubrieknummer INT          NOT NULL PRIMARY KEY,
    rubrieknaam   VARCHAR(255) NOT NULL,
    rubriek       INT          NULL,
    volgnr        INT          NULL,
);
GO

CREATE TABLE Voorwerp
(
    voorwerpnummer          INT                 NOT NULL IDENTITY PRIMARY KEY,
    titel                   VARCHAR(255)        NOT NULL,
    beschrijving            VARCHAR(MAX)        NOT NULL,
    startprijs              DECIMAL(18,2)       NOT NULL,
    betalingsinstructies    VARCHAR(255)        NULL,
    plaatsnaam              VARCHAR(255)        NOT NULL,
    landnaam                VARCHAR(255)        NOT NULL,
    looptijd                INT                 NOT NULL DEFAULT 7,
    looptijdbegindag        DATE                NOT NULL DEFAULT GETDATE(),
    looptijdbegintijdstip   TIME                NOT NULL DEFAULT CURRENT_TIMESTAMP,
    verzendkosten           DECIMAL(18,2)       NULL,
    verzendinstructies      VARCHAR(MAX)        NULL,
    verkoper                VARCHAR(255)        NOT NULL,
    koper                   VARCHAR(255)        NULL,
    looptijdeindedag        DATE                NULL,
    looptijdeindetijdstip   TIME                NULL,
    gesloten                BIT                 NOT NULL DEFAULT 0,
    verkoopprijs            DECIMAL(18,2)       NULL
);
GO

/* TABLE: Verkoper */
create table Verkoper
(
    gebruiker       VARCHAR(255)        NOT NULL    PRIMARY KEY,
    bank            VARCHAR(255)        NULL,
    bankrekening    VARCHAR(255)        NULL,
    controleoptie   VARCHAR(255)        NOT NULL,
    creditcard      VARCHAR(255)        NULL,

    CONSTRAINT fk_gebruiker FOREIGN KEY (gebruiker) REFERENCES Gebruiker(gebruikersnaam)
        ON UPDATE CASCADE
        ON DELETE NO ACTION
);
GO

/* TABLE: Bod */
CREATE TABLE Bod
(
    voorwerp        VARCHAR(255)        NOT NULL    PRIMARY KEY,
    bodbedrag       INT                 NOT NULL,
    gebruiker       VARCHAR(255)        NULL,
    boddag          DATE                NULL,
    bodtijd         INT                 NULL
)
GO