/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.39 : Database - venados
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `venados`;

/*Table structure for table `DescripcionEvento` */

DROP TABLE IF EXISTS `DescripcionEvento`;

CREATE TABLE `DescripcionEvento` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'El identificador',
  `id_evento` int(11) NOT NULL COMMENT 'El identificador de el evento',
  `id_empresa` int(11) NOT NULL COMMENT 'El identificador de la empresa que estará abierta en el evento',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `DescripcionEvento` */

/*Table structure for table `DetallePedidos` */

DROP TABLE IF EXISTS `DetallePedidos`;

CREATE TABLE `DetallePedidos` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idpedido` int(11) NOT NULL COMMENT 'Identificador del pedido asociado',
  `idproducto` int(11) NOT NULL COMMENT 'Identificador del producto asociado',
  `precio` double(8,2) NOT NULL COMMENT 'Precio del producto vendido',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `DetallePedidos` */

/*Table structure for table `Empresas` */

DROP TABLE IF EXISTS `Empresas`;

CREATE TABLE `Empresas` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la empresa',
  `razonsocial` varchar(50) NOT NULL COMMENT 'La razón social de la empresa',
  `rfc` varchar(15) NOT NULL COMMENT 'RFC de la empresa',
  `domicilio` varchar(100) DEFAULT NULL COMMENT 'Domicilio fiscal de la empresa',
  `telefono` varchar(20) DEFAULT NULL COMMENT 'Telefono de la empresa en el local ',
  `local` varchar(5) NOT NULL COMMENT 'Número del local donde se ubica dentro del estadio',
  `logotipo` varchar(50) DEFAULT NULL COMMENT 'Ruta de la imagen del logotipo de la empresa',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro, (activo, inactivo)',
  `descripcion` varchar(50) DEFAULT NULL COMMENT 'Descripcion CORTA de lo que vende el negocio',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Empresas` */

/*Table structure for table `Eventos` */

DROP TABLE IF EXISTS `Eventos`;

CREATE TABLE `Eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `imagen` varchar(80) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Eventos` */

/*Table structure for table `Modulos` */

DROP TABLE IF EXISTS `Modulos`;

CREATE TABLE `Modulos` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre del módulo',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción del módulo',
  `ruta` varchar(100) NOT NULL COMMENT 'Ruta de la ubicación del módulo',
  `icono` varchar(50) DEFAULT NULL COMMENT 'Ruta de la imagen del ícono',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Modulos` */

/*Table structure for table `Notificaciones` */

DROP TABLE IF EXISTS `Notificaciones`;

CREATE TABLE `Notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idpedido` int(11) NOT NULL COMMENT 'Identificador del pedido asociado',
  `mensaje` varchar(50) NOT NULL COMMENT 'Texto del mensaje de la notificación',
  `fecha` date NOT NULL COMMENT 'Fecha de la notificación',
  `hora` time NOT NULL COMMENT 'Hora de la notificación',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado de la notificación (enviado,recibido)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Notificaciones` */

/*Table structure for table `Pedidos` */

DROP TABLE IF EXISTS `Pedidos`;

CREATE TABLE `Pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idempresa` int(2) NOT NULL COMMENT 'Identificador de la empresa asociada',
  `idusuario` int(11) NOT NULL COMMENT 'Identificador del usuario asociado (cliente)',
  `fecha` date NOT NULL COMMENT 'Fecha del pedido',
  `hora` time NOT NULL COMMENT 'Hora del pedido',
  `total` double(8,2) NOT NULL COMMENT 'Costo total del pedido',
  `estatus` enum('Soliciado','Realizado','Entregado','Cancelado') DEFAULT NULL COMMENT 'Estado del pedido (solicitado,realizado,entregado,cancelado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Pedidos` */

/*Table structure for table `Perfiles` */

DROP TABLE IF EXISTS `Perfiles`;

CREATE TABLE `Perfiles` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre del perfil',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción del perfil',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Perfiles` */

/*Table structure for table `PerfilesModulos` */

DROP TABLE IF EXISTS `PerfilesModulos`;

CREATE TABLE `PerfilesModulos` (
  `idperfil` int(2) NOT NULL COMMENT 'Identificador del perfil asociado',
  `idmodulo` int(4) NOT NULL COMMENT 'Identificador del módulo asociado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `PerfilesModulos` */

/*Table structure for table `Productos` */

DROP TABLE IF EXISTS `Productos`;

CREATE TABLE `Productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la empresa',
  `descripcion` varchar(50) NOT NULL COMMENT 'Descripción del producto',
  `precio` double(8,2) NOT NULL COMMENT 'Precio del producto',
  `imagen` varchar(50) DEFAULT NULL COMMENT 'Ruta de la imagen del producto',
  `idempresa` int(2) NOT NULL COMMENT 'Identificador de la empresa asociada',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Productos` */

/*Table structure for table `Usuarios` */

DROP TABLE IF EXISTS `Usuarios`;

CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de usuario (repetir correo para cliente)',
  `contraseña` varchar(50) NOT NULL COMMENT 'Contraseña encriptada',
  `correo` varchar(50) NOT NULL COMMENT 'Correo electrónico',
  `idperfil` int(2) NOT NULL COMMENT 'Identificador del perfil asociado al usuario',
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de fecha y hora',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Usuarios` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
