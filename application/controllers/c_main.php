<?php

class c_main extends CI_Controller {

	function __construct(){
		parent::__construct();		
        $this->load->helper('url');
        $this->load->model('Mahasiswa_model');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
  
	}

	public function index() {
		$this->load->view('elements/head');
		$this->load->view('home');
		$this->load->view('elements/js');
	}

	public function profile() {
		$data['mahasiswa'] = $this->Mahasiswa_model->connect()->result();
		$this->load->view('elements/head');
		$this->load->view('profile', $data);
		$this->load->view('elements/js');
	}

	public function table() {
		$data['mahasiswa'] = $this->Mahasiswa_model->connect()->result();
		$this->load->view('elements/head');
		$this->load->view('table', $data);
		$this->load->view('elements/js');
	}	

	public function hapus() {
		$mahasiswa = $this->Mahasiswa_model->getMahasiswa()->result();
		foreach ($mahasiswa as $m) {
			$id = $m->id;
			$where = array('id' => $id);
			$this->Mahasiswa_model->hapusData($where,'mahasiswa');		
		}
		redirect('profile');
	}
	public function hasil1() {
		$alternative =  $this->db->get('mahasiswa')->result();

		$data = [
			'mahasiswa' => $alternative
		];
		$this->load->view('elements/head');
		$this->load->view('hasil1', $data);
		$this->load->view('elements/js');
	}

	public function hasil2() {
		// Bagian bobot kriteria
		$w_c1 = 0.38;
		$w_c2 = 0.31;
		$w_c3 = 0.31;

		// Pencarian bobot maksimum per kriteria
		$alternative =  $this->db->get('mahasiswa')->result();
		$start = microtime(true);
		$c1 = [];
		foreach ($alternative as $alt) {
			$c1[] = $alt->pot;
		}
		$max_c1 = max($c1);

		$c2 = [];
		foreach ($alternative as $alt) {
			$c2[] = $alt->ukt;
		}
		$max_c2 = max($c2);

		$c3 = [];
		foreach ($alternative as $alt) {
			$c3[] = $alt->jt;
		}
		$max_c3 = max($c3);

		$c = [$c1, $c2, $c3];
		$c_max = [$max_c1, $max_c2, $max_c3];

		$normalisasi = []; 
		foreach ($alternative as $alt) {
			$normalisasi[] = array(
				($alt->pot/$c_max[0]),
				($alt->ukt/$c_max[1]),
				($alt->jt/$c_max[2]),
				($alt->id)
			);
		}

		// die(json_encode($normalisasi));

		// perhitungan vector
		$vector = [];
		$i=0;
		foreach ($normalisasi as $norm) {
			$vector[] = ['id' => $norm[3] , 'value' => (($norm[0]*$w_c1) + ($norm[1]*$w_c2) + ($norm[2]*$w_c3))];
			$i++;
		}

		$value = [];
		foreach ($vector as $key => $val) {
			$value[$key] = $val['value']	;
		}
		array_multisort($value, SORT_DESC, $vector);

		// die(json_encode($vector));

		$hasil = [];
		foreach ($vector as $data) {
			$hasil[] = [
				'data' => $this->db->get_where('mahasiswa', ['id' => $data['id']])->row_array(),
				'value' => $data['value']

			];
		}
		$time_elapsed_secs = microtime(true) - $start;

		$data = array(
			'hasil' => $hasil,
			'runningtime' => $time_elapsed_secs
		);

		$this->load->view('elements/head');
		$this->load->view('hasil2', $data);
		$this->load->view('elements/js');
	}



	function exeImport(){
    if ($_FILES['file']['name']) {
      $fileName = time().$_FILES['file']['name'];

      $config['upload_path'] = FCPATH .'/assets/upload/';
      $config['file_name'] = $fileName;
      $config['allowed_types'] = 'xls|xlsx|csv';
      $config['max_size'] = 10000;

      $this->load->library('upload');
      $this->upload->initialize($config);

      if(! $this->upload->do_upload('file') )
      $this->upload->display_errors();

      $media = $this->upload->data('file');
      $inputFileName = $this->upload->data('full_path');

      try {
        $inputFileType = IOFactory::identify($inputFileName);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
      } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
          //tabel alumni
          $map_pot = [
          	'<300.000' => 7,
          	'300.000-500.000' => 6,
          	'500.000-1.000.000' => 5,
          	'1.000.000-2.500.000' => 4,
          	'2.500.000-5.000.000' => 3,
          	'5.000.000-7.500.000' => 2,
          	'7.500.000-10.000.000' => 1
          ];
          $data = array(
            "nama"=> $rowData[0][0],
            "prodi"=> $rowData[0][1],
            "angkatan" => $rowData[0][2],
            "pot" => $map_pot[$rowData[0][3]],
            "ukt"=> $rowData[0][4],
            "jt"=> $rowData[0][5]
          );
          $insert = $this->db->insert("mahasiswa",$data);
        } 
        /*else {
          unlink($inputFileName);
        
      }*/
      /*$this->session->set_flashdata("suksesImpor", '<div><div class="alert alert-info" id="alert" align="center">Data alumni berhasil diimpor</div></div>');*/
      redirect('profile');
    } else {
      /*$this->session->set_flashdata("gagalImpor", '<div><div class="alert alert-danger" id="alert" align="center">File belum dimasukkan</div></div>');*/
      redirect('profile');
    }
  }


}
