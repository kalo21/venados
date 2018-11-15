/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.36-MariaDB : Database - venados
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`venados` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `venados`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidopaterno` varchar(50) NOT NULL,
  `apellidomaterno` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `telefono` varchar(16) NOT NULL,
  `saldo` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

/*Table structure for table `descripcionevento` */

DROP TABLE IF EXISTS `descripcionevento`;

CREATE TABLE `descripcionevento` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'El identificador',
  `id_evento` int(11) NOT NULL COMMENT 'El identificador de el evento',
  `id_empresa` int(11) NOT NULL COMMENT 'El identificador de la empresa que estará abierta en el evento',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `descripcionevento` */

/*Table structure for table `detallepedidos` */

DROP TABLE IF EXISTS `detallepedidos`;

CREATE TABLE `detallepedidos` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idpedido` int(11) NOT NULL COMMENT 'Identificador del pedido asociado',
  `idproducto` int(11) NOT NULL COMMENT 'Identificador del producto asociado',
  `precio` double(8,2) NOT NULL COMMENT 'Precio del producto vendido',
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detallepedidos` */

/*Table structure for table `detallesevento` */

DROP TABLE IF EXISTS `detallesevento`;

CREATE TABLE `detallesevento` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'El identificador',
  `id_evento` int(11) NOT NULL COMMENT 'El identificador de el evento',
  `id_empresa` int(11) NOT NULL COMMENT 'El identificador de la empresa que estará abierta en el evento',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `detallesevento` */

insert  into `detallesevento`(`id`,`id_evento`,`id_empresa`) values 
(1,1,1),
(3,2,1),
(4,2,2);

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la empresa',
  `razonsocial` varchar(50) NOT NULL COMMENT 'La razón social de la empresa',
  `rfc` varchar(15) NOT NULL COMMENT 'RFC de la empresa',
  `domicilio` varchar(100) DEFAULT NULL COMMENT 'Domicilio fiscal de la empresa',
  `telefono` varchar(20) DEFAULT NULL COMMENT 'Telefono de la empresa en el local ',
  `local` varchar(5) NOT NULL COMMENT 'Número del local donde se ubica dentro del estadio',
  `logotipo` varchar(200) DEFAULT NULL COMMENT 'Ruta de la imagen del logotipo de la empresa',
  `estatus` tinyint(1) NOT NULL COMMENT 'Estado del registro, (activo, inactivo)',
  `descripcion` varchar(50) DEFAULT NULL COMMENT 'Descripcion CORTA de lo que vende el negocio',
  `id_usuario` int(11) NOT NULL COMMENT 'Id del usuario relacionado',
  `img_fondo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`nombre`,`razonsocial`,`rfc`,`domicilio`,`telefono`,`local`,`logotipo`,`estatus`,`descripcion`,`id_usuario`,`img_fondo`) values 
(1,'starbuck','razon Starbucks','rfc Starbucks','Starbucks','669122053','1','assets/Empresas/1/starbucks-logo1411.png',1,'',13,''),
(2,'Pacífico','cerveceria pacifico','rfc pacifico','Pacífico','6691580333','2','assets/Empresas/2/7b1d9b33361522f8613a31f3ef1b0ae5.png',1,'Cerveza-Snacks-cerveza',13,''),
(3,'Mona','la mona','rfc mona','mona','6691220334','3','assets/Empresas/3/mona.jpg',1,NULL,13,''),
(4,'water\'s edge bar','WE','WE','WE','669','4','assets/Empresas/4/Waters+Edge+Logo1.png',1,'alcohol',16,'assets/Empresas/4/Waters+Edge+Logo2.png'),
(5,'beach cafe surfs up','surfs up','beach cafe','beach cafe','669','5','assets/Empresas/5/images2.jpg',1,'hotdogs',17,'assets/Empresas/5/images3.jpg');

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `imagen` varchar(80) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `eventos` */

insert  into `eventos`(`id`,`nombre`,`descripcion`,`fecha_inicial`,`fecha_fin`,`imagen`,`status`) values 
(1,'venados vs tomateros','lorem ipsum eter dio una meter preter equis de quin tu ple','2018-10-31 08:10:00','2018-10-31 20:00:00','hola',1),
(2,'venados vs mochis','los mochis van a jugar contra los venados de mazatlan pq yolo swagg','2018-11-01 03:00:00','2018-10-01 17:00:00','yolo',1);

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre del módulo',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción del módulo',
  `ruta` varchar(100) NOT NULL COMMENT 'Ruta de la ubicación del módulo',
  `icono` varchar(50) DEFAULT NULL COMMENT 'Ruta de la imagen del ícono',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`descripcion`,`ruta`,`icono`,`estatus`) values 
(1,'Empresa','Módulo de empresa','index.php/Empresa','fa fa-building',1),
(2,'Productos','Módulo de productos','index.php/Productos','fa fa-product-hunt',1),
(3,'Pedidos','Módulo de pedidos','index.php/Pedidos','fa fa-shopping-cart',1),
(4,'Usuarios','Módulo de usuarios','index.php/Usuarios','fa fa-users',1),
(5,'Perfiles','Módulo de perfiles','index.php/Perfiles','fa fa-user-circle',1),
(6,'Módulos','Módulo de módulos','index.php/Modulos','fa fa-th-large',1),
(7,'Vendedores','Módulo de vendedores','index.php/Vendedores','fa fa-address-card ',1),
(8,'Recargas','Módulo de Recargas','index.php/Recargas','fa  fa-money',1),
(9,'Eventos','Modulo de eventos','index.php/Eventos','fa fa-calendar',1);

/*Table structure for table `notificaciones` */

DROP TABLE IF EXISTS `notificaciones`;

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idpedido` int(11) NOT NULL COMMENT 'Identificador del pedido asociado',
  `mensaje` varchar(50) NOT NULL COMMENT 'Texto del mensaje de la notificación',
  `fecha` date NOT NULL COMMENT 'Fecha de la notificación',
  `hora` time NOT NULL COMMENT 'Hora de la notificación',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado de la notificación (enviado,recibido)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `notificaciones` */

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `idempresa` int(2) NOT NULL COMMENT 'Identificador de la empresa asociada',
  `idusuario` int(11) NOT NULL COMMENT 'Identificador del usuario asociado (cliente)',
  `fecha` date NOT NULL COMMENT 'Fecha del pedido',
  `hora` time NOT NULL COMMENT 'Hora del pedido',
  `total` double(8,2) NOT NULL COMMENT 'Costo total del pedido',
  `estatus` enum('Soliciado','Realizado','Entregado','Cancelado') DEFAULT NULL COMMENT 'Estado del pedido (solicitado,realizado,entregado,cancelado)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `pedidos` */

insert  into `pedidos`(`id`,`idempresa`,`idusuario`,`fecha`,`hora`,`total`,`estatus`) values 
(5,1,1,'0000-00-00','00:00:00',80.00,'Soliciado'),
(6,1,0,'0000-00-00','00:00:00',160.00,'Soliciado');

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre del perfil',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción del perfil',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `perfiles` */

insert  into `perfiles`(`id`,`nombre`,`descripcion`,`estatus`) values 
(1,'Administrador','Admin',1),
(2,'Empresa','Empresa',1),
(3,'Sistemas','Sistemas',1),
(4,'Cliente','Cliente',1),
(5,'Empleados','Empleados',1);

/*Table structure for table `perfilesmodulos` */

DROP TABLE IF EXISTS `perfilesmodulos`;

CREATE TABLE `perfilesmodulos` (
  `idperfil` int(2) NOT NULL COMMENT 'Identificador del perfil asociado',
  `idmodulo` int(4) NOT NULL COMMENT 'Identificador del módulo asociado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perfilesmodulos` */

insert  into `perfilesmodulos`(`idperfil`,`idmodulo`) values 
(1,1),
(1,6),
(1,5),
(1,4),
(1,3),
(1,2),
(3,1),
(3,7),
(5,8),
(1,7),
(1,8),
(1,9);

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la empresa',
  `descripcion` varchar(150) NOT NULL COMMENT 'Descripción del producto',
  `precio` double(8,2) NOT NULL COMMENT 'Precio del producto',
  `imagen` varchar(200) DEFAULT NULL COMMENT 'Ruta de la imagen del producto',
  `idempresa` int(2) NOT NULL COMMENT 'Identificador de la empresa asociada',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre`,`descripcion`,`precio`,`imagen`,`idempresa`,`estatus`) values 
(1,'Cafe mediano','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minimco do',80.00,'assets/Empresas/1/starbucks-logo.png',1,1),
(2,'Cafe chico','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minimco do',50.00,NULL,1,1),
(3,'Ballena','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minimco do',40.00,NULL,2,1),
(4,'cuartito','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minimco do',20.00,NULL,2,1),
(5,'bote','lorem ipsum odor leu quiet fria taolst tala dalaru dpue pito cuento palo',20.00,NULL,2,1);

/*Table structure for table `recargas` */

DROP TABLE IF EXISTS `recargas`;

CREATE TABLE `recargas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `recargas` */

insert  into `recargas`(`id`,`id_usuario`,`id_empleado`,`monto`,`fecha`) values 
(14,13,14,1000000,'0000-00-00 00:00:00'),
(15,12,12,100,'0000-00-00 00:00:00');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada registro',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de usuario (repetir correo para cliente)',
  `contraseña` varchar(150) NOT NULL COMMENT 'Contraseña encriptada',
  `correo` varchar(50) NOT NULL COMMENT 'Correo electrónico',
  `idperfil` int(2) NOT NULL COMMENT 'Identificador del perfil asociado al usuario',
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de fecha y hora',
  `estatus` tinyint(1) DEFAULT NULL COMMENT 'Estado del registro (activo, inactivo)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`contraseña`,`correo`,`idperfil`,`registro`,`estatus`) values 
(1,'cedi@cedi.cedi','$2y$10$n9gpfa7zkkgwIuLjRcHBh.MED.V4l34N/vQyGUb8qjE','cedi@cedi.cedi',1,'2018-11-01 20:41:33',1),
(2,'emple','$2y$10$2cGPkQWeTI7u.B0OZnAZYeODmW9H1Y/SsoqOpdRZAWsK0/nluFDjG','empleado@gmail.com',5,'2018-11-12 09:19:39',1),
(3,'a@aa','$2y$10$9mEgO4Szic6LI/SjFHpJR.krsQtrLvHEyZIeiqCJYi7xufKpSqAlS','a@aa',4,'2018-11-02 05:19:39',1),
(9,'cedi@cedi','$2y$10$qCXAsiqQV6QIUAU9NSSJjuBqMRHC7cnmmQYDmO1D9gxmlTAjDotTe','cedi@cedi',4,'2018-11-02 05:55:00',1),
(10,'c@c','$2y$10$ouIN2MY4noJaWBctXE.yhOVECjixDkLWnVZbzTySBwPH5dMI3yLwm','c@c',4,'2018-11-06 09:37:45',1),
(12,'julio','$2y$10$m0YtIBk9xWlUyK1H16ZVpeskZCevmKZPQWUOZ/B8YWbzxF8vQ5eym','pedro@alvarez.com',1,'2018-11-06 20:34:28',1),
(13,'kevin','$2y$10$OqhteRfyTz9xNrxbbEYsKuGhaM.2xOcFu/VdTiwI2jbGlgO7JNkn.','empresa@lo.com',2,'2018-11-06 20:48:11',1),
(14,'jose','$2y$10$dvhAJE8MbGcdk3H9GBoQm.UwEeOSpy7buOdb8wFgKpCfkhU4zSyL6','sistemas@hotmail.com',3,'2018-11-06 20:48:55',1),
(15,'aaron','$2y$10$RomSsm0w3bNre5b20wMunOv9OVxbK21LdcgOvl8eVPuf2hKC1yQla','usuario@gmail.com',4,'2018-11-06 20:49:24',1),
(16,'WE','$2y$10$Pz5jxeKZgQOmSiUIq9lT1.favDa117.p8z/eQ7sZUVMXg7ZW5JpTS','we@we.com',2,'2018-11-15 09:22:13',1),
(17,'surfs up','$2y$10$0Jgo7IxPMw2ea9CBJRe3QeFOxlFRHSRvkv2VNUTs5JzNQFX0nYEce','surfsup@beachup.com',2,'2018-11-15 09:24:28',1);

/*Table structure for table `vendedores` */

DROP TABLE IF EXISTS `vendedores`;

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidomaterno` varchar(50) NOT NULL,
  `apellidopaterno` varchar(50) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `vendedores` */

insert  into `vendedores`(`id`,`nombre`,`apellidomaterno`,`apellidopaterno`,`domicilio`,`telefono`,`imagen`,`estatus`,`id_usuario`) values 
(1,'Jose','Grande','Elenes','el medio del mar','6691580333','assets/Empleados/1/cliente.png',1,14);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
