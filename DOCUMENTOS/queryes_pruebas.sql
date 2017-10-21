


<select class="form-control input-lg" name="tipo_institucion">		
'Seleccione el tipo de institucion'

insert into tipo_institucion ('nombre') values 
('Corporaciones Privadas'),('Instituciones Públicas'),('Organizaciones Mixtas'),('Organismos Multilaterales'),('Organizaciones No Gubernamentales'),('Agencias Oficiales'),('Instituciones de Educación Superior'),('Representaciones Diplomáticas')
</select>		

<select name="tipo_alianza" class="form-control input-lg">		
<option value="" selected="selected">Seleccione el tipo de alianza'

insert into tipo_alianza ('nombre') values 
('Marco'),('Especifico')
</select>		

<select name="modalidad" title="Seleccione las modalidades" class="selectpicker form-control input-lg" multiple>		

insert into modalidad ('tipo_alianza_id', 'nombre') values 
(1,'Cooperación Interinstitucional'),(1,'Actividades Científicas y de Cooperación Académica Investigativa'),(2,'Prácticas y Pasantías'),(2,'Movilidad Académica Estudiantil'),(2,'Doble Titulación'),(2,'Docencia-Servicio + ARL'), (2,'Inmersión Universitaria'),(2,'Movilidad Académica de Profesores, Investigadores o Administrativos')

</select>	


<select name="tipo_tramite" id="tipo_tramite" class="form-control input-lg">		
<option selected="selected" disabled="disabled" value="">Seleccione el tipo de trámite'

insert into tipo_tramite ('nombre') values 
('Nueva Alianza'),('Prórroga'),('Modificación'),('Renovación'),('Adición'),('Otro sí'),('Acta de Iniciación'),('Acta de Terminación'),('Carta de Intención')

</select>	

<select class="form-control input-lg" name="repre_tipo_documento">		
'Seleccione el tipo de identificación'

('Cédula de Ciudadanía'),('Cédula de Extranjería'),('Pasaporte')
</select>



<select class="selectpicker form-control input-lg" name="tipos_documentos" title="Seleccione los tipos documentos a cargar" multiple>	

INSERT INTO `clase_documento`(`nombre`) VALUES 
('iniciativa'),('inscripcion'),('institucion'),('oportunidad'),('multimedia');


insert into tipo_documento (nombre, clase_documento_id) values 
('Representación Legal',1),('Acta de Nombramiento',1),('Acta de Posesión',2),('Cédula (C)(E)',2),('Cámara de Comercio',3),('Resolución/Decreto',3),('Personería Jurídica',4),('Carta del Decano(a)',4),('Pre-formas documentos de alianza',5);

</select>		

// query para insertar las revisiones que han hecho los validadores
insert into pasos_alianza (tipo_paso_id,estado_id,user_id,observacion,alianza_id)
values(5,2,6,'prueba 2 observacion de un validador',100)

// query para ver las revisiones que han hecho los validadores
select `pasos_alianza`.*, `estado`.`nombre` from `pasos_alianza` inner join `tipo_paso` on `pasos_alianza`.`tipo_paso_id` = `tipo_paso`.`id` inner join `user_tipo_paso` on `tipo_paso`.`id` = `user_tipo_paso`.`tipo_paso_id` inner join `estado` on `pasos_alianza`.`estado_id` = `estado`.`id` inner join `alianza` on `pasos_alianza`.`alianza_id` = `alianza`.`id` where `tipo_paso`.`nombre` = 'paso5_alianza' and `pasos_alianza`.`alianza_id` = 100 and `pasos_alianza`.`deleted_at` is null order by pasos_alianza.id desc


// query para ver las ultimas revisiones que han hecho los validadores
select `pasos_alianza`.*, `estado`.`nombre` from `pasos_alianza` inner join `tipo_paso` on `pasos_alianza`.`tipo_paso_id` = `tipo_paso`.`id` inner join `user_tipo_paso` on `tipo_paso`.`id` = `user_tipo_paso`.`tipo_paso_id` inner join `estado` on `pasos_alianza`.`estado_id` = `estado`.`id` inner join `alianza` on `pasos_alianza`.`alianza_id` = `alianza`.`id` where `tipo_paso`.`nombre` = 'paso5_alianza' and `pasos_alianza`.`alianza_id` = 100 and `pasos_alianza`.`deleted_at` is null 
and pasos_alianza.id in ( select max(pasos_alianza.id) from pasos_alianza inner join `tipo_paso` on `pasos_alianza`.`tipo_paso_id` = `tipo_paso`.`id` WHERE `tipo_paso`.`nombre` = 'paso5_alianza' and `pasos_alianza`.`alianza_id` = 100 group by pasos_alianza.user_id )

// query para ver la cantidad de registros en cada paso por cada alianza
SELECT `id`, `tipo_paso_id`, count(`tipo_paso_id`) AS conteo_tipo, `estado_id`, `user_id`, `observacion`, `alianza_id` FROM `pasos_alianza` GROUP BY `alianza_id`, `tipo_paso_id` ORDER BY user_id asc, conteo_tipo desc













<select name="unidad_origen" class="form-control input-lg">		
<option value="" selected="selected">Seleccione la Unidad / Oficina / Departamento'

insert into unidad ('nombre') values 
('Administración'),('Artes y Humanidades'),('Arquitectura y Diseño'),('Ciencias Económicas y Administrativas'),('Ciencias Naturales'),('Ciencias Sociales'),('Derecho'),('Educación'),('Ingeniería'),('Medicina'),('Otro')

</select>	



<select name="facultad" title="Seleccione las facultades" class="selectpicker form-control input-lg" multiple>		

insert into facultad ('campus_id', 'nombre') values 
(1,'Administración'),(1,'Artes y Humanidades'),(1,'Arquitectura y Diseño'),(1,'Ciencias Económicas y Administrativas'),(1,'Ciencias Naturales'),(2,'Ciencias Sociales'),(2,'Derecho'),(2,'Educación'),(2,'Ingeniería'),(2,'Medicina')

</select>	


<select name="programa_origen" title="Seleccione los programas" class="selectpicker form-control input-lg" multiple>	


insert into programa ('facultad_id', 'nombre') values 
(1,'Administración'),(1,'Contaduría Internacional'),(1,'Especialización en Administración Financiera'),(1,'Especialización en Negociación'),(1,'Especialización en Gerencia de Abastecimiento Estratégico'),(1,'Especialización en Inteligencia de Mercados'),(1,'Maestría en Investigación en Administración'),(1,'Maestría en Administración (Tiempo Completo)'),(1,'Maestría en Administración (Tiempo Parcial)'),(1,'Maestría en Administración (Ejecutivo - EMBA)'),(1,'Maestría en Finanzas'),(1,'Maestría en Mercadeo'),(1,'Maestría en Gerencia Ambiental'),(1,'Maestría en Gerencia y Práctica del Desarrollo'),(2,'Arquitectura'),(2,'Diseño'),(2,'Maestría en Arquitectura'),(2,'Maestría en Diseño'),(2,'Arte'),(2,'Historia del Arte'),(2,'Literatura'),(2,'Música'),(2,'Especialización en Creación Multimedia'),(2,'Maestría en Literatura'),(2,'Maestría en Periodismo'),(2,'Doctorado en Literatura'),(2,'Biología'),(2,'Microbiología'),(2,'Física'),(2,'Geociencias'),(2,'Matemáticas'),(2,'Química'),(3,'Maestría en Ciencias Biológicas'),(3,'Maestría en Ciencias - Física'),(3,'Maestría en Matemáticas'),(3,'Maestría en Química'),(3,'Doctorado en Ciencias - Biología'),(3,'Doctorado en Ciencias - Física'),(3,'Doctorado en Matemáticas'),(3,'Doctorado en Ciencias Química')
</select>			
		



update pais as pa INNER JOIN (
	SELECT p.id, ca.codigo
    FROM pais AS p inner JOIN capitales AS ca on (p.nombre=ca.pais) 
	order by p.nombre asc, ca.pais asc
    ) as p on (pa.id=p.id)
    set pa.codigo_ref=p.codigo


DELETE pa.* 
from capitales as pa 
WHERE id IN (SELECT id
             FROM (
	SELECT ca.id
    FROM pais AS p inner JOIN capitales AS ca on (p.nombre=ca.pais) 
	order by p.nombre asc, ca.pais asc
   ) x)
   