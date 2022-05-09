<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Backend extends MX_Controller
{

	public function __construct()
	{
		$this->Auth_Guard();
		$this->data = array();
		$this->data["ctr"] = $this;
		parent::__construct();
	}

	public function index() {
		redirect("backend/login");
	}

	public function login() {
		$this->data["title"] = "Masuk";
		viewPage("base/auth", "login", $this->data);
	}

	public function dashboard()
	{
		$this->Auth_Guard();
		$this->data["title"] = "Dashboard";
        $this->data["catalogue_count"] = $this->db->count_all_results("catalogue_item");
		$this->data["promo_count"] = $this->db->count_all_results("promotion");
		viewPage("base/backend", "dashboard", $this->data);
	}

	public function sortCatalogue()
	{
		$this->data["title"] = "Urut Katalog";
        $this->data["catalogue"] = $this->db->select("a.*, b.name as category_name")->from("catalogue_item a")->join("catalogue_category b", "b.id = a.category_id")->get()->result();
		viewPage("base/backend", "sort_catalogue", $this->data);
	}

    public function catalogue()
	{
		$this->data["title"] = "Katalog";
        $this->data["catalogue"] = $this->db->select("a.*, b.name as category_name")->from("catalogue_item a")->join("catalogue_category b", "b.id = a.category_id", "left")->get()->result();
		viewPage("base/backend", "catalogue", $this->data);
	}

	public function add_catalogue()
	{
		$this->data["title"] = "Tambah Katalog";
		viewPage("base/backend", "add_catalogue", $this->data);
	}

	public function edit_catalogue()
	{
		$this->data["title"] = "Ubah Katalog";
		$this->data["catalogue"] = $this->db->select("a.*, b.name as category_name, c.name as brand_name")->from("catalogue_item a")->join("catalogue_category b", "b.id = a.category_id", "LEFT")->join("catalogue_brand c", "c.id = a.brand_id", "LEFT")->where("a.id", $this->input->get("id"))->get()->row();
		if (!$this->data["catalogue"]) {
			redirect("backend/catalogue");
		}
		viewPage("base/backend", "edit_catalogue", $this->data);
	}

	public function promo()
	{
		$this->data["title"] = "Promo";
        $this->data["promo"] = $this->db->from("promotion")->get()->result();
		viewPage("base/backend", "promo", $this->data);
	}

	public function add_promo()
	{
		$this->data["title"] = "Tambah Promo";
		viewPage("base/backend", "add_promo", $this->data);
	}

	public function edit_promo()
	{
		$this->data["title"] = "Ubah Katalog";
		$this->data["promo"] = $this->db->from("promotion")->get()->row();
		if (!$this->data["promo"]) {
			redirect("backend/promo");
		}
		viewPage("base/backend", "edit_promo", $this->data);
	}
}
