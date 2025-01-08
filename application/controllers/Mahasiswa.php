<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Mahasiswa extends CI_Controller
{
   
    public function __construct()
    {
        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('admin_id')) {
            redirect('master/auth'); // Redirect ke halaman login
        } 
        $this->load->model('Mahasiswa_model', 'mhs');
        
    }

    public function index()
    {
        $attradd = array('class' => 'btn  btn-gradient-success');
        
        $tambahdata = anchor('mahasiswa/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        $items_per_page = 10;
        $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $start = ($current_page - 1) * $items_per_page;
        
        // Load model dulu sebelum menggunakannya
        $this->load->model('Mahasiswa_model', 'mhs');
        
        // Get total records and paginated data
        $total_items = $this->mhs->count_all_mahasiswa();
        $mhs = $this->mhs->get_paginated_mahasiswa($start, $items_per_page);
        
        $data = array(
            'mahasiswa' =>  $mhs,
            'title' => 'Data Mahasiswa',
            'btntambah' => $tambahdata,
            'total_items' => $total_items,
            'items_per_page' => $items_per_page,
            'current_page' => $current_page
        );
        $this->template->load('master/template/template_v', 'mahasiswa/mahasiswa_v', $data);
    }
    public function detail($id)
{
    $id = $this->uri->segment(3);
    $get_row = $this->mhs->get_row($id);
    if ($get_row->num_rows() > 0) {
        $row = $get_row->row();
        
        $id_mahasiswa = $row->id_mahasiswa;
        $nim = $row->nim;
        $nama_mhs = $row->nama_mhs;
        $id_fakultas = $row->id_fakultas;
        $id_prodi = $row->id_prodi;
        $kode_fakultas = $row->kode_fakultas;
        $kode_prodi = $row->kode_prodi;
        $nama_fakultas = $row->nama_fakultas;
        $nama_prodi = $row->nama_prodi;
        $email = $row->email;
        $no_telp = $row->no_telp;
        $tanggal_lahir = $row->tanggal_lahir;  // Tambahkan ini
        
        $data = array(
            'title' => 'Detail Mahasiswa',
            'parent' => 'Data Mahasiswa',
            'id_mahasiswa' => $id_mahasiswa,
            'nim' => $nim,
            'nama_mhs' => $nama_mhs,
            'id_fakultas' => $id_fakultas,
            'id_prodi' => $id_prodi,
            'kode_fakultas' => $kode_fakultas,
            'kode_prodi' => $kode_prodi,
            'nama_fakultas' => $nama_fakultas,
            'nama_prodi' => $nama_prodi,
            'email' => $email,
            'no_telp' => $no_telp,
            'tanggal_lahir' => $tanggal_lahir,  // Tambahkan ini
        );
        $this->template->load('master/template/template_v', 'mahasiswa/mahasiswa_d', $data);
    } else {
        $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
        redirect('mahasiswa');
    }
}

public function get_prodi_by_fakultas()
{
    $fakultas_id = $this->input->post('fakultas_id');

    // Validasi input
    if (!empty($fakultas_id)) {
        $prodi = $this->mhs->get_prodi_by_fakultas($fakultas_id);
        $options = '<option value="">Pilih jurusan</option>'; // Default option

        foreach ($prodi as $p) {
            $options .= '<option value="' . $p->id_prodi . '">' . $p->nama_prodi . '</option>';
        }

        echo $options;
    } else {
        echo '<option value="">Pilih jurusan</option>';
    }
}

    
    public function add()
{
    $fakultas = $this->mhs->get_fakultas();
    $prodi = $this->mhs->get_prodi();
    $attrform = array(
        'class' => 'needs-validation space-y-6'
    );
    
   
    $action  = 'mahasiswa/addaction';

    $formopen = form_open($action, $attrform);
    $formclose  = form_close();

    $lnim = form_label('NIM', 'nim');
    $lnama_mhs = form_label('Nama Peserta', 'nama_mhs');
    $lfakultas = form_label('Departemen', 'fakultas');
    $lprodi = form_label('Jurusan', 'prodi');
    $lemail = form_label('Email', 'email');
    $lno_telp = form_label('Nomor Telepon', 'no_telp');
    $ltanggal_lahir = form_label('Tanggal Lahir', 'tanggal_lahir'); // Label Tanggal Lahir

    // ATTRIBUTE INPUT TEXT
    $attrid_mahasiswa = array(
        'type' => 'hidden',
        'name' => 'id_mahasiswa',
        'id' => 'id_mahasiswa',
        'value' => set_value('id_mahasiswa'),
        'required' => 'required'
    );

    $attrnim = array(
        'type' => 'text',
        'name' => 'nim',
        'id' => 'nim',
        'placeholder' => 'Masukkan nim',
        'value' => set_value('nim'),
        'class' => 'form-control nim',
        'required' => 'required'
    );

    $attrnama_mhs = array(
        'type' => 'text',
        'name' => 'nama_mhs',
        'id' => 'nama_mhs',
        'placeholder' => 'Masukkan Nama Mahasiswa',
        'value' => set_value('nama_mhs'),
        'class' => 'form-control',
        'required' => 'required'
    );

    $attremail = array(
        'type' => 'email',
        'name' => 'email',
        'id' => 'email',
        'placeholder' => 'Masukkan Email',
        'class' => 'form-control',
        'value' => set_value('email'),
        'required' => 'required'
    );

   // In your controller, update the phone input attributes
   $attrno_telp = array(
    'type' => 'tel',
    'name' => 'no_telp',
    'id' => 'no_telp',
    'placeholder' => '08XX-XXXX-XXXX',
    'class' => 'w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500',
    
    'value' => set_value('no_telp'),
    'required' => 'required',
    'minlength' => '10',
    'maxlength' => '13'
);

    $attrtanggal_lahir = array( // Input Tanggal Lahir
        'type' => 'date',
        'name' => 'tanggal_lahir',
        'id' => 'tanggal_lahir',
        'value' => set_value('tanggal_lahir'),
        'class' => 'form-control',
        'required' => 'required'
    );

    // DROP DOWN
    $getprd = $this->mhs->get_fakultas();
    $fakultas = array();
    foreach ($getprd as $p) {
        $fakultas[$p->id_fakultas] = $p->nama_fakultas;
    }

    $optfakultas = array(
        'id' => 'fakultas',
        'class' => 'w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500'
    );
    
    

    $getksn = $this->mhs->get_prodi();
    $prodi = array();
    foreach ($getksn as $k) {
        $prodi[$k->id_prodi] = $k->nama_prodi;
    }

    $optprodi = array(
        'id' => 'prodi',
        'class' => 'w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500'
    );

    $ddfakultas = form_dropdown('fakultas', $fakultas, set_value('fakultas'), $optfakultas);
    $ddprodi = form_dropdown('prodi', $prodi, set_value('prodi'), $optprodi);

    // FORM INPUT
    $inputid_mahasiswa = form_input($attrid_mahasiswa);
    $inputnim = form_input($attrnim);
    $inputnama_mhs = form_input($attrnama_mhs);
    $inputemail = form_input($attremail);
    $inputno_telp = form_input($attrno_telp);
    $inputtanggal_lahir = form_input($attrtanggal_lahir); // Input Field Tanggal Lahir

    $attrsubmit = array(
        'id' => 'submit',
        'class' => 'inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
    );
    
    // Form input attributes
    $attrinput = array(
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
    );


    $submit = form_submit('submit', 'Simpan', $attrsubmit);

    // FORM ERRORS
    $fe_nim = form_error('nim');
    $fe_namamhs = form_error('nama_mhs');
    $fe_email = form_error('email');
    $fe_notelp = form_error('no_telp');

    // INVALID FEEDBACKS
    $ivnim = 'NIM harus diisi!';
    $ivnama_mhs = 'Nama harus diisi!';
    $ivemail = 'Email harus diisi!';
    $ivnotelp = 'No telepon harus diisi!';

    // Data untuk template
    $data = array(
        'formopen' => $formopen,
        'formclose' => $formclose,
        'fakultas' => $fakultas,
        'parent' => 'Data Mahasiswa',
        'title' => 'Tambah Mahasiswa',
        'prodi' => $prodi,
        'lnim' => $lnim,
        'lnama_mhs' => $lnama_mhs,
        'lfakultas' => $lfakultas,
        'lprodi' => $lprodi,
        'lemail' => $lemail,
        'lno_telp' => $lno_telp,
        'ltanggal_lahir' => $ltanggal_lahir, // Data Label Tanggal Lahir
        'inputid' => $inputid_mahasiswa,
        'inputnim' => $inputnim,
        'inputnama_mhs' => $inputnama_mhs,
        'iemail' => $inputemail,
        'inputno_telp' => $inputno_telp,
        'inputtanggal_lahir' => $inputtanggal_lahir, // Data Input Tanggal Lahir
        'ddfakultas' => $ddfakultas,
        'ddprodi' => $ddprodi,
        'fe_nim' => $fe_nim,
        'fe_namamhs' => $fe_namamhs,
        'fe_email' => $fe_email,
        'fe_notelp' => $fe_notelp,
        'ivnim' => $ivnim,
        'ivnama_mhs' => $ivnama_mhs,
        'ivemail' => $ivemail,
        'ivnotelp' => $ivnotelp,
        'submit' => $submit
    );
    $this->template->load('master/template/template_v', 'mahasiswa/mahasiswa_form', $data);
}


  //addaction
  public function addaction()
{
    $this->_rules();
    $validation = $this->form_validation->run();
    
    if ($validation == FALSE) {
        $this->add(); // Jika validasi gagal, panggil method add untuk menampilkan form
        return; // Tambahkan return agar tidak melanjutkan eksekusi
    }

    // Generate NIM
    $nim = $this->generate_nim(); // Menghasilkan NIM
    $nama_mhs = $this->input->post('nama_mhs', TRUE);
    $fakultas = $this->input->post('fakultas', TRUE);
    $prodi = $this->input->post('prodi', TRUE);
    $email = $this->input->post('email', TRUE);
    
    $no_telp = $this->input->post('no_telp', TRUE);
    $notelp = str_replace('-', '', $no_telp);
    
    // Tambahkan pengambilan tanggal_lahir
    $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
    
    // Cek jika NIM sudah ada
    if ($this->mhs->check_nim_exists($nim)) {
        $this->session->set_flashdata('error', 'NIM sudah terdaftar!');
        $this->add(); // Kembali ke form
        return; // Pastikan untuk mengakhiri eksekusi
    }

    // Cek jika email sudah ada
    if ($this->mhs->check_email_exists($email)) {
        $this->session->set_flashdata('error', 'Email sudah digunakan!');
        $this->add(); // Kembali ke form
        return; // Pastikan untuk mengakhiri eksekusi
    }
    
    // Data untuk tabel mahasiswa
    $data = array(
        'nim' => $nim,
        'nama_mhs' => $nama_mhs,
        'id_fakultas' => $fakultas,
        'id_prodi' => $prodi,
        'email' => $email,
        'no_telp' => $notelp,
        'tanggal_lahir' => $tanggal_lahir,
    );
    
    // Insert data ke tabel mahasiswa dan ambil id_mahasiswa yang dihasilkan
    $id_mahasiswa = $this->mhs->insert_data_id($data);
    
    // Pastikan id_mahasiswa tidak kosong
    if ($id_mahasiswa) {
        $hashed_password = md5($tanggal_lahir);
        
        // Data untuk tabel user_mhs
        $data_user = array(
            'id_mahasiswa' => $id_mahasiswa, // Menggunakan ID yang baru saja dimasukkan
            'nim' => $nim,
            'password' => $hashed_password,
            'email' => $email
        );

        // Insert data ke tabel user_mhs
        $this->mhs->insert_data_user($data_user);
        
        $this->session->set_flashdata('success', 'Data berhasil disimpan');
        redirect('mahasiswa', 'refresh');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan data mahasiswa.');
        $this->add(); // Kembali ke form
    }
}

  
  // Fungsi untuk menghasilkan NIM
  private function generate_nim() {
      $year = date('y'); // Tahun dua digit
      $month = date('m'); // Bulan dua digit
      $count = $this->mhs->get_last_nim_count($year, $month); // Ambil angka urut berdasarkan tahun dan bulan
      $new_nim = $year . $month . str_pad($count + 1, 3, '0', STR_PAD_LEFT); // Format NIM
      return $new_nim;
  }
  
  

  
  public function update($id = NULL)
    {
        /**
         * set segment
         *
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * pemanggilan method get_row di Mahasiswa_model
         *
         * @var		mixed	$this->mhs->get_row($id)
         */
        $cek_row = $this->mhs->get_row($id);
        /**
         * ambil method dari model untuk menampilkan data fakultas
         *
         * @var		mixed	$this->mhs->get_fakultas()
         */
        $fakultas = $this->mhs->get_fakultas();
        $prodi = $this->mhs->get_prodi();
        

        if ($cek_row->num_rows() > 0) {
            /**
             * data yang di return berupa row()
             * @var		mixed	$cek_row->row()
             */
            $row = $cek_row->row();

            // value dari nilai yang di return oleh variable row()
            /**
             * @var		mixed	$row->id_mahasiswa
             */
            $id_mahasiswa = $row->id_mahasiswa;
            /**
             * @var		mixed	$row->nim
             */
            /**
             * @var		mixed	$row->nama_mhs
             */
            $nama_mhs = $row->nama_mhs;
            /**
             * @var		mixed	$row->id_fakultas
             */
            $id_fakultas = $row->id_fakultas;
            /**
             * @var		mixed	$row->id_prodi
             */
            $id_prodi = $row->id_prodi;
            /**
             * @var		mixed	$row->email
             */
            $email = $row->email;
            /**
             * @var		mixed	$row->no_telp
             */
            $no_telp = $row->no_telp;
            /**
             * @var		mixed	$row->no_telp
             */
            $tanggal_lahir = $row->tanggal_lahir;


            // membuat form 

            $attrform = array(
                'class' => 'needs-validation',
                'novalidate' => 'novalidate'
            );
            /**
             * @var		string	$action
             */
            $action = 'mahasiswa/updateaction';
            /**
             * $form.
             *
             * @param	mixed	$action	
             * @return	void
             */
            $formopen = form_open($action, $attrform);
            /**
             * $formclose.
             *
             * @return	void
             */
            $formclose = form_close();
            /**
             * label
             * label NIM
             * @param	string	'NIM'	
             * @param	string	'nim'	
             * @return	void
             */
            /**
             * $lnama_mhs.
             *. label nama mahasiswa 
             * @param	string	'Nama Mahasiswa'	
             * @param	string	'nama_mhs'      	
             * @return	void
             */
            $lnama_mhs = form_label('Nama Peserta', 'nama_mhs');
            /**
             * $lfakultas.
             * label program studi
             * @param	string	'Fakultas'	
             * @param	string	'fakultas'        	
             * @return	void
             */
            $lfakultas = form_label('Departemen', 'fakultas');
            /**
             * $lprodi.
             * label prodi 
             * @param	string	'Prodi'	
             * @param	string	'prodi'	
             * @return	void
             */
            $lprodi = form_label('Jurusan', 'prodi');
            /**
             * $lemail.
             *  
             * @param	string	'email'	
             * @param	string	'email'	
             * @return	void
             */
            $lemail = form_label('Email', 'email');

            /**
             * $lno_telp.
             * @param	string	'Nomo Telepon'	
             * @param	string	'no_telp'     	
             * @return	void
             */
            $lno_telp = form_label('Nomor Telepon', 'no_telp');
            // ATTRIBUTE INPUT TEXT     
            $ltanggal_lahir = form_label('Tanggal Lahir', 'tanggal_lahir');
            /**
             * @var		mixed	$attrid_mahasiswa
             * 
             */
            $attrid_mahasiswa = array(
                'type' => 'hidden',
                'name' => 'id_mahasiswa',
                'id' => 'id_mahasiswa',
                'value' => set_value('id_mahasiswa', $id_mahasiswa),
                'class' => 'form-control',

            );

            /**
             * @var		mixed	$inim
             */
           
            /**
             * @var		mixed	$inama_mhs
             */
            $attrnama_mhs = array(
                'type' => 'text',
                'name' => 'nama_mhs',
                'id' => 'nama_mhs',
                'placeholder' => 'Masukkan Nama Mahasiswa',
                'value' => set_value('nama_mhs', $nama_mhs),
                'class' => 'form-control',
                'required' => 'required'
            );
            /**
             * @var		mixed	$attremail
             */
            $attremail = array(
                'type' => 'email',
                'name' => 'email',
                'id' => 'email',
                'placeholder' => 'Masukkan Email',
                'value' => set_value('email', $email),
                'class' => 'form-control',
                'required' => 'required'
            );

            /**
             * @var		mixed	$attrno_telp
             */
            $attrno_telp = array(
                'type' => 'text',
                'name' => 'no_telp',
                'id' => 'no_telp',
                'placeholder' => 'Masukkan No Telepon',
                'value' => set_value('no_telp', $no_telp),
                'class' => 'form-control .phone',
                'required' => 'required'
            );

            /**
         * @var		mixed	$attrtanggal_lahir
         * 
         */
        $attrtanggal_lahir = array( // Tambahkan ini
            'type' => 'date',
            'name' => 'tanggal_lahir',
            'id' => 'tanggal_lahir',
            'value' => set_value('tanggal_lahir', $tanggal_lahir),
            'class' => 'form-control',
            'required' => 'required'
        );

            /**
             * di urutkan menjadi nilai array
             * @var		mixed	$data
             */

            // DROP DOWN
            $getprd = $this->mhs->get_fakultas();
            /**
             * $fakultas.
             *
             * @return	void
             */
            $fakultas = array();
            foreach ($getprd as $p) {
                $fakultas[$p->id_fakultas] = $p->nama_fakultas;
            }

            /**
             * @var		mixed	$optfakultas
             */
            $optfakultas = array(
                'id' => 'fakultas',
                'class' => 'form-control'
            );

            $getksn = $this->mhs->get_prodi();
            /**
             * $prodi.
             *

             * @return	void
             */
            $prodi = array();
            foreach ($getksn as $k) {
                $prodi[$k->id_prodi] = $k->nama_prodi;
            }

            /**
             * @var		mixed	$optkonsentasi
             */
            $optprodi = array(
                'id' => 'prodi',
                'class' => 'w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500'
            );


            /**
             * $ddfakultas.
             *
             * @param	string	'fakultas'           	
             * @param	mixed 	$fakultas            	
             * @param	mixed 	set_value('fakultas')	
             * @param	mixed 	$optfakultas         	
             * @return	void
             */
            $ddfakultas = form_dropdown('fakultas', $fakultas, set_value('fakultas', $id_fakultas), $optfakultas);
            /**
             * $ddprodi.
             *
             * @param	string	'prodi'           	
             * @param	mixed 	$prodi            	
             * @param	mixed 	set_value('prodi')	
             * @param	mixed 	$optprodi         	
             * @return	void
             */
            $ddprodi = form_dropdown('prodi', $prodi, set_value('prodi', $id_prodi), $optprodi);
            /**
             * @var		mixed	$inputnim
             */
            /**
            
             * @param	mixed	$attrnim	
             * @return	void
             */

            // FORM INPUT
            /**
             * $inputnim.
             *
             * @param	mixed	$attrnim	
             * @return	void
             */
           
            $inputnama_mhs = form_input($attrnama_mhs);
            /**
             * $inputemail.
             *
             * @param	mixed	$attremail	
             * @return	void
             */
            $inputemail = form_input($attremail);

            /**
             * $inputid_mahasiswa.
             *
             * @param	mixed	$attrid_mahasiswa	
             * @return	void
             */
            $inputid_mahasiswa = form_input($attrid_mahasiswa);

            /**
             * $inputno_telp.
             *
             * @param	mixed	$attrno_telp	
             * @return	void
             */
            $inputno_telp = form_input($attrno_telp);
            /**
             * @var		mixed	$attrsubmit
             */
            /**
 * @var		mixed	$inputtanggal_lahir
 *
 * @param	mixed	$attrtanggal_lahir	
 * @return	void
 */
$inputtanggal_lahir = form_input($attrtanggal_lahir);

            $attrsubmit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            /**
             * FORM ERROR TEXT INPUT
             *
             * @param	string	'nim'	
             * @return	void
             */
           
            $fe_namamhs = form_error('nama_mhs');
            /**
             * $fe_email.
             *
             * @param	string	'email'	
             * @return	void
             */
            $fe_email = form_error('email');
            /**
             * $fe_notelp.
             *
             * @param	string	'no_telp'	
             * @return	void
             */
            $fe_notelp = form_error('no_telp');
            /**
 * $fe_tanggal_lahir.
 *
 * @param	string	'tanggal_lahir'	
 * @return	void
 */
$fe_tanggal_lahir = form_error('tanggal_lahir');

            /**
             * $submit.
             * .
             * @param	string	'sumbit'   	
             * @param	string	'Simpan'   	
             * @param	mixed 	$attrsubmit	
             * @return	void
             */

            $submit = form_submit('submit', 'Simpan', $attrsubmit);
            /**
             * INVALID FEEDBACKS
             *
             * @var		string	$ivnim
             */
            
            $ivnama_mhs = 'Nama harus diisi!';
            /**
             * @var		string	$ivemail
             */
            $ivemail = 'Email harus diisi!';
            /**
             * @var		string	$ivnotelp
             */
            $ivnotelp = 'No telepon harus diisi!';
            /**
 * @var		string	$ivtanggal_lahir
 */
$ivtanggal_lahir = 'Tanggal lahir harus diisi!';

            /**
             * @var		mixed	$data
             */
            $data = array(
                'formopen' => $formopen,
                'formclose' => $formclose,
                'fakultas' => $fakultas,
                'parent' => 'Data Mahasiswa',
                'title' => 'Update Mahasiswa',
                'prodi' => $prodi,
                'lnama_mhs' => $lnama_mhs,
                'lfakultas' => $lfakultas,
                'lprodi' => $lprodi,
                'lemail' => $lemail,
                'lno_telp' => $lno_telp,
                'ltanggal_lahir' => $ltanggal_lahir, // Tambahkan label tanggal lahir
                'inputid' => $inputid_mahasiswa,
                'inputnama_mhs' => $inputnama_mhs,
                'iemail' => $inputemail,
                'inputno_telp' => $inputno_telp,
                'inputtanggal_lahir' => $inputtanggal_lahir, // Tambahkan input tanggal lahir
                'ddfakultas' => $ddfakultas,
                'ddprodi' => $ddprodi,
                'fe_namamhs' => $fe_namamhs,
                'fe_email' => $fe_email,
                'fe_notelp' => $fe_notelp,
                'fe_tanggal_lahir' => $fe_tanggal_lahir, // Tambahkan error tanggal lahir
               
                'ivnama_mhs' => $ivnama_mhs,
                'ivemail' => $ivemail,
                'ivnotelp' => $ivnotelp,
                'ivtanggal_lahir' => $ivtanggal_lahir, // Tambahkan invalid message tanggal lahir
                'submit' => $submit
            );
            
            $this->template->load('master/template/template_v', 'mahasiswa/mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('warning', 'gagal edit karna ada kesamaan data');
            redirect('mahasiswa');
        }
    }
  

 
  public function updateaction()
  {
      $this->_rules();
      $validation = $this->form_validation->run();
  
      if ($validation == FALSE) {
          $this->update();
      } else {
          $id = $this->input->post('id_mahasiswa', TRUE);
          $nama_mhs = $this->input->post('nama_mhs', TRUE);
          $fakultas = $this->input->post('fakultas', TRUE);
          $prodi = $this->input->post('prodi', TRUE);
          $email = $this->input->post('email', TRUE);
          $no_telp = $this->input->post('no_telp', TRUE);
          $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE); // Tambahkan ini

          if ($this->mhs->check_nim_exists_except_self($nim, $id)) {
            $this->session->set_flashdata('error', 'NIM sudah terdaftar!');
            $this->update(); // Kembali ke form
            return; // Pastikan untuk mengakhiri eksekusi
        }

        // Cek jika email sudah ada selain dari data yang sedang diedit
        if ($this->mhs->check_email_exists_except_self($email, $id)) {
            $this->session->set_flashdata('error', 'Email sudah digunakan!');
            $this->update(); // Kembali ke form
            return; // Pastikan untuk mengakhiri eksekusi
        }
          
          $data = array(
              'id_mahasiswa' => $id,
              'nama_mhs' => $nama_mhs,
              'id_fakultas' => $fakultas,
              'id_prodi' => $prodi,
              'email' => $email,
              'no_telp' => $no_telp,
              'tanggal_lahir' => $tanggal_lahir, // Tambahkan ini
          );
          
  
          $this->mhs->update_data($id, $data);
          $this->session->set_flashdata('success', 'Data berhasil diubah');
          redirect("mahasiswa/detail/{$id}");
      }
  }
  
    public function delete($id)
    {
        $id = $this->uri->segment(3);
       
        $this->mhs->delete_data($id);
        
        redirect('mahasiswa', 'refresh');
    }
    public function _rules()
    {
        
    
        $attrnama_mhs = array(
            'required' => 'Nama mahasiswa harus diisi!',
            'min_length' => 'Nama mahasiswa minimal 5 karakter!',
            'max_length' => 'Nama mahasiswa maksimal 50 karakter!',
        );
    
        $attremail = array(
            'required' => 'Email harus diisi!',
            'valid_email' => 'Masukkan email yang valid!'
        );
    
        $attrno_telp = array(
            'required' => 'Nomor Telepon harus diisi!',
            'min_length' => 'Nomor Telepon minimal 12 karakter!',
            'max_length' => 'Nomor Telepon tidak boleh melebihi 12 karakter!',
        );
    
        $attrtanggal_lahir = array(
            'required' => 'Tanggal lahir harus diisi!',
            'callback_valid_date' => 'Tanggal lahir tidak valid!' // Callback untuk validasi tambahan
        );
    
        // Mengatur form validasi
        $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required|min_length[5]|max_length[50]', $attrnama_mhs);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', $attremail);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|min_length[12]|max_length[15]', $attrno_telp);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', $attrtanggal_lahir); // Tambahkan aturan untuk tanggal_lahir
    
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


    
}


/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
