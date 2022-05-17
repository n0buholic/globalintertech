<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

	public function request_quotation()
	{
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

			$sq = $this->db->from("sales_quote")->where("id", $this->db->insert_id())->get()->row();
			$return = [];
			if ($sq) {
				$return["id"] = $sq->id;
				$return["no"] = "#SQ-" . $this->SQ_NUmber($sq->id);
			}

			$this->JSON_Output(true, "Pratinjau penawaran berhasil dibuat", ["sales_quote" => $return]);
		} else {
			$this->JSON_Output(true, "Gagal membuat pratinjau penawaran");
		}
	}

	public function update_quotation()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$check = $this->db->from("sales_quote")->where("id", $data["id"])->get()->row();

		if ($check->status > 0) {
			$this->JSON_Output(false, "Pesanan tidak dapat diubah karena sudah diterima oleh sales kami", ["redirect" => base_url("catalogue")]);
		}

		$q = [
			"table" => "sales_quote",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {

			$sq = $this->db->from("sales_quote")->where("id", $data["id"])->get()->row();
			$return = [];
			if ($sq) {
				$return["id"] = $sq->id;
				$return["no"] = "#SQ-" . $this->SQ_NUmber($sq->id);
			}

			$this->JSON_Output(true, "Pratinjau penawaran berhasil diperbarui", ["sales_quote" => $return]);
		} else {
			$this->JSON_Output(true, "Gagal memperbarui pratinjau penawaran");
		}
	}

	public function sq_activity_log()
	{
		if (!$this->input->get('id')) {
			$this->JSON_Output(false, "Tidak ada data yang dapat ditampilkan");
		}

		$sq = $this->db->from("sales_quote")->where("id", $this->input->get("id"))->get()->row();
		$activity = $this->db->from("sales_quote_activity")->where("sales_quote_id", $this->input->get("id"))->order_by("id", "asc")->get()->result();

		$sq->no = "#SQ-" . $this->SQ_NUmber($sq->id);

		$result = [
			[
				"id" => 0,
				"date" => $sq->created_at,
				"activity" => "Pesanan dibuat",
				"showRemove" => false,
				"removable" => false
			]
		];

		if ($sq->status > 0) {
			$result[] = [
				"id" => 0,
				"date" => $sq->taken_date,
				"activity" => "Pesanan diambil oleh sales",
				"showRemove" => false,
				"removable" => false
			];
		}


		$now = new DateTime("now");

		foreach ($activity as $ac) {
			$datetime = new DateTime($ac->datetime);
			$datetime->add(new DateInterval('P1D'));

			$result[] = [
				"id" => $ac->id,
				"date" => $ac->datetime,
				"activity" => $ac->activity,
				"showRemove" => true,
				"removable" => $now > $datetime ? false : true,
				"file" => $ac->file
			];
		}

		if ($sq->status == 2) {
			$result[] = [
				"id" => 0,
				"date" => $sq->finish_date,
				"activity" => "<span class=''><span class='badge bg-success'>DEAL</span> Pesanan selesai</span>",
				"showRemove" => false,
				"removable" => false
			];
		} else if ($sq->status == 3) {
			$result[] = [
				"id" => 0,
				"date" => $sq->finish_date,
				"activity" => "<span class=''><span class='badge bg-danger'>BATAL</span> Pesanan selesai</span>",
				"showRemove" => false,
				"removable" => false
			];
		}

		$result = array_map(function($d) {
			$d["date"] = date("d/m/Y", strtotime($d["date"])) . "<br><small>" . date("H:i", strtotime($d["date"])) . "</small>";
			return $d;
		}, $result);

		$this->JSON_Output(true, "Berhasil mengambil data", ["activity" => $result, "info" => $sq]);
	}

	public function add_sq_activity() {
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}
		
		$data["datetime"] = date("Y-m-d H:i:s");

		if ($_FILES['file']['size'] > 0) {
			$time = time();

			$config['upload_path']          = './assets/backend/uploads/sq_file/';
			$config['allowed_types']        = 'jpg|jpeg|png|pdf';
			$config['file_ext_tolower']     = TRUE;
			$config['max_size']				= 1024;
			$config['file_name']            = "$data[sales_quote_id]-$time}";

			$this->Make_Dir($config['upload_path']);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')) {
				$this->JSON_Output(false, "Upload gagal: {$this->upload->display_errors()}");
			} else {
				$data['file'] = $this->upload->data()['file_name'];
			}
		}

		$q = [
			"table" => "sales_quote_activity",
			"data" => $data
		];

		if ($this->DB_Insert($q)) {
			$this->JSON_Output(true, "Berhasil menambahkan log aktifitas");
		} else {
			$this->JSON_Output(true, "Gagal menambahkan log aktifitas");
		}
	}

	public function remove_sq_activity() {
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$q = [
			"table" => "sales_quote_activity",
			"where" => "id = $data[id]"
		];

		if ($this->DB_Delete($q)) {
			$this->JSON_Output(true, "Berhasil menghapus log aktifitas");
		} else {
			$this->JSON_Output(true, "Gagal menghapus log aktifitas");
		}
	}

	public function email_preview_sales_quote()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$sq = $this->db->from("sales_quote")->where("id", $data["id"])->get()->row();
		$sq_no = $this->SQ_NUmber($sq->id);
		$customer = json_decode($sq->customer);

		// config
		$to = $data["email"];

		$account = getSMTPAccount();

		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = $account["email"];
			$mail->Password   = $account["password"];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			$mail->setFrom("dev@glosindotech.com", "Global Integra Technology");
			$mail->addAddress($to);

			$mail->isHTML(true);
			$mail->Subject = "Pratinjau Penawaran #SQ-$sq_no";
			$mail->Body    = "Hai, $customer->name<br>Berikut adalah pratinjau penawaran untuk produk yang Anda inginkan:";

			// get file
			$url = base_url("sales-quote-preview/view?id=" . $sq->id);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_URL, $url);
			$response = curl_exec($ch);
			curl_close($ch);

			$mail->addStringAttachment($response, "#SQ-" . $sq_no . ".pdf");

			$mail->send();
			$this->JSON_Output(true, "Email telah berhasil dikirim");
		} catch (Exception $e) {
			$this->JSON_Output(false, "Gagal mengirim email. Error: {$mail->ErrorInfo}");
		}
	}

	public function generate_sales_quote()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["is_generated"] = 1;

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

	public function finish_sales_quote()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["status"] = 2;
		$data["finish_date"] = date("Y-m-d H:i:s");

		$q = [
			"table" => "sales_quote",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Berhasil menandai Sales Quote sebagai deal", ["redirect" => base_url("backend/sales-quote")]);
		} else {
			$this->JSON_Output(true, "Gagal menandai Sales Quote sebagai deal");
		}
	}

	public function cancel_sales_quote()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$data["status"] = 3;
		$data["finish_date"] = date("Y-m-d H:i:s");

		$q = [
			"table" => "sales_quote",
			"data" => $data,
			"where" => "id = $data[id]"
		];

		if ($this->DB_Update($q)) {
			$this->JSON_Output(true, "Berhasil menandai Sales Quote sebagai batal", ["redirect" => base_url("backend/sales-quote")]);
		} else {
			$this->JSON_Output(true, "Gagal menandai Sales Quote sebagai batal");
		}
	}

	public function take_order()
	{
		$data = [];

		foreach ($this->input->post() as $name => $value) {
			$data[$name] = $value;
		}

		$check = $this->db->from("sales_quote")->where("id", $data["id"])->get()->row();

		if ($check->status != 0) {
			$this->JSON_Output(false, "Pesanan sudah diambil");
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
			$this->JSON_Output(true, "Pesanan berhasil diambil", ["redirect" => base_url("backend/sales-quote")]);
		} else {
			$this->JSON_Output(true, "Pesanan gagal diambil");
		}
	}

	public function sales_quote_view($type, $mode = "view")
	{
		$this->data["sales_quote"] = $this->db->select("a.*, b.name")->from("sales_quote a")->join("admin b", "b.id = a.taken_by", "left")->where("a.id", $this->input->get("id"))->get()->row();
		if (!$this->data["sales_quote"]) {
			show_404();
		}
		$this->data["counter"] = $this->SQ_NUmber($this->data["sales_quote"]->id);

		$header = $this->load->view("backend/sales_quote_header", $this->data, true);
		$footer = $this->load->view("backend/sales_quote_footer", $this->data, true);
		$html = $this->load->view($mode == "view" ? "sales_quote_view" : "sales_quote_preview", $this->data, true);
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
			$mpdf->Output("Quote-SQ-" . date("m", strtotime($this->data["sales_quote"]->created_at)) . date("y", strtotime($this->data["sales_quote"]->created_at)) . sprintf('%03d', $this->data["counter"]) . ".pdf", "D");
		} else {
			$mpdf->Output("Quote-SQ-" . date("m", strtotime($this->data["sales_quote"]->created_at)) . date("y", strtotime($this->data["sales_quote"]->created_at)) . sprintf('%03d', $this->data["counter"]) . ".pdf", "I");
		}
	}
}
