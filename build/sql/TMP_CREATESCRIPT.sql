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
    voorwerpnummer          NUMERIC(10)   NOT NULL PRIMARY KEY,
    titel                   CHAR(18)      NOT NULL,
    beschrijving            CHAR(10)      NOT NULL,
    startprijs              CHAR(5)       NOT NULL,
    betalingswijzenaam      CHAR(9)       NOT NULL,
    betalingsinstructie     VARCHAR(255)  NULL,
    plaatsnaam              CHAR(12)      NOT NULL,
    landnaam                CHAR(9)       NOT NULL,
    looptijd                INT           NOT NULL,
    looptijdbegindag        DATE          NOT NULL,
    looptijdbegintijdstip   TIME(0)       NOT NULL DEFAULT CONVERT(TIME, GETDATE()),
    verzendkosten           CHAR(27)      NULL,
    verzendinstructies      CHAR(27)      NULL,
    verkopersgebruikersnaam VARCHAR(255)  NOT NULL,
    kopersgebruikersnaam    VARCHAR(255)  NOT NULL,
    looptijdeindedag        DATE          NOT NULL,
    looptijdeindetijdstip   TIME(0)       NOT NULL DEFAULT CONVERT(TIME, GETDATE()),
    veilinggesloten         BIT           NOT NULL,
    verkoopprijs            NUMERIC(8, 2) NOT NULL,
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
    bodbedrag       INT                 NOT NULL    PRIMARY KEY,
    gebruiker       VARCHAR(255)        NULL,
    boddag          DATE                NULL,
    bodtijd         INT                 NULL
)
GO
