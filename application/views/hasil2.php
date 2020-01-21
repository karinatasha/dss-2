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
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url ('c_main/index')?>">
              <i class="material-icons">dashboard</i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url ('c_main/profile')?>">
              <i class="material-icons">library_books</i>
              <p>Weighted Product</p>
            </a>
          </li>
          <li class="nav-item active">
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
            <a class="navbar-brand" href="#"><b>Simple Additive Weighting</b></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="<?php echo base_url ('c_main/table')?>" class="btn btn-success pull-left"><span class="fa fa-arrow-circle-left"></span> <b>Kembali</b> </a>
              <a href="#" class="mt-2 ml-2 pt-5">
                Running Time : <?php echo number_format($runningtime,4,",",".")." seconds"; ?>
              </a>
              <br>
              <br>
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Pendaftar</h4>
                  <p class="card-category">Hasil Perangkingan Metode Simple Additive Weighting</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-success">
                        <th>
                          <b>Peringkat</b>
                        </th>
                        <th>
                          <b>Hasil Bobot Preferensi</b>
                        </th>
                        <th>
                          <b>Nama</b>
                        </th>
                        <th>
                          <b>Program Studi</b>
                        </th>
                        <th>
                          <b>Angkatan</b>
                        </th>
                        <th>
                          <b>Penghasilan Orang Tua</b>
                        </th>
                        <th>
                          <b>Uang Kuliah Tunggal</b>
                        </th>
                        <th>
                          <b>Jumlah Tanggungan</b>
                        </th>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($hasil as $h): ?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo number_format($h['value'],3,",",".")?></td>
                            <td><?php echo $h['data']['nama']?></td>
                            <td><?php echo $h['data']['prodi']?></td>
                            <td><?php echo $h['data']['angkatan']?></td>
                            <td><?php echo $h['data']['pot']?></td>
                            <td class="text-primary"><?php echo $h['data']['ukt']?></td>
                            <td><?php echo $h['data']['jt']?></td>
                          </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                
                      </tbody>
                    </table>
                  </div>
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
