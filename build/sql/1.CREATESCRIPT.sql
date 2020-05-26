USE iproject19
GO

/* ***************************** */
/**  DROP TABLES AND FUNCTIONS   */
/* ***************************** */

-- Drop tables
-- (Wont work because of foreign key constrains delete manually)
alter table Users drop constraint if exists FK_Users_1
GO
alter table Admins drop constraint if exists FK_Admins_1
GO
alter table Trader drop constraint if exists FK_Trader_1
GO
alter table Items drop constraint if exists FK_Items_1
GO
alter table Items drop constraint if exists FK_Items_2
GO
alter table Items drop constraint if exists FK_Items_3
GO
alter table Files drop constraint if exists FK_Files_1
GO
alter table Feedback drop constraint if exists FK_Feedback_1
GO
alter table Feedback drop constraint if exists FK_Feedback_2
GO
alter table Bids drop constraint if exists FK_Bids_1
GO
alter table Bids drop constraint if exists FK_Bids_2
GO
drop table if exists Admins
GO
drop table if exists Bids
GO
drop table if exists Feedback
GO
drop table if exists Files
GO
drop table if exists ItemsInCategory
GO
drop table if exists Items
GO
drop table if exists Categories
GO
drop table if exists Trader
GO
drop table if exists Users
GO
drop table if exists Country
GO

/* ***************************** */
/**        CREATE TABLES         */
/* ***************************** */



-- ************************************** Country
create table Country
(
  code          char(4)         not null,
  name          varchar(40)     not null,
  startdate     date                null,
  enddate       date                null,
  eer_member    bit             not null,

    -- ***************** Primary Keys
  constraint PK_Country primary key (code)
);
GO





-- ************************************** Categories
create table Categories
(
  id        int             identity    not null,
  name      varchar(255)                not null,
  within    int                             null,

    -- ***************** Primary Keys
  constraint PK_Categories primary key (id)
);
GO





-- ************************************** Users
create table Users
(
    id              int             identity    not null,
    username        varchar(50)                 not null,
    email           varchar(255)                not null,
    password        varchar(255)                not null,
    profilepicture  varchar(255)                    null,
    firstname       varchar(50)                     null,
    lastname        varchar(50)                     null,
    phone           varchar(50)                     null,
    birthdate       DATE                            null,
    address1        varchar(255)                    null,
    address2        varchar(255)                    null,
    postalcode      varchar(50)                     null,
    city            varchar(50)                     null,
    country         char(4)                         null,
    verified        bit                         not null default 0,
    trader          bit                         not null default 0,
    complete        bit                         not null default 0,
    banned          bit                         not null default 0,

    -- ***************** Primary Keys
    constraint PK_Users primary key (username),

    -- ***************** Foreign Keys
    constraint FK_Users_1 foreign key (country) references Country (code)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
);
GO




-- ************************************** Admins
create table Admins
(
    username    varchar(50)         not null,

    -- ***************** Primary Keys
    constraint PK_Admins primary key (username),

    -- ***************** Foreign Keys
    constraint FK_Admins_1 foreign key (username) references Users (username)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);




-- ************************************** Trader
create table Trader
(
    username      varchar(50)                 not null,
    bank          varchar(255)                not null,
    bankaccount   varchar(255)                not null,
    controloption varchar(255)                not null,
    creditcard    varchar(255)                not null,
    activated     bit                         not null,

    -- ***************** Primary Keys
    constraint pk_Trader primary key (username),

    -- ***************** Foreign Keys
    constraint FK_Trader_1 foreign key (username) references Users (username),
);
GO





-- ************************************** Items
create table Items
(
    id                      bigint          identity    not null,
    trader                  varchar(50)                 not null,
    token                   varchar(255)                    null,
    title                   varchar(255)                not null,
    description             varchar(max)                not null,
    thumbnail               varchar(255)                not null,
    category                int                         not null,
    price                   decimal(18,2)               not null,
    paymentname             varchar(50)                 not null,
    paymentinstruction      varchar(255)                    null,
    postalcode              varchar(50)                 not null,
    city                    varchar(50)                 not null,
    country                 char(4)                     not null,
    duration                int                         not null constraint DF_Items_duration default 7,
    durationbegindate       date                        not null constraint DF_Items_durationbegindate default GETDATE(),
    durationbegintime       time                        not null constraint DF_Items_durationbegintime default CURRENT_TIMESTAMP,
    shippingcost            decimal(18,2)               not null constraint DF_Items_shippingcost default 6.75,
    shippinginstructions    varchar(255)                    null,
    durationenddate         date                            null,
    durationendtime         time                            null,
    closed                  bit                         not null constraint DF_Items_closed default 0,
    buyer                   varchar(50)                     null,
    saleprice               decimal(18,2)                   null,
    hidden                  bit                         not null constraint DF_Items_hidden default 0

    -- ***************** Primary Keys
    constraint PK_items primary key (id),

    -- ***************** Foreign Keys
    constraint FK_Items_1 foreign key (category) references Categories (id),
    constraint FK_Items_2 foreign key (trader) references Trader (username)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    constraint FK_Items_3 foreign key (country) references Country (code)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
);
GO


-- ************************************** Files
create table Files
(
    item        bigint          not null,
    filename    varchar(255)    not null,

    -- ***************** Foreign Keys
    constraint FK_Files_1 foreign key (item) references Items (id)
);
GO






-- ************************************** Files
create table Feedback
(
    username    varchar(50)     not null,
    item        bigint          not null,
    review      varchar(50)     not null,
    date        date            not null constraint DF_Feedback_date default GETDATE(),
    time        time            not null constraint DF_Feedback_time default CURRENT_TIMESTAMP,
    comment     varchar(255)        null,

    -- ***************** Foreign Keys
    constraint FK_Feedback_1 foreign key (username) references Trader (username),
    constraint FK_Feedback_2 foreign key (item) references Items (id),

    -- ***************** Checks
    constraint CK_Feedback_review CHECK (review in ('negative', 'neutral', 'positive'))
);
GO






-- ************************************** Bids
create table Bids
(
    username    varchar(50) not null,
    item        bigint          not null,
    amount      decimal(18,2)   not null,
    date        date            not null constraint DF_Bids_date default GETDATE(),
    time        time            not null constraint DF_Bids_time default CURRENT_TIMESTAMP,

    -- ***************** Foreign Keys
    constraint FK_Bids_1 foreign key (item) references Items (id),
    constraint FK_Bids_2 foreign key (username) references Users (username),
);
GO