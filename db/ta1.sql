/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.4.27-MariaDB : Database - tugas_akhir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tugas_akhir` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `tugas_akhir`;

/*Table structure for table `tb_absen` */

DROP TABLE IF EXISTS `tb_absen`;

CREATE TABLE `tb_absen` (
  `id_absensi` varchar(10) NOT NULL,
  `id_tentor` varchar(10) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `materi` varchar(255) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `id_tentor` (`id_tentor`),
  CONSTRAINT `tb_absen_ibfk_1` FOREIGN KEY (`id_tentor`) REFERENCES `tb_tentor` (`id_tentor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_absen` */

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
('A2','tentor');

/*Table structure for table `tb_daftar` */

DROP TABLE IF EXISTS `tb_daftar`;

CREATE TABLE `tb_daftar` (
  `id_pendaftaran` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_layanan` varchar(10) DEFAULT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `status_daftar` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_pendaftaran`),
  KEY `nama` (`nama`),
  KEY `id_layanan` (`id_layanan`),
  KEY `asal_sekolah` (`asal_sekolah`),
  KEY `kelas` (`kelas`),
  CONSTRAINT `tb_daftar_ibfk_1` FOREIGN KEY (`nama`) REFERENCES `tb_member` (`id_member`),
  CONSTRAINT `tb_daftar_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `tb_layanan` (`id_layanan`),
  CONSTRAINT `tb_daftar_ibfk_3` FOREIGN KEY (`asal_sekolah`) REFERENCES `tb_member` (`id_member`),
  CONSTRAINT `tb_daftar_ibfk_4` FOREIGN KEY (`kelas`) REFERENCES `tb_member` (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_daftar` */

insert  into `tb_daftar`(`id_pendaftaran`,`nama`,`id_layanan`,`asal_sekolah`,`kelas`,`status_daftar`) values 
('P1','M1','L1','M1','M1','WER');

/*Table structure for table `tb_jadwal` */

DROP TABLE IF EXISTS `tb_jadwal`;

CREATE TABLE `tb_jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `id_tentor` varchar(255) DEFAULT NULL,
  `id_layanan` varchar(50) DEFAULT NULL,
  `ruang` varchar(25) DEFAULT NULL,
  `jadwal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_tentor` (`id_tentor`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`id_tentor`) REFERENCES `tb_tentor` (`id_tentor`),
  CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `tb_layanan` (`id_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_jadwal` */

/*Table structure for table `tb_layanan` */

DROP TABLE IF EXISTS `tb_layanan`;

CREATE TABLE `tb_layanan` (
  `id_layanan` varchar(10) NOT NULL,
  `nama_layanan` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kuota` int(15) DEFAULT NULL,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_layanan` */

insert  into `tb_layanan`(`id_layanan`,`nama_layanan`,`keterangan`,`kuota`) values 
('4','ju','2',0),
('L1','sa','2',0),
('L2','ty','9',0);

/*Table structure for table `tb_member` */

DROP TABLE IF EXISTS `tb_member`;

CREATE TABLE `tb_member` (
  `id_member` varchar(10) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_member_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_member` */

insert  into `tb_member`(`id_member`,`id_user`,`nama`,`alamat`,`asal_sekolah`,`kelas`,`telepon`,`email`) values 
('M1','U1','Maria','Kediri','SMAK ','12',878798,'MARIA@GMAIL.COM'),
('M2','U1','coba','jl kenanga','smp 3','3',986,'aje');

/*Table structure for table `tb_metodebayar` */

DROP TABLE IF EXISTS `tb_metodebayar`;

CREATE TABLE `tb_metodebayar` (
  `id_metode` varchar(10) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_metode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_metodebayar` */

/*Table structure for table `tb_pembayaran` */

DROP TABLE IF EXISTS `tb_pembayaran`;

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(10) NOT NULL,
  `id_tagihan` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_tagihan` (`id_tagihan`),
  KEY `nama` (`nama`),
  KEY `metode_pembayaran` (`metode_pembayaran`),
  CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tb_tagihan` (`id_tagihan`),
  CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`nama`) REFERENCES `tb_member` (`id_member`),
  CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`metode_pembayaran`) REFERENCES `tb_metodebayar` (`id_metode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_pembayaran` */

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
  `judul` varchar(255) DEFAULT NULL,
  `rekapan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rekap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_rekapabsen` */

/*Table structure for table `tb_tagihan` */

DROP TABLE IF EXISTS `tb_tagihan`;

CREATE TABLE `tb_tagihan` (
  `id_tagihan` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `bulan` varchar(25) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_tagihan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `nama` (`nama`),
  CONSTRAINT `tb_tagihan_ibfk_1` FOREIGN KEY (`nama`) REFERENCES `tb_member` (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tagihan` */

/*Table structure for table `tb_tentor` */

DROP TABLE IF EXISTS `tb_tentor`;

CREATE TABLE `tb_tentor` (
  `id_tentor` varchar(10) NOT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kelas_jenjang` varchar(20) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tentor`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_tentor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_tentor` */

insert  into `tb_tentor`(`id_tentor`,`id_user`,`nama`,`alamat`,`kelas_jenjang`,`mapel`,`telepon`,`email`) values 
('T1','U2','Tentor 1','kediri','4-6 SD','Matematika',87391,'tentor@gmail.com'),
('T2','U2','Tentor 2','Malang','1-3 SMA','Bing',854938,'tentor2@gmail.com'),
('t6','U2','tyu','juh','4ddf','vbn',567,'gh');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `ID` varchar(10) NOT NULL,
  `id_akses` varchar(10) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `pw` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_akses` (`id_akses`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tb_akses` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`ID`,`id_akses`,`username`,`pw`) values 
('U1','A1','test1','test1'),
('U2','A1','test2','test2');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
