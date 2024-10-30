-- test_db.curiculum_vitae definition

CREATE TABLE `curiculum_vitae` (
  `code` varchar(16) NOT NULL DEFAULT '',
  `nik` char(16) NOT NULL DEFAULT '',
  `nama` varchar(150) DEFAULT NULL,
  `alamat_nik` varchar(250) DEFAULT NULL,
  `alamat_domisili` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `no_wa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`code`,`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.cv_pendidikan definition

CREATE TABLE `cv_pendidikan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code_cv` char(16) NOT NULL DEFAULT '',
  `nik` char(16) NOT NULL DEFAULT '',
  `sekolah` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `periode` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`code_cv`,`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.cv_pengalaman definition

CREATE TABLE `cv_pengalaman` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `code_cv` char(16) NOT NULL DEFAULT '',
  `nik` char(16) NOT NULL DEFAULT '',
  `nama_pt` varchar(100) DEFAULT NULL,
  `periode` char(20) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `type_pendidikan` varchar(100) DEFAULT NULL COMMENT 'Formal || Non Formal',
  PRIMARY KEY (`id`,`code_cv`,`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.cv_siswa definition

CREATE TABLE `cv_siswa` (
  `code` varchar(16) NOT NULL DEFAULT '',
  `nik` char(16) NOT NULL DEFAULT '',
  `pendidikan` text,
  `pengalaman` text,
  `kemampuan` text,
  PRIMARY KEY (`code`,`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.group_menu definition

CREATE TABLE `group_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- test_db.group_menu_detail definition

CREATE TABLE `group_menu_detail` (
  `id_group` int(11) NOT NULL DEFAULT '0',
  `id_menu` int(11) NOT NULL DEFAULT '0',
  `read` tinyint(1) DEFAULT '0',
  `create` tinyint(1) DEFAULT '0',
  `update` tinyint(1) DEFAULT '0',
  `delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_group`,`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.jawaban_kuisioner definition

CREATE TABLE `jawaban_kuisioner` (
  `code` char(15) NOT NULL DEFAULT '',
  `nisn` char(100) NOT NULL DEFAULT '',
  `nama` varchar(150) DEFAULT NULL,
  `status_data` tinyint(1) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(15) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(15) DEFAULT NULL,
  PRIMARY KEY (`code`,`nisn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.jawaban_kuisioner_detail definition

CREATE TABLE `jawaban_kuisioner_detail` (
  `code_jawaban` char(15) NOT NULL DEFAULT '',
  `code_kuisioner` char(15) NOT NULL DEFAULT '',
  `jawaban` text,
  PRIMARY KEY (`code_jawaban`,`code_kuisioner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.jurusan definition

CREATE TABLE `jurusan` (
  `code` char(15) NOT NULL DEFAULT '',
  `nama` varchar(100) DEFAULT NULL,
  `status_data` tinyint(1) DEFAULT '1',
  `created_by` char(16) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.lowker definition

CREATE TABLE `lowker` (
  `code_lowker` char(16) NOT NULL DEFAULT '',
  `tgl_post` date DEFAULT NULL,
  `tgl_last` date DEFAULT NULL,
  `lowongan` varchar(100) DEFAULT NULL,
  `id_perusahaan` char(16) DEFAULT NULL,
  `nama_perusahaan` varchar(150) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(150) DEFAULT NULL,
  `propinsi` varchar(150) DEFAULT NULL,
  `kontak` char(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `requirement` text,
  `keterangan` text,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`code_lowker`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.magang definition

CREATE TABLE `magang` (
  `code` char(15) NOT NULL DEFAULT '',
  `code_perusahaan` char(16) DEFAULT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.magang_detail definition

CREATE TABLE `magang_detail` (
  `code_magang` char(15) DEFAULT NULL,
  `nisn` char(16) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `rombel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.master_kuisioner definition

CREATE TABLE `master_kuisioner` (
  `code` char(15) NOT NULL DEFAULT '',
  `code_jurusan` char(15) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL COMMENT '''MAGANG'',''ALUMNI''',
  `pertanyaan` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `status_data` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`code`),
  KEY `master_kuisioner_code_IDX` (`code`) USING BTREE,
  KEY `master_kuisioner_code_jurusan_IDX` (`code_jurusan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.menu definition

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `id_header` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `url_menu` varchar(100) DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL COMMENT 'left, top',
  `read` tinyint(1) DEFAULT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `akses_menu` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `menu_id_menu_IDX` (`id_menu`) USING BTREE,
  KEY `menu_id_header_IDX` (`id_header`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;


-- test_db.menu_user definition

CREATE TABLE `menu_user` (
  `id_user_menu` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(16) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.perusahaan definition

CREATE TABLE `perusahaan` (
  `id_perusahaan` char(16) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `propinsi` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `pic1` varchar(100) DEFAULT NULL,
  `phone_pic1` char(15) DEFAULT NULL,
  `email_pic1` varchar(100) DEFAULT NULL,
  `pic2` varchar(100) DEFAULT NULL,
  `phone_pic2` varchar(100) DEFAULT NULL,
  `email_pic2` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `status_data` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.profile definition

CREATE TABLE `profile` (
  `profile_id` char(16) NOT NULL,
  `user_id` char(16) DEFAULT NULL,
  `type_user` varchar(100) DEFAULT NULL COMMENT 'PEGAWAI,PERUSAHAAN',
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `kabupaten` varchar(150) DEFAULT NULL,
  `profinsi` varchar(150) DEFAULT NULL,
  `jabatan` int(11) DEFAULT NULL,
  `instansi` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  KEY `profile_profile_id_IDX` (`profile_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Profile User Untuk';


-- test_db.send_mail definition

CREATE TABLE `send_mail` (
  `code` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_email` varchar(150) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `from` varchar(150) NOT NULL,
  `to` varchar(250) NOT NULL,
  `cc` varchar(200) DEFAULT NULL,
  `bcc` varchar(200) DEFAULT NULL,
  `body` text,
  `status` tinyint(1) DEFAULT '1' COMMENT '1 => active || 2 => send || 0 => Not Send',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.`session` definition

CREATE TABLE `session` (
  `id` varchar(100) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.setting definition

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `instansi` varchar(100) DEFAULT NULL,
  `alamat_instansi` varchar(150) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `profinsi` varchar(150) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `background` varchar(150) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `email_notif` varchar(100) DEFAULT NULL,
  `password_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_setting`),
  KEY `setting_id_setting_IDX` (`id_setting`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- test_db.siswa definition

CREATE TABLE `siswa` (
  `code` char(16) NOT NULL,
  `nipd` char(16) DEFAULT NULL,
  `nisn` char(16) DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jen_kelamin` char(1) DEFAULT NULL COMMENT 'P = Perempuan || L = Laki-Laki',
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `rt` char(5) DEFAULT NULL,
  `rw` char(5) DEFAULT NULL,
  `dusun` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kode_pos` char(10) DEFAULT NULL,
  `jenis_tinggal` varchar(100) DEFAULT NULL,
  `alat_transportasi` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `handphone` char(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `skhun` bigint(20) DEFAULT NULL,
  `no_kps` varchar(50) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `tgl_lahir_ayah` int(11) DEFAULT NULL,
  `pendidikan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `penghasilan_ayah` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `tgl_lahir_ibu` int(11) DEFAULT NULL,
  `pendidikan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `tgl_lahir_wali` int(11) DEFAULT NULL,
  `pendidikan_wali` varchar(100) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `penghasilan_wali` varchar(100) DEFAULT NULL,
  `nik_wali` varchar(100) DEFAULT NULL,
  `rombel_now` varchar(100) DEFAULT NULL,
  `no_peserta_ujian` varchar(100) DEFAULT NULL,
  `no_seri_ijazah` varchar(100) DEFAULT NULL,
  `nomor_kip` varchar(100) DEFAULT NULL,
  `nama_di_kip` int(11) DEFAULT NULL,
  `nomor_kks` varchar(100) DEFAULT NULL,
  `no_akta_lahir` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `no_rekening_bank` varchar(100) DEFAULT NULL,
  `atas_nama_rekening` varchar(100) DEFAULT NULL,
  `layak_pip` varchar(20) DEFAULT NULL,
  `alasan_layak_pip` text,
  `kebutuhan_khusus` varchar(100) DEFAULT NULL,
  `sekolah_asal` varchar(150) DEFAULT NULL,
  `anak_keberapa` int(11) DEFAULT NULL,
  `lintang` varchar(20) DEFAULT NULL,
  `bujur` varchar(20) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `lingkar_kepala` int(11) DEFAULT '0',
  `jml_saudara` int(11) DEFAULT NULL,
  `jarak_rumah` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `id_status_siswa` tinyint(1) DEFAULT '1',
  `tahun_lulus` char(5) DEFAULT NULL,
  `code_jurusan` char(15) DEFAULT NULL,
  `whatsapp` varchar(100) DEFAULT NULL,
  `sosial_media` varchar(255) DEFAULT NULL,
  `perusahaan` varchar(100) DEFAULT NULL,
  `alamat_perusahaan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `mulai_bekerja` date DEFAULT NULL,
  `jenis_usaha` varchar(150) DEFAULT NULL,
  `lokasi_usaha` varchar(150) DEFAULT NULL,
  `nama_universitas` varchar(150) DEFAULT NULL,
  `jurusan_kuliah` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- test_db.status_siswa definition

CREATE TABLE `status_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_data` tinyint(1) DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` char(16) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


-- test_db.`user` definition

CREATE TABLE `user` (
  `user_id` char(16) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `type_akun` varchar(150) DEFAULT 'CUSTOMER' COMMENT '''CUSTOMER'' | ''PO''',
  `device_id` varchar(255) DEFAULT NULL,
  `fire_base` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `long` int(11) DEFAULT NULL,
  `lat` int(11) DEFAULT NULL,
  `id_telegram` varchar(100) DEFAULT NULL,
  `generate_code` char(10) DEFAULT NULL,
  `type_user` varchar(100) DEFAULT NULL COMMENT 'SISWA, PEGAWAI, PERUSAHAAN',
  `developer` tinyint(1) DEFAULT NULL,
  `approval` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `authKey` varchar(100) DEFAULT NULL,
  `accessToken` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `propinsi` varchar(100) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` char(16) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` char(16) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;