-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-01-2019 a las 08:40:28
-- Versión del servidor: 5.6.39-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `databaseomg3`
--

DELIMITER $$
--
-- Procedimientos
--
$$

$$

$$

$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_contrato`
--

CREATE TABLE `asignaciones_contrato` (
  `ID_ASIGNACION` int(11) NOT NULL,
  `CLAVE_CONTRATO` text CHARACTER SET latin1 COLLATE latin1_bin,
  `REGION_FISCAL` text CHARACTER SET latin1 COLLATE latin1_bin,
  `CONTRATO` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_tema_requisito`
--

CREATE TABLE `asignacion_tema_requisito` (
  `ID_ASIGNACION_TEMA_REQUISITO` int(11) NOT NULL,
  `ID_DOCUMENTO` int(11) DEFAULT NULL,
  `ID_TEMA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_tema_requisito_requisitos`
--

CREATE TABLE `asignacion_tema_requisito_requisitos` (
  `ID_ASIGNACION_TEMA_REQUISITO` int(11) NOT NULL,
  `ID_REQUISITO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoridad_remitente`
--

CREATE TABLE `autoridad_remitente` (
  `ID_AUTORIDAD` int(11) NOT NULL,
  `CLAVE_AUTORIDAD` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `DESCRIPCION` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `DIRECCION` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `TELEFONO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `EXTENSION` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `EMAIL` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `DIRECCION_WEB` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_produccion`
--

CREATE TABLE `catalogo_produccion` (
  `ID_CATALOGOP` int(11) NOT NULL,
  `UBICACION` text CHARACTER SET latin1 COLLATE latin1_bin,
  `TAG_PATIN` text CHARACTER SET latin1 COLLATE latin1_bin,
  `TIPO_MEDIDOR` text CHARACTER SET latin1 COLLATE latin1_bin,
  `TAG_MEDIDOR` text CHARACTER SET latin1 COLLATE latin1_bin,
  `CLASIFICACION` text CHARACTER SET latin1 COLLATE latin1_bin,
  `HIDROCARBURO` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ID_ASIGNACION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_reportes`
--

CREATE TABLE `concepto_reportes` (
  `ID_CONCEPTO_REPORTES` int(11) NOT NULL,
  `CONCEPTO` text CHARACTER SET latin1 COLLATE latin1_bin,
  `VISTA` text CHARACTER SET latin1 COLLATE latin1_bin,
  `CUMPLIMIENTOS` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concepto_reportes`
--

INSERT INTO `concepto_reportes` (`ID_CONCEPTO_REPORTES`, `CONCEPTO`, `VISTA`, `CUMPLIMIENTOS`) VALUES
(1, 'Producción', 'Catalogo_Produccion', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimientos`
--

CREATE TABLE `cumplimientos` (
  `ID_CUMPLIMIENTO` int(11) NOT NULL,
  `CLAVE_CUMPLIMIENTO` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `CUMPLIMIENTO` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `idRamaPrincipal` int(11) DEFAULT NULL,
  `AYUDA_TRIGGER` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '-2' COMMENT 'el ayuda trigger es el id del usuario ',
  `MODO_TRABAJO` int(11) DEFAULT '0' COMMENT 'ESTA COLUMNA SE ENCARGA DE INDICAR SI SE LE PODRA DEFINIR EN GENERAL FECHAS DE INICIO  POR BLOQUES MASIVOS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cumplimientos`
--

INSERT INTO `cumplimientos` (`ID_CUMPLIMIENTO`, `CLAVE_CUMPLIMIENTO`, `CUMPLIMIENTO`, `idRamaPrincipal`, `AYUDA_TRIGGER`, `MODO_TRABAJO`) VALUES
(1, 'TEMATICA 1', 'TEMATICA 1', NULL, '1', 0),
(2, 'TEMATICA 2', 'TEMATICA 2', NULL, '1', 0),
(3, 'TEMATICA 3', 'TEMATICA 3', NULL, '1', 0);

--
-- Disparadores `cumplimientos`
--
DELIMITER $$
CREATE TRIGGER `cumplimientos_after_insert` AFTER INSERT ON `cumplimientos` FOR EACH ROW BEGIN
UPDATE usuarios set usuarios.AYUDA_TRIGGER=(new.ID_CUMPLIMIENTO);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cumplimientos_after_update` AFTER UPDATE ON `cumplimientos` FOR EACH ROW BEGIN

CALL `update_usuarios_cumplimientos`(new.AYUDA_TRIGGER, new.ID_CUMPLIMIENTO);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimientos_estructura`
--

CREATE TABLE `cumplimientos_estructura` (
  `ID_CUMPLIMIENTO` int(11) NOT NULL,
  `ID_ESTRUCTURA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `ID_DOCUMENTO` int(11) NOT NULL,
  `CLAVE_DOCUMENTO` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `DOCUMENTO` varchar(1000) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `CONTRATO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `documentos`
--
DELIMITER $$
CREATE TRIGGER `documentos_after_insert` AFTER INSERT ON `documentos` FOR EACH ROW BEGIN

 INSERT INTO validacion_documento SET validacion_documento.id_validacion_documento =
 (
 	SELECT IFNULL( max(tbvalidacion.id_validacion_documento)+1,0) 
	 as aliasid_validacion_documento 
	 from  validacion_documento tbvalidacion),
 validacion_documento.id_documento=(new.ID_DOCUMENTO);
 
 


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_dir`
--

CREATE TABLE `documento_dir` (
  `ID_DOCUMENTO_ENTRADA` int(11) NOT NULL,
  `DIR` varchar(200) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_entrada`
--

CREATE TABLE `documento_entrada` (
  `ID_CUMPLIMIENTO` int(11) NOT NULL,
  `ID_DOCUMENTO_ENTRADA` int(11) NOT NULL,
  `FOLIO_REFERENCIA` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `FOLIO_ENTRADA` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `FECHA_RECEPCION` date DEFAULT NULL,
  `ASUNTO` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `REMITENTE` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ID_TEMA` int(11) NOT NULL,
  `ID_AUTORIDAD` int(11) NOT NULL,
  `CLASIFICACION` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `STATUS_DOC` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL COMMENT '1: en proceso,2:suspendido,3:terminado',
  `FECHA_ASIGNACION` date DEFAULT NULL,
  `FECHA_LIMITE_ATENCION` date DEFAULT NULL,
  `FECHA_ALARMA` date DEFAULT NULL,
  `DOCUMENTO` varchar(200) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `OBSERVACIONES` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `MENSAJE_ALERTA` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Disparadores `documento_entrada`
--
DELIMITER $$
CREATE TRIGGER `documento_entrada_before_delete` BEFORE DELETE ON `documento_entrada` FOR EACH ROW BEGIN

delete from seguimiento_entrada where seguimiento_entrada.ID_DOCUMENTO_ENTRADA=(old.ID_DOCUMENTO_ENTRADA);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_salida`
--

CREATE TABLE `documento_salida` (
  `ID_DOCUMENTO_SALIDA` int(11) NOT NULL,
  `ID_DOCUMENTO_ENTRADA` int(11) DEFAULT NULL,
  `FOLIO_SALIDA` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `FECHA_ENVIO` date DEFAULT NULL,
  `ASUNTO` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `DESTINATARIO` varchar(150) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `OBSERVACIONES` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ID_CUMPLIMIENTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_salida_sinfolio_entrada`
--

CREATE TABLE `documento_salida_sinfolio_entrada` (
  `ID_DOCUMENTO_SALIDA` int(11) NOT NULL,
  `ID_DOCUMENTO_ENTRADA` varchar(50) COLLATE latin1_bin NOT NULL DEFAULT '-1',
  `FOLIO_ENTRADA` varchar(50) COLLATE latin1_bin NOT NULL,
  `FOLIO_SALIDA` varchar(45) COLLATE latin1_bin DEFAULT NULL,
  `ID_EMPLEADO` varchar(50) COLLATE latin1_bin DEFAULT '',
  `FECHA_ENVIO` date DEFAULT NULL,
  `ASUNTO` varchar(150) COLLATE latin1_bin DEFAULT NULL,
  `DESTINATARIO` varchar(150) COLLATE latin1_bin DEFAULT NULL,
  `ID_AUTORIDAD` varchar(50) COLLATE latin1_bin DEFAULT '',
  `OBSERVACIONES` varchar(500) COLLATE latin1_bin DEFAULT NULL,
  `ID_CUMPLIMIENTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `ID_EMPLEADO` int(11) NOT NULL,
  `NOMBRE_EMPLEADO` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `CATEGORIA` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `APELLIDO_PATERNO` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `APELLIDO_MATERNO` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `CORREO` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `FECHA_CREACION` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IDENTIFICADOR` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID_EMPLEADO`, `NOMBRE_EMPLEADO`, `CATEGORIA`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `CORREO`, `FECHA_CREACION`, `IDENTIFICADOR`) VALUES
(0, 'SIN RESPONSABLE', '', '', '', '', '2018-05-09 19:50:17', 'catalogo'),
(1, 'Carolina', 'No aplica', 'Dávila', 'Ruíz', 'davila.carolina@gmail.com', '2018-11-28 18:54:09', 'tareas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estructura`
--

CREATE TABLE `estructura` (
  `ID_ESTRUCTURA` int(11) NOT NULL,
  `ID_SUBMODULOS` int(11) NOT NULL,
  `ID_VISTAS` int(11) NOT NULL,
  `DESCRIPCION` varchar(95) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `AYUDATRIGGER` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `VISTA_NOMBRE_LOGICO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `NOMBRE_CONTENIDO_DENTRO_SUBMODULOS` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `IMAGEN_SECCION_UP` text CHARACTER SET latin1 COLLATE latin1_bin,
  `IMAGEN_SECCION_IZQUIERDA` text CHARACTER SET latin1 COLLATE latin1_bin,
  `ORDENAR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estructura`
--

INSERT INTO `estructura` (`ID_ESTRUCTURA`, `ID_SUBMODULOS`, `ID_VISTAS`, `DESCRIPCION`, `AYUDATRIGGER`, `VISTA_NOMBRE_LOGICO`, `NOMBRE_CONTENIDO_DENTRO_SUBMODULOS`, `IMAGEN_SECCION_UP`, `IMAGEN_SECCION_IZQUIERDA`, `ORDENAR`) VALUES
(0, 7, 17, 'Tareas-Personal', '1', 'Empleados', 'Gestión de Temas Especiales', 'tareas.png', 'si', 13),
(2, 2, 6, 'Catalogo-Personal', '1', 'Empleados', 'Información', 'catalogo.png', 'si', 1),
(3, 2, 2, 'Catalogo-Temas', '1', 'Temas', 'Información', 'catalogo.png', 'si', 2),
(4, 2, 5, 'Catalogo-Documentos', '1', 'Documentos', 'Información', 'catalogo.png', 'si', 3),
(5, 2, 1, 'Catalogo-Asignacion Tema Requisito', '1', 'Asignacion Tema Requisito', 'Información', 'catalogo.png', 'si', 4),
(6, 3, 13, 'Cumplimientos-Validacion', '1', 'Validacion', 'Validación', 'documentos.png', 'undefined', 5),
(7, 3, 11, 'Cumplimientos-Evidencias', '1', 'Evidencias', 'Evidencias', 'operaciones.png', 'undefined', 6),
(8, 3, 0, 'Cumplimientos-Informe Validacion', '1', 'Informe Validacion', 'Informe', 'informe.png', 'si', 7),
(9, 5, 6, 'Oficios-Personal', '1', 'Empleados', 'Catálogos', 'catalogos.png', 'si', 15),
(10, 5, 7, 'Oficios-Autoridad Remitente', '1', 'Autoridad Remitente', 'Catálogos', 'catalogos.png', 'si', 16),
(11, 5, 2, 'Oficios-Temas', '1', 'Temas', 'Catálogos', 'catalogos.png', 'si', 17),
(12, 5, 3, 'Oficios-Documento Entrada', '1', 'Documento Entrada', 'Documentación', 'oficios.png', 'si', 18),
(13, 5, 4, 'Oficios-Documento Salida', '1', 'Documento Salida', 'Documentación', 'oficios.png', 'si', 19),
(14, 5, 12, 'Oficios-Seguimiento Entrada', '1', 'Seguimiento Entrada', 'Seguimiento', '663.png', 'undefined', 20),
(15, 5, 9, 'Oficios-Informe Gerencial', '1', 'Informe Gerencial', 'Informe Gerencial', 'seguimiento.png', 'undefined', 21),
(16, 6, 14, 'Usuario-Permisos', '1', 'Permisos', 'Bienvenido', 'user.png', 'si', 22),
(17, 7, 15, 'Tareas-Registro Temas', '1', 'Carga Programa Gantt', 'Gestión de Temas Especiales', 'tareas.png', 'si', 14),
(18, 8, 21, 'Procesos-Catalogo', '1', 'Catalogo', 'Reportes', 'procesos.png', 'si', 10),
(19, 3, 18, 'Cumplimientos-Informe Evidencias', '1', 'Informe Evidencias', 'Informe', 'documentos.jpg', 'si', 8),
(20, 3, 19, 'Cumplimientos-Informe Consultas', '1', 'Informe Consultas', 'Informe', 'documentos.jpg', 'si', 9),
(21, 6, 20, 'Usuario-Personalizar', '1', 'Ajustes', 'Bienvenido', 'user.png', 'si', 23),
(22, 8, 22, 'Procesos-Reporte', '1', 'Reporte', 'Reportes', 'procesos.png', 'si', 11),
(23, 8, 23, 'Procesos-Generador', '1', 'Generador', 'Reportes', 'procesos.png', 'si', 12),
(24, 6, 24, 'Usuario-Control Temas', '1', 'Control', 'Bienvenido', 'controlTemas.png', 'si', 24);

--
-- Disparadores `estructura`
--
DELIMITER $$
CREATE TRIGGER `estructura_after_insert` AFTER UPDATE ON `estructura` FOR EACH ROW call insertar_a_usuarios_vista_validando_que_no_existan_ya_ingresado(new.AYUDATRIGGER,new.ID_ESTRUCTURA)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estructura_responsable_contrato`
--

CREATE TABLE `estructura_responsable_contrato` (
  `ID_USUARIO_EMPLEADO` int(11) NOT NULL,
  `ID_CUMPLIMIENTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencias`
--

CREATE TABLE `evidencias` (
  `ID_EVIDENCIAS` int(11) NOT NULL,
  `ID_REGISTRO` int(11) NOT NULL,
  `ID_USUARIO` int(10) NOT NULL,
  `FECHA_VALIDACION` datetime DEFAULT '0000-00-00 00:00:00',
  `DESVIACION` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '',
  `ACCION_CORRECTIVA` text CHARACTER SET latin1 COLLATE latin1_bin,
  `VALIDACION_SUPERVISOR` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `PLAN_ACCION` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '-1',
  `FECHA_CREACION` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gantt_evidencias`
--

CREATE TABLE `gantt_evidencias` (
  `id` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `progress` float NOT NULL,
  `parent` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `id_evidencias` int(11) NOT NULL,
  `ponderado_programado` float NOT NULL DEFAULT '-1',
  `notas` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gantt_notas_historico_temas`
--

CREATE TABLE `gantt_notas_historico_temas` (
  `idgantt_notas_historico` int(11) NOT NULL,
  `id_tarea` varchar(50) COLLATE latin1_bin NOT NULL DEFAULT '0',
  `historico_notas` text COLLATE latin1_bin,
  `quien_introdujo_el_registro` varchar(45) COLLATE latin1_bin NOT NULL,
  `fecha_creacion_nota` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gantt_seguimiento_entrada`
--

CREATE TABLE `gantt_seguimiento_entrada` (
  `ID_GANTT` varchar(50) NOT NULL,
  `ID_SEGUIMIENTO_ENTRADA` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gantt_tareas`
--

CREATE TABLE `gantt_tareas` (
  `id` varchar(55) COLLATE latin1_bin NOT NULL DEFAULT '',
  `text` varchar(255) COLLATE latin1_bin DEFAULT '',
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `progress` float NOT NULL,
  `parent` varchar(45) COLLATE latin1_bin NOT NULL,
  `user` varchar(45) COLLATE latin1_bin NOT NULL,
  `ID_TAREA` int(11) NOT NULL,
  `ponderado_programado` float NOT NULL DEFAULT '-1',
  `notas` text COLLATE latin1_bin NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `notificacion_porcentaje_programado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gantt_tasks`
--

CREATE TABLE `gantt_tasks` (
  `id` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `progress` float NOT NULL,
  `parent` varchar(50) NOT NULL,
  `ponderado_programado` float NOT NULL DEFAULT '-1',
  `notas` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_gerencial`
--

CREATE TABLE `informe_gerencial` (
  `ID_INFORME_GERENCIAL` int(11) NOT NULL,
  `ID_DOCUMENTO_ENTRADA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `ID_MODULOS` int(11) NOT NULL,
  `NOMBRE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`ID_MODULOS`, `NOMBRE`) VALUES
(1, 'OMG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `ID_NOTIFICACIONES` int(11) NOT NULL,
  `ID_DE` int(10) NOT NULL,
  `ID_PARA` int(10) NOT NULL,
  `ID_CONTRATO` int(11) DEFAULT NULL,
  `TIPO_MENSAJE` int(11) NOT NULL,
  `MENSAJE` text CHARACTER SET latin1 COLLATE latin1_bin,
  `ATENDIDO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `FECHA_ENVIO` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ASUNTO` text CHARACTER SET latin1 COLLATE latin1_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `omg_reporte_produccion`
--

CREATE TABLE `omg_reporte_produccion` (
  `ID_REPORTE` int(11) NOT NULL,
  `OMGC1` date NOT NULL,
  `OMGC2` double NOT NULL DEFAULT '0',
  `OMGC3` double NOT NULL DEFAULT '0',
  `OMGC4` double NOT NULL DEFAULT '0',
  `OMGC5` double NOT NULL DEFAULT '0',
  `OMGC6` double NOT NULL DEFAULT '0',
  `OMGC7` double NOT NULL DEFAULT '0',
  `OMGC8` double NOT NULL DEFAULT '0',
  `OMGC9` double NOT NULL DEFAULT '0',
  `OMGC10` double NOT NULL DEFAULT '0',
  `OMGC11` double NOT NULL DEFAULT '0',
  `OMGC12` double NOT NULL DEFAULT '0',
  `OMGC13` double NOT NULL DEFAULT '0',
  `OMGC14` double NOT NULL DEFAULT '0',
  `OMGC15` double NOT NULL DEFAULT '0',
  `OMGC16` double NOT NULL DEFAULT '0',
  `OMGC17` text,
  `OMGC18` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_CATALOGOP` int(11) DEFAULT NULL,
  `USUARIO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermisos` int(11) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `Agregar` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0',
  `Eliminar` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0',
  `Modificar` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0',
  `Consultar` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermisos`, `descripcion`, `Agregar`, `Eliminar`, `Modificar`, `Consultar`) VALUES
(5, 'SuperAdministrador', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes_molares`
--

CREATE TABLE `porcentajes_molares` (
  `ID_PORCENTAJE` int(11) NOT NULL,
  `MES` int(2) UNSIGNED ZEROFILL NOT NULL,
  `ANO` text NOT NULL,
  `OMG2C1` double NOT NULL DEFAULT '0',
  `OMG2C2` double NOT NULL DEFAULT '0',
  `OMG2C3` double NOT NULL DEFAULT '0',
  `OMG2C4` double NOT NULL DEFAULT '0',
  `OMG2C5` double NOT NULL DEFAULT '0',
  `OMG2C6` double NOT NULL DEFAULT '0',
  `OMG2C7` double NOT NULL DEFAULT '0',
  `OMG2C8` double NOT NULL DEFAULT '0',
  `OMG2C9` double NOT NULL DEFAULT '0',
  `OMG2C10` double NOT NULL DEFAULT '0',
  `OMG2C11` double NOT NULL DEFAULT '0',
  `CONTRATO` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramaprincipal`
--

CREATE TABLE `ramaprincipal` (
  `idRamaPrincipal` int(11) NOT NULL,
  `Descripcion` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `ID_REGISTRO` int(11) NOT NULL,
  `REGISTRO` text CHARACTER SET latin1 COLLATE latin1_bin,
  `ID_DOCUMENTO` int(11) NOT NULL,
  `FRECUENCIA` text CHARACTER SET latin1 COLLATE latin1_bin
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos`
--

CREATE TABLE `requisitos` (
  `ID_REQUISITO` int(11) NOT NULL,
  `REQUISITO` text CHARACTER SET latin1 COLLATE latin1_bin,
  `PENALIZACION` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos_registros`
--

CREATE TABLE `requisitos_registros` (
  `ID_REQUISITO` int(11) NOT NULL,
  `ID_REGISTRO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_entrada`
--

CREATE TABLE `seguimiento_entrada` (
  `ID_SEGUIMIENTO_ENTRADA` int(11) NOT NULL,
  `ID_DOCUMENTO_ENTRADA` int(11) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `AVANCE_PROGRAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos`
--

CREATE TABLE `submodulos` (
  `ID_SUBMODULOS` int(11) NOT NULL,
  `ID_MODULOS` int(11) NOT NULL,
  `NOMBRE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ADQUIRIDO` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `submodulos`
--

INSERT INTO `submodulos` (`ID_SUBMODULOS`, `ID_MODULOS`, `NOMBRE`, `ADQUIRIDO`) VALUES
(1, 1, 'Principal', 1),
(2, 1, 'Catálogo', 0),
(3, 1, 'Cumplimientos', 0),
(5, 1, 'Oficios', 0),
(6, 1, 'Usuario', 1),
(7, 1, 'Temas', 1),
(8, 1, 'Procesos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `ID_TAREA` int(11) NOT NULL,
  `REFERENCIA` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `TAREA` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `FECHA_CREACION` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FECHA_ALARMA` date DEFAULT NULL,
  `FECHA_CUMPLIMIENTO` date DEFAULT NULL,
  `STATUS_TAREA` varchar(45) DEFAULT NULL COMMENT '1:En Proceso,2:Suspendido,3:Terminado',
  `OBSERVACIONES` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `EXISTE_PROGRAMA` int(11) DEFAULT '0',
  `AVANCE_PROGRAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0',
  `ID_EMPLEADO` int(11) NOT NULL,
  `CREADOR_TAREA` int(11) NOT NULL,
  `CUMPLIMIENTO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `ID_TEMA` int(11) NOT NULL,
  `NO` text CHARACTER SET utf8 COLLATE utf8_bin,
  `NOMBRE` text CHARACTER SET utf8 COLLATE utf8_bin,
  `DESCRIPCION` text CHARACTER SET utf8 COLLATE utf8_bin,
  `PLAZO` text CHARACTER SET utf8 COLLATE utf8_bin,
  `PADRE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '0',
  `ID_EMPLEADO` int(11) NOT NULL,
  `IDENTIFICADOR` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `CONTRATO` int(11) DEFAULT NULL,
  `FECHA_INICIO` date NOT NULL DEFAULT '0000-00-00',
  `PADRE_GENERAL` varchar(50) DEFAULT '0',
  `RESPONSABLE_GENERAL` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `temas`
--
DELIMITER $$
CREATE TRIGGER `temas_after_insert` AFTER INSERT ON `temas` FOR EACH ROW BEGIN
CALL `insertartemas_requisitos`(NEW.ID_TEMA);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mensaje`
--

CREATE TABLE `tipo_mensaje` (
  `idtipo_mensaje` int(11) NOT NULL,
  `TEXTO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_mensaje`
--

INSERT INTO `tipo_mensaje` (`idtipo_mensaje`, `TEXTO`) VALUES
(0, '\'default\'');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(10) NOT NULL,
  `NOMBRE_USUARIO` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `CONTRA` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `FONDO_COLOR` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '#3399CC',
  `AYUDA_TRIGGER` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '1' COMMENT 'el ayuda trigger es el id del cumplimiento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE_USUARIO`, `CONTRA`, `ID_EMPLEADO`, `FONDO_COLOR`, `AYUDA_TRIGGER`) VALUES
(0, 'admin', '$1231P3', 0, '#ff6021', '1'),
(1, 'davilac', 'davila', 1, '#3399CC', '1');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_after_insert` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
UPDATE estructura set estructura.AYUDATRIGGER=(new.ID_USUARIO);

UPDATE cumplimientos set cumplimientos.AYUDA_TRIGGER=(new.ID_USUARIO);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_after_update` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN

DECLARE done INT DEFAULT 0;
declare d int;
declare param varchar(50);
DECLARE result varchar(4000);

 DECLARE cur1 CURSOR FOR SELECT usuarios.ID_USUARIO FROM  usuarios;
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
 
   OPEN cur1;
 REPEAT
    FETCH cur1 INTO d;
    IF NOT done THEN
    
      SET param = param + "," + result; 
    END IF;
  UNTIL done END REPEAT;

  CLOSE cur1;
   

 CALL `update_usuarios_cumplimientos`(new.id_usuario, new.AYUDA_TRIGGER);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_cumplimientos`
--

CREATE TABLE `usuarios_cumplimientos` (
  `ID_USUARIO` int(10) NOT NULL,
  `ID_CUMPLIMIENTO` int(11) NOT NULL,
  `ACCESO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios_cumplimientos`
--

INSERT INTO `usuarios_cumplimientos` (`ID_USUARIO`, `ID_CUMPLIMIENTO`, `ACCESO`) VALUES
(0, 1, 'true'),
(0, 2, 'true'),
(0, 3, 'true'),
(1, 1, 'true'),
(1, 2, 'true'),
(1, 3, 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_temas`
--

CREATE TABLE `usuarios_temas` (
  `ID_USUARIO` int(10) NOT NULL,
  `ID_TEMA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_vistas`
--

CREATE TABLE `usuarios_vistas` (
  `ID_USUARIO` int(10) DEFAULT NULL,
  `ID_ESTRUCTURA` int(11) NOT NULL,
  `EDIT` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `DELETE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `NEW` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `CONSULT` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios_vistas`
--

INSERT INTO `usuarios_vistas` (`ID_USUARIO`, `ID_ESTRUCTURA`, `EDIT`, `DELETE`, `NEW`, `CONSULT`) VALUES
(0, 0, 'false', 'false', 'false', 'true'),
(0, 2, 'false', 'false', 'false', 'true'),
(0, 3, 'false', 'false', 'false', 'true'),
(0, 4, 'false', 'false', 'false', 'true'),
(0, 5, 'false', 'false', 'false', 'true'),
(0, 6, 'false', 'false', 'false', 'true'),
(0, 7, 'false', 'false', 'false', 'true'),
(0, 8, 'false', 'false', 'false', 'true'),
(0, 9, 'false', 'false', 'false', 'true'),
(0, 10, 'false', 'false', 'false', 'true'),
(0, 11, 'false', 'false', 'false', 'true'),
(0, 12, 'false', 'false', 'false', 'true'),
(0, 13, 'false', 'false', 'false', 'true'),
(0, 14, 'false', 'false', 'false', 'true'),
(0, 15, 'false', 'false', 'false', 'true'),
(0, 16, 'false', 'false', 'false', 'true'),
(0, 17, 'false', 'false', 'false', 'true'),
(0, 18, 'false', 'false', 'false', 'true'),
(0, 19, 'false', 'false', 'false', 'true'),
(0, 20, 'false', 'false', 'false', 'true'),
(0, 21, 'false', 'false', 'false', 'true'),
(0, 22, 'false', 'false', 'false', 'true'),
(0, 23, 'false', 'false', 'false', 'true'),
(0, 24, 'false', 'false', 'false', 'false'),
(1, 0, 'false', 'false', 'false', 'true'),
(1, 2, 'false', 'false', 'false', 'false'),
(1, 3, 'false', 'false', 'false', 'false'),
(1, 4, 'false', 'false', 'false', 'false'),
(1, 5, 'false', 'false', 'false', 'false'),
(1, 6, 'false', 'false', 'false', 'false'),
(1, 7, 'false', 'false', 'false', 'false'),
(1, 8, 'false', 'false', 'false', 'false'),
(1, 9, 'false', 'false', 'false', 'false'),
(1, 10, 'false', 'false', 'false', 'false'),
(1, 11, 'false', 'false', 'false', 'false'),
(1, 12, 'false', 'false', 'false', 'false'),
(1, 13, 'false', 'false', 'false', 'false'),
(1, 14, 'false', 'false', 'false', 'false'),
(1, 15, 'false', 'false', 'false', 'false'),
(1, 16, 'false', 'false', 'false', 'true'),
(1, 17, 'false', 'false', 'false', 'true'),
(1, 18, 'false', 'false', 'false', 'false'),
(1, 19, 'false', 'false', 'false', 'false'),
(1, 20, 'false', 'false', 'false', 'false'),
(1, 21, 'false', 'false', 'false', 'true'),
(1, 22, 'false', 'false', 'false', 'false'),
(1, 23, 'false', 'false', 'false', 'false'),
(1, 24, 'false', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_y_empleados`
--

CREATE TABLE `usuarios_y_empleados` (
  `ID_USUARIO_EMPLEADO` int(11) NOT NULL,
  `ID_USUARIO` int(10) NOT NULL,
  `ID_EMPLEADO` int(11) NOT NULL,
  `idpermisos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validacion_documento`
--

CREATE TABLE `validacion_documento` (
  `ID_VALIDACION_DOCUMENTO` int(11) NOT NULL,
  `DOCUMENTO_ARCHIVO` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '0',
  `VALIDACION_DOCUMENTO_RESPONSABLE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `VALIDACION_TEMA_RESPONSABLE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `OBSERVACIONES` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `PLAN_ACCION` int(11) DEFAULT '-1',
  `DESVIACION_MAYOR` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT 'false',
  `ID_DOCUMENTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `ID_VISTAS` int(11) NOT NULL,
  `NOMBRE` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`ID_VISTAS`, `NOMBRE`) VALUES
(0, 'InformeValidacionDocumentosView.php'),
(1, 'AsignacionTemasRequisitosView.php'),
(2, 'TemasView.php'),
(3, 'DocumentoEntradaView.php'),
(4, 'DocumentoSalidaView.php'),
(5, 'DocumentosView.php'),
(6, 'EmpleadosView.php'),
(7, 'EntidadesReguladorasView.php'),
(8, 'GanttView.php'),
(9, 'InformeGerencialView.php'),
(10, 'InyectarVistasView.php'),
(11, 'EvidenciasView.php'),
(12, 'SeguimientoEntradaView.php'),
(13, 'ValidacionDocumentosView.php'),
(14, 'AdminView.php'),
(15, 'TareasView.php'),
(16, 'CatalogoProcesosView.php'),
(17, 'EmpleadosTareasView.php'),
(18, 'InformeEvidenciasView.php'),
(19, 'ConsultasView.php'),
(20, 'UsuarioAjustesView'),
(21, 'CatalogoProduccionView.php'),
(22, 'ReportesProduccionView.php'),
(23, 'GeneradorReporteView.php'),
(24, 'ControlTemasView.php');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones_contrato`
--
ALTER TABLE `asignaciones_contrato`
  ADD PRIMARY KEY (`ID_ASIGNACION`);

--
-- Indices de la tabla `asignacion_tema_requisito`
--
ALTER TABLE `asignacion_tema_requisito`
  ADD PRIMARY KEY (`ID_ASIGNACION_TEMA_REQUISITO`),
  ADD KEY `fk_asignacion_tema_requisito_documentos1_idx` (`ID_DOCUMENTO`),
  ADD KEY `fk_asignacion_tema_requisito_TEMAS1_idx` (`ID_TEMA`);

--
-- Indices de la tabla `asignacion_tema_requisito_requisitos`
--
ALTER TABLE `asignacion_tema_requisito_requisitos`
  ADD PRIMARY KEY (`ID_ASIGNACION_TEMA_REQUISITO`,`ID_REQUISITO`),
  ADD KEY `fk_asignacion_tema_requisito_has_REQUISITOS_REQUISITOS1_idx` (`ID_REQUISITO`),
  ADD KEY `fk_asignacion_tema_requisito_has_REQUISITOS_asignacion_tema_idx` (`ID_ASIGNACION_TEMA_REQUISITO`);

--
-- Indices de la tabla `autoridad_remitente`
--
ALTER TABLE `autoridad_remitente`
  ADD PRIMARY KEY (`ID_AUTORIDAD`);

--
-- Indices de la tabla `catalogo_produccion`
--
ALTER TABLE `catalogo_produccion`
  ADD PRIMARY KEY (`ID_CATALOGOP`),
  ADD KEY `fk_catalogo_produccion_asignaciones_contrato1_idx` (`ID_ASIGNACION`);

--
-- Indices de la tabla `concepto_reportes`
--
ALTER TABLE `concepto_reportes`
  ADD PRIMARY KEY (`ID_CONCEPTO_REPORTES`);

--
-- Indices de la tabla `cumplimientos`
--
ALTER TABLE `cumplimientos`
  ADD PRIMARY KEY (`ID_CUMPLIMIENTO`),
  ADD KEY `fk_cumplimientos_RamaPrincipal1_idx` (`idRamaPrincipal`);

--
-- Indices de la tabla `cumplimientos_estructura`
--
ALTER TABLE `cumplimientos_estructura`
  ADD PRIMARY KEY (`ID_CUMPLIMIENTO`,`ID_ESTRUCTURA`),
  ADD KEY `fk_cumplimientos_has_estructura_estructura1_idx` (`ID_ESTRUCTURA`),
  ADD KEY `fk_cumplimientos_has_estructura_cumplimientos1_idx` (`ID_CUMPLIMIENTO`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`ID_DOCUMENTO`),
  ADD KEY `fk_documentos_empleados1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `documento_dir`
--
ALTER TABLE `documento_dir`
  ADD KEY `fk_table1_documento_entrada1_idx` (`ID_DOCUMENTO_ENTRADA`);

--
-- Indices de la tabla `documento_entrada`
--
ALTER TABLE `documento_entrada`
  ADD PRIMARY KEY (`ID_DOCUMENTO_ENTRADA`),
  ADD KEY `fk_documentoentrada_cumplimientos1_idx` (`ID_CUMPLIMIENTO`),
  ADD KEY `fk_documentoentrada_entidad_reguladora1_idx` (`ID_AUTORIDAD`),
  ADD KEY `fk_documento_entrada_temas1_idx` (`ID_TEMA`);

--
-- Indices de la tabla `documento_salida`
--
ALTER TABLE `documento_salida`
  ADD PRIMARY KEY (`ID_DOCUMENTO_SALIDA`),
  ADD KEY `fk_documento_salida_documento_entrada1_idx` (`ID_DOCUMENTO_ENTRADA`);

--
-- Indices de la tabla `documento_salida_sinfolio_entrada`
--
ALTER TABLE `documento_salida_sinfolio_entrada`
  ADD PRIMARY KEY (`ID_DOCUMENTO_SALIDA`),
  ADD KEY `fk_documento_salida_sinfolio_entrada_empleados1_idx` (`ID_EMPLEADO`),
  ADD KEY `fk_documento_salida_sinfolio_entrada_autoridad_remitente1_idx` (`ID_AUTORIDAD`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_EMPLEADO`),
  ADD UNIQUE KEY `XPKEMPLEADOS` (`ID_EMPLEADO`);

--
-- Indices de la tabla `estructura`
--
ALTER TABLE `estructura`
  ADD PRIMARY KEY (`ID_ESTRUCTURA`),
  ADD KEY `fk_ESTRUCTURA_ID_SUBMODULOS1_idx` (`ID_SUBMODULOS`),
  ADD KEY `fk_ESTRUCTURA_VISTAS1_idx` (`ID_VISTAS`);

--
-- Indices de la tabla `estructura_responsable_contrato`
--
ALTER TABLE `estructura_responsable_contrato`
  ADD KEY `fk_estructura_usuarios_y_empleados1_idx` (`ID_USUARIO_EMPLEADO`),
  ADD KEY `fk_estructura_responsable_contrato_cumplimientos1_idx` (`ID_CUMPLIMIENTO`);

--
-- Indices de la tabla `evidencias`
--
ALTER TABLE `evidencias`
  ADD PRIMARY KEY (`ID_EVIDENCIAS`),
  ADD KEY `fk_evidencias_registros1_idx` (`ID_REGISTRO`),
  ADD KEY `fk_evidencias_usuarios1_idx` (`ID_USUARIO`);

--
-- Indices de la tabla `gantt_evidencias`
--
ALTER TABLE `gantt_evidencias`
  ADD PRIMARY KEY (`id`,`id_evidencias`),
  ADD KEY `fk_gantt_evidencias_evidencias1_idx` (`id_evidencias`);

--
-- Indices de la tabla `gantt_notas_historico_temas`
--
ALTER TABLE `gantt_notas_historico_temas`
  ADD PRIMARY KEY (`idgantt_notas_historico`);

--
-- Indices de la tabla `gantt_seguimiento_entrada`
--
ALTER TABLE `gantt_seguimiento_entrada`
  ADD PRIMARY KEY (`ID_GANTT`,`ID_SEGUIMIENTO_ENTRADA`),
  ADD KEY `fk_gantt_tasks_has_seguimiento_entrada_seguimiento_entrada1_idx` (`ID_SEGUIMIENTO_ENTRADA`),
  ADD KEY `fk_gantt_tasks_has_seguimiento_entrada_gantt_tasks1_idx` (`ID_GANTT`),
  ADD KEY `fk_gantt_seguimiento_entrada_empleados1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `gantt_tareas`
--
ALTER TABLE `gantt_tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `KEY` (`ID_TAREA`);

--
-- Indices de la tabla `gantt_tasks`
--
ALTER TABLE `gantt_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informe_gerencial`
--
ALTER TABLE `informe_gerencial`
  ADD PRIMARY KEY (`ID_INFORME_GERENCIAL`),
  ADD KEY `fk_INFORME_GERENCIAL_documento_entrada1_idx` (`ID_DOCUMENTO_ENTRADA`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`ID_MODULOS`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`ID_NOTIFICACIONES`),
  ADD KEY `fk_notificaciones_tipo_mensaje1_idx` (`TIPO_MENSAJE`),
  ADD KEY `fk_notificaciones_usuarios1_idx` (`ID_DE`),
  ADD KEY `fk_notificaciones_usuarios2_idx` (`ID_PARA`);

--
-- Indices de la tabla `omg_reporte_produccion`
--
ALTER TABLE `omg_reporte_produccion`
  ADD PRIMARY KEY (`ID_REPORTE`),
  ADD KEY `fk_omg_reporte_produccion_catalogo_produccion1_idx1` (`ID_CATALOGOP`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermisos`);

--
-- Indices de la tabla `porcentajes_molares`
--
ALTER TABLE `porcentajes_molares`
  ADD PRIMARY KEY (`ID_PORCENTAJE`);

--
-- Indices de la tabla `ramaprincipal`
--
ALTER TABLE `ramaprincipal`
  ADD PRIMARY KEY (`idRamaPrincipal`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`ID_REGISTRO`),
  ADD KEY `fk_registros_documentos1_idx` (`ID_DOCUMENTO`);

--
-- Indices de la tabla `requisitos`
--
ALTER TABLE `requisitos`
  ADD PRIMARY KEY (`ID_REQUISITO`);

--
-- Indices de la tabla `requisitos_registros`
--
ALTER TABLE `requisitos_registros`
  ADD PRIMARY KEY (`ID_REQUISITO`,`ID_REGISTRO`),
  ADD KEY `fk_REQUISITOS_has_REGISTROS_REGISTROS1_idx` (`ID_REGISTRO`),
  ADD KEY `fk_REQUISITOS_has_REGISTROS_REQUISITOS1_idx` (`ID_REQUISITO`);

--
-- Indices de la tabla `seguimiento_entrada`
--
ALTER TABLE `seguimiento_entrada`
  ADD PRIMARY KEY (`ID_SEGUIMIENTO_ENTRADA`),
  ADD KEY `fk_SEGUIMIENTO_ENTRADA_documento_entrada1_idx` (`ID_DOCUMENTO_ENTRADA`),
  ADD KEY `fk_SEGUIMIENTO_ENTRADA_empleados1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD PRIMARY KEY (`ID_SUBMODULOS`),
  ADD KEY `fk_ID_SUBMODULOS_MODULOS1_idx` (`ID_MODULOS`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`ID_TAREA`),
  ADD KEY `fk_TAREAS_EMPLEADOS_TAREAS1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`ID_TEMA`),
  ADD KEY `fk_TEMAS_empleados1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `tipo_mensaje`
--
ALTER TABLE `tipo_mensaje`
  ADD PRIMARY KEY (`idtipo_mensaje`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `XPKUSUARIOS` (`ID_USUARIO`),
  ADD KEY `fk_usuarios_empleados1_idx` (`ID_EMPLEADO`);

--
-- Indices de la tabla `usuarios_cumplimientos`
--
ALTER TABLE `usuarios_cumplimientos`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_CUMPLIMIENTO`),
  ADD KEY `fk_usuarios_has_cumplimientos_cumplimientos1_idx` (`ID_CUMPLIMIENTO`),
  ADD KEY `fk_usuarios_has_cumplimientos_usuarios1_idx` (`ID_USUARIO`);

--
-- Indices de la tabla `usuarios_temas`
--
ALTER TABLE `usuarios_temas`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_TEMA`),
  ADD KEY `fk_usuarios_has_clausulas_usuarios1_idx` (`ID_USUARIO`),
  ADD KEY `fk_usuarios_clausulas_temas1_idx` (`ID_TEMA`);

--
-- Indices de la tabla `usuarios_vistas`
--
ALTER TABLE `usuarios_vistas`
  ADD KEY `fk_usuarios_vistas_usuarios1_idx` (`ID_USUARIO`),
  ADD KEY `fk_usuarios_vistas_estructura1_idx` (`ID_ESTRUCTURA`);

--
-- Indices de la tabla `usuarios_y_empleados`
--
ALTER TABLE `usuarios_y_empleados`
  ADD PRIMARY KEY (`ID_USUARIO_EMPLEADO`),
  ADD UNIQUE KEY `ID_USUARIO_UNIQUE` (`ID_USUARIO`),
  ADD UNIQUE KEY `ID_EMPLEADO_UNIQUE` (`ID_EMPLEADO`),
  ADD KEY `fk_USUARIOS_Y_EMPLEADOS_usuarios1_idx` (`ID_USUARIO`),
  ADD KEY `fk_USUARIOS_Y_EMPLEADOS_empleados1_idx` (`ID_EMPLEADO`),
  ADD KEY `fk_usuarios_y_empleados_permisos1_idx` (`idpermisos`);

--
-- Indices de la tabla `validacion_documento`
--
ALTER TABLE `validacion_documento`
  ADD PRIMARY KEY (`ID_VALIDACION_DOCUMENTO`),
  ADD KEY `fk_validacion_documento_documentos1_idx` (`ID_DOCUMENTO`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`ID_VISTAS`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones_contrato`
--
ALTER TABLE `asignaciones_contrato`
  MODIFY `ID_ASIGNACION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `catalogo_produccion`
--
ALTER TABLE `catalogo_produccion`
  MODIFY `ID_CATALOGOP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento_salida_sinfolio_entrada`
--
ALTER TABLE `documento_salida_sinfolio_entrada`
  MODIFY `ID_DOCUMENTO_SALIDA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evidencias`
--
ALTER TABLE `evidencias`
  MODIFY `ID_EVIDENCIAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gantt_notas_historico_temas`
--
ALTER TABLE `gantt_notas_historico_temas`
  MODIFY `idgantt_notas_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `ID_NOTIFICACIONES` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `omg_reporte_produccion`
--
ALTER TABLE `omg_reporte_produccion`
  MODIFY `ID_REPORTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `porcentajes_molares`
--
ALTER TABLE `porcentajes_molares`
  MODIFY `ID_PORCENTAJE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ramaprincipal`
--
ALTER TABLE `ramaprincipal`
  MODIFY `idRamaPrincipal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `ID_REGISTRO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `requisitos`
--
ALTER TABLE `requisitos`
  MODIFY `ID_REQUISITO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `ID_TEMA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_y_empleados`
--
ALTER TABLE `usuarios_y_empleados`
  MODIFY `ID_USUARIO_EMPLEADO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_tema_requisito`
--
ALTER TABLE `asignacion_tema_requisito`
  ADD CONSTRAINT `fk_asignacion_tema_requisito_TEMAS1` FOREIGN KEY (`ID_TEMA`) REFERENCES `temas` (`ID_TEMA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignacion_tema_requisito_documentos1` FOREIGN KEY (`ID_DOCUMENTO`) REFERENCES `documentos` (`ID_DOCUMENTO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignacion_tema_requisito_requisitos`
--
ALTER TABLE `asignacion_tema_requisito_requisitos`
  ADD CONSTRAINT `fk_asignacion_tema_requisito_has_REQUISITOS_REQUISITOS1` FOREIGN KEY (`ID_REQUISITO`) REFERENCES `requisitos` (`ID_REQUISITO`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignacion_tema_requisito_has_REQUISITOS_asignacion_tema_r1` FOREIGN KEY (`ID_ASIGNACION_TEMA_REQUISITO`) REFERENCES `asignacion_tema_requisito` (`ID_ASIGNACION_TEMA_REQUISITO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `catalogo_produccion`
--
ALTER TABLE `catalogo_produccion`
  ADD CONSTRAINT `fk_catalogo_produccion_asignaciones_contrato1` FOREIGN KEY (`ID_ASIGNACION`) REFERENCES `asignaciones_contrato` (`ID_ASIGNACION`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cumplimientos`
--
ALTER TABLE `cumplimientos`
  ADD CONSTRAINT `fk_cumplimientos_RamaPrincipal1` FOREIGN KEY (`idRamaPrincipal`) REFERENCES `ramaprincipal` (`idRamaPrincipal`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cumplimientos_estructura`
--
ALTER TABLE `cumplimientos_estructura`
  ADD CONSTRAINT `fk_cumplimientos_has_estructura_cumplimientos1` FOREIGN KEY (`ID_CUMPLIMIENTO`) REFERENCES `cumplimientos` (`ID_CUMPLIMIENTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cumplimientos_has_estructura_estructura1` FOREIGN KEY (`ID_ESTRUCTURA`) REFERENCES `estructura` (`ID_ESTRUCTURA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_empleados1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_dir`
--
ALTER TABLE `documento_dir`
  ADD CONSTRAINT `fk_table1_documento_entrada1` FOREIGN KEY (`ID_DOCUMENTO_ENTRADA`) REFERENCES `documento_entrada` (`ID_DOCUMENTO_ENTRADA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_entrada`
--
ALTER TABLE `documento_entrada`
  ADD CONSTRAINT `fk_documento_entrada_temas1` FOREIGN KEY (`ID_TEMA`) REFERENCES `temas` (`ID_TEMA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentoentrada_cumplimientos1` FOREIGN KEY (`ID_CUMPLIMIENTO`) REFERENCES `cumplimientos` (`ID_CUMPLIMIENTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentoentrada_entidad_reguladora1` FOREIGN KEY (`ID_AUTORIDAD`) REFERENCES `autoridad_remitente` (`ID_AUTORIDAD`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_salida`
--
ALTER TABLE `documento_salida`
  ADD CONSTRAINT `fk_documento_salida_documento_entrada1` FOREIGN KEY (`ID_DOCUMENTO_ENTRADA`) REFERENCES `documento_entrada` (`ID_DOCUMENTO_ENTRADA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estructura`
--
ALTER TABLE `estructura`
  ADD CONSTRAINT `fk_ESTRUCTURA_ID_SUBMODULOS1` FOREIGN KEY (`ID_SUBMODULOS`) REFERENCES `submodulos` (`ID_SUBMODULOS`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTRUCTURA_VISTAS1` FOREIGN KEY (`ID_VISTAS`) REFERENCES `vistas` (`ID_VISTAS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estructura_responsable_contrato`
--
ALTER TABLE `estructura_responsable_contrato`
  ADD CONSTRAINT `fk_estructura_responsable_contrato_cumplimientos1` FOREIGN KEY (`ID_CUMPLIMIENTO`) REFERENCES `cumplimientos` (`ID_CUMPLIMIENTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estructura_usuarios_y_empleados1` FOREIGN KEY (`ID_USUARIO_EMPLEADO`) REFERENCES `usuarios_y_empleados` (`ID_USUARIO_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evidencias`
--
ALTER TABLE `evidencias`
  ADD CONSTRAINT `fk_evidencias_registros1` FOREIGN KEY (`ID_REGISTRO`) REFERENCES `registros` (`ID_REGISTRO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evidencias_usuarios1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gantt_evidencias`
--
ALTER TABLE `gantt_evidencias`
  ADD CONSTRAINT `fk_gantt_evidencias_evidencias1` FOREIGN KEY (`id_evidencias`) REFERENCES `evidencias` (`ID_EVIDENCIAS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gantt_seguimiento_entrada`
--
ALTER TABLE `gantt_seguimiento_entrada`
  ADD CONSTRAINT `FK_gantt_seguimiento_entrada_empleados` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_gantt_seguimiento_entrada_gantt_tasks` FOREIGN KEY (`ID_GANTT`) REFERENCES `gantt_tasks` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_gantt_seguimiento_entrada_seguimiento_entrada` FOREIGN KEY (`ID_SEGUIMIENTO_ENTRADA`) REFERENCES `seguimiento_entrada` (`ID_SEGUIMIENTO_ENTRADA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gantt_tareas`
--
ALTER TABLE `gantt_tareas`
  ADD CONSTRAINT `fk_gantt_tareas_tareas1` FOREIGN KEY (`ID_TAREA`) REFERENCES `tareas` (`ID_TAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `informe_gerencial`
--
ALTER TABLE `informe_gerencial`
  ADD CONSTRAINT `fk_INFORME_GERENCIAL_documento_entrada1` FOREIGN KEY (`ID_DOCUMENTO_ENTRADA`) REFERENCES `documento_entrada` (`ID_DOCUMENTO_ENTRADA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_tipo_mensaje1` FOREIGN KEY (`TIPO_MENSAJE`) REFERENCES `tipo_mensaje` (`idtipo_mensaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificaciones_usuarios1` FOREIGN KEY (`ID_DE`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificaciones_usuarios2` FOREIGN KEY (`ID_PARA`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `omg_reporte_produccion`
--
ALTER TABLE `omg_reporte_produccion`
  ADD CONSTRAINT `fk_omg_reporte_produccion_catalogo_produccion1` FOREIGN KEY (`ID_CATALOGOP`) REFERENCES `catalogo_produccion` (`ID_CATALOGOP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `fk_registros_documentos1` FOREIGN KEY (`ID_DOCUMENTO`) REFERENCES `documentos` (`ID_DOCUMENTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `requisitos_registros`
--
ALTER TABLE `requisitos_registros`
  ADD CONSTRAINT `fk_REQUISITOS_has_REGISTROS_REGISTROS1` FOREIGN KEY (`ID_REGISTRO`) REFERENCES `registros` (`ID_REGISTRO`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_REQUISITOS_has_REGISTROS_REQUISITOS1` FOREIGN KEY (`ID_REQUISITO`) REFERENCES `requisitos` (`ID_REQUISITO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimiento_entrada`
--
ALTER TABLE `seguimiento_entrada`
  ADD CONSTRAINT `fk_SEGUIMIENTO_ENTRADA_documento_entrada1` FOREIGN KEY (`ID_DOCUMENTO_ENTRADA`) REFERENCES `documento_entrada` (`ID_DOCUMENTO_ENTRADA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SEGUIMIENTO_ENTRADA_empleados1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD CONSTRAINT `fk_ID_SUBMODULOS_MODULOS1` FOREIGN KEY (`ID_MODULOS`) REFERENCES `modulos` (`ID_MODULOS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_TAREAS_EMPLEADOS_TAREAS1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `fk_TEMAS_empleados1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_empleados1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_cumplimientos`
--
ALTER TABLE `usuarios_cumplimientos`
  ADD CONSTRAINT `fk_usuarios_has_cumplimientos_cumplimientos1` FOREIGN KEY (`ID_CUMPLIMIENTO`) REFERENCES `cumplimientos` (`ID_CUMPLIMIENTO`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_cumplimientos_usuarios1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_temas`
--
ALTER TABLE `usuarios_temas`
  ADD CONSTRAINT `fk_usuarios_clausulas_temas1` FOREIGN KEY (`ID_TEMA`) REFERENCES `temas` (`ID_TEMA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_clausulas_usuarios1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_vistas`
--
ALTER TABLE `usuarios_vistas`
  ADD CONSTRAINT `fk_usuarios_vistas_estructura1` FOREIGN KEY (`ID_ESTRUCTURA`) REFERENCES `estructura` (`ID_ESTRUCTURA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_vistas_usuarios1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_y_empleados`
--
ALTER TABLE `usuarios_y_empleados`
  ADD CONSTRAINT `fk_USUARIOS_Y_EMPLEADOS_empleados1` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USUARIOS_Y_EMPLEADOS_usuarios1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_y_empleados_permisos1` FOREIGN KEY (`idpermisos`) REFERENCES `permisos` (`idpermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `validacion_documento`
--
ALTER TABLE `validacion_documento`
  ADD CONSTRAINT `fk_validacion_documento_documentos1` FOREIGN KEY (`ID_DOCUMENTO`) REFERENCES `documentos` (`ID_DOCUMENTO`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
