<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) 
		{
			show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			redirect('home', 'refresh');
		}
	}

	public function login()
{
    $this->data['title'] = 'Login';

    // Validasi form
    $this->form_validation->set_rules('identity', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === TRUE) {
        $email = $this->input->post('identity');
        $password = $this->input->post('password');

        // Ambil data user dari tabel users
        $this->load->model('ion_auth_model'); // Pastikan ada model user_model
        $user = $this->ion_auth_model->get_user_by_email($email);

        if ($user) {
            // Verifikasi password hash
            if (password_verify($password, $user->password)) {
                // Simpan data ke session
                $this->session->set_userdata([
                    'id_vendor' => $user->id_vendor,
                    'email' => $user->email,
                    'nama' => $user->nama_vendor,
                    'logged_in' => TRUE,
                ]);

                $this->session->set_flashdata('success', 'Login berhasil');
                redirect('home', 'refresh');
            } else {
                $this->session->set_flashdata('danger', 'Password salah');
                redirect('auth/login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('danger', 'Email tidak ditemukan');
            redirect('auth/login', 'refresh');
        }
    } else {
        // Jika validasi gagal
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['identity'] = [
            'name' => 'identity',
            'id' => 'identity',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'Email Address',
            'value' => $this->form_validation->set_value('identity'),
            'required' => 'required',
        ];

        $this->data['password'] = [
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Password',
            'type' => 'password',
            'required' => 'required',
        ];

        $this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
    }
}



	public function logout()
	{
		$this->data['title'] = "Logout";
		$this->ion_auth->logout();
		redirect('auth/login', 'refresh');
	}

	public function forgot_password()
	{
		$this->data['title'] = $this->lang->line('forgot_password_heading');
		
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
			];

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{
				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->session->set_flashdata('status', 'success');
				redirect("auth/login", 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$this->data['title'] = $this->lang->line('reset_password_heading');
		
		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
			}
			else
			{
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{
					$this->ion_auth->clear_forgotten_password_code($identity);
					show_error($this->lang->line('error_csrf'));
				}
				else
				{
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change) {
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->session->set_flashdata('status', 'success');
						redirect("auth/login", 'refresh');
					} else {
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						$this->session->set_flashdata('status', 'error');
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	public function redirectUser(){
		if ($this->ion_auth->is_admin()){
			redirect('auth', 'refresh');
		}
		redirect('/', 'refresh');
	}

	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		return FALSE;
	}

	public function _render_page($view, $data = NULL, $returnhtml = FALSE)
	{
		$viewdata = (empty($data)) ? $this->data : $data;
		$view_html = $this->load->view($view, $viewdata, $returnhtml);
		if ($returnhtml)
		{
			return $view_html;
		}
	}
}
