use iproject19
GO

alter table batchItems drop constraint FK_BatchItems_In_Categorie
GO
alter table batchIllustraties drop constraint [ItemsVoorPlaatje]
GO
drop index IX_Items_Categorie on batchItems
GO
drop index IX_Categorieen_Parent on batchCategorieen
GO
drop table if exists batchUsers
GO
drop table if exists batchCategorieen
GO
drop table if exists batchItems
GO
drop table if exists batchIllustraties
GO
drop table if exists tblIMAOLand
GO