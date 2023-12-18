CREATE DATABASE SENATIDB;
USE SENATIDB;

CREATE TABLE sedes
(
idsede		INT AUTO_INCREMENT	PRIMARY KEY,
sede		VARCHAR(80)			NOT NULL,
create_at	DATETIME			NOT NULL DEFAULT NOW(),
inactive_at	DATETIME			NULL,
update_at	DATETIME			NULL,
CONSTRAINT uk_sede_sed UNIQUE (sede)
)
ENGINE=INNODB;

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT
    idsede,
    sede
    FROM sedes
    WHERE inactive_at IS NULL
    ORDER BY sede;
END$$

INSERT INTO sedes
	(sede)
    VALUES
		('Sede Chincha'),
        ('Sede Arequipa'),
        ('Sede Lima'),
        ('Sede Ica');

CREATE TABLE empleados
(
	idempleado		INT AUTO_INCREMENT	PRIMARY KEY,
    idsede			INT					NOT NULL,
    apellidos		VARCHAR(80)			NOT NULL,
    nombres			VARCHAR(80)			NOT NULL,
    nrodocumento	CHAR(8)				NOT NULL,
    fechanac		DATETIME			NOT NULL,
    telefono		CHAR(9)				NULL,
    create_at		DATETIME			NOT NULL DEFAULT NOW(),
    inactive_at		DATETIME			NULL,
    update_at		DATETIME			NULL,
    CONSTRAINT fk_idsede_emp FOREIGN KEY (idsede) REFERENCES sedes(idsede),
    CONSTRAINT uk_nrodocumento_emp UNIQUE (nrodocumento)
)
ENGINE = INNODB;



INSERT INTO empleados
	(idsede,apellidos,nombres,nrodocumento,fechanac,telefono)
    VALUES
    (1,'Quizpe Suarez','Torres Alberto','75461278','2003-12-11',''),
    (2,'Haruno Shiobana','Giornno Giovanna','87542315','2001-08-10','978456123'),
    (3,'Higashikata','Josuke',87542214,'1998-05-12',''),
    (4,'Garido Aldair','Luis Treviño','54216354','1990-10-11','945615784');
   

DELIMITER $$
CREATE PROCEDURE spu_empleados_registrar(
	IN _idsede		INT,
    IN _apellidos	 VARCHAR(80),
    IN _nombres		 VARCHAR(80),
    IN _nrodocumento CHAR(8),
    IN _fechanac	 DATE,
    IN _telefono	CHAR(9)
)
BEGIN
	INSERT INTO empleados
    (idsede,apellidos,nombres,nrodocumento,fechanac,telefono)VALUES
    (_idsede,_apellidos,_nombres,_nrodocumento,_fechanac,_telefono);
END$$
    
CALL spu_empleados_registrar(3,'Ugartechi Zolano','Saravia Luis','78542654','1990-10-11','');

DELIMITER $$
CREATE PROCEDURE spu_empleados_buscar(IN _nrodocumento CHAR(8))
BEGIN
	SELECT
    EMP.idempleado,
    SED.sede,
    EMP.apellidos,
    EMP.nombres,
    EMP.nrodocumento,
    EMP.fechanac,
    EMP.telefono
    FROM empleados EMP
    INNER JOIN sedes SED ON SED.idsede = EMP.idsede
    WHERE (EMP.inactive_at IS NULL) AND
		  (EMP.nrodocumento =_nrodocumento);
END$$

DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
BEGIN
    SELECT
        sed.sede,
        emp.apellidos,
        emp.nombres,
        emp.nrodocumento,
        emp.fechanac,
        emp.telefono
    FROM empleados emp
    INNER JOIN sedes sed ON emp.idsede = sed.idsede
    WHERE emp.inactive_at IS NULL 
    ORDER BY emp.apellidos;
END$$

DELIMITER $$
CREATE PROCEDURE spu_empleados_listartabla()
BEGIN
    SELECT
        sed.sede,
        emp.apellidos,
        emp.nombres,
        emp.nrodocumento,
        emp.fechanac,
        emp.telefono
    FROM empleados emp
    INNER JOIN sedes sed ON emp.idsede = sed.idsede
    WHERE emp.inactive_at IS NULL 
    ORDER BY emp.apellidos;
END$$

