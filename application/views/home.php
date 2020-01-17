<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="<?php echo base_url ('assets/img/sidebar-1.jpg')?>">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Sistem Pendukung <br> Keputusan Beasiswa
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="<?php echo base_url ('c_main/index')?>">
              <i class="material-icons">dashboard</i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url ('c_main/profile')?>">
              <i class="material-icons">library_books</i>
              <p>Weighted Product</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url ('c_main/table')?>">
              <i class="material-icons">library_books</i>
              <p>Simple Additive Weighting</p>
            </a>
          </li>
        </ul>
      </div>
    </div>   
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#"><b>Home</b></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Metode</h4>
                  <p class="card-category">Weighted Product</p>
                </div>
                <div class="card-body table-responsive">
                  <ul>
                      Metode Weighted Product merupakan teknik pengambilan keputusan dari beberapa pilihan alternatif yang ada.
                    <hr/>
                      Weighted Product merupakan metode pengambilan keputusan dengan cara perkalian untuk menghubungkan rating atribut.
                    <hr/>
                      Bobot untuk atribut keuntungan berfungsi sebagai pangkat positif dalam proses perkalian, sementara bobot untuk atribut biaya berfungsi sebagai pangkat negatif. 
                    <hr/>
                      Langkah-langkah dalam perhitungan metode Weighted Product adalah sebagai berikut : 
                        <li>1. Mendefinisikan terlebih dahulu kriteria-kriteria yang akan dijadikan sebagai tolak ukur penyelesaian masalah. </li>
                        <li>2. Menormalisasi setiap nilai alternatif. </li>
                        <li>3. Menghitung nilai bobot preferensi pada setiap alternatif. </li>
                        <li>4. Melakukan perangkingan. </li>
                    <hr/>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Metode</h4>
                  <p class="card-category">Simple Additive Weighting</p>
                </div>
                <div class="card-body table-responsive">
                  <ul>
                      Metode Simple Additive Weighting (SAW) sering juga dikenal dengan metode penjumlahan terbobot
                    <hr/>
                      Metode SAW merupakan suatu metode yang digunakan untuk mencari alternatif optimal dari sejumlah alternatif dengan kriteria tertentu. 
                    <hr/>
                      Metode Simple Additive Weighting memerlukan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat dibandingkan dengan semua rating alternatif yang ada. 
                    <hr/>
                      Langkah-langkah dalam penyelesaian metode Simple Additive Weighting yaitu sebagai berikut : 
                        <li>1. Mendefinisikan terlebih dahulu kriteria-kriteria yang akan dijadikan sebagai tolak ukur penyelesaian masalah. </li>
                        <li>2. Menormalisasi setiap nilai alternatif pada setiap atribut dengan cara menghitung nilai rating kinerja. </li>
                        <li>3. Menghitung nilai bobot preferensi pada setiap alternatif. </li>
                        <li>4. Melakukan perangkingan. </li>
                    <hr/>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
