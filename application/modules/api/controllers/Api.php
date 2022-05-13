<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

class Api extends MX_Controller
{

	public function __construct()
	{
		$this->data = array();
		$this->data["ctr"] = $this;
		parent::__construct();
	}

	public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $hasil = $this->db->select("*")->from("admin")->where("username", $username)->get()->row();
        if ($hasil) {
            if (password_verify($password, $hasil->password) === true) {
                $session = array(
                    "logged_in" => true,
                    "id" => $hasil->id
                );
                $this->session->set_userdata($session);
                $this->JSON_Output(true, "Berhasil masuk, mengarahkan ke Dashboard...", ["redirect" => base_url("backend/dashboard")]);
            } else {
                $this->JSON_Output(false, "Password yang Anda masukkan salah");
            }
        } else {
            $this->JSON_Output(false, "Username tidak ditemukan");
        }
    }

	public function logout()
    {
        $this->session->sess_destroy();
        $this->JSON_Output(true, "Berhasil keluar Aplikasi", ["redirect" => base_url("backend/login")]);
    }

	public function add_catalogue()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["price"] = str_replace(".", "", $data["price"]);

		$time = time();

		$config['upload_path']          = './assets/frontend/images/uploads/catalogue/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['file_ext_tolower']     = TRUE;
		$config['max_size']				= 1024;
		$config['file_name']            = "$data[name]-$time}";

		$this->Make_Dir($config['upload_path']);

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$this->JSON_Output(false, "Upload gagal: {$this->upload->display_errors()}");
		} else {
			$data['image'] = $this->upload->data()['file_name'];

			$this->load->library('image_lib');

			$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    =>  $this->upload->data()['full_path'],
				'maintain_ratio'  =>  TRUE,
				'width'           =>  500,
				'height'          =>  500,
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();
		}

		$q = [
			"table" => "catalogue_item",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$this->JSON_Output(true, "Berhasil menambah katalog", ["redirect" => base_url("backend/catalogue")]);
		} else {
			$this->JSON_Output(true, "Gagal menambah katalog");
		}
	}

	public function edit_catalogue()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["price"] = str_replace(".", "", $data["price"]);

		if ($_FILES['image']['size'] > 0) {
			$time = time();

			$config['upload_path']          = './assets/frontend/images/uploads/catalogue/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_ext_tolower']     = TRUE;
			$config['max_size']				= 1024;
			$config['file_name']            = "$data[name]-$time}";

			$this->Make_Dir($config['upload_path']);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$this->JSON_Output(false, "Upload gagal: {$this->upload->display_errors()}");
			} else {
				$data['image'] = $this->upload->data()['file_name'];

				$this->load->library('image_lib');

				$configer =  array(
					'image_library'   => 'gd2',
					'source_image'    =>  $this->upload->data()['full_path'],
					'maintain_ratio'  =>  TRUE,
					'width'           =>  500,
					'height'          =>  500,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			}
		}

		$q = [
			"table" => "catalogue_item",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Berhasil mengubah katalog", ["redirect" => base_url("backend/catalogue")]);
		} else {
			$this->JSON_Output(true, "Gagal mengubah katalog");
		}
	}

	public function delete_catalogue()
	{
		$q = [
			"table" => "catalogue_item",
			"where" => "id = {$this->input->get('id')}"
		];

		$this->DB_Delete($q);
		redirect("backend/catalogue");
	}

	public function add_category()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		unset($data["dynamic"]);

		$q = [
			"table" => "catalogue_category",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$id = $this->db->insert_id();
			if ($this->input->post("dynamic")) {
				$this->JSON_Output(true, "", [
					"text" => $data["name"],
					"id" => $id
				]);
			} else {
				$this->JSON_Output(true, "");
			}
		}
	}

	public function fetch_brand()
	{
		$q = $this->input->get("term");
		$data = $this->db->select("id, name as text")->from("catalogue_brand")->where("name LIKE '%$q%'")->get()->result();
		$this->JSON_Output(true, "", $data);
	}

	public function add_brand()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		unset($data["dynamic"]);

		$q = [
			"table" => "catalogue_brand",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$id = $this->db->insert_id();
			if ($this->input->post("dynamic")) {
				$this->JSON_Output(true, "", [
					"text" => $data["name"],
					"id" => $id
				]);
			} else {
				$this->JSON_Output(true, "");
			}
		}
	}

	public function fetch_category()
	{
		$q = $this->input->get("term");
		$data = $this->db->select("id, name as text")->from("catalogue_category")->where("name LIKE '%$q%'")->get()->result();
		$this->JSON_Output(true, "", $data);
	}

	public function add_promo()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$time = time();

		$config['upload_path']          = './assets/frontend/images/uploads/promo/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['file_ext_tolower']     = TRUE;
		$config['max_size']				= 1024;
		$config['file_name']            = "$data[name]-$time}";

		$this->Make_Dir($config['upload_path']);

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$this->JSON_Output(false, "Upload gagal: {$this->upload->display_errors()}");
		} else {
			$data['image'] = $this->upload->data()['file_name'];

			$this->load->library('image_lib');

			$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    =>  $this->upload->data()['full_path'],
				'maintain_ratio'  =>  TRUE,
				'width'           =>  500,
				'height'          =>  500,
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();
		}

		$q = [
			"table" => "promotion",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$this->JSON_Output(true, "Berhasil menambah promo", ["redirect" => base_url("backend/promo")]);
		} else {
			$this->JSON_Output(true, "Gagal menambah promo");
		}
	}

	public function edit_promo()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		if ($_FILES['image']['size'] > 0) {
			$time = time();

			$config['upload_path']          = './assets/frontend/images/uploads/promo/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['file_ext_tolower']     = TRUE;
			$config['max_size']				= 1024;
			$config['file_name']            = "$data[name]-$time}";

			$this->Make_Dir($config['upload_path']);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$this->JSON_Output(false, "Upload gagal: {$this->upload->display_errors()}");
			} else {
				$data['image'] = $this->upload->data()['file_name'];

				$this->load->library('image_lib');

				$configer =  array(
					'image_library'   => 'gd2',
					'source_image'    =>  $this->upload->data()['full_path'],
					'maintain_ratio'  =>  TRUE,
					'width'           =>  500,
					'height'          =>  500,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			}
		}

		$q = [
			"table" => "promotion",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Berhasil mengubah promo", ["redirect" => base_url("backend/promo")]);
		} else {
			$this->JSON_Output(true, "Gagal mengubah promo");
		}
	}

	public function delete_promo()
	{
		$q = [
			"table" => "promotion",
			"where" => "id = {$this->input->get('id')}"
		];

		$this->DB_Delete($q);
		redirect("backend/promo");
	}

	public function request_quotation() {
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["status"] = 0;

		$q = [
			"table" => "sales_quote",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$this->JSON_Output(true, "Berhasil mengirimkan permintaan penawaran, silahkan tunggu konfirmasi dari kami");
		} else {
			$this->JSON_Output(true, "Gagal mengirimkan permintaan penawaran");
		}
	}

	public function generate_sales_quote() {
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["status"] = 2;
		$data["generate_date"] = date("Y-m-d H:i:s");

		$q = [
			"table" => "sales_quote",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Sales Quote berhasil dibuat", ["redirect" => base_url("backend/sales-quote")]);
		} else {
			$this->JSON_Output(true, "Sales Quote gagal dibuat");
		}
	}

	public function take_order() {
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["status"] = 1;
		$data["taken_by"] = $this->session->userdata("id");
		$data["taken_date"] = date("Y-m-d H:i:s");

		$q = [
			"table" => "sales_quote",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Pesanan berhasil diambil, klik OK untuk lanjut ke halaman Sales Quote", ["redirect" => base_url("backend/sales-quote/generate?id=$data[id]")]);
		} else {
			$this->JSON_Output(true, "Pesanan gagal diambil");
		}
	}

	public function sales_quote_view($type)
	{
		$this->data["sales_quote"] = $this->db->select("a.*, b.name")->from("sales_quote a")->join("admin b", "b.id = a.taken_by", "left")->where("a.id", $this->input->get("id"))->get()->row();
		if (!$this->data["sales_quote"]) {
			show_404();
		}
		$this->data["counter"] = $this->CounterSQ($this->data["sales_quote"]->id);

		$header = $this->load->view("backend/sales_quote_header", $this->data, true);
		$footer = $this->load->view("backend/sales_quote_footer", $this->data, true);
		$html = $this->load->view("sales_quote_view", $this->data, true);
		//echo $html;exit;

		$mpdf = new Mpdf();
		$mpdf->setAutoBottomMargin = 'stretch';
		$mpdf->setAutoTopMargin = 'stretch';
		$mpdf->showImageErrors = true;
		$mpdf->curlAllowUnsafeSslRequests = true;
		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		if ($type == "download") {
			$mpdf->Output("Quote-SQ-" . date("m", strtotime($this->data["sales_quote"]->generate_date)) . date("y", strtotime($this->data["sales_quote"]->generate_date)) . sprintf('%03d', $this->data["counter"]) . ".pdf", "D");
		} else {
			$mpdf->Output();$mpdf->Output("Quote-SQ-" . date("m", strtotime($this->data["sales_quote"]->generate_date)) . date("y", strtotime($this->data["sales_quote"]->generate_date)) . sprintf('%03d', $this->data["counter"]) . ".pdf", "I");
		}
	}
}
