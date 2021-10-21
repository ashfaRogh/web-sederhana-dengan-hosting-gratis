<?php include_once("inc_header.php") ?>
<!-- untuk home -->
<section id="home">
    <img src="<?php echo ambil_gambar('8') ?>" />
    <div class="kolom">
        <p class="deskripsi"><?php echo ambil_kutipan('8') ?></p>
        <h2><?php echo ambil_judul('8') ?></h2>
        <?php echo maximum_kata(ambil_isi('8'), 30) ?>
        <p><a href="<?php echo buat_link_halaman('8') ?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
    </div>
</section>

<!-- untuk courses -->
<section id="courses">
    <div class="kolom">
        <p class="deskripsi"><?php echo ambil_kutipan('9') ?></p>
        <h2><?php echo ambil_judul('9') ?></h2>
        <?php echo maximum_kata(ambil_isi('9'), 30) ?>
        <p><a href="<?php echo buat_link_halaman('9') ?>" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
    </div>
    <img src="<?php echo ambil_gambar('9') ?>" />
</section>

<!-- untuk portfolio -->
<section id="portfolio">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi">My Portfolio</p>
            <h2>Portfolio</h2>
            <p>Merupakan kumpulan dari beberapa projek yang telah saya kerjakan</p>
        </div>

        <div class="portfolio-list">
            <?php
            $sql1       = "select * from portfolio order by id asc";
            $q1         = mysqli_query($koneksi, $sql1);
            while ($r1 = mysqli_fetch_array($q1)) {
            ?>
                <div class="kartu-portfolio">
                    <a href="<?php echo buat_link_portfolio($r1['id']) ?>">
                        <img src="<?php echo url_dasar() . "/gambar/" . portfolio_foto($r1['id']) ?>" />
                        <p><?php echo $r1['nama'] ?></p>
                    </a>
                </div>
            <?php
            }
            ?>


        </div>
    </div>
</section>

<!-- untuk microcontroller -->
<section id="microcontroller">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi">Microcontroller</p>
            <h2>Microcontroller</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi magni tempore expedita sequi. Similique rerum doloremque impedit saepe atque maxime.</p>
        </div>

        <div class="microcontroller-list">
            <?php
            $sql1   = "select * from microcontroller order by id asc";
            $q1     = mysqli_query($koneksi, $sql1);
            while ($r1 = mysqli_fetch_assoc($q1)) {
            ?>
                <div class="kartu-microcontroller">
                    <a href="<?php echo buat_link_microcontroller($r1['id'])?>">
                    <img src="<?php echo url_dasar()."/gambar/".microcontroller_foto($r1['id'])?>"/>
                    </a>
                </div>
            <?php
            }
            ?>


        </div>
    </div>
</section>
<?php include_once("inc_footer.php") ?>