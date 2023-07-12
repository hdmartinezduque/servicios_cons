
INSERT INTO `USUARIO`(USUARIO, EMAIL, NOMBRE, APELLIDO, PASSWORD, ESTADO)
VALUES('hmar4317@elpoli.edu.co', 'hmar4317@elpoli.edu.co', 'HERNAN', 'MARTINEZ', '123456', '0');


SELECT PASSWORD FROM `USUARIO` WHERE USUARIO='hd.martinezduque@gmail.com';

SELECT U.ID, U.USUARIO, U.NOMBRE, U.APELLIDO, M.DESCRIPCION AS MENU, MD.DESCRIPCION AS OPCION, MD.PROM FROM PERMISO AS P INNER JOIN MODULO_DETALLE AS MD ON P.ID_MODULO_DETALLE = MD.ID INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
WHERE U.USUARIO = 'AdminSuper';

SELECT DISTINCTROW M.DESCRIPCION, M.PROM FROM PERMISO P INNER JOIN MODULO_DETALLE MD ON P.ID_MODULO_DETALLE = MD.ID  INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID  INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
WHERE U.ID = '5';

UPDATE modulo_detalle SET PROM = CONCAT(PROM,'.php');

select * from USUARIO WHERE ID = 1;

UPDATE usuario SET USUARIO = 'adminsuper@conservarte.com.co' WHERE ID =1;

SELECT U.USUARIO, MD.DESCRIPCION AS MODULO_DETALLE, SMD.DESCRIPCION AS SUB_MODULO_DETALLE, SMD.PROM 
FROM PERMISO_SUB PS INNER JOIN USUARIO U ON PS.ID_USUARIO = U.ID INNER JOIN MODULO_DETALLE MD ON PS.ID_MODULO_DETALLE = MD.ID INNER JOIN SUB_MODULO_DETALLE SMD ON ID_SUB_MODULO_DETALLE = SMD.ID 
WHERE U.ID = '1';

DROP VIEW empleado_desc;

SELECT E.id_empleado
, E.cedula
, fecha_expedicion
, PE.nombre as pais_expedicion
, E.id_pais_expedicion
, DE.nombre as departamento_expedicion
, E.id_departamento
, E.id_lugar_expedicion
, CE.nombre as lugar_expedicion
, E.nombre
, E.apellido
, PN.nombre as pais_nacimiento
, E.id_pais_nacimiento
, DN.nombre as departamento_nacimiento
, E.id_departamento_nacimiento
, E.id_lugar_nacimiento
, CN.nombre as lugar_nacimiento
, E.fecha_nacimiento
, E.fecha_ingreso
, E.id_tipo_contrato
, TC.tipo_contrato
, E.estado
, E.salario
, E.socio
, E.id_area
, A.area
, E.id_oficio
, O.oficio
, EC.estado as estado_civil
, E.id_estado_civil
, E.id_genero
, G.genero
, direccion
, PR.nombre as pais_direccion
, E.id_pais_direccion
, DR.nombre as departamento_direccion
, E.id_departamento_direccion
, E.id_lugar_direccion
, CR.nombre as lugar_direccion
, E.tel_fijo
, E.tel_celular
, E.email
, E.tipo_vivienda
, TV.tipo_vivienda as vivienda
, E.estrato_social
, ES.entidad_salud
, E.id_eps
, EAF.entidad_afp
, E.id_afp
, EAR.entidad_arl
, E.id_arl
, TS.descripcion_sangre
, E.id_tipo_sangre
, E.talla_camisa
, E.talla_pantalon
, E.talla_calzado
, E.imagen_empleado
, E.num_loker
, E.tipo_calzado 
, TiC.calzado
, TIMESTAMPDIFF(YEAR,E.fecha_nacimiento,CURDATE()) AS edad
FROM empleado E 
INNER JOIN area A On E.id_area = A.id 
INNER JOIN oficio O On E.id_oficio = O.id
Inner Join paises PE On E.id_pais_expedicion = PE.id
Inner Join paises PN On E.id_pais_nacimiento = PN.id
Inner Join paises PR On E.id_pais_direccion = PR.id
Inner join departamentos DE on  E.id_departamento = DE.id
Inner join departamentos DN on  E.id_departamento_nacimiento = DN.id
Inner join departamentos DR on  E.id_departamento_direccion = DR.id
Inner join municipios CE on  E.id_lugar_expedicion = CE.id
Inner join municipios CN on  E.id_lugar_nacimiento = CN.id
Inner join municipios CR on  E.id_lugar_direccion = CR.id
Inner join tipo_contrato TC on E.id_tipo_contrato = TC.id 
Inner Join genero G on E.id_genero = G.id
Inner Join estado_civil EC on E.id_estado_civil = EC.id
Inner Join tipo_vivienda TV on E.tipo_vivienda = TV.id
Inner Join entidad_salud ES on E.id_eps = ES.id
Inner Join entidad_afp EAF on E.id_afp = EAF.id
Inner join entidad_arl EAR on E.id_arl = EAR.id
Inner join tipo_sangre TS on E.id_tipo_sangre = TS.id 
Inner Join tipo_calzado TiC on E.tipo_calzado = TiC.id;

SELECT E.id_empleado
, E.cedula
, E.fecha_expedicion
, PE.nombre as pais_expedicion
, E.id_pais_expedicion
, DE.nombre as departamento_expedicion
, E.id_departamento
, E.id_lugar_expedicion
, E.nombre
, E.apellido
, PN.nombre as pais_nacimiento
, E.id_pais_nacimiento
, DN.nombre as departamento_nacimiento
, E.id_departamento_nacimiento
, E.id_lugar_nacimiento
, E.fecha_nacimiento
, E.fecha_ingreso
, E.id_tipo_contrato
, E.estado
, E.salario
, E.socio
, E.id_area
, A.area
, E.id_oficio
, O.oficio
, E.id_genero
, direccion
, PR.nombre as pais_direccion
, E.id_pais_direccion
, DR.nombre as departamento_direccion
, E.id_departamento_direccion
, E.id_lugar_direccion
, E.tel_fijo
, E.tel_celular
, E.email
, E.tipo_vivienda
, E.estrato_social
, E.id_eps
, E.id_afp
, E.id_arl
, E.id_tipo_sangre
, E.talla_camisa
, E.talla_pantalon
, E.talla_calzado
, E.imagen_empleado
, E.num_loker
, E.tipo_calzado 
, CN.nombre as lugar_nacimiento
, CR.nombre as lugar_direccion
, CE.nombre as lugar_expedicion
, DE.nombre as departamento_expedicion
FROM empleado E 
INNER JOIN area A On E.id_area = A.id 
INNER JOIN oficio O On E.id_oficio = O.id
Inner Join paises PE On E.id_pais_expedicion = PE.id
Inner join departamentos DE on  E.id_departamento = DE.id
Inner Join paises PN On E.id_pais_nacimiento = PN.id
Inner join departamentos DN on  E.id_departamento_nacimiento = DN.id
Inner join municipios CN on  E.id_lugar_nacimiento = CN.id
Inner Join paises PR On E.id_pais_direccion = PR.id
Inner join departamentos DR on  E.id_departamento_direccion = DR.id
Inner join municipios CR on  E.id_lugar_direccion = CR.id
Inner join municipios CE on  E.id_lugar_expedicion = CE.id
Inner join departamentos DE on  E.id_departamento = DE.id;


DROP VIEW empleado_desc;
Create View  empleado_desc AS select `E`.`id_empleado` AS `id_empleado`,`E`.`cedula` AS `cedula`,`E`.`fecha_expedicion` AS `fecha_expedicion`,`PE`.`nombre` AS `pais_expedicion`,`E`.`id_pais_expedicion` AS `id_pais_expedicion`,`DE`.`nombre` AS `departamento_expedicion`,`E`.`id_departamento` AS `id_departamento`,`E`.`id_lugar_expedicion` AS `id_lugar_expedicion`,`CE`.`nombre` AS `lugar_expedicion`,`E`.`nombre` AS `nombre`,`E`.`apellido` AS `apellido`,`PN`.`nombre` AS `pais_nacimiento`,`E`.`id_pais_nacimiento` AS `id_pais_nacimiento`,`DN`.`nombre` AS `departamento_nacimiento`,`E`.`id_departamento_nacimiento` AS `id_departamento_nacimiento`,`E`.`id_lugar_nacimiento` AS `id_lugar_nacimiento`,`CN`.`nombre` AS `lugar_nacimiento`,`E`.`fecha_nacimiento` AS `fecha_nacimiento`,`E`.`fecha_ingreso` AS `fecha_ingreso`,`E`.`id_tipo_contrato` AS `id_tipo_contrato`,`TC`.`tipo_contrato` AS `tipo_contrato`,`E`.`estado` AS `estado`,`E`.`salario` AS `salario`,`E`.`socio` AS `socio`,`E`.`id_area` AS `id_area`,`A`.`area` AS `area`,`E`.`id_oficio` AS `id_oficio`,`O`.`oficio` AS `oficio`,`EC`.`estado` AS `estado_civil`,`E`.`id_estado_civil` AS `id_estado_civil`,`E`.`id_genero` AS `id_genero`,`G`.`genero` AS `genero`,`E`.`direccion` AS `direccion`,`PR`.`nombre` AS `pais_direccion`,`E`.`id_pais_direccion` AS `id_pais_direccion`,`DR`.`nombre` AS `departamento_direccion`,`E`.`id_departamento_direccion` AS `id_departamento_direccion`,`E`.`id_lugar_direccion` AS `id_lugar_direccion`,`CR`.`nombre` AS `lugar_direccion`,`E`.`tel_fijo` AS `tel_fijo`,`E`.`tel_celular` AS `tel_celular`,`E`.`email` AS `email`,`E`.`tipo_vivienda` AS `tipo_vivienda`,`TV`.`tipo_vivienda` AS `vivienda`,`E`.`estrato_social` AS `estrato_social`,`ES`.`entidad_salud` AS `entidad_salud`,`E`.`id_eps` AS `id_eps`,`EAF`.`entidad_afp` AS `entidad_afp`,`E`.`id_afp` AS `id_afp`,`EAR`.`entidad_arl` AS `entidad_arl`,`E`.`id_arl` AS `id_arl`,`TS`.`descripcion_sangre` AS `descripcion_sangre`,`E`.`id_tipo_sangre` AS `id_tipo_sangre`,`E`.`talla_camisa` AS `talla_camisa`,`E`.`talla_pantalon` AS `talla_pantalon`,`E`.`talla_calzado` AS `talla_calzado`,`E`.`imagen_empleado` AS `imagen_empleado`,`E`.`num_loker` AS `num_loker`,`E`.`tipo_calzado` AS `tipo_calzado`,`TiC`.`calzado` AS `calzado`,timestampdiff(YEAR,`E`.`fecha_nacimiento`,curdate()) AS `edad` from ((((((((((((((((((((`empleado` `E` join `area` `A` on((`E`.`id_area` = `A`.`id`))) join `oficio` `O` on((`E`.`id_oficio` = `O`.`id`))) join `paises` `PE` on((`E`.`id_pais_expedicion` = `PE`.`id`))) join `paises` `PN` on((`E`.`id_pais_nacimiento` = `PN`.`id`))) join `paises` `PR` on((`E`.`id_pais_direccion` = `PR`.`id`))) join `departamentos` `DE` on((`E`.`id_departamento` = `DE`.`id`))) join `departamentos` `DN` on((`E`.`id_departamento_nacimiento` = `DN`.`id`))) join `departamentos` `DR` on((`E`.`id_departamento_direccion` = `DR`.`id`))) join `municipios` `CE` on((`E`.`id_lugar_expedicion` = `CE`.`id`))) join `municipios` `CN` on((`E`.`id_lugar_nacimiento` = `CN`.`id`))) join `municipios` `CR` on((`E`.`id_lugar_direccion` = `CR`.`id`))) join `tipo_contrato` `TC` on((`E`.`id_tipo_contrato` = `TC`.`id`))) join `genero` `G` on((`E`.`id_genero` = `G`.`id`))) join `estado_civil` `EC` on((`E`.`id_estado_civil` = `EC`.`id`))) join `tipo_vivienda` `TV` on((`E`.`tipo_vivienda` = `TV`.`id`))) join `entidad_salud` `ES` on((`E`.`id_eps` = `ES`.`id`))) join `entidad_afp` `EAF` on((`E`.`id_afp` = `EAF`.`id`))) join `entidad_arl` `EAR` on((`E`.`id_arl` = `EAR`.`id`))) join `tipo_sangre` `TS` on((`E`.`id_tipo_sangre` = `TS`.`id`))) join `tipo_calzado` `TiC` on((`E`.`tipo_calzado` = `TiC`.`id`)));
describe municipios;

select * from empleado where nombre like '%karol%';

SELECT * from municipios where id = 170;

UPDATE modulo_detalle SET PROM = CONCAT(PROM,'.php') where ID = 7;

select CONCAT(PROM,'.php') from modulo_detalle where ID = 7;

describe modulo_detalle;

alter table modulo_detalle modify column PROM VARCHAR(50) NOT NULL;

SELECT DISTINCTROW M.DESCRIPCION, M.PROM FROM PERMISO P INNER JOIN MODULO_DETALLE MD ON P.ID_MODULO_DETALLE = MD.ID  INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID  INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
    WHERE U.ID='1' ORDER BY M.ID DESC;

SELECT U.USUARIO, MD.DESCRIPCION AS MODULO_DETALLE, SMD.DESCRIPCION AS SUB_MODULO_DETALLE, SMD.PROM FROM PERMISO_SUB PS INNER JOIN USUARIO U ON PS.ID_USUARIO = U.ID INNER JOIN MODULO_DETALLE MD ON PS.ID_MODULO_DETALLE = MD.ID INNER JOIN SUB_MODULO_DETALLE SMD ON ID_SUB_MODULO_DETALLE = SMD.ID WHERE U.ID = '1';

SELECT U.USUARIO, U.NOMBRE, U.APELLIDO, M.DESCRIPCION AS MENU, MD.DESCRIPCION AS OPCION, MD.PROM FROM PERMISO AS P INNER JOIN MODULO_DETALLE AS MD ON P.ID_MODULO_DETALLE = MD.ID INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
WHERE U.id='1' ORDER BY M.DESCRIPCION;

SELECT U.USUARIO, MD.DESCRIPCION AS MODULO_DETALLE, SMD.DESCRIPCION AS SUB_MODULO_DETALLE, SMD.PROM FROM PERMISO_SUB PS INNER JOIN USUARIO U ON PS.ID_USUARIO = U.ID INNER JOIN MODULO_DETALLE MD ON PS.ID_MODULO_DETALLE = MD.ID INNER JOIN SUB_MODULO_DETALLE SMD ON ID_SUB_MODULO_DETALLE = SMD.ID WHERE U.ID = 1;

select * from PERMISO;

SELECT 
U.USUARIO
, MD.DESCRIPCION AS MODULO_DETALLE
, SMD.DESCRIPCION AS SUB_MODULO_DETALLE
, SMD.PROM 
FROM PERMISO_SUB PS INNER JOIN USUARIO U ON PS.ID_USUARIO = U.ID INNER JOIN MODULO_DETALLE MD ON PS.ID_MODULO_DETALLE = MD.ID INNER JOIN SUB_MODULO_DETALLE SMD ON ID_SUB_MODULO_DETALLE = SMD.ID 
    WHERE U.ID = '1' AND MD.ID_MODULO = 3
    UNION ALL
SELECT "USUARIO", "CERRAR", "CERRAR", "../process/logout.php"
    ;

SELECT * FROM modulo_detalle;
SELECT * FROM permiso_sub;

INSERT INTO permiso_sub (ID_USUARIO,ID_MODULO_DETALLE, ID_SUB_MODULO_DETALLE)
SELECT 2 AS ID_USUARIO, ID_MODULO_DETALLE, ID_SUB_MODULO_DETALLE FROM permiso_sub WHERE ID NOT IN(5,1);


ALTER Table permiso Add Column leer INT NULL;
ALTER Table permiso Add Column edit INT NULL;

UPDATE permiso SET leer = 0, edit = 0;

SELECT E.id_empleado, DF.nombre, DF.apellido, DF.direccion, DF.telefono, DF.email, DF.contacto
FROM datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id_empleado
WHERE E.cedula = 7121103;

SELECT DF.id_financiero, DF.id_empleado, DF.numero_cuenta, DF.tipo_transaccion, E.nombre, E.apellido 
FROM datos_financieros DF INNER JOIN empleado E 
WHERE E.cedula = 7121103;

SELECT count(DF.id_financiero) CanRegn 
FROM datos_financieros DF INNER JOIN empleado E 
WHERE E.cedula = 7121103;


SELECT E.cedula, E.nombre, E.apellido, M.id_empleado, WEEKOFYEAR(M.fecha_ingreso_real) As Semana, Year(M.fecha_ingreso_real) As ano ,M.fecha_ingreso_real, M.fecha_salida_real, M.fecha_ingreso_ajuste, M.fecha_salida_ajuste
FROM marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado
WHERE E.cedula = 70906783

;

SELECT Distinct Year(M.fecha_ingreso_real) As ano
FROM marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado
WHERE E.cedula = 70906783
;

SELECT Distinct WEEKOFYEAR(M.fecha_ingreso_real) As Semana
FROM marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado
WHERE E.cedula = 70906783 AND Year(M.fecha_ingreso_real)=2019
;

SELECT E.cedula, E.nombre, E.apellido, M.id_empleado, (ELT(WEEKDAY(fecha_ingreso_real) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) As Dia, WEEKOFYEAR(M.fecha_ingreso_real) As Semana, Year(M.fecha_ingreso_real) As ano ,M.fecha_ingreso_real, M.fecha_salida_real, M.fecha_ingreso_ajuste, M.fecha_salida_ajuste
, timestampdiff(SECOND,M.fecha_ingreso_real,M.fecha_salida_real) / 3600 AS Horas
FROM marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado
WHERE E.cedula = 70906783 AND WEEKOFYEAR(M.fecha_ingreso_real) = 12 AND Year(M.fecha_ingreso_real)=2019;

ALTER Table modulo ADD COLUMN orden INT NOT NULL default 0;
ALTER Table permiso_sub 
ADD CONSTRAINT `permiso_sub_modulo_detalle_1` FOREIGN KEY(ID_SUB_MODULO_DETALLE) REFERENCES sub_modulo_detalle(ID) ON UPDATE CASCADE;

ALTER TABLE datos_familiares ADD COLUMN identificacion VARCHAR(64) NOT NULL DEFAULT 0;

Select * 
From datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id


---- USUARIOS / PERMISOS
SELECT per.ID_USUARIO, per.ID_USUARIO, usu.USUARIO, per.ID_MODULO_DETALLE, per.edit 
FROM permiso per INNER JOIN usuario usu WHERE per.ID_USUARIO = usu.ID