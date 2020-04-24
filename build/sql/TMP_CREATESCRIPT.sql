/* ***************************** */
/** TEMPORARY CREATESCRIPT FOR DEVELOPMENT */
/** (DOES NOT HAVE FULL FUNCTIONALITY UNLESS DEVELOPED) */
/* ***************************** */
USE iproject19
GO

CREATE TABLE Gebruiker (
    id int identity,
    gebruikersnaam varchar(255),
    emailadres varchar(255),
    wachtwoord varchar(255)
);
GO