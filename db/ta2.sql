/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - ta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ta`;

/*Table structure for table `tb_absen` */

DROP TABLE IF EXISTS `tb_absen`;

CREATE TABLE `tb_absen` (
  `id_absensi` int(10) NOT NULL AUTO_INCREMENT,
  `id_tentor` varchar(10) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `materi` varchar(255) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `id_tentor` (`id_tentor`),
  CONSTRAINT `tb_absen` FOREIGN KEY (`id_tentor`) REFERENCES `tb_tentor` (`id_tentor`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_absen` */

insert  into `tb_absen`(`id_absensi`,`id_tentor`,`tgl_absen`,`materi`,`bukti`) values 
(16,'T1',NULL,'INTEGRAL','Bukti_2024-03-20_14-06-55.png');

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` varchar(10) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_admin` */

/*Table structure for table `tb_akses` */

DROP TABLE IF EXISTS `tb_akses`;

CREATE TABLE `tb_akses` (
  `ID` varchar(10) NOT NULL,
  `akses` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_akses` */

insert  into `tb_akses`(`ID`,`akses`) values 
('A1','member'),
('A2','tentor'),
('A3','admin'),
('A4','pemilik');

/*Table structure for table `tb_bukti` */

DROP TABLE IF EXISTS `tb_bukti`;

CREATE TABLE `tb_bukti` (
  `id_bukti` varchar(10) NOT NULL,
  `id_tagihan` varchar(10) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bukti`),
  KEY `id_tagihan` (`id_tagihan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_bukti` */

/*Table structure for table `tb_jadwal` */

DROP TABLE IF EXISTS `tb_jadwal`;

CREATE TABLE `tb_jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `id_tentor` varchar(10) DEFAULT NULL,
  `ruang` varchar(25) DEFAULT NULL,
  `jadwal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `tb_jadwal` (`id_tentor`),
  CONSTRAINT `tb_jadwal` FOREIGN KEY (`id_tentor`) REFERENCES `tb_tentor` (`id_tentor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_jadwal` */

insert  into `tb_jadwal`(`id_jadwal`,`id_tentor`,`ruang`,`jadwal`) values 
('J1','T1','R1','senin-rabu 16.00 WIB'),
('J2','T2','r2','kamis-jumat 16.00 wib');

/*Table structure for table `tb_layanan` */

DROP TABLE IF EXISTS `tb_layanan`;

CREATE TABLE `tb_layanan` (
  `id_layanan` varchar(10) NOT NULL,
  `id_jadwal` varchar(10) DEFAULT NULL,
  `nama_layanan` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `biaya` int(25) DEFAULT NULL,
  `kuota` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_layanan`),
  KEY `id_jadwal` (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_layanan` */

insert  into `tb_layanan`(`id_layanan`,`id_jadwal`,`nama_layanan`,`keterangan`,`biaya`,`kuota`) values 
('L1','J1','PRIVAT SD KELAS 4 SESI 1','vvvv',23,1),
('L2','J2','REGULER SMP KELAS 8 SESI 2','ggg',56,4);

/*Table structure for table `tb_metodebayar` */

DROP TABLE IF EXISTS `tb_metodebayar`;

CREATE TABLE `tb_metodebayar` (
  `id_metode` varchar(10) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_metode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_metodebayar` */

/*Table structure for table `tb_murid` */

DROP TABLE IF EXISTS `tb_murid`;

CREATE TABLE `tb_murid` (
  `id_murid` varchar(10) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `id_layanan` varchar(10) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `kelas` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_murid`),
  KEY `id_user` (`id_user`),
  KEY `tb_murid` (`id_layanan`),
  CONSTRAINT `tb_murid` FOREIGN KEY (`id_layanan`) REFERENCES `tb_layanan` (`id_layanan`),
  CONSTRAINT `tb_murid_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_murid` */

insert  into `tb_murid`(`id_murid`,`id_user`,`id_layanan`,`nama`,`asal_sekolah`,`kelas`) values 
('M1','U2','L1','Suniyem','SDN NGLEMPUN','4'),
('m2','U1','L2','Painim','smpn 2 pare','2');

/*Table structure for table `tb_pemilik` */

DROP TABLE IF EXISTS `tb_pemilik`;

CREATE TABLE `tb_pemilik` (
  `id_pemilik` varchar(10) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pemilik`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_pemilik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pemilik` */

/*Table structure for table `tb_rekapabsen` */

DROP TABLE IF EXISTS `tb_rekapabsen`;

CREATE TABLE `tb_rekapabsen` (
  `id_rekap` varchar(10) NOT NULL,
  `id_tentor` varchar(10) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rekap`),
  KEY `tb_rekababsen` (`id_tentor`),
  CONSTRAINT `tb_rekababsen` FOREIGN KEY (`id_tentor`) REFERENCES `tb_tentor` (`id_tentor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_rekapabsen` */

insert  into `tb_rekapabsen`(`id_rekap`,`id_tentor`,`judul`,`created_at`,`file_name`) values 
('R1','T1','rekap absen bulan januari','2024-03-25 19:17:33','Rekap-2024-03-25_13-17-33.pdf');

/*Table structure for table `tb_tagihan` */

DROP TABLE IF EXISTS `tb_tagihan`;

CREATE TABLE `tb_tagihan` (
  `id_tagihan` varchar(10) NOT NULL,
  `id_murid` varchar(10) DEFAULT NULL,
  `bulan` varchar(25) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_tagihan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `id_murid` (`id_murid`),
  CONSTRAINT `tb_tagihan_ibfk_1` FOREIGN KEY (`id_murid`) REFERENCES `tb_murid` (`id_murid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tagihan` */

insert  into `tb_tagihan`(`id_tagihan`,`id_murid`,`bulan`,`jumlah`,`status_tagihan`) values 
('p1','M1','januari',100000,'lunas');

/*Table structure for table `tb_tentor` */

DROP TABLE IF EXISTS `tb_tentor`;

CREATE TABLE `tb_tentor` (
  `id_tentor` varchar(15) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas_jenjang` varchar(255) DEFAULT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tentor`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_tentor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tentor` */

insert  into `tb_tentor`(`id_tentor`,`id_user`,`nama`,`kelas_jenjang`,`mapel`) values 
('T1','U3','AJENG','1-3 SMA','MATEMATIKA'),
('T2','U4','ARUM','1-3 SMP','BIOLOGI');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `ID` varchar(10) NOT NULL,
  `id_akses` varchar(10) DEFAULT NULL,
  `username` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_akses` (`id_akses`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tb_akses` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`ID`,`id_akses`,`username`,`alamat`,`telepon`,`email`,`password`) values 
('U1','A1','MEMBER','KEDIRI',87999,'MEMBER@GMAIL.COM','MEMBER'),
('U2','A1','MEMBER1','NGANJUK',88988,'MEMBER1@GMAIL.COM','MEMBER1'),
('U3','A2','TENTOR','NGAWI',897771,'TENTOR@GMAIL.COM','TENTOR'),
('U4','A2','TENTOR1','BLITAR',87999,'TENTOR1@GMAIL.COM','TENTOR1'),
('U5','A3','admin','Kediri',98299,'admin@gmail.com','admin123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
