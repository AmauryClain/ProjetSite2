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
        mbr_birthdate Date NOT NULL ,
        mbr_joinDate  Date NOT NULL ,
        mbr_nickname  Varchar (100)
	,CONSTRAINT membre_PK PRIMARY KEY (mbr_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: music_genre
#------------------------------------------------------------

CREATE TABLE music_genre(
        mgr_id   Int  Auto_increment  NOT NULL ,
        mgr_name Varchar (200) NOT NULL
	,CONSTRAINT music_genre_PK PRIMARY KEY (mgr_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: album
#------------------------------------------------------------

CREATE TABLE album(
        alb_id         Int  Auto_increment  NOT NULL ,
        alb_name       Varchar (300) NOT NULL ,
        alb_createdate Date NOT NULL ,
        grp_id         Int NOT NULL
	,CONSTRAINT album_PK PRIMARY KEY (alb_id)

	,CONSTRAINT album_groupe_FK FOREIGN KEY (grp_id) REFERENCES groupe(grp_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: grp_membre
#------------------------------------------------------------

CREATE TABLE grp_membre(
        mbr_id Int NOT NULL ,
        grp_id Int NOT NULL
	,CONSTRAINT grp_membre_PK PRIMARY KEY (mbr_id,grp_id)

	,CONSTRAINT grp_membre_membre_FK FOREIGN KEY (mbr_id) REFERENCES membre(mbr_id)
	,CONSTRAINT grp_membre_groupe0_FK FOREIGN KEY (grp_id) REFERENCES groupe(grp_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: grp_genre
#------------------------------------------------------------

CREATE TABLE grp_genre(
        grp_id Int NOT NULL ,
        mgr_id Int NOT NULL
	,CONSTRAINT grp_genre_PK PRIMARY KEY (grp_id,mgr_id)

	,CONSTRAINT grp_genre_groupe_FK FOREIGN KEY (grp_id) REFERENCES groupe(grp_id)
	,CONSTRAINT grp_genre_music_genre0_FK FOREIGN KEY (mgr_id) REFERENCES music_genre(mgr_id)
)ENGINE=InnoDB;

