<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layanan extends CI_Controller
{
    var $judul_page = "Layanan";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Layanan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'layanan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'layanan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'layanan/index.html';
            $config['first_url'] = base_url() . 'layanan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Layanan_model->total_rows($q);
        $layanan = $this->Layanan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'layanan_data' => $layanan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => $this->judul_page,
            'konten' => 'layanan/layanan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_layanan' => $row->id_layanan,
		'layanan' => $row->layanan,
		'harga' => $row->harga,
	    );
            $this->load->view('layanan/layanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => $this->judul_page,
            'konten' => 'layanan/layanan_form',
            'button' => 'Create',
            'action' => site_url('layanan/create_action'),
	    'id_layanan' => set_value('id_layanan'),
	    'layanan' => set_value('layanan'),
	    'harga' => set_value('harga'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'layanan' => $this->input->post('layanan',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Layanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => $this->judul_page,
                'konten' => 'layanan/layanan_form',
                'button' => 'Update',
                'action' => site_url('layanan/update_action'),
		'id_layanan' => set_value('id_layanan', $row->id_layanan),
		'layanan' => set_value('layanan', $row->layanan),
		'harga' => set_value('harga', $row->harga),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_layanan', TRUE));
        } else {
            $data = array(
		'layanan' => $this->input->post('layanan',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Layanan_model->update($this->input->post('id_layanan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('layanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $this->Layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('layanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('layanan', 'layanan', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('id_layanan', 'id_layanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Layanan.php */
/* Location: ./application/controllers/Layanan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2022-08-03 17:37:33 */
/* https://jualkoding.com */