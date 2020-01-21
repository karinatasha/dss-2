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
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url ('c_main/profile')?>">
              <i class="material-icons">library_books</i>
              <p>Weighted Product</p>
            </a>
          </li>
          <li class="nav-item">
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
            <a class="navbar-brand" href="#"><b>Weighted Product</b></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content" id="app">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="<?php echo base_url ('c_main/profile')?>" class="btn btn-success pull-left"><span class="fa fa-arrow-circle-left"></span> <b>Kembali</b> </a>
              <a href="#" class="mt-2 ml-2 pt-5">
                Running Time : {{ this.runtime }} seconds
              </a>
              <br>
              <br>
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Pendaftar</h4>
                  <p class="card-category">Hasil Perangkingan Metode Weighted Product</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" >
                      <thead class=" text-success">
                        <th>
                          <b>Peringkat</b>
                        </th>
                        <th>
                          <b>Hasil Bobot Preferensi</b>
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
                        <tr v-for="data in hasil">
                          <td>
                            {{ data.peringkat }}
                          </td>
                          <td>
                            {{ data.vektor }}
                          </td>
                          <td>
                            {{ data.nama }}
                          </td>
                          <td>
                            {{ data.prodi }}
                          </td>
                          <td>
                            {{ data.angkatan }}
                          </td>
                          <td>
                            {{ data.pot }}
                          </td>
                          <td class="text-primary">
                            {{ formatPrice(data.ukt) }}
                          </td>
                          <td>
                            {{ data.jt }}
                          </td>
                        </tr>
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
<script type="text/javascript">
  var app = new Vue({
    el: '#app',
    data: {
      weight: [0.38, 0.31, 0.31],
      mahasiswa: <?php echo json_encode($mahasiswa); ?>,
      vector: [],
      hasil: [], 
      runtime: 0
    },
    methods: {
      dwp: function() {
        startTime = new Date();

        var count;
        for (var i = 0; i < this.mahasiswa.length; i++) {
          count = Math.pow(this.mahasiswa[i].pot, this.weight[0]) * Math.pow(this.mahasiswa[i].ukt, this.weight[1]) * Math.pow(this.mahasiswa[i].jt, this.weight[2])
          this.vector[i] = [this.mahasiswa[i].id, count]
        }

        var sum = this.vector.reduce((r, a) => a.map((b, i) => (r[i] || 0) + b), []);

        for (var i = 0; i < this.mahasiswa.length; i++) {
          this.vector[i] = [this.mahasiswa[i].id, this.vector[i][1]/sum[1]];
        }

        this.vector = this.vector.sort(this.Comparator);

        var mapPot = {
          1: "7.500.000-10.000.000",
          2: "5.000.000-7.500.000",
          3: "2.500.000-5.000.000",
          4: "1.000.000-2.500.000",
          5: "500.000-1.000.000",
          6: "300.000-500.000",
          7: "<300.000"
        };

        for (var i = 0; i < this.vector.length; i++) {
          this.hasil[i] = this.findObjectKey(this.mahasiswa, 'id', this.vector[i][0]);
          this.hasil[i].peringkat = i + 1;
          this.hasil[i].vektor = (this.vector[i][1]).toFixed(3).replace('.',',').toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          this.hasil[i].pot = mapPot[this.hasil[i].pot]
        }

        endTime = new Date();
        this.runtime = (endTime - startTime)/1000;
        console.log(this.vector)
        console.log(this.hasil)
      },

      formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },

      Comparator: function(a,b) {
        if (a[1] > b[1]) return -1;
        if (a[1] < b[1]) return 1;
        return 0;
      },

      findObjectKey: function(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i];
            }
        }
        return null;
      }
    },
   
    beforeMount(){
      this.dwp()
    }
  })
  
</script>
</html>
