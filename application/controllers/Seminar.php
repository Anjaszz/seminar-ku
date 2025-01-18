<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Seminar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        }
        $this->load->model('Seminar_model', 'sm');
    }
    
    public function index()
    {
        $attradd = array('class' => 'btn btn-gradient-success');
        $tambahdata = anchor('seminar/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
        
        // Ambil data seminar berdasarkan id_vendor
        $seminar = $this->sm->get_data();
        
        $title = "Data Seminar";
    
        $data = array(
            'seminar' => $seminar,
            'title' => $title,
            'btntambah' => $tambahdata,
        );
        $this->template->load('template/template_v', 'seminar/seminar_v', $data);
    }
    

    public function detail($id)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->sm->get_row($id);
        
        if ($get_row->num_rows() > 0) {
            $seminar_box = $this->seminar_box();
            $row = $get_row->row();
            $get_pembicara = $this->sm->get_pembicara($id);
            $get_sponsor = $this->sm->get_sponsor($id);
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $tgl_pelaksanaan = $row->tgl_pelaksana;
            $harga_tiket = $row->harga_tiket;
            $slot_tiket = $this->sm->total_tiket($id)->row()->slot_tiket;
            $lampiran = $row->lampiran;
            $foto_tiket = $row->lampiran_tiket;
            $parent = "Data Seminar";
            $title = "Detail Seminar";
            $tiket = "Tiket Seminar";

            // Ambil lokasi berdasarkan id_lokasi
            $lokasi = $this->sm->get_lokasi_by_id($row->id_lokasi); // Ambil lokasi
            $nama_provinsi = $lokasi ? $lokasi->nama_provinsi : 'Tidak Diketahui'; // Nama provinsi
            $detail_lokasi = $row->lokasi; // Detail lokasi dari tabel seminar

            $data = array(
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
                'tgl_pelaksanaan' => $tgl_pelaksanaan,
                'harga_tiket' => $harga_tiket,
                'slot_tiket' => $slot_tiket,
                'foto_tiket' => $foto_tiket,
                'lampiran' => $lampiran,
                'title' => $title,
                'pembicara' => $get_pembicara,
                'sponsor' => $get_sponsor,
                'seminar_box' => $seminar_box,
                'parent' => $parent,
                'tiket' => $tiket,
                'nama_provinsi' => $nama_provinsi, // Tambahkan nama provinsi
                'detail_lokasi' => $detail_lokasi, // Tambahkan detail lokasi
            );

            $this->template->load('template/template_v', 'seminar/seminar_d', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data tidak tersedia!');
            redirect('seminar');
        }
    }


    public function seminar_box()
    {
        $id = $this->uri->segment(3);
        $total_tiket = $this->sm->total_tiket($id)->row()->slot_tiket;
        $tiket_terjual = $this->sm->tiket_terjual($id);
        $total_peserta = $tiket_terjual;
        $sisa_tiket = intval($total_tiket) - intval($tiket_terjual);

        $box = [
            [
                'color'         => 'red',
                'total'     => $total_tiket,
                'title'        => 'Slot Tiket',
                'icon'        => 'list'
            ],
            [
                'color'         => 'blue',
                'total'     => $tiket_terjual,
                'title'        => 'Tiket Terjual',
                'icon'        => 'id-card'
            ],
            [
                'color'         => 'green',
                'total'     => $sisa_tiket,
                'title'        => 'Sisa Tiket',
                'icon'        => 'id-card'
            ],
            [
                'color'         => 'yellow',
                'total'     => $total_peserta,
                'title'        => 'Total Peserta',
                'icon'        => 'users'
            ],
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }



    // Update fungsi add di controller
public function add() {
    $data['title'] = 'Form Tambah Seminar';
    $data['kategori_seminar'] = $this->sm->get_all_kategori();
    $data['lokasi_seminar'] = $this->sm->get_all_lokasi();
    $data['fakultas'] = $this->sm->get_all_fakultas();
    $data['jenis_seminar'] = $this->sm->get_all_jenis(); // Tambahkan ini
    $data['seminar'] = array('lampiran' => null);
    
    $this->template->load('template/template_v', 'seminar/seminar_form', $data);
}

// Update fungsi addaction untuk menambah field baru
public function addaction() {
    if (!$this->session->userdata('id_vendor')) {
        redirect('auth');
    }
    
    // Konfigurasi upload
    $config['upload_path']   = FCPATH . '/uploads/poster/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = '1000';
    $config['max_width']     = '5000';
    $config['max_height']    = '5000';
    $config['encrypt_name']  = TRUE;
    
    $this->upload->initialize($config);
    
    $lampiran_path = null;
    
    if ($this->upload->do_upload('lampiran')) {
        $upload_data = $this->upload->data();
        $lampiran_path = $upload_data['file_name'];
    } else {
        $this->session->set_flashdata('warning', 'Kesalahan Upload: ' . $this->upload->display_errors());
    }
    
    // Ambil data dari input
    $tgl_dan_jam = $this->input->post('tgl_pelaksana') . ' ' . $this->input->post('jam_mulai') . ':00';
    $data = [
        'nama_seminar' => $this->input->post('nama_seminar', TRUE),
        'id_jenis'     => $this->input->post('id_jenis', TRUE), // Tambahkan ini
        'id_kategori'  => $this->input->post('id_kategori', TRUE),
        'id_lokasi'    => $this->input->post('id_lokasi', TRUE),
        'lokasi'       => $this->input->post('lokasi', TRUE),
        'id_fakultas'  => $this->input->post('id_fakultas', TRUE),
        'tgl_pelaksana'=> $tgl_dan_jam,
        'deskripsi'    => $this->input->post('deskripsi', TRUE),
        'link_seminar' => $this->input->post('link_seminar', TRUE), // Tambahkan ini
        'lampiran'     => $lampiran_path,
        'id_vendor'    => $this->session->userdata('id_vendor')
    ];
    
    if ($this->sm->insert_data($data)) {
        $this->session->set_flashdata('success', 'Data seminar berhasil ditambahkan!');
    } else {
        $db_error = $this->db->error();
        $this->session->set_flashdata('error', 'Gagal menambahkan data seminar. Error: ' . $db_error['message']);
    }
    
    redirect('seminar');
}
    
    
// Fungsi untuk aturan validasi
private function _rules() {
    $this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
    $this->form_validation->set_rules('id_jenis', 'Jenis Seminar', 'required');
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
    $this->form_validation->set_rules('id_lokasi', 'Lokasi', 'required');
    $this->form_validation->set_rules('lokasi', 'Detail Lokasi', 'required');
    $this->form_validation->set_rules('id_fakultas', 'Departemen', 'required');
    $this->form_validation->set_rules('tgl_pelaksana', 'Tanggal Pelaksanaan', 'required');
    $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    // Add conditional validation for link_seminar if needed
}


   


    public function uploadaction()
    {
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler");
        $file = $this->input->get('file');
        if (isset($file)) {
            $fcpatht = FCPATH . '/uploads/pembicara/';
            $fcpathth = FCPATH . '/uploads/pembicara/thumbnail/';
            $thumbnail = ($fcpathth . $file);
            $tiket = ($fcpatht . $file);
            if (unlink($tiket) && unlink($thumbnail)) { } else {
                echo "error";
            }
        }
    }

    public function update($id) {
        // Mengecek apakah pengguna sudah login
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth');
        }
        
        // Variabel untuk judul halaman
        $data['title'] = 'Form Edit Seminar';
        
        // Mengambil data seminar berdasarkan ID
        $data['seminar'] = $this->sm->get_seminar_id($id);
        
        // Mengambil semua data yang diperlukan
        $data['kategori_seminar'] = $this->sm->get_all_kategori();
        $data['lokasi_seminar'] = $this->sm->get_all_lokasi();
        $data['fakultas'] = $this->sm->get_all_fakultas();
        $data['jenis_seminar'] = $this->sm->get_all_jenis(); // Tambahkan ini
        
        // Pastikan seminar ditemukan
        if (!$data['seminar']) {
            $this->session->set_flashdata('error', 'Seminar tidak ditemukan.');
            redirect('seminar');
        }
        
        // Pisahkan tanggal dan jam dari tgl_pelaksana
        $tanggal_pelaksanaan = new DateTime($data['seminar']['tgl_pelaksana']);
        $data['tgl_pelaksana'] = $tanggal_pelaksanaan->format('Y-m-d');
        $data['jam_mulai'] = $tanggal_pelaksanaan->format('H:i');
        
        // Load view
        $this->template->load('template/template_v', 'seminar/seminar_form', $data);
    }
    
    public function updateAction() {
        $id_seminar = $this->input->post('id_seminar');
        
        // Validasi id_lokasi
        $id_lokasi = $this->input->post('id_lokasi', TRUE);
        if (empty($id_lokasi)) {
            $this->session->set_flashdata('error', 'Lokasi seminar harus dipilih');
            redirect('seminar/update/' . $id_seminar);
            return;
        }
        
        // Menggabungkan tanggal dan jam
        $tgl_pelaksana = $this->input->post('tgl_pelaksana', true);
        $jam_mulai = $this->input->post('jam_mulai', true);
        
        if ($tgl_pelaksana && $jam_mulai) {
            $tgl_dan_jam = $tgl_pelaksana . ' ' . $jam_mulai . ':00';
        } else {
            $this->session->set_flashdata('error', 'Tanggal dan jam pelaksanaan harus diisi');
            redirect('seminar/update/' . $id_seminar);
            return;
        }
        
        // Data yang akan diupdate
        $data = [
            'nama_seminar' => $this->input->post('nama_seminar', true),
            'id_jenis'     => $this->input->post('id_jenis', true), // Tambahkan ini
            'id_kategori'  => $this->input->post('id_kategori', true),
            'id_lokasi'    => $id_lokasi,
            'lokasi'       => $this->input->post('lokasi', true),
            'id_fakultas'  => $this->input->post('id_fakultas', true),
            'tgl_pelaksana'=> $tgl_dan_jam,
            'deskripsi'    => $this->input->post('deskripsi', true),
            'link_seminar' => $this->input->post('link_seminar', true) // Tambahkan ini
        ];
        
        // Proses upload lampiran jika ada
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/poster/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '1000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';
            $config['encrypt_name'] = true;
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('lampiran')) {
                // Hapus file lama jika ada
                $old_data = $this->sm->get_seminar_id($id_seminar);
                if ($old_data['lampiran'] && file_exists('./uploads/poster/' . $old_data['lampiran'])) {
                    unlink('./uploads/poster/' . $old_data['lampiran']);
                }
                
                $uploadData = $this->upload->data();
                $data['lampiran'] = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('warning', 'Kesalahan Upload: ' . $this->upload->display_errors());
            }
        }
        
        // Update data seminar
        if ($this->sm->update_seminar($id_seminar, $data)) {
            $this->session->set_flashdata('success', 'Seminar berhasil diperbarui!');
        } else {
            $db_error = $this->db->error();
            $this->session->set_flashdata('error', 'Gagal memperbarui data seminar. Error: ' . $db_error['message']);
        }
        
        redirect('seminar');
    }
   
    public function updatke($id)
    {
       
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->sm->get_row($id)
         */
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {

            /**
             * @var		mixed	$get_row->row()
             */
            $row = $get_row->row();

            // GET ROW 
            /**
             * @var		mixed	$row->id_seminar
             */
            $id_seminar = $row->id_seminar;
            /**
             * @var		mixed	$row->nama_seminar
             */
            $nama_seminar = $row->nama_seminar;
            /**
             * @var		mixed	$row->tgl_laksana
             */
            $tgl_laksana = $row->tgl_pelaksana;
            /**
             * @var		mixed	$row->harga_tiket
             */
            /**
             * @var		mixed	$row->lampiran
             */
            $lampiran = $row->lampiran;
            /**
             * FORM
             *
             * @var		string	$attr_form
             */
            $attr_form = 'seminar/editaction';
            /**
             * $formopen.
             *
             * @param	mixed	$attr_form	
             * @return	void
             */
            $formopen = form_open_multipart($attr_form);
            /**
             * $formclose.
             *
             * @return	void
             */
            $formclose = form_close();

            /**
             * @var		mixed	$paren
             */
            $parent  = 'Data Seminar';
            /**
             * Label
             *
             * @param	string	'Nama Seminar'	
             * @param	string	'nama_seminar'	
             * @return	void
             */
            $lnama_seminar = form_label('Nama Seminar', 'nama_seminar');
            /**
             * $ltgl_pelaksana.
             *
             * @param	string	'Tanggal Pelaksaan'	
             * @param	string	'tgl_laksana'      	
             * @return	void
             */
            $ltgl_pelaksanaan = form_label('Tanggal Pelaksaan', 'tgl_laksana');
            $ljam_mulai = form_label('Jam Mulai', 'jam_mulai');
            
            /**
             * $lharga_tiket.
             *
             * @param	string	'Harga Tiket'	
             * @param	string	'harga_tiket'	
             * @return	void
             */
            $lharga_tiket = form_label('Harga Tiket', 'harga_tiket');
            /**
             * $llampiran.
             *
             * @param	string	'Lampiran'	
             * @param	string	'lampiran'	
             * @return	void
             */
            $llampiran = form_label('Lampiran', 'input-file-now');
            /**
             * @var		string	$title
             */
            /**
             * ATTRIBUTE
             *
             * @var		mixed	$attr_namaseminar
             */
            $attr_namaseminar = array(
                'type' => 'text',
                'name' => 'nama_seminar',
                'id' => 'nama_seminar',
                'value' => set_value('nama_seminar', $nama_seminar),
                'placeholder' => 'Nama Seminar',
                'class' => 'form-control'
            );
            /**
             * @var		mixed	$attr_tgllaksana
             */
            $attr_tgllaksana = array(
                'type' => 'text',
                'name' => 'tanggal_pelaksanaan',
                'id' => 'tanggal_pelaksanaan',
                'value' => set_value('tanggal_pelaksanaan', $tgl_laksana),
                'placeholder' => 'Tanggal Pelaksanaan',
                'class' => 'form-control'
            );

            $attr_jammulai = array(
                'type' => 'text',
                'name' => 'jam_mulai',
                'id' => 'jam_mulai',
                'value' => set_value('jam_mulai'),
                'placeholder' => 'Jam Mulai (HH:MM)',
                'class' => 'form-control'
            );
            /**
             * @var		mixed	$attr_hargatiket
             */
            /**
             * @var		mixed	$attr_lampiran
             */
            $attr_lampiran = array(
                'type' => 'file',
                'name' => 'lampiran',
                'value' => set_value('lampiran'),
                'placeholder' => 'Lampiran',
                'id' => 'input-file-now',
                'class' => 'dropify',
            );

            /**
             * @var		mixed	$attr_submit
             */
            $attr_submit = array(
                'id' => 'submit',
                'class' => 'btn btn-gradient-info'
            );

            /**
             * @var		mixed	$attr_idseminar
             */
            $attr_idseminar = array(
                'type' => 'hidden',
                'name' => 'id_seminar',
                'value' => set_value('id_seminar', $id_seminar),
            );

            /**
             * FORM INPUT
             *
             * @var		mixed	form_input($attr_namaseminar)
             */
            $i_namaseminar =  form_input($attr_namaseminar);
            /**
             * $i_tglpelaksanaan.
             *
             * @param	mixed	$attr_tgllaksana	
             * @return	void
             */
            $i_tglpelaksanaan = form_input($attr_tgllaksana);
            
        $i_jammulai = form_input($attr_jammulai); // Input Jam Mulai
            /**
             * $i_hargatiket.
             *
             * @param	mixed	$attr_hargatiket	
             * @return	void
             */
            /**
             * $i_lampiran.
             *
             * @param	mixed	$attr_lampiran	
             * @return	void
             */
            $i_lampiran = form_input($attr_lampiran);
            /**
             * $i_idlampiran.
             *
             * @param	mixed	$attr_idseminar	
             * @return	void
             */
            $i_idseminar = form_input($attr_idseminar);
            /**
             * SUBMIT BUTTON
             *
             * @param	string	'submit'   	
             * @param	string	'Simpan'   	
             * @param	mixed 	$attrsubmit	
             * @return	void
             */
            $submit = form_submit('submit', 'Simpan', $attr_submit);
            /**
             * FORM ERROR
             *	
             * @param	string	'nama_seminar'	
             * @return	void
             */
            $fe_namaseminar = form_error('nama_seminar');
            /**
             * $fe_tglpelaksanaan.
             *
             * @param	string	'tgl_pelaksanaan'	
             * @return	void
             */
            $fe_tglpelaksanaan = form_error('tgl_pelaksanaan');
            /**
             * $fe_hargatiket.
             *
             * @param	string	'harga_tiket'	
             * @return	void
             */
            $fe_hargatiket = form_error('harga_tiket');
            /**
             * @var		string	$title
             */
            $title = "Update Data";
            /**
             * @var		mixed	$data
             */
            $data = array(
                'title' => $title,
                'lnama_seminar' => $lnama_seminar,
                'ltgl_pelaksanaan' => $ltgl_pelaksanaan,
                'ljam_mulai' => $ljam_mulai,
                'lharga_tiket' => $lharga_tiket,
                'llampiran' => $llampiran,
                'i_namaseminar' => $i_namaseminar,
                'i_tglpelaksanaan' => $i_tglpelaksanaan,
                'i_lampiran' => $i_lampiran,
                'i_idseminar' => $i_idseminar,
                'fe_namaseminar' => $fe_namaseminar,
                'fe_tglpelaksanaan' => $fe_tglpelaksanaan,
                'fe_hargatiket' => $fe_hargatiket,
                'formopen' => $formopen,
                'formclose' => $formclose,
                'submit' => $submit,
                'parent' => $parent,
            );
            $this->template->load('template/template_v', 'seminar/seminar_form', $data);
        }
    }


    public function editaction()
    {
        /**
         * @var		mixed	$this->input->post('id_seminar'
         */ /**
         * @var		mixed	TRUE)
         */
        $id = $this->input->post('id_seminar', TRUE);
        /**
         * @var		mixed	$this->input->post('nama_seminar'
         */ /**
         * @var		mixed	TRUE)
         */
        $nama_seminar = $this->input->post('nama_seminar', TRUE);
        /**
         * @var		mixed	$this->input->post('tanggal_pelaksanaan')
         */
        $tanggal_pelaksanaan = $this->input->post('tanggal_pelaksanaan');
        $jam_mulai = $this->input->post('jam_mulai', TRUE); // Mengambil input jam mulai
        /**
         * @var		mixed	$this->input->post('harga_tiket')
         */
        $harga_tiket = $this->input->post('harga_tiket');
        /**
         * $hrg_tkt.
         *
         * @param	array 	['.', 'Rp', '.00']	
         * @param	string	''                	
         * @param	mixed 	$harga_tiket      	
         * @return	void
         * 
         */
        $tgl_dan_jam = $tanggal_pelaksanaan . ' ' . $jam_mulai . ':00';
        $hrg_tkt = str_replace(['.', 'Rp'], '', $harga_tiket);
        /**
         * @var		mixed	$this->_rules()
         */
        $this->_rules();
        /**
         * @var		mixed	$this->form_validation->run()
         */
        $validation = $this->form_validation->run();
        /**
         * @var		mixed	$validatio
         */
        if ($validation == FALSE) {
            /**
             * @var		mixed	$this->update($id)
             */
            $this->update($id);
        } else {
            $config['upload_path']   = FCPATH . '/uploads/poster/';
            /**
             * @var		string	$config['allowed_types']
             */
            $config['allowed_types'] = 'gif|jpg|png';
            /**
             * @var		mixed	$config['max_size']
             */
            $config['max_size']  = '1000';
            /**
             * @var		mixed	$config['max_width']
             */
            $config['max_width']  = '5000';
            /**
             * @var		mixed	$config['max_height']
             */
            $config['max_height']  = '5000';
            /**
             * @var		mixed	$config['overwrite']
             */
            $config['overwrite'] = TRUE;
            /**
             * @var		mixed	$config['remove_spaces']
             */
            $config['remove_spaces'] = TRUE;
            /**
             * @var		mixed	$config['encrypt_name']
             */
            $config['encrypt_name'] = TRUE;
            /**
             * @var		mixed	$this->upload->initialize($config)
             */
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('lampiran')) {
                /**
                 * @var		mixed	$data
                 */
                $data = array(
                    'nama_seminar' => $nama_seminar,
                    'tgl_pelaksana' => $tgl_dan_jam,  // Menyimpan gabungan tanggal dan jam
                    
                );
                /**
                 * @var		mixed	$this->sm->update_data($id
                 */ /**
                 * @var		mixed	$data)
                 */
                $this->sm->update_data($id, $data);
                /**
                 * @var		mixed	$this->session->set_flashdata('success'
                 */ /**
                 * @var		mixed	!')
                 */
                $this->session->set_flashdata('success', 'Data Berhasil di ubah!');
                /**
                 * @var		mixed	redirect('seminar'
                 */ /**
                 * @var		mixed	refresh')
                 */
                redirect('seminar', 'refresh');
            } else {
                /**
                 * @var		mixed	$this->upload->data('file_name')
                 */
                $lampiran = $this->upload->data('file_name');
                /**
                 * @var		mixed	$this->sm->get_row($id)->row()->lampiran
                 */
                $get_lampiran = $this->sm->get_row($id)->row()->foto;
                $folder = FCPATH . '/uploads/poster/';
                /**
                 * @var		mixed	$get_lampiran
                 */
                $uploads = $folder . $get_lampiran;
                if (unlink($uploads)) { } else {
                    $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
                }
                /**
                 * @var		mixed	$data
                 */
                $data = array(
                    'nama_seminar' => $nama_seminar,
                    'tgl_pelaksana' => $tanggal_pelaksanaan,
                    'lampiran' => $lampiran,
                );
                /**
                 * @var		mixed	$this->sm->update_data($id
                 */ /**
                 * @var		mixed	$data)
                 */
                $this->sm->update_data($id, $data);
                /**
                 * @var		mixed	$this->session->set_flashdata('success'
                 */ /**
                 * @var		mixed	!')
                 */
                $this->session->set_flashdata('success', 'Data Berhasil di ubah!');
                /**
                 * @var		mixed	redirect('seminar'
                 */ /**
                 * @var		mixed	refresh')
                 */
                redirect('seminar', 'refresh');
            }
        }
    }

    public function delete($id)
    {
        /**
         * @var		mixed	$this->uri->segment(3)
         */
        $id = $this->uri->segment(3);
        /**
         * @var		mixed	$this->sm->get_row($id)->row()->lampiran
         */
        $get_lampiran = $this->sm->get_row($id)->row()->lampiran;
        $folder = FCPATH . '/uploads/poster/';
        /**
         * @var		mixed	$get_lampiran
         */
        $uploads = $folder . $get_lampiran;
        if (unlink($uploads)) { } else {
            $this->session->set_flashdata('warning', 'data lama tidak ditemukan atau rusak!');
        }
        /**
         * @var		mixed	$this->sm->delete_data($id)
         */
        $this->sm->delete_data($id);
        /**
         * @var		mixed	redirect('seminar'
         */ /**
         * @var		mixed	refresh')
         */
        redirect('seminar', 'refresh');
    }
}