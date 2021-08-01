<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // memanggil library form_validation yang sudah diaktifkan di autoload.php
        $this->load->library('form_validation');
    }

    public function index()
    {
        // pengecekan apak session login masih aktif
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // pengecekan form_validation untuk email
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        // pengecekan form_validation untuk password
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // apabila validasi gagal, maka akan tetap pada halaman login
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // sedangkan apabila validasi sukses, akan diarahkan ke function _login()
            $this->_login();
        }
    }


    private function _login()
    {
        // menampung unputan email dari kolom email di FORM HTML
        $email = $this->input->post('email');

        // menampung unputan password dari kolom email di FORM HTML
        $password = $this->input->post('password');

        // pengecekan di table user untuk email yang diinputkan
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // lakukan pengecekan apabila usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    // Tampilkan pesan jika USER ada namun PASSWORD salah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');

                    // arahkan kembali ke halaman login
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');

                // arahkan kembali ke halaman login
                redirect('auth');
            }
        } else {
            // Tampilkan pesan jika USER atidak ditemukan di databasi
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');

            // arahkan kembali ke halaman login
            redirect('auth');
        }
    }


    public function registration()
    {
        // pengecekan apak session login masih aktif
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // pengecekan form_validation untuk rules yang dsudah ditetapkan 
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // pengecekan apabila validasi salah
        if ($this->form_validation->run() == false) {
            $data['title'] = 'BinusOnline | User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            //apabila pengecekan form validasi berhasil makan akan disiapkan data untuk diinputkan kedalam database
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'address' => htmlspecialchars($this->input->post('address', true)),
                'phone' => htmlspecialchars($this->input->post('phone', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            // insert data ke table user yang ada di database
            $this->db->insert('user', $data);

            // tampilkan pesan apabila registrasi berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created</div>');

            // arahkan kembali ke halaman login
            redirect('auth');
        }
    }


    public function logout()
    {

        // unset session
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        // tampilkan pesan apabila telah berhasil logout
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');

        // arahkan kembali ke halaman login
        redirect('auth');
    }


    public function blocked()
    {
        // untuk menghalangi user mengakses HARD URL ke halaman dashboard meskipun tidak login
        $this->load->view('auth/blocked');
    }
}
