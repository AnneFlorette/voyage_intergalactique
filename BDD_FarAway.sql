#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: USERS
#------------------------------------------------------------

CREATE TABLE USERS(
        user_ID         int (11) Auto_increment  NOT NULL ,
        user_first_name Char (25) ,
        user_last_name  Char (25) ,
        user_mail       Varchar (25) ,
        user_password   Varchar (50) ,
        user_admin      Bool ,
        PRIMARY KEY (user_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TRAVELPRES
#------------------------------------------------------------

CREATE TABLE TRAVELPRES(
        travelpres_ID               int (11) Auto_increment  NOT NULL ,
        travelpres_destination      Char (25) ,
        travelpres_img_url          Varchar (255) ,
        travelpres_description      Varchar (255) ,
        travelpres_destination_time Time ,
        travelpres_nbr_travel       Int NOT NULL ,
        PRIMARY KEY (travelpres_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TRAVEL
#------------------------------------------------------------

CREATE TABLE TRAVEL(
        travel_ID             int (11) Auto_increment  NOT NULL ,
        travel_destination    Char (25) NOT NULL ,
        travel_depart_date    Date ,
        travel_total_places   Int NOT NULL ,
        travel_remain_places  Int NOT NULL ,
        travel_spaceship_type Char (25) NOT NULL ,
        PRIMARY KEY (travel_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: USERSBOOKING
#------------------------------------------------------------

CREATE TABLE USERSBOOKING(
        userbooking_ID           int (11) Auto_increment  NOT NULL ,
        userbooking_booking_date Date NOT NULL ,
        userbooking_nbr_places   Int NOT NULL ,
        PRIMARY KEY (userbooking_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: book
#------------------------------------------------------------

CREATE TABLE book(
        user_ID        Int NOT NULL ,
        userbooking_ID Int NOT NULL ,
        PRIMARY KEY (user_ID ,userbooking_ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relation2
#------------------------------------------------------------

CREATE TABLE relation2(
        userbooking_ID Int NOT NULL ,
        travel_ID      Int NOT NULL ,
        PRIMARY KEY (userbooking_ID ,travel_ID )
)ENGINE=InnoDB;

ALTER TABLE book ADD CONSTRAINT FK_book_user_ID FOREIGN KEY (user_ID) REFERENCES USERS(user_ID);
ALTER TABLE book ADD CONSTRAINT FK_book_userbooking_ID FOREIGN KEY (userbooking_ID) REFERENCES USERSBOOKING(userbooking_ID);
ALTER TABLE relation2 ADD CONSTRAINT FK_relation2_userbooking_ID FOREIGN KEY (userbooking_ID) REFERENCES USERSBOOKING(userbooking_ID);
ALTER TABLE relation2 ADD CONSTRAINT FK_relation2_travel_ID FOREIGN KEY (travel_ID) REFERENCES TRAVEL(travel_ID);
