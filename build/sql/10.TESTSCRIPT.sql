/* ***************************** */
/**         TESTSCRIPT           */
/* ***************************** */

USE iproject19
GO
/* ***************************** */
/* TABEL LAND */
/* ***************************** */

/* CHECK FOR:
   CONSTRAINT PK_landnaam        PRIMARY KEY (naam),
 */
insert into iproject19.dbo.Land (code, naam, begindatum, einddatum)
VALUES ('1111', 'Nederland', '02-12-2020', '02-13-2020')

insert into iproject19.dbo.Land (code, naam, begindatum, einddatum)
VALUES ('2222', 'Nederland', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT UQ_code            UNIQUE (code),
 */
insert into Land (code, naam, begindatum, einddatum)
VALUES ('3333', 'Belgie', '02-12-2020', '02-13-2020')

insert into Land (code, naam, begindatum, einddatum)
VALUES ('3333', 'Duitsland', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT CHK_code           CHECK (LEN(code) = 4),
 */
insert into Land (code, naam, begindatum, einddatum)
VALUES ('4444', 'Uganda', '02-12-2020', '02-13-2020')

insert into Land (code, naam, begindatum, einddatum)
VALUES ('555', 'Uganda', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT CH_datum           CHECK (BEGINDATUM < EINDDATUM)
 */
insert into Land (code, naam, begindatum, einddatum)
VALUES ('6666', 'Angola', '02-12-2020', '02-13-2020')

insert into Land (code, naam, begindatum, einddatum)
VALUES ('7777', 'China', '02-13-2020', '02-12-2020')

/* ***************************** */
/* TABEL Gebruiker */
/* ***************************** */

/* CHECK FOR:
   CONSTRAINT PK_gebruiker PRIMARY KEY (gebruikersnaam),
 */
insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord)
VALUES ('Frank', 'frankvisser@hotmail.com', 'wachtwoord')

insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord)
VALUES ('Frank', 'frankvisjes@hotmail.com', 'wachtwoord')



/* CHECK FOR:
   CONSTRAINT UQ_emailadres UNIQUE (emailadres)
 */
 insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord)
VALUES ('FrankLeVisser', 'frankvisjes@hotmail.com', 'wachtwoord')

insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord)
VALUES ('FrankElVissero', 'frankvisjes@hotmail.com', 'wachtwoord')

/* ***************************** */
/* TABEL Rubriek */
/* ***************************** */
/* CHECK FOR:
   CONSTRAINT PK_rubriek PRIMARY KEY (rubrieknummer),
 */
insert into Rubriek (rubrieknummer, rubrieknaam, rubriek) VALUES
    ('1', 'Snoepjes', '-1')

insert into Rubriek (rubrieknummer, rubrieknaam, rubriek) VALUES
    ('1', 'Autos', '-1')

/* ***************************** */
/* TABEL Verkoper */
/* ***************************** */

/* CHECK FOR:
   CONSTRAINT PK_verkoper PRIMARY KEY (gebruikersnaam),
   CONSTRAINT FK_gebruiker FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
   CONSTRAINT CHK_controloptie CHECK (controleoptie = 'Creditcard' OR controleoptie = 'Post')
*/
insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord, profielfoto, voornaam, achternaam, telefoonnummer, geboortedag, adresregel1, adresregel2, postcode, plaatsnaam, landnaam) VALUES
('frankVisser', '', '', '', '', '', '', '', '', '', '', '', '')

insert into Verkoper (gebruikersnaam, bank, bankrekening, controleoptie, creditcard) VALUES
('frankVisser', '', '', 'Creditcard', '')

insert into Verkoper (gebruikersnaam, bank, bankrekening, controleoptie, creditcard) VALUES
('frankVisser', '', '', 'Creditcard', '')

insert into Verkoper (gebruikersnaam, bank, bankrekening, controleoptie, creditcard) VALUES
('frankVisserDeTweede', '', '', '', '')

/* ***************************** */
/* TABEL VoorwerpInRubriek */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_voorwerpnummerRubrieknummer PRIMARY KEY (voorwerpnummer, rubrieknummer),
    CONSTRAINT FK_voorwerpInRubriekVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
    CONSTRAINT FK_rubriekVoorwerpInRubriekRubrieknummer FOREIGN KEY (rubrieknummer) REFERENCES Rubriek (rubrieknummer)
   */
insert into Rubriek (rubrieknummer, rubrieknaam, rubriek) VALUES
    ('1', 'Snoepjes', '-1')

insert into Voorwerp (titel, beschrijving, thumbnail, rubriek, startprijs, betalingswijzenaam, betalingsinstructies, postcode, plaatsnaam, landnaam, looptijd, looptijdbegindag, looptijdbegintijdstip, verzendkosten, verzendinstructies, verkoper, koper, looptijdeindedag, looptijdeindetijdstip, gesloten, verkoopprijs) VALUES
('producttitel',
'productbeschrijving',
 '',
 -1,
 11,
 '',
 '',
 '',
 '',
 '',
 11,
 '',
 '',
 11,
 '',
 '',
 '',
 '',
 '',
 '',
 22)

insert into VoorwerpInRubriek (voorwerpnummer, rubrieknummer) VALUES (1, 1)
insert into VoorwerpInRubriek (voorwerpnummer, rubrieknummer) VALUES (1, 2)

/* ***************************** */
/* TABEL Feedback */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_feedback PRIMARY KEY (voorwerpnummer),
    CONSTRAINT  CHK_verkoper            CHECK (verkoper = 0 OR verkoper = 1),
    CONSTRAINT  CHK_feedbacksoortnaam   CHECK (feedbacksoortnaam = 'negatief' OR feedbacksoortnaam = 'neutraal' OR feedbacksoortnaam = 'positief'),
    CONSTRAINT  FK_FeedbackvoorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
   */

insert into Feedback (voorwerpnummer, verkoper, feedbacksoortnaam, datum, tijdstip, commentaar) VALUES
(1, 0, 'negatief', '08-02-2020', '', 'Hallo wereld!')

insert into Feedback (voorwerpnummer, verkoper, feedbacksoortnaam, datum, tijdstip, commentaar) VALUES
(1, 0, 'negatief', '08-02-2020', '', 'Hallo wereld!')

insert into Feedback (voorwerpnummer, verkoper, feedbacksoortnaam, datum, tijdstip, commentaar) VALUES
(3, 0, 'slecht!', '08-02-2020', '', 'Hallo wereld!')

/* ***************************** */
/* TABEL Bod */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_bod PRIMARY KEY (voorwerpnummer, bodbedrag),
    CONSTRAINT FK_gebruikerGebruikersnaam FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
    CONSTRAINT FK_voorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp(voorwerpnummer)
   */
insert into Gebruiker (gebruikersnaam, emailadres, wachtwoord, profielfoto, voornaam, achternaam, telefoonnummer, geboortedag, adresregel1, adresregel2, postcode, plaatsnaam, landnaam) VALUES
('frankVisser', '', '', '', '', '', '', '', '', '', '', '', '')

insert into Bod (voorwerpnummer, bodbedrag, gebruikersnaam) VALUES
(1, 11, 'FrankVisser')

insert into Bod (voorwerpnummer, bodbedrag, gebruikersnaam) VALUES
(1, 12, 'FrankVisser')

insert into Bod (voorwerpnummer, bodbedrag, gebruikersnaam) VALUES
(30, 12, 'FrankVisser')

insert into Bod (voorwerpnummer, bodbedrag, gebruikersnaam) VALUES
(1, 13, 'frankie')