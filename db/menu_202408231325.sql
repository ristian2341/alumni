INSERT INTO test_db.menu (nama,id_header,`level`,urutan,url_menu,posisi,`read`,`create`,`update`,`delete`,akses_menu,created_at,created_by,updated_at,updated_by) VALUES
	 ('Setting',NULL,1,1,'#','1',1,1,1,1,'user_menu',1,'1',1,'1'),
	 ('User',1,1,1,'user/index',NULL,1,1,1,1,'user',NULL,NULL,1722162274,'2024061800001'),
	 ('Hak Akses User',1,2,2,'menu-user/index',NULL,1,1,1,1,'hak_akses_user',1721546240,'2024061800001',1722162293,'2024061800001'),
	 ('Setting Aplikasi',NULL,1,1,'setting/index',NULL,0,1,0,0,'setting_aplikasi',1722415850,'2024061800001',1722415850,'2024061800001'),
	 ('Perusahaan',NULL,1,2,'perusahaan/index',NULL,1,1,1,1,'perusahaan',1722927880,'2024061800001',1722927880,'2024061800001'),
	 ('Lowongan Kerja',NULL,1,1,'lowker/index',NULL,1,1,1,1,'lowongan_kerja',1723022271,'2024061800001',1723022271,'2024061800001'),
	 ('Data Siswa',NULL,1,3,'siswa/index',NULL,1,1,1,1,NULL,1724106688,'2024061800001',1724106688,'2024061800001');
