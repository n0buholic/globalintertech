<?php

use Mpdf\Tag\P;

(defined('BASEPATH')) or exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__) . '/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller
{
	public $autoload = array();

	public function __construct()
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class . " MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);

		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->load->library('minify');
		$this->load->library('CI_Minifier');
	}

	public function __get($class)
	{
		return CI::$APP->$class;
	}

	public function toRupiah($num)
	{
		return "Rp " . number_format($num, 0, '.', '.');
	}

	public function CounterSQ($id) {
		$sq = $this->db->from("sales_quote")->where("id", $id)->get()->row();
		$sq_month = date("m", strtotime($sq->created_at));
		$sq_year = date("Y", strtotime($sq->created_at));
		$sq_id = $sq->id;
		
		$sales_quote_this_month = $this->db->where("id < $sq_id")->where("MONTH(created_at)", $sq_month)->where("YEAR(created_at)", $sq_year)->count_all_results("sales_quote");
		$counter = 1;
		if ($sales_quote_this_month > 0) {
			$counter = $sales_quote_this_month + 1;
		}
		return $counter;
	}

	public function Make_Dir($dir)
	{
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
	}

	public function Auth_Guard()
	{
		if (!$this->session->userdata("logged_in") || $this->session->userdata("logged_in") === null || empty($this->session->userdata("logged_in"))) {
			if ($this->uri->segment(2) !== "login") redirect(base_url("backend/login"));
		} else {
			if ($this->uri->segment(2) === "login") redirect(base_url("backend/dashboard"));
		}
	}

	public function JSON_Output($success = true, $message = "", $data = null)
	{
		$output = array(
			"success" => $success,
			"message" => $message
		);
		if ($data !== null) {
			$output["data"] = $data;
		}
		header("Content-Type: application/json");
		print_r(json_encode($output, JSON_PRETTY_PRINT));
		exit;
	}

	public function DB_Delete($data)
	{
		if (isset($data['table'])) {
			if (isset($data['where']) || isset($data['where_str'])) {
				if (isset($data['where'])) {
					$this->db->where($data['where']);
				}

				if (isset($data['where_str'])) {
					$this->db->where($data['where_str']);
				}
			}
			$run = $this->db->delete($data['table']);
			if (isset($run)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function DB_SoftDelete($data)
	{
		if (isset($data['table'])) {
			if (isset($data['where']) || isset($data['where_str'])) {
				if (isset($data['where'])) {
					$this->db->where($data['where']);
				}

				if (isset($data['where_str'])) {
					$this->db->where($data['where_str']);
				}
			}
			$run = $this->db->update($data['table'], array('is_deleted' => 1));
			if (isset($run)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function DB_Update($data)
	{
		if (isset($data['table'])) {
			if (isset($data['where']) || isset($data['where_str'])) {
				if (isset($data['where'])) {
					$this->db->where($data['where']);
				}

				if (isset($data['where_str'])) {
					$this->db->where($data['where_str']);
				}
			}
			$run = $this->db->update($data['table'], $data['data']);
			if (isset($run)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function DB_Insert($data)
	{
		if (isset($data['table'])) {
			$run = $this->db->insert($data['table'], $data['data']);
			if (isset($run)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function DB_InsertBatch($data)
	{
		if (isset($data['table'])) {
			$run = $this->db->insert_batch($data['table'], $data['data']);
			if (isset($run)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function AppSetting()
	{
		return $this->db->get("setting")->row();
	}

	public function NamaBulan($num, $abbr = false)
	{
		$m = [];

		if ($abbr) {
			$m = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
		} else {
			$m = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		}

		return $m[$num - 1];
	}

	public function NamaHari($num, $abbr = false)
	{
		$m = [];

		if ($abbr) {
			$m = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];
		} else {
			$m = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
		}

		return $m[$num - 1];
	}

	public function getUserIP()
	{
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if (filter_var($client, FILTER_VALIDATE_IP)) {
			$ip = $client;
		} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}

		return $ip;
	}
}
