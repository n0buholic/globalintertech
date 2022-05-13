<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

class Backend extends MX_Controller
{

	public function __construct()
	{
		$this->Auth_Guard();
		$this->data = array();
		$this->data["ctr"] = $this;
		$this->data["available_order"] = $this->db->where("status", 0)->count_all_results("sales_quote");
		parent::__construct();
	}

	public function index()
	{
		redirect("backend/login");
	}

	public function login()
	{
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
		$this->data["catalogue"] = $this->db->select("a.*, b.name as category_name, c.name as brand_name")->from("catalogue_item a")->join("catalogue_category b", "b.id = a.category_id", "left")->join("catalogue_brand c", "c.id = a.brand_id", "left")->get()->result();
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

	public function order()
	{
		$this->data["title"] = "Pesanan";
		$this->data["orders"] = $this->db->from("sales_quote")->where("status", 0)->get()->result();
		viewPage("base/backend", "order", $this->data);
	}

	public function sales_quote()
	{
		$this->data["title"] = "Pesanan";
		$this->data["orders"] = $this->db->from("sales_quote")->where("taken_by", $this->session->userdata("id"))->get()->result();
		viewPage("base/backend", "sales_quote", $this->data);
	}

	public function sales_quote_view()
	{
		$this->data["title"] = "Quote-SQ-00000";
		$this->data["sales_quote"] = $this->db->select("a.*, b.name")->from("sales_quote a")->join("admin b", "b.id = a.taken_by", "left")->where("a.id", $this->input->get("id"))->get()->row();
		$header = $this->load->view("sales_quote_header", $this->data, true);
		$footer = $this->load->view("sales_quote_footer", $this->data, true);
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
		$mpdf->Output("Quote-SQ-" . sprintf('%06d', $this->data["sales_quote"]->id) . ".pdf", "I");
	}

	public function sales_quote_generate()
	{
		$this->data["title"] = "Pesanan";
		$this->data["sales_quote"] = $this->db->from("sales_quote")->where("id", $this->input->get("id"))->get()->row();
		viewPage("base/backend", "sales_quote_generate", $this->data);
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
