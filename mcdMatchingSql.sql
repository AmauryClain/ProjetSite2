#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: groupe
#------------------------------------------------------------

CREATE TABLE groupe(
        grp_id         Int  Auto_increment  NOT NULL ,
        grp_name       Varchar (200) NOT NULL ,
        grp_createdate Date ,
        grp_genre      Varchar (150) NOT NULL ,
        grp_img        Text
	,CONSTRAINT groupe_PK PRIMARY KEY (grp_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: membre
#------------------------------------------------------------

CREATE TABLE membre(
        mbr_id        Int  Auto_increment  NOT NULL ,
        mbr_firstName Varchar (100) NOT NULL ,
        mbr_lastName  Varchar (100) NOT NULL ,
        mbr_role      Varchar (70) NOT NULL ,
        mbr_birthdate Date NOT NULL
	,CONSTRAINT membre_PK PRIMARY KEY (mbr_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: joindate
#------------------------------------------------------------

CREATE TABLE joindate(
        jdt_id   Int  Auto_increment  NOT NULL ,
        jdt_date Date NOT NULL
	,CONSTRAINT joindate_PK PRIMARY KEY (jdt_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartenir
#------------------------------------------------------------

CREATE TABLE appartenir(
        mbr_id Int NOT NULL ,
        grp_id Int NOT NULL ,
        jdt_id Int NOT NULL
	,CONSTRAINT appartenir_PK PRIMARY KEY (mbr_id,grp_id,jdt_id)

	,CONSTRAINT appartenir_membre_FK FOREIGN KEY (mbr_id) REFERENCES membre(mbr_id)
	,CONSTRAINT appartenir_groupe0_FK FOREIGN KEY (grp_id) REFERENCES groupe(grp_id)
	,CONSTRAINT appartenir_joindate1_FK FOREIGN KEY (jdt_id) REFERENCES joindate(jdt_id)
)ENGINE=InnoDB;

