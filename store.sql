-- shema store
DROP DATABASE IF EXISTS store;
CREATE DATABASE store;
USE store;


-- drop tables if exist
drop table if exists address;
drop table if exists cart;
drop table if exists image;
drop table if exists item;
drop table if exists rating;
drop table if exists receipt;
drop table if exists receipt_item;
drop table if exists roles;
drop table if exists user;

/*==============================================================*/
/* Table: address                                               */
/*==============================================================*/
create table address
(
   Postal_Code          int not null,
   City                 varchar(30) not null,
   Street               varchar(30) not null,
   House_Number         int not null,
   House_Number_Addon   char(1),
   Addres_Id            int not null auto_increment,
   primary key (Addres_Id)
);

alter table address comment '
';

/*==============================================================*/
/* Table: cart                                                  */
/*==============================================================*/
create table cart
(
   User_Id              int not null,
   Item_Id              int not null,
   primary key (User_Id, Item_Id)
);

/*==============================================================*/
/* Table: image                                                 */
/*==============================================================*/
create table image
(
   Image_Id             int not null auto_increment,
   Item_Id              int not null,
   Image_Name           varchar(50) not null,
   Serial_Number        int,
   Image_Path           varchar(200),
   primary key (Image_Id)
);

/*==============================================================*/
/* Table: item                                                  */
/*==============================================================*/
create table item
(
   Item_Id              int not null auto_increment,
   Item_Name            varchar(50) not null,
   Item_Price           int,
   primary key (Item_Id)
);

/*==============================================================*/
/* Table: rating                                                */
/*==============================================================*/
create table rating
(
   User_Id              int not null,
   Item_Id              int not null,
   Rating               int not null,
   primary key (User_Id, Item_Id)
);

/*==============================================================*/
/* Table: receipt                                               */
/*==============================================================*/
create table receipt
(
   Receipt_Id           int not null auto_increment,
   User_Id              int not null,
   use_User_Id          int not null,
   primary key (Receipt_Id)
);

/*==============================================================*/
/* Table: receipt_item                                          */
/*==============================================================*/
create table receipt_item
(
   Item_Id              int not null,
   Receipt_Id           int not null,
   primary key (Item_Id, Receipt_Id)
);

/*==============================================================*/
/* Table: roles                                                 */
/*==============================================================*/
create table roles
(
   Role_Id              int not null,
   Role                 varchar(30) not null,
   primary key (Role_Id)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   User_Id              int not null auto_increment,
   Addres_Id            int,
   Role_Id              int not null,
   User_First_Name      varchar(30) not null,
   User_Last_Name       varchar(30) not null,
   User_Email           varchar(320) not null,
   User_Password        varchar(30) not null,
   User_Phone_Number    varchar(12),
   User_Confirmed       bool,
   primary key (User_Id)
);

alter table cart add constraint FK_cart_has_items foreign key (Item_Id)
      references item (Item_Id) on delete restrict on update restrict;

alter table cart add constraint FK_has_user foreign key (User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table image add constraint FK_image_of foreign key (Item_Id)
      references item (Item_Id) on delete restrict on update restrict;

alter table rating add constraint FK_of_item foreign key (Item_Id)
      references item (Item_Id) on delete restrict on update restrict;

alter table rating add constraint FK_of_user foreign key (User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table receipt add constraint FK_is_customer foreign key (User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table receipt add constraint FK_is_salesman foreign key (use_User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table receipt_item add constraint FK_Relationship_11 foreign key (Item_Id)
      references item (Item_Id) on delete restrict on update restrict;

alter table receipt_item add constraint FK_Relationship_12 foreign key (Receipt_Id)
      references receipt (Receipt_Id) on delete restrict on update restrict;

alter table user add constraint FK_has_role foreign key (Role_Id)
      references roles (Role_Id) on delete restrict on update restrict;

alter table user add constraint FK_lives_at foreign key (Addres_Id)
      references address (Addres_Id) on delete restrict on update restrict;


-- Add some entries to db (hardcoded)
INSERT INTO `item` (Item_Name, Item_Price) VALUES ('Traktor1', 50000);
INSERT INTO `item` (Item_Name, Item_Price) VALUES ('Traktor2', 50000);
INSERT INTO `item` (Item_Name, Item_Price) VALUES ('Traktor3', 50000);
INSERT INTO `item` (Item_Name, Item_Price) VALUES ('Traktor4', 50000);