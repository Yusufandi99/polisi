/*
 Navicat Premium Dump SQL

 Source Server         : databaseku
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : surat

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 12/02/2025 14:11:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for devisi
-- ----------------------------
DROP TABLE IF EXISTS `devisi`;
CREATE TABLE `devisi`  (
  `id_devisi` int NOT NULL AUTO_INCREMENT,
  `deskripsi_devisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_devisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of devisi
-- ----------------------------
INSERT INTO `devisi` VALUES (1, 'Devisi - 01');
INSERT INTO `devisi` VALUES (2, 'Devisi - 02');
INSERT INTO `devisi` VALUES (3, 'Devisi - 03');
INSERT INTO `devisi` VALUES (4, 'Devisi - 04');

-- ----------------------------
-- Table structure for dispo
-- ----------------------------
DROP TABLE IF EXISTS `dispo`;
CREATE TABLE `dispo`  (
  `no_disposisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tipe` int NULL DEFAULT NULL,
  `no_surat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_dispo` date NULL DEFAULT NULL,
  `prihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kepada` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prioritas` enum('SEGERA','TENTATIF') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sifat_surat` enum('PENTING','UMUM') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file_pdf` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `id_petugas_input` int NULL DEFAULT NULL,
  `id_devisi` int NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT NULL,
  PRIMARY KEY (`no_disposisi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dispo
-- ----------------------------
INSERT INTO `dispo` VALUES ('COBAAA', 100, 'COBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaaaaaaaaa', '2025-02-07', 'penangkapan', 'perwira dan bintara', 'SEGERA', 'PENTING', 'COBAAA.pdf', 100002, 4, 5);
INSERT INTO `dispo` VALUES ('DISP/007/I/2025/SETJEN', 100, 'ST/005/VIII/2024/SETJEN', '2025-01-01', 'penangkapan', 'perwira dan bintara ', 'SEGERA', 'PENTING', NULL, 100003, 4, 5);
INSERT INTO `dispo` VALUES ('DISP/008/I/2025/Ditreskrimsus', 200, 'B/123/I/2025/Ditreskrimsus', '2025-01-02', 'permohonan pemeriksaan air limbah', 'kepala laboratorium kesehatan', 'TENTATIF', 'UMUM', 'DISP_008_I_2025_Ditreskrimsus.pdf', 100001, 2, 2);
INSERT INTO `dispo` VALUES ('DISP/009/IX/2025/SETJEN', 100, 'SPeng/009/I/2025/SETJEN', '2025-01-12', 'permohonan memberikan data untuk tugas', 'ditreskrimsus ', 'TENTATIF', 'UMUM', NULL, 100004, 1, 1);
INSERT INTO `dispo` VALUES ('DISP/010/IX/2025/SETJEN', 200, 'Lap/010/I/2025/SETJEN', '2025-01-12', 'laporan kegiatan', 'kapolda', 'TENTATIF', 'UMUM', NULL, 100001, 1, 5);
INSERT INTO `dispo` VALUES ('DISP/010/V/2024/Kemenkeu', 100, 'SPRIN/010/V/2024/KEMENKEU', '2024-05-30', 'pengamanan di jl seturan', 'perwira dan bintara ', 'SEGERA', 'PENTING', NULL, 100002, 2, 1);
INSERT INTO `dispo` VALUES ('DISP/011/I/2025/Diintelkam', 200, 'SPM/011/I/2025/Ditintelkam', '2025-01-13', 'permohonan  pelatihan dasar Bintara ', 'kepala bagian diintelkam', 'SEGERA', 'PENTING', NULL, 100003, 3, 2);
INSERT INTO `dispo` VALUES ('DISP/012/I/2025/Kapolda', 200, 'KEP/005/VIII/2024/Kapolda', '2025-01-15', 'penetapan struktur organisasi dan daftar susunan personel', 'staff polda', 'SEGERA', 'PENTING', 'DISP_012_I_2025_Kapolda.pdf', 100004, 4, 5);
INSERT INTO `dispo` VALUES ('DISP/012/I/2025/SETJEN', 200, 'ND/012/I/2025/SETJEN', '2025-01-13', 'Perkembangan Kasus Tindak Pidana Korupsi', 'kasat reskrim polres ', 'TENTATIF', 'PENTING', NULL, 100001, 1, 4);
INSERT INTO `dispo` VALUES ('DISP/013/I/2025/Bidhumas', 200, 'Peng/005/VIII/2024/Bidhumas', '2025-01-16', 'pengawalan presiden ', 'divisi renmin,divisi subditgasum, dan divisi subdiitdalmas', 'SEGERA', 'PENTING', NULL, 100002, 2, 5);
INSERT INTO `dispo` VALUES ('DISP/013/I/2025/Bidhumas1', 100, 'Peng/005/VIII/2024/BidhumasCOBAAAAA', '2025-02-07', 'cobaaaaaaaaaaaaa', 'COBAAAA', 'SEGERA', 'PENTING', 'DISP_013_I_2025_Bidhumas1.pdf', 100003, 4, 5);
INSERT INTO `dispo` VALUES ('Nugroho', 200, 'Nugroho', '2025-02-03', 'Nugroho111111', 'Nugroho', 'TENTATIF', 'UMUM', 'Nugroho.pdf', 100004, 1, 1);
INSERT INTO `dispo` VALUES ('yusuf', 200, 'yusuf111', '2025-02-14', 'yusuf', 'yusuf', 'SEGERA', 'UMUM', 'yusuf.pdf', 100001, 3, 2);

-- ----------------------------
-- Table structure for dispo_status
-- ----------------------------
DROP TABLE IF EXISTS `dispo_status`;
CREATE TABLE `dispo_status`  (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `deskripsi_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `closing` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dispo_status
-- ----------------------------
INSERT INTO `dispo_status` VALUES (1, 'Menunggu', 0);
INSERT INTO `dispo_status` VALUES (2, 'Proses', 0);
INSERT INTO `dispo_status` VALUES (3, 'Koreksi', 0);
INSERT INTO `dispo_status` VALUES (4, 'Tolak', 1);
INSERT INTO `dispo_status` VALUES (5, 'Selesai', 1);

-- ----------------------------
-- Table structure for dispo_trans
-- ----------------------------
DROP TABLE IF EXISTS `dispo_trans`;
CREATE TABLE `dispo_trans`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_disposisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_petugas_validasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu_trans` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `uraian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dispo_trans
-- ----------------------------
INSERT INTO `dispo_trans` VALUES (9, 'DISP/013/I/2025/Bidhumas1', '100012', '2025-02-09 13:11:46', 'gass mas eeee', 5);
INSERT INTO `dispo_trans` VALUES (11, 'COBAAA', '100012', '2025-02-10 01:42:48', 'masih dalam tahapan proses pengecekan validasi', 2);
INSERT INTO `dispo_trans` VALUES (12, 'DISP/012/I/2025/Kapolda', '100012', '2025-02-10 02:41:40', 'siapp', 5);
INSERT INTO `dispo_trans` VALUES (13, 'COBAAA', '100013', '2025-02-10 14:58:56', 'proses 3', 2);
INSERT INTO `dispo_trans` VALUES (14, 'COBAAA', '100013', '2025-02-11 06:47:37', 'selesai', 5);
INSERT INTO `dispo_trans` VALUES (15, 'DISP/007/I/2025/SETJEN', '100013', '2025-02-11 06:49:39', 'weewewrew', 1);
INSERT INTO `dispo_trans` VALUES (16, 'DISP/007/I/2025/SETJEN', '100013', '2025-02-11 06:49:55', 'gfbgfdb', 2);
INSERT INTO `dispo_trans` VALUES (17, 'DISP/007/I/2025/SETJEN', '100013', '2025-02-11 06:50:38', 'selesai dan siapp', 5);
INSERT INTO `dispo_trans` VALUES (18, 'DISP/008/I/2025/Ditreskrimsus', '100013', '2025-02-11 16:05:34', 'siapppp bos oke', 1);
INSERT INTO `dispo_trans` VALUES (19, 'DISP/008/I/2025/Ditreskrimsus', '100013', '2025-02-11 23:26:24', 'sabar bos masih proses ini', 2);
INSERT INTO `dispo_trans` VALUES (26, 'yusuf', '100014', '2025-02-12 13:34:26', 'coba 1', 2);
INSERT INTO `dispo_trans` VALUES (27, 'yusuf', '100014', '2025-02-12 13:34:38', 'coba 2', 3);
INSERT INTO `dispo_trans` VALUES (28, 'yusuf', '100014', '2025-02-12 13:34:56', 'coba 2 berhasil', 2);

-- ----------------------------
-- Table structure for jenis_surat
-- ----------------------------
DROP TABLE IF EXISTS `jenis_surat`;
CREATE TABLE `jenis_surat`  (
  `id_jenis_surat` int NOT NULL AUTO_INCREMENT,
  `id_tipe_surat` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis_surat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_surat
-- ----------------------------
INSERT INTO `jenis_surat` VALUES (1, 100);
INSERT INTO `jenis_surat` VALUES (2, 100);
INSERT INTO `jenis_surat` VALUES (3, 100);
INSERT INTO `jenis_surat` VALUES (4, 200);
INSERT INTO `jenis_surat` VALUES (5, 200);

-- ----------------------------
-- Table structure for jenis_surat_template
-- ----------------------------
DROP TABLE IF EXISTS `jenis_surat_template`;
CREATE TABLE `jenis_surat_template`  (
  `id_template` int NOT NULL AUTO_INCREMENT,
  `id_jenis_surat` int NULL DEFAULT NULL,
  `id_divisi` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_template`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_surat_template
-- ----------------------------
INSERT INTO `jenis_surat_template` VALUES (1, 1, 1);
INSERT INTO `jenis_surat_template` VALUES (2, 1, 2);
INSERT INTO `jenis_surat_template` VALUES (3, 1, 4);

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_devisi` int NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_login` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pass_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100015 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES (100001, 'petugas 01', 1, 'Bripda', 'user01', '1234567');
INSERT INTO `petugas` VALUES (100002, 'petugas 02', 2, 'Bripda', 'user02', '1234567');
INSERT INTO `petugas` VALUES (100003, 'petugas 03', 3, 'Bripda', 'user03', '1234567');
INSERT INTO `petugas` VALUES (100004, 'petugas 04', 1, 'Bripda', 'user04', '1234567');
INSERT INTO `petugas` VALUES (100013, 'Yusuf Andi Nugroho', 1, 'kapolsek', 'yusuf', 'dd2eb170076a5dec97cdbbbbff9a4405');
INSERT INTO `petugas` VALUES (100014, 'andi nugroho', 2, 'anggota', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46');

-- ----------------------------
-- Table structure for tipe_surat
-- ----------------------------
DROP TABLE IF EXISTS `tipe_surat`;
CREATE TABLE `tipe_surat`  (
  `id_tipe` int NOT NULL,
  `deskripsi_tipe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipe`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipe_surat
-- ----------------------------
INSERT INTO `tipe_surat` VALUES (100, 'Surat Masuk');
INSERT INTO `tipe_surat` VALUES (200, 'Surat Keluar');

SET FOREIGN_KEY_CHECKS = 1;
