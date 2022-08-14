<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public $image = '';

    public function tes()
    {
        $a = "10";
        $b = explode("%", $a);
        print_r($b);
        if (isset($b[1])) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function log_user()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        $data = array(
            'konten' => 'a_user/log_user',
            'judul_page' => 'Log User',
        );
        $this->load->view('v_index', $data);
    }
	
	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function pengembangan()
    {
        $this->session->set_flashdata('message', alert_biasa('Masih Dalam Pengembangan','warning'));
                redirect('app','refresh');
    }

    public function admin()
	{
        // if ($this->session->userdata('username') == '') {
        //     redirect('app/login');
        // }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }
    
    public function tagihan_pelanggan()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        $data = array(
            'konten' => 'tagihan/view',
            'judul_page' => 'Tagihan Pelanggan',
        );
        $this->load->view('v_index', $data);
    }	

    public function simpan_tagihan($id_pelanggan, $tahun, $id_bulan)
    {
        $denda = $this->input->post('denda');
        $biaya = $this->input->post('biaya');
        $kolektor = $this->input->post('kolektor');
        $bayar_via = $this->input->post('bayar_via');
        $tanggal_bayar = date('Y-m-d');
        $created_at = get_waktu();
        $created_by = ($this->session->userdata('level') == 'admin') ? $kolektor : $this->session->userdata('id_user');
        $total_bayar = $biaya + $denda;
        $data = array(
            'id_pelanggan' => $id_pelanggan,
            'id_bulan' => $id_bulan,
            'tahun' => $tahun,
            'bayar_via' => $bayar_via,
            'tanggal_bayar' => $tanggal_bayar,
            'denda' => $denda,
            'tagihan' => $biaya,
            'total_bayar' => $total_bayar,
            'created_at' => $created_at,
            'created_by' => $created_by,
        );
        $this->db->insert('tagihan', $data);
        ?>
        <script type="text/javascript">
            alert("Tagihan berhasil dibayar !");
            window.location = "<?php echo base_url() ?>app/cetak_nota/<?php echo $id_pelanggan.'/'.$tahun.'/'.$id_bulan ?>";
        </script>
        <?php
    }

    public function batalkan_tagihan($id_pelanggan, $tahun, $id_bulan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('tahun', $tahun);
        $this->db->where('id_bulan', $id_bulan);
        $this->db->delete('tagihan');
        ?>
        <script type="text/javascript">
            alert("Tagihan berhasil dibatalkan !");
            window.location = "<?php echo base_url() ?>app/tagihan_pelanggan";
        </script>
        <?php
    }

    public function cetak_nota($id_pelanggan, $tahun, $bulan)
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        $this->load->view('tagihan/cetak_nota');
    }

    public function statistik($tipe)
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        if ($tipe == 'bulan') {
            $data = array(
                'konten' => 'statistik/view_bulan',
                'judul_page' => 'Statistik',
            );
            $this->load->view('v_index', $data);
        }
        
    }   

    public function pembukuan()
    {
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        $data = array(
            'konten' => 'pembukuan/view',
            'judul_page' => 'Pembukuan',
        );
        $this->load->view('v_index', $data);
    }   


    public function excel_pembukuan()
    {
        $this->load->view('laporan/pembukuan');
    }

	
}