/* ***************************** */
/** TEMPORARY CREATESCRIPT FOR DEVELOPMENT */
/** (DOES NOT HAVE FULL FUNCTIONALITY UNLESS DEVELOPED) */
/* ***************************** */
USE iproject19
GO

CREATE TABLE Gebruiker (
    id              INT             NOT NULL    IDENTITY,
    gebruikersnaam  VARCHAR(255)    NOT NULL    UNIQUE,
    emailadres      VARCHAR(255)    NOT NULL,
    wachtwoord      VARCHAR(255)    NOT NULL,

    profielfoto     VARCHAR(255)    NULL,
    voornaam        VARCHAR(255)    NULL,
    achternaam      VARCHAR(255)    NULL,
    geboortedag     DATE            NULL,

    adresregel1     VARCHAR(255)    NULL,
    adresregel2     VARCHAR(255)    NULL,
    postcode        VARCHAR(255)    NULL,
    plaatsnaam      VARCHAR(255)    NULL,
    landnaam        VARCHAR(255)    NULL,
);
GO

CREATE TABLE Rubriek
(
    rubrieknummer   INT             NOT NULL    PRIMARY KEY,
    rubrieknaam     VARCHAR(255)    NOT NULL,
    rubriek         INT             NULL,
    volgnr          INT             NULL,
);
GO