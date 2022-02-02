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
		viewPage("base/frontend", "promo_imlek", $this->data);
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
		$to = "sales02@glosindotech.com";
		$bcc = [
			"glosindotech@gmail.com",
			"harranobu@gmail.com"
		];

		$date = date("Y-m-d");
		$time = date("h:i:s");

		try {
			$mail->isSMTP();
			$mail->Host       = 'globalintertech.co.id';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'contact@globalintertech.co.id';
			$mail->Password   = 'n@k@t@123';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465;

			$mail->setFrom('contact@globalintertech.co.id');
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
