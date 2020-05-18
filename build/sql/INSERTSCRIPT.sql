/* ***************************** */
/**  INSERT ADMIN USER           */
/* ***************************** */

use iproject19
go

-- Insert admin user
insert into Users (username, email, password, profilepicture, firstname, lastname, phone, birthdate, address1, address2, postalcode, city, country, trader, complete)
values
('Admin',
 'Administrator@eenmaalandermaal.nl',
 '$2y$10$qYlBcwQ5UC.iX5Mc8TLrnOp6wLRsX5nv5p4VTP2k9jsejO/RkJuJW',
 'upload/profilepictures/8206e9979431e3b726b065fdcdeba9d0.gif',
 'Administrator',
 'Eenmaal',
 '',
 '1997-02-06',
 'Ruitenberglaan 31',
 '',
 '6826 CC',
 'Arnhem',
 6030,
 0,
 1);
GO

insert into Admins (username, pin)
values ('Admin', '$2y$10$vJz60rzBQ.dysrCkZjhgjebfEjvsfpbdGA97HqAMA2ol19vDdVbzK')
GO