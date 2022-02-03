<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Frontend extends MX_Controller
{

	public function __construct()
	{
		$this->data = array();
		$this->data["ctr"] = $this;
		parent::__construct();
	}

	public function index()
	{
		$this->data["title"] = "Global Integra Technology";
		viewPage("base/frontend", "home", $this->data);
	}

	public function landing()
	{
		$now = date("Y-m-d H:i:s");
		$this->data["title"] = "Global Integra Technology";
		$this->data["promotion"] = $this->db->where("start_date <= '$now'")->where("end_date >= '$now'")->get("promotion")->result();
		viewPage("base/frontend", "landing", $this->data);
	}

	public function promo_imlek()
	{
		$this->data["title"] = "Promo Imlek 2022 - Global Integra Technology";
		$this->data["product"] = $this->db->get("promo_package")->result();
		viewPage("base/frontend", "promo_imlek", $this->data);
	}

	public function get_items_promo_imlek($id = null)
	{
		if ($id == null) $this->JSON_Output(false);

		$data = $this->db->select("b.name, b.type, a.qty")->join("promo_item b", "b.id = a.item_id")->join("promo_package c", "c.id = a.package_id")->where("a.package_id", $id)->get("promo_package_detail a")->result();
		$this->JSON_Output(true, "", $data);
	}

	public function submit_promo_imlek()
	{
		$name = $this->input->post("name", true);
		$email = $this->input->post("email", true);
		$handphone = $this->input->post("handphone");
		$package = $this->input->post("package", true);
		$token = $this->input->post("g-recaptcha-response", true);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("secret" => "6Ld2mRMeAAAAAKmu7R6RJeCV4LzKJPb6Vqg9XEuh", "response" => $token, "remoteip" => $this->getUserIP()));
		$output = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($output, true);

		if ($res["success"] == false) {
			$this->JSON_Output(false, "Recaptcha gagal diverifikasi.");
		}

		/*
		$checkNumber = $this->db->where("handphone", $handphone)->count_all_result("promo_imlek_data");
		if ($checkNumber > 0) {
			$this->JSON_Output(false, "Nomor handphone sudah terdaftar, Anda tidak dapat mengikuti program promo lagi");
		}
		*/

		if (!$name || empty($name)) {
			$this->JSON_Output(false, "Nama tidak boleh kosong.");
		}

		if (!$handphone || empty($handphone)) {
			$this->JSON_Output(false, "No.HP/WhatsApp tidak boleh kosong.");
		}

		if (!$package || empty($package)) {
			$this->JSON_Output(false, "Silahkan pilih paket promo.");
		}

		if (substr($handphone, 0, 1) === "0") {
			$handphone = "62" . substr($handphone, 1);
		}

		$q = [
			"table" => "promo_data",
			"data" => [
				"name" => $name,
				"email" => @$email,
				"handphone" => $handphone,
				"package_id" => $package
			]
		];

		$package = $this->db->where("id", $package)->get("promo_package")->row();

		if ($this->DB_Insert($q)) {
			// config
			$receipent = getReceipent();
			$to = $receipent["to"];
			$bcc = $receipent["bcc"];

			$account = getSMTPPromo();

			$date = date("Y-m-d");
			$time = date("h:i:s");

			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host       = 'globalintertech.co.id';
			$mail->SMTPAuth   = true;
			$mail->Username   = $account["email"];
			$mail->Password   = $account["password"];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			$mail->setFrom($account["email"]);
			$mail->addAddress($to);

			foreach ($bcc as $email) {
				$mail->addBCC = $email;
			}

			$mail->isHTML(true);
			$mail->Subject = "Pendaftaran Baru Promo Imlek 2022 - Global Integra Technology";
			$mail->Body    = "Tanggal: $date<br>Jam: $time<br><br>Nama: $name<br>Email: $email<br>No.HP/WhatsApp: <a href=\"https://wa.me/$handphone\">$handphone</a><br>Paket: {$package->name}";

			$mail->send();
			$this->JSON_Output(true, "Berhasil mendaftar promo imlek");
		} else {
			$this->JSON_Output(false, "Gagal mendaftar promo imlek");
		}
	}

	public function send_email()
	{
		$mail = new PHPMailer(true);

		$name = $this->input->post("name", true);
		$email = $this->input->post("email", true);
		$handphone = $this->input->post("handphone");
		$message = $this->input->post("message", true);
		$token = $this->input->post("g-recaptcha-response", true);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("secret" => "6Ld2mRMeAAAAAKmu7R6RJeCV4LzKJPb6Vqg9XEuh", "response" => $token, "remoteip" => $this->getUserIP()));
		$output = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($output, true);

		if ($res["success"] == false) {
			$this->JSON_Output(false, "Recaptcha gagal diverifikasi.");
		}

		if (!$name || empty($name)) {
			$this->JSON_Output(false, "Nama tidak boleh kosong.");
		}

		if (!$email || empty($email)) {
			$this->JSON_Output(false, "Email tidak boleh kosong.");
		}

		if (!$handphone || empty($handphone)) {
			$this->JSON_Output(false, "No.HP/WhatsApp tidak boleh kosong.");
		}

		if (!$message || empty($message)) {
			$this->JSON_Output(false, "Pesan tidak boleh kosong.");
		}

		if (substr($handphone, 0, 1) === "0") {
			$handphone = "62" . substr($handphone, 1);
		}

		// config
		$receipent = getReceipent();
		$to = $receipent["to"];
		$bcc = $receipent["bcc"];

		$account = getSMTPContact();

		$date = date("Y-m-d");
		$time = date("h:i:s");

		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host       = 'globalintertech.co.id';
			$mail->SMTPAuth   = true;
			$mail->Username   = $account["email"];
			$mail->Password   = $account["password"];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			$mail->setFrom($account["email"]);
			$mail->addAddress($to);

			foreach ($bcc as $email) {
				$mail->addBCC = $email;
			}

			$mail->isHTML(true);
			$mail->Subject = "Pesan baru dari Web Global Integra Technology";
			$mail->Body    = "Tanggal: $date<br>Jam: $time<br><br>Nama: $name<br>Email: $email<br>No.HP/WhatsApp: <a href=\"https://wa.me/$handphone\">$handphone</a><br>Pesan:<br><br>$message";

			$mail->send();
			$this->JSON_Output(true, "Pesan telah berhasil dikirim");
		} catch (Exception $e) {
			$this->JSON_Output(false, "Gagal mengirim pesan. Mailer Error: {$mail->ErrorInfo}");
		}
	}
}
