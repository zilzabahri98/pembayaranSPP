    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
    <script>
        window.print();
    </script>
</head>

<body>
    
    
    <div class="col-12 m-0 p-0">
        <div class="col-12 m-0 p-0">
            <h3 class="text-center">Arina Jati</h3>
            <small class="col-12 m-0 p-0 d-block text-center">Petekeyan, RT20 RW 04, Kec. Tahunan, Kab. Jepara</small>
        <div class="col-12 m-0 p-3 row">
			<table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Info Penerima</th>
                                    <th>Info Pesanan</th>
                                    <th>Harga Akhir</th>
                                    <th>Daftar Produk</th>
                                    <th>Tanggal Pesanan</th>
                                <?php
                                $i = 1;
                                foreach ($transaksi as $a) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <b><?php echo $a['ref']; ?></b><br>
                                        <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?><br>
                                    </td>
                                    <td>
                                        <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
                                        <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?><br>
                                    </td>
                                    <td>Rp. <?php echo number_format($a['harga_akhir'],0,',','.'); ?></td>
                                    <td>
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            foreach ($pesanan[$a['id']] as $b) {
                                            ?>
                                            <li class="list-group-item"><?php echo $b['nama']; ?> <?php echo $b['ukuran']; ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <?php echo date('d F Y', strtotime($a['checkout_at'])); ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/RatingForm/js/better-rating.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>