<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MX_Controller {

	public function __construct() {
        $this->data = array();
        $this->data["ctr"] = $this;
        parent::__construct();
    }

    public function not_found() {
        $this->data["title"] = "Halaman tidak ditemukan";
		viewPage("base/frontend", "404", $this->data);
    }

}