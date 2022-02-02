<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MX_Controller {

	public function __construct() {
        $this->data = array();
		$setting = $this->db->get("setting")->result();

		foreach($setting as $set) {
			$this->data[$set->name] = $set->value;
		}
        parent::__construct();
    }

    public function not_found() {
        $this->data["page_name"] = "404 Tidak Ditemukan";
        $this->data["page_desc"] = $this->data["page_name"];
        $this->data["keywords"] = "";
        $this->load->view('404', $this->data);
    }

}