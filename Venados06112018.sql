/*
SQLyog Trial v13.1.1 (64 bit)
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

/*Data for the table `descripcionevento` */

/*Data for the table `detallepedidos` */

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`nombre`,`razonsocial`,`rfc`,`domicilio`,`telefono`,`local`,`logotipo`,`estatus`,`descripcion`,`id_usuario`) values 
(1,'Pacifico','Grupo Modelo','',NULL,NULL,'A-1','desarollador.png',1,'soy una cerveceria',0),
(2,'Salchichas','salchichas','',NULL,NULL,'A-2','desarollador.png',1,'soy el de las salchichas',0),
(3,'Donas','donas','f6sd18f6f681rw','playa las cruces','6691220538','A-6',NULL,1,NULL,3);

/*Data for the table `eventos` */

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nombre`,`descripcion`,`ruta`,`icono`,`estatus`) values 
(1,'Empresa','modulo de empresas','index.php/Empresa','fa fa-building',1),
(2,'Productos','modulo de producto','index.php/Productos','fa fa-product-hunt',1),
(3,'Pedidos','modulo de pedidos','index.php/Pedidos','fa fa-shopping-cart',1),
(4,'Usuarios','modulo de usuarios','index.php/Usuarios','fa fa-users',1),
(5,'Perfiles','modulo de perfiles','index.php/perfiles','fa fa-user-circle',1),
(6,'Modulos','modulos','index.php/modulos','fa fa-th-large',1);

/*Data for the table `notificaciones` */

/*Data for the table `pedidos` */

/*Data for the table `perfiles` */

insert  into `perfiles`(`id`,`nombre`,`descripcion`,`estatus`) values 
(1,'sistemas','soy el de sistemas',1),
(2,'administrador','soy el administrador',1),
(3,'empresa','soy la empresa',1),
(4,'cliente','soy el cliente',1);

/*Data for the table `perfilesmodulos` */

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre`,`descripcion`,`precio`,`imagen`,`idempresa`,`estatus`) values 
(1,'media pacifico','pacifico media 355ml',30.00,'desarollador.png',1,1),
(2,'doble pacifico','pacifico doble 710ml',60.00,'desarollador.png',1,1),
(3,'6 donas','dona glasiada',65.00,'desarollador.png',3,1);

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nombre`,`contraseña`,`correo`,`idperfil`,`registro`,`estatus`) values 
(1,'veloxme','1234','2017030727',1,'2018-10-22 08:00:00',1),
(2,'kalo','1234','2016030',1,'2018-10-22 08:00:00',1),
(3,'admin','12345678','venados.soporte@gmail.com',2,'2018-11-06 13:12:20',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
