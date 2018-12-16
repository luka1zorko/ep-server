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
   Address_Id           int not null auto_increment,
   primary key (Address_Id)
);

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
   UNIQUE (Image_Name),
   primary key (Image_Id)
);

/*==============================================================*/
/* Table: item                                                  */
/*==============================================================*/
create table item
(
   Item_Id              int not null auto_increment,
   Item_Name            varchar(100) not null,
   Item_Price           int,
   UNIQUE (Item_Name),
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
   Customer_User_Id     int not null,
   Salesman_User_Id     int not null,
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
   UNIQUE (Role),
   primary key (Role_Id)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   User_Id              int not null auto_increment,
   Username             varchar(30) not null,
   Address_Id           int,
   Role_Id              int not null,
   User_First_Name      varchar(30) not null,
   User_Last_Name       varchar(30) not null,
   User_Email           varchar(320) not null,
   User_Password        varchar(30) not null,
   User_Phone_Number    varchar(12),
   User_Confirmed       bool,
   UNIQUE (User_Email, User_Phone_Number, Username),
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

alter table receipt add constraint FK_is_customer foreign key (Customer_User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table receipt add constraint FK_is_salesman foreign key (Salesman_User_Id)
      references user (User_Id) on delete restrict on update restrict;

alter table receipt_item add constraint FK_Relationship_11 foreign key (Item_Id)
      references item (Item_Id) on delete restrict on update restrict;

alter table receipt_item add constraint FK_Relationship_12 foreign key (Receipt_Id)
      references receipt (Receipt_Id) on delete restrict on update restrict;

alter table user add constraint FK_has_role foreign key (Role_Id)
      references roles (Role_Id) on delete restrict on update restrict;

alter table user add constraint FK_lives_at foreign key (Address_Id)
      references address (Address_Id) on delete restrict on update restrict;



INSERT INTO address(Postal_Code, City, Street, House_Number) 
VALUES (1000, 'Ljubljana', 'Primorska ulica', 5);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (1000, 'Ljubljana', 'Cesta na Brdo', 9);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (1000, 'Ljubljana', 'Stanetova ulica', 12);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (1000, 'Ljubljana', 'Legatova ulica', 2);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (1000, 'Ljubljana', 'Brdnikova ulica', 18);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (2000, 'Maribor', 'Cesta zmage', 15);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (2000, 'Maribor', 'Puncerjeva ulica', 1);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (8000, 'Novo mesto', 'Kandijska cesta', 3);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (8000, 'Novo mesto', 'Trdinova ulica', 14);

INSERT INTO address(Postal_Code, City, Street, House_Number)  
VALUES (8000, 'Novo mesto', 'Ulica Mirana Jarca', 3);

INSERT INTO address(Postal_Code, City, Street, House_Number, House_Number_Addon)  
VALUES (8000, 'Novo mesto', 'Šmihel', 24, 'A');

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('ASUS Phoenix GeForce GTX 1050 Ti 4GB GDDR5', 169.90);

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('ASUS ROG STRIX RTX2080 O8G GAMING', 1040.40);

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('Intel® Core™ i5-9600K Processor', 310.45);

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('Intel® Core™ i7-9700K Processor', 543.50);

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('Intel® Pentium® Processor G4560', 76.40);

INSERT INTO item(Item_Name, Item_Price)  
VALUES ('SAMSUNG SSD 860 EVO 2.5" SATA III 250GB', 65.42);

INSERT INTO roles(Role_Id, Role)  
VALUES (1, 'Administrator');

INSERT INTO roles(Role_Id, Role)  
VALUES (2, 'Salesman');

INSERT INTO roles(Role_Id, Role)  
VALUES (3, 'Customer');

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id)  
VALUES ('janezek', 'Janez', 'Novak', 'jn@gmail.com', 'p4ssword', 1);

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id)  
VALUES ('ana_hrovat', 'Ana', 'Horvat', 'ah@yahoo.com', 'password', 2);

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id)  
VALUES ('klara_turk', 'Klara', 'Turk', 'kt@blabla.com', 'password', 2);

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id, Address_Id, User_Phone_Number, User_Confirmed) 
VALUES ('luka1.zorko', 'Luka', 'Zorko', 'luka1.zorko@gmail.com', 's4pwv84mhg', 3, 4, '123456789', 1);

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id, Address_Id, User_Phone_Number, User_Confirmed) 
VALUES ('anon', 'Kristjan', 'Reba', 'kristjan.reba96@gmail.com', 'reba', 3, 5, '987654321', 1);

INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
User_Password, Role_Id, Address_Id, User_Phone_Number, User_Confirmed) 
VALUES ('robert_rajh', 'Robert', 'Rajh', 'rr@gmail.com', 'password', 3, 6, '132456789', 0);

INSERT INTO rating(User_Id, Item_Id, Rating)
VALUES (4, 1, 4);

INSERT INTO rating(User_Id, Item_Id, Rating)
VALUES (4, 3, 5);

INSERT INTO rating(User_Id, Item_Id, Rating)
VALUES (5, 2, 5);

INSERT INTO rating(User_Id, Item_Id, Rating)
VALUES (5, 3, 3);

INSERT INTO cart(User_Id, Item_Id)
VALUES (4, 2);

INSERT INTO cart(User_Id, Item_Id)
VALUES (4, 4);

INSERT INTO cart(User_Id, Item_Id)
VALUES (5, 1);

INSERT INTO receipt(Customer_User_Id, Salesman_User_Id)
VALUES (4, 2);

INSERT INTO receipt(Customer_User_Id, Salesman_User_Id)
VALUES (4, 3);

INSERT INTO receipt(Customer_User_Id, Salesman_User_Id)
VALUES (5, 3);

INSERT INTO receipt_item(Receipt_Id, Item_Id)
VALUES (1, 1);

INSERT INTO receipt_item(Receipt_Id, Item_Id)
VALUES (1, 2);

INSERT INTO receipt_item(Receipt_Id, Item_Id)
VALUES (1, 4);

INSERT INTO receipt_item(Receipt_Id, Item_Id)
VALUES (2, 3);

INSERT INTO receipt_item(Receipt_Id, Item_Id)
VALUES (3, 4);

INSERT INTO image(Item_Id, Image_Name, Serial_Number, Image_Path)
VALUES (1, 'Asus_Phoenix_GTX_1050tTi_1.jpeg', 1, '/resources/images');

INSERT INTO image(Item_Id, Image_Name, Serial_Number, Image_Path)
VALUES (1, 'Asus_Phoenix_GTX_1050tTi_2.jpeg', 2, '/resources/images');

INSERT INTO image(Item_Id, Image_Name, Serial_Number, Image_Path)
VALUES (2, 'ASUS_ROG_STRIX_RTX2080_1.jpeg', 1, '/resources/images');
