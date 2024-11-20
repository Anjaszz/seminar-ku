<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Mahasiswa extends CI_Controller
{
   
    public function __construct()
    {
        parent::__construct();
   if (!$this->ion_auth->logged_in()) {
        redirect('auth');
    }      
        $this->load->model('Mahasiswa_model', 'mhs');
    }

    public function index()
    {
        $attradd = array('class' => 'btn  btn-gradient-success');
       
        $tambahdata = anchor('mahasiswa/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
       
        $mhs = $this->mhs->lihat_data();
       
        $data = array(
            'mahasiswa' =>  $mhs,
            'title' => 'Data Mahasiswa',
            'btntambah' => $tambahdata,
        );
        $this->template->load('template/template_v', 'mahasiswa/mahasiswa_v', $data);
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
        $id_jenjang = $row->id_jenjang;
        $kode_fakultas = $row->kode_fakultas;
        $kode_prodi = $row->kode_prodi;
        $kode_jenjang = $row->kode_jenjang;
        $nama_fakultas = $row->nama_fakultas;
        $nama_prodi = $row->nama_prodi;
        $nama_jenjang = $row->nama_jenjang;
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
            'id_jenjang' => $id_jenjang,
            'kode_fakultas' => $kode_fakultas,
            'kode_jenjang' => $kode_jenjang,
            'kode_prodi' => $kode_prodi,
            'nama_fakultas' => $nama_fakultas,
            'nama_prodi' => $nama_prodi,
            'nama_jenjang' => $nama_jenjang,
            'email' => $email,
            'no_telp' => $no_telp,
            'tanggal_lahir' => $tanggal_lahir,  // Tambahkan ini
        );
        $this->template->load('template/template_v', 'mahasiswa/mahasiswa_d', $data);
    } else {
        $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
        redirect('mahasiswa');
    }
}

    public function get_prodi_by_fakultas()
    {
        $fakultas_id = $this->input->post('fakultas_id');
        $prodi = $this->mhs->get_prodi_by_fakultas($fakultas_id);
        
        $options = '';
        foreach ($prodi as $p) {
            $options .= '<option value="' . $p->id_prodi . '">' . $p->nama_prodi . '</option>';
        }
        
        echo $options;
    }
    
    public function add()
{
    $fakultas = $this->mhs->get_fakultas();
    $prodi = $this->mhs->get_prodi();
    $jenjang = $this->mhs->get_jenjang();

    $attrform = array(
        'class' => 'needs-validation',
        'novalidate' => 'novalidate'
    );

    $action  = 'mahasiswa/addaction';

    $formopen = form_open($action, $attrform);
    $formclose  = form_close();

    $lnim = form_label('NIM', 'nim');
    $lnama_mhs = form_label('Nama Mahasiswa', 'nama_mhs');
    $lfakultas = form_label('Fakultas', 'fakultas');
    $lprodi = form_label('Prodi', 'prodi');
    $ljenjang = form_label('Jenjang', 'jenjang');
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

    $attrno_telp = array(
        'type' => 'text',
        'name' => 'no_telp',
        'id' => 'no_telp',
        'placeholder' => 'Masukkan Nomor Telpon',
        'class' => 'form-control phone',
        'value' => set_value('no_telp'),
        'required' => 'required'
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
        'class' => 'form-control'
    );

    $getksn = $this->mhs->get_prodi();
    $prodi = array();
    foreach ($getksn as $k) {
        $prodi[$k->id_prodi] = $k->nama_prodi;
    }

    $optprodi = array(
        'id' => 'prodi',
        'class' => 'form-control'
    );

    $getjng = $this->mhs->get_jenjang();
    $jenjang = array();
    foreach ($getjng as $j) {
        $jenjang[$j->id_jenjang] = $j->nama_jenjang;
    }

    $optjenjang = array(
        'id' => 'jenjang',
        'class' => 'form-control'
    );

    $ddfakultas = form_dropdown('fakultas', $fakultas, set_value('fakultas'), $optfakultas);
    $ddprodi = form_dropdown('prodi', $prodi, set_value('prodi'), $optprodi);
    $ddjenjang = form_dropdown('jenjang', $jenjang, set_value('jenjang'), $optjenjang);

    // FORM INPUT
    $inputid_mahasiswa = form_input($attrid_mahasiswa);
    $inputnim = form_input($attrnim);
    $inputnama_mhs = form_input($attrnama_mhs);
    $inputemail = form_input($attremail);
    $inputno_telp = form_input($attrno_telp);
    $inputtanggal_lahir = form_input($attrtanggal_lahir); // Input Field Tanggal Lahir

    $attrsubmit = array(
        'id' => 'submit',
        'class' => 'btn btn-gradient-info'
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
        'jenjang' => $jenjang,
        'lnim' => $lnim,
        'lnama_mhs' => $lnama_mhs,
        'lfakultas' => $lfakultas,
        'lprodi' => $lprodi,
        'ljenjang' => $ljenjang,
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
        'ddjenjang' => $ddjenjang,
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
    $this->template->load('template/template_v', 'mahasiswa/mahasiswa_form', $data);
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
  
      $nim = $this->input->post('nim', TRUE);
      $nama_mhs = $this->input->post('nama_mhs', TRUE);
      $fakultas = $this->input->post('fakultas', TRUE);
      $prodi = $this->input->post('prodi', TRUE);
      $jenjang = $this->input->post('jenjang', TRUE);
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
          'id_jenjang' => $jenjang,
          'email' => $email,
          'no_telp' => $notelp,
          'tanggal_lahir' => $tanggal_lahir,
      );
      
      // Insert data ke tabel mahasiswa dan ambil id_mahasiswa yang dihasilkan
      $id_mahasiswa = $this->mhs->insert_data_id($data);
      $hashed_password = md5($tanggal_lahir);
      
      // Data untuk tabel user_mhs
      $data_user = array(
          'id_mahasiswa' => $id_mahasiswa,
          'nim' => $nim,
          'password' => $hashed_password,
          'email' => $email
      );
  
      // Insert data ke tabel user_mhs
      $this->mhs->insert_data_user($data_user);
      
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
      redirect('mahasiswa', 'refresh');
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
        /**
         * ambil method dari model untuk menampilkan data jenjang
         *
         * @var		mixed	$this->mhs->get_jenjang()
         */

        $jenjang = $this->mhs->get_jenjang();
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
            $nim = $row->nim;
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
             * @var		mixed	$row->id_jenjang
             */
            $id_jenjang = $row->id_jenjang;
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
            $lnim = form_label('NIM', 'nim');
            /**
             * $lnama_mhs.
             *. label nama mahasiswa 
             * @param	string	'Nama Mahasiswa'	
             * @param	string	'nama_mhs'      	
             * @return	void
             */
            $lnama_mhs = form_label('Nama Mahasiswa', 'nama_mhs');
            /**
             * $lfakultas.
             * label program studi
             * @param	string	'Fakultas'	
             * @param	string	'fakultas'        	
             * @return	void
             */
            $lfakultas = form_label('Fakultas', 'fakultas');
            /**
             * $lprodi.
             * label prodi 
             * @param	string	'Prodi'	
             * @param	string	'prodi'	
             * @return	void
             */
            $lprodi = form_label('Prodi', 'prodi');
            /**
             * $ljenjang.
             *
             * @param	string	'Jenjang'	
             * @param	string	'jenjang'	
             * @return	void
             */
            $ljenjang = form_label('Jenjang', 'jenjang');
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
            $lno_telp = form_label('Nomo Telepon', 'no_telp');
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
            $attrnim = array(
                'type' => 'text',
                'name' => 'nim',
                'id' => 'nim',
                'placeholder' => 'Masukkan nim',
                'value' => set_value('nim', $nim),
                'class' => 'form-control nim',
                'required' => 'required'
            );

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
                'class' => 'form-control'
            );

            $getjng = $this->mhs->get_jenjang();
            /**
             * $jenjang.
             *
             * @return	void
             */
            $jenjang = array();
            foreach ($getjng as $j) {
                $jenjang[$j->id_jenjang] = $j->nama_jenjang;
            }

            /**
             * @var		mixed	$optjenjang
             */
            $optjenjang = array(
                'id' => 'jenjang',
                'class' => 'form-control'
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
             * $ddjenjang.
             *
             * @param	string	'jenjang'           	
             * @param	mixed 	$jenjang            	
             * @param	mixed 	set_value('jenjang')	
             * @param	mixed 	$optjenjang         	
             * @return	void
             */
            $ddjenjang = form_dropdown('jenjang', $jenjang, set_value('jenjang', $id_jenjang), $optjenjang);
            /**
             * $inputnim.
             *
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
            $inputnim = form_input($attrnim);
            /**
             * $inputnama.
             * @param	mixed	$inama_mhs	
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
            $fe_nim = form_error('nim');
            /**
             * $fe_namamhs.
             *
             * @param	string	'nama_mhs'	
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
            $ivnim = 'NIM harus diisi!';
            /**
             * @var		string	$ivnama_mhs
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
                'jenjang' => $jenjang,
                'lnim' => $lnim,
                'lnama_mhs' => $lnama_mhs,
                'lfakultas' => $lfakultas,
                'lprodi' => $lprodi,
                'ljenjang' => $ljenjang,
                'lemail' => $lemail,
                'lno_telp' => $lno_telp,
                'ltanggal_lahir' => $ltanggal_lahir, // Tambahkan label tanggal lahir
                'inputid' => $inputid_mahasiswa,
                'inputnim' => $inputnim,
                'inputnama_mhs' => $inputnama_mhs,
                'iemail' => $inputemail,
                'inputno_telp' => $inputno_telp,
                'inputtanggal_lahir' => $inputtanggal_lahir, // Tambahkan input tanggal lahir
                'ddfakultas' => $ddfakultas,
                'ddprodi' => $ddprodi,
                'ddjenjang' => $ddjenjang,
                'fe_nim' => $fe_nim,
                'fe_namamhs' => $fe_namamhs,
                'fe_email' => $fe_email,
                'fe_notelp' => $fe_notelp,
                'fe_tanggal_lahir' => $fe_tanggal_lahir, // Tambahkan error tanggal lahir
                'ivnim' => $ivnim,
                'ivnama_mhs' => $ivnama_mhs,
                'ivemail' => $ivemail,
                'ivnotelp' => $ivnotelp,
                'ivtanggal_lahir' => $ivtanggal_lahir, // Tambahkan invalid message tanggal lahir
                'submit' => $submit
            );
            
            $this->template->load('template/template_v', 'mahasiswa/mahasiswa_form', $data);
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
          $nim = $this->input->post('nim', TRUE);
          $nama_mhs = $this->input->post('nama_mhs', TRUE);
          $fakultas = $this->input->post('fakultas', TRUE);
          $prodi = $this->input->post('prodi', TRUE);
          $jenjang = $this->input->post('jenjang', TRUE);
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
              'nim' => $nim,
              'nama_mhs' => $nama_mhs,
              'id_fakultas' => $fakultas,
              'id_prodi' => $prodi,
              'id_jenjang' => $jenjang,
              'email' => $email,
              'no_telp' => $no_telp,
              'tanggal_lahir' => $tanggal_lahir, // Tambahkan ini
          );
          
  
          $this->mhs->update_data($id, $data);
          $this->session->set_flashdata('success', 'Data berhasil diubah');
          redirect('mahasiswa', 'refresh');
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
        $attrnim = array(
            'required' => 'NIM harus diisi!',
            'min_length' => 'NIM minimal 8 karakter!',
            'max_length' => 'NIM melebihi 8 karakter!',
            'numeric' => 'NIM tidak menggunakan huruf!'
        );
    
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
        $this->form_validation->set_rules('nim', 'NIM', 'trim|required|numeric|min_length[8]|max_length[8]', $attrnim);
        $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required|min_length[5]|max_length[50]', $attrnama_mhs);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', $attremail);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'trim|required|min_length[12]|max_length[15]', $attrno_telp);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', $attrtanggal_lahir); // Tambahkan aturan untuk tanggal_lahir
    
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


    
}


/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
