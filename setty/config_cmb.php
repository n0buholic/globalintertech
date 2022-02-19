<?php
	class Base {
		protected $host = 'localhost';
		protected $dbname = 'global89_base_cmb';
		protected $user = 'global89_globel';
		protected $pass = 'admin_golax';
		public $mysqli;

		// fungsi yang pertama kali dipaggil
		function __construct() {
			$this->db_kon();
		}

		// koneksi ke database
		function db_kon() {
			$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if($this->mysqli->connect_errno !== 0) {
				$err = null;
				$err .= 'Kode Error : '.$this->mysqli->connect_errno.'<br>';
				$err .= 'Deskripsi : '.$this->mysqli->connect_error;
				echo $err;
			} else {
				return $this->mysqli;
			}
		}

		//menutup koneksi ke database
		function db_tutup() {
			return $this->mysqli->close();
		}

		// error pada database
		function db_error() {
			return $this->mysqli->error();
		}

	}
?>