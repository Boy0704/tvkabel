<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    var $judul_page = 'Pelanggan';
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
    }

    public function upload_foto_rumah()
    {
    	$id_pelanggan = $this->input->post('id_pelanggan');
    	$foto_rumah = upload_gambar_biasa('foto_rumah', 'image/foto_rumah/', 'jpeg|png|jpg|gif', 10000, 'foto_rumah');
    	if($foto_rumah != strip_tags($foto_rumah)) {
		    ?>
		    <script type="text/javascript">
		    	alert("<?php echo $foto_rumah ?>");
		    	window.location = "<?php echo base_url() ?>/pelanggan?<?php echo param_get() ?>";
		    </script>
		    <?php
		} else {
			$this->db->where('id_pelanggan', $id_pelanggan);
			$this->db->update('pelanggan', ['foto_rumah'=>$foto_rumah]);
			?>
		    <script type="text/javascript">
		    	alert("berhasil upload foto rumah");
		    	window.location = "<?php echo base_url() ?>/pelanggan?<?php echo param_get() ?>";
		    </script>
		    <?php
		}

    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pelanggan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pelanggan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pelanggan/index.html';
            $config['first_url'] = base_url() . 'pelanggan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelanggan_model->total_rows($q);
        $pelanggan = $this->Pelanggan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pelanggan_data' => $pelanggan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => $this->judul_page,
            'konten' => 'pelanggan/pelanggan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pelanggan' => $row->id_pelanggan,
		'kd_pelanggan' => $row->kd_pelanggan,
		'nama' => $row->nama,
		'id_wilayah' => $row->id_wilayah,
		'id_rt' => $row->id_rt,
		'id_rw' => $row->id_rw,
		'alamat' => $row->alamat,
		'telp' => $row->telp,
		'biaya_daftar' => $row->biaya_daftar,
		'id_layanan' => $row->id_layanan,
		'tahun_tagihan_aktif' => $row->tahun_tagihan_aktif,
		'bulan_tagihan_aktif' => $row->bulan_tagihan_aktif,
		'tanggal_daftar' => $row->tanggal_daftar,
		'tanggal_nonaktif' => $row->tanggal_nonaktif,
		'aktif' => $row->aktif,
		'ket' => $row->ket,
		'created_at' => $row->created_at,
		'created_by' => $row->created_by,
		'updated_at' => $row->updated_at,
		'updated_by' => $row->updated_by,
	    );
            $this->load->view('pelanggan/pelanggan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => $this->judul_page,
            'konten' => 'pelanggan/pelanggan_form',
            'button' => 'Create',
            'action' => site_url('pelanggan/create_action'),
	    'id_pelanggan' => set_value('id_pelanggan'),
	    'kd_pelanggan' => set_value('kd_pelanggan'),
	    'nama' => set_value('nama'),
	    'id_wilayah' => set_value('id_wilayah'),
	    'id_rt' => set_value('id_rt'),
	    'id_rw' => set_value('id_rw'),
	    'alamat' => set_value('alamat'),
	    'telp' => set_value('telp'),
	    'biaya_daftar' => set_value('biaya_daftar'),
	    'id_layanan' => set_value('id_layanan'),
	    'tahun_tagihan_aktif' => set_value('tahun_tagihan_aktif'),
	    'bulan_tagihan_aktif' => set_value('bulan_tagihan_aktif'),
	    'tanggal_daftar' => set_value('tanggal_daftar'),
	    'tanggal_nonaktif' => set_value('tanggal_nonaktif'),
	    'aktif' => set_value('aktif'),
	    'ket' => set_value('ket'),
	    'created_at' => set_value('created_at'),
	    'created_by' => set_value('created_by'),
	    'updated_at' => set_value('updated_at'),
	    'updated_by' => set_value('updated_by'),
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
		'kd_pelanggan' => $this->input->post('kd_pelanggan',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_wilayah' => $this->input->post('id_wilayah',TRUE),
		'id_rt' => $this->input->post('id_rt',TRUE),
		'id_rw' => $this->input->post('id_rw',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'biaya_daftar' => $this->input->post('biaya_daftar',TRUE),
		'id_layanan' => $this->input->post('id_layanan',TRUE),
		'tahun_tagihan_aktif' => $this->input->post('tahun_tagihan_aktif',TRUE),
		'bulan_tagihan_aktif' => $this->input->post('bulan_tagihan_aktif',TRUE),
		'tanggal_daftar' => $this->input->post('tanggal_daftar',TRUE),
		'tanggal_nonaktif' => $this->input->post('tanggal_nonaktif',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'created_at' => get_waktu(),
		'created_by' => $this->session->userdata('id_user'),
	    );

            $this->Pelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => $this->judul_page,
                'konten' => 'pelanggan/pelanggan_form',
                'button' => 'Update',
                'action' => site_url('pelanggan/update_action'),
		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
		'kd_pelanggan' => set_value('kd_pelanggan', $row->kd_pelanggan),
		'nama' => set_value('nama', $row->nama),
		'id_wilayah' => set_value('id_wilayah', $row->id_wilayah),
		'id_rt' => set_value('id_rt', $row->id_rt),
		'id_rw' => set_value('id_rw', $row->id_rw),
		'alamat' => set_value('alamat', $row->alamat),
		'telp' => set_value('telp', $row->telp),
		'biaya_daftar' => set_value('biaya_daftar', $row->biaya_daftar),
		'id_layanan' => set_value('id_layanan', $row->id_layanan),
		'tahun_tagihan_aktif' => set_value('tahun_tagihan_aktif', $row->tahun_tagihan_aktif),
		'bulan_tagihan_aktif' => set_value('bulan_tagihan_aktif', $row->bulan_tagihan_aktif),
		'tanggal_daftar' => set_value('tanggal_daftar', $row->tanggal_daftar),
		'tanggal_nonaktif' => set_value('tanggal_nonaktif', $row->tanggal_nonaktif),
		'aktif' => set_value('aktif', $row->aktif),
		'ket' => set_value('ket', $row->ket),
		'created_at' => set_value('created_at', $row->created_at),
		'created_by' => set_value('created_by', $row->created_by),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'updated_by' => set_value('updated_by', $row->updated_by),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelanggan', TRUE));
        } else {
            $data = array(
		'kd_pelanggan' => $this->input->post('kd_pelanggan',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_wilayah' => $this->input->post('id_wilayah',TRUE),
		'id_rt' => $this->input->post('id_rt',TRUE),
		'id_rw' => $this->input->post('id_rw',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'biaya_daftar' => $this->input->post('biaya_daftar',TRUE),
		'id_layanan' => $this->input->post('id_layanan',TRUE),
		'tahun_tagihan_aktif' => $this->input->post('tahun_tagihan_aktif',TRUE),
		'bulan_tagihan_aktif' => $this->input->post('bulan_tagihan_aktif',TRUE),
		'tanggal_daftar' => $this->input->post('tanggal_daftar',TRUE),
		'tanggal_nonaktif' => $this->input->post('tanggal_nonaktif',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'updated_at' => get_waktu(),
		'updated_by' => $this->session->userdata('id_user'),
	    );

            $this->Pelanggan_model->update($this->input->post('id_pelanggan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $this->Pelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_pelanggan', 'kd pelanggan', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('id_wilayah', 'id wilayah', 'trim|required');
	$this->form_validation->set_rules('id_rt', 'id rt', 'trim|required');
	$this->form_validation->set_rules('id_rw', 'id rw', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');
	$this->form_validation->set_rules('biaya_daftar', 'biaya daftar', 'trim|required');
	$this->form_validation->set_rules('id_layanan', 'id layanan', 'trim|required');
	$this->form_validation->set_rules('tahun_tagihan_aktif', 'tahun tagihan aktif', 'trim|required');
	$this->form_validation->set_rules('bulan_tagihan_aktif', 'bulan tagihan aktif', 'trim|required');
	$this->form_validation->set_rules('tanggal_daftar', 'tanggal daftar', 'trim|required');
	$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');

	$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2022-08-03 18:21:42 */
/* https://jualkoding.com */