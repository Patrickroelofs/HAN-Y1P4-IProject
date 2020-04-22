use IProject
go

create table bod
(
    voorwerp  BIGINT NOT NULL,
    bodBedrag NUMERIC(6, 2) NOT NULL DEFAULT '0.00',
    gebruiker char(10) NOT NULL,
    bodDag    DATE NOT NULL DEFAULT GETDATE(),
    bodTijdstip TIME(0) DEFAULT convert(TIME, GETDATE()),

    CONSTRAINT pk_voorwerp_bodBedrag PRIMARY KEY(voorwerp, bodBedrag)
)
go