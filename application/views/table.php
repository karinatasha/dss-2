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
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Upload</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body table-responsive">
                  <ul>
                    <form action="<?php echo base_url();?>c_main/exeImport/" method="post" enctype="multipart/form-data">
                        <label>Upload File</label>
                        <input type="file" placeholder="" class="form-control" name="file">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <a href="<?php echo base_url ('c_main/hasil2')?>" class="btn btn-success pull-left"><span class="fa fa-arrow-circle-right"></span> <b>Proses</b> </a>
              <a data-toggle="modal" data-target="#exampleModal" class="btn btn-danger"><b>Hapus</b></a>
              <div class="clearfix"></div>
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Pendaftar</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-success">
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
                        <?php foreach ($mahasiswa as $m) { ?>
                          <tr>
                            <td> <?= $m->nama ?></td>
                            <td> <?= $m->prodi ?></td>
                            <td> <?= $m->angkatan ?></td>
                            <td> <?= $m->pot ?></td>
                            <td class="text-primary"> <?= $m->ukt ?></td>
                            <td> <?= $m->jt ?></td>
                          </tr>
                        <?php } ?> 
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
  <!-- Modal Hapus -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            <div class="text-center">
                              <i class="fa fa-trash fa-4x mb-3 animated bounce"></i>
                              <p style="font-size: 15px">Apakah anda yakin ingin menghapus data ini?</p>
                            </div>

                          </div> <!-- modal body -->
                          <div class="modal-footer">
                           <!--  <form method="post" action="<?php echo base_url ('c_main/hapus')?>"> -->
                              <a href="<?php echo base_url ('c_main/hapus')?>" class="btn btn-default" type="submit">Ya</a>
                           <!--  </form> -->
                              <a class="btn btn-default" data-dismiss="modal">Batal</a>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->
</body>
</html>
