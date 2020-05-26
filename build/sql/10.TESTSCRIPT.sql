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
insert into Country (code, name, startdate, enddate)
VALUES ('1111', 'Nederland', '02-12-2020', '02-13-2020')

insert into Country (code, name, startdate, enddate)
VALUES ('2222', 'Nederland', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT UQ_code            UNIQUE (code),
 */
insert into Country (code, name, startdate, enddate)
VALUES ('3333', 'Belgie', '02-12-2020', '02-13-2020')

insert into Country (code, name, startdate, enddate)
VALUES ('3333', 'Duitsland', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT CHK_code           CHECK (LEN(code) = 4),
 */
insert into Country (code, name, startdate, enddate)
VALUES ('4444', 'Uganda', '02-12-2020', '02-13-2020')

insert into Country (code, name, startdate, enddate)
VALUES ('555', 'Uganda', '02-12-2020', '02-13-2020')



/* CHECK FOR:
   CONSTRAINT CH_datum           CHECK (BEGINDATUM < EINDDATUM)
 */
insert into Country (code, name, startdate, enddate)
VALUES ('6666', 'Angola', '02-12-2020', '02-13-2020')

insert into Country (code, name, startdate, enddate)
VALUES ('7777', 'China', '02-13-2020', '02-12-2020')

/* ***************************** */
/* TABEL Gebruiker */
/* ***************************** */

/* CHECK FOR:
   CONSTRAINT PK_gebruiker PRIMARY KEY (gebruikersnaam),
 */
insert into Users (username, email, password)
VALUES ('Frank', 'frankvisser@hotmail.com', 'wachtwoord')

insert into Users (username, email, password)
VALUES ('Frank', 'frankvisjes@hotmail.com', 'wachtwoord')



/* CHECK FOR:
   CONSTRAINT UQ_emailadres UNIQUE (emailadres)
 */
insert into Users (username, email, password)
VALUES ('FrankLeVisser', 'frankvisjes@hotmail.com', 'wachtwoord')

insert into Users (username, email, password)
VALUES ('FrankElVissero', 'frankvisjes@hotmail.com', 'wachtwoord')

/* ***************************** */
/* TABEL Rubriek */
/* ***************************** */
/* CHECK FOR:
   CONSTRAINT PK_rubriek PRIMARY KEY (rubrieknummer),
 */
insert into Categories (id, name, within) VALUES
    ('1', 'Snoepjes', '-1')

insert into Categories (id, name, within) VALUES
    ('1', 'Autos', '-1')

/* ***************************** */
/* TABEL Verkoper */
/* ***************************** */

/* CHECK FOR:
   CONSTRAINT PK_verkoper PRIMARY KEY (gebruikersnaam),
   CONSTRAINT FK_gebruiker FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
   CONSTRAINT CHK_controloptie CHECK (controleoptie = 'Creditcard' OR controleoptie = 'Post')
*/
insert into Users (username, email, password, profilepicture, firstname, lastname, phone, birthdate, address1, address2, postalcode, city, country) VALUES
('frankVisser', '', '', '', '', '', '', '', '', '', '', '', '')

insert into Trader (username, bank, bankaccount, controloption, creditcard, activated) VALUES
('frankVisser', '', '', 'Creditcard', '', 1)

insert into Trader (username, bank, bankaccount, controloption, creditcard, activated) VALUES
('frankVisser', '', '', 'Creditcard', '', 1)

insert into Trader (username, bank, bankaccount, controloption, creditcard, activated) VALUES
('frankVisserDeTweede', '', '', '', '', 1)

/* ***************************** */
/* TABEL VoorwerpInRubriek */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_voorwerpnummerRubrieknummer PRIMARY KEY (voorwerpnummer, rubrieknummer),
    CONSTRAINT FK_voorwerpInRubriekVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
    CONSTRAINT FK_rubriekVoorwerpInRubriekRubrieknummer FOREIGN KEY (rubrieknummer) REFERENCES Rubriek (rubrieknummer)
   */
insert into Categories (id, name, within) VALUES
    ('1', 'Snoepjes', '-1')

insert into Items (title, description, thumbnail, category, price, paymentname, paymentinstruction, postalcode, city, country, duration, durationbegindate, durationbegintime, shippingcost, shippinginstructions, trader, buyer, durationenddate, durationendtime, closed, saleprice) VALUES
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
 22);

/* ***************************** */
/* TABEL Feedback */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_feedback PRIMARY KEY (voorwerpnummer),
    CONSTRAINT  CHK_verkoper            CHECK (verkoper = 0 OR verkoper = 1),
    CONSTRAINT  CHK_feedbacksoortnaam   CHECK (feedbacksoortnaam = 'negatief' OR feedbacksoortnaam = 'neutraal' OR feedbacksoortnaam = 'positief'),
    CONSTRAINT  FK_FeedbackvoorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp (voorwerpnummer)
   */

insert into Feedback (username, item, review, date, time, comment) VALUES
('pim', 0, 'negatief', '08-02-2020', '', 'Hallo wereld!')

insert into Feedback (username, item, review, date, time, comment) VALUES
('pim', 0, 'negatief', '08-02-2020', '', 'Hallo wereld!')

insert into Feedback (username, item, review, date, time, comment) VALUES
('pim', 0, 'slecht!', '08-02-2020', '', 'Hallo wereld!')

/* ***************************** */
/* TABEL Bod */
/* ***************************** */
/* CHECK FOR:
    CONSTRAINT PK_bod PRIMARY KEY (voorwerpnummer, bodbedrag),
    CONSTRAINT FK_gebruikerGebruikersnaam FOREIGN KEY (gebruikersnaam) REFERENCES Gebruiker(gebruikersnaam)
    CONSTRAINT FK_voorwerpVoorwerpnummer FOREIGN KEY (voorwerpnummer) REFERENCES Voorwerp(voorwerpnummer)
   */
insert into Users (username, email, password, profilepicture, firstname, lastname, phone, birthdate, address1, address2, postalcode, city, country) VALUES
('frankVisser', '', '', '', '', '', '', '', '', '', '', '', '')

insert into Bids (item, amount, username) VALUES
(1, 11, 'FrankVisser')

insert into Bids (item, amount, username) VALUES
(1, 12, 'FrankVisser')

insert into Bids (item, amount, username) VALUES
(30, 12, 'FrankVisser')

insert into Bids (item, amount, username) VALUES
(1, 13, 'frankie')