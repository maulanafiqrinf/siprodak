CREATE TABLE `tb_galeri` (
  `id_galeri` int NOT NULL,
  `nama` varchar(250) NOT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id_galeri`);

ALTER TABLE `tb_galeri`
  MODIFY `id_galeri` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


  CREATE TABLE `tb_berita` (
  `id_berita` int NOT NULL,
  `nama` varchar(250) NOT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `detail` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

ALTER TABLE `tb_berita`
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;