<?php 

	/**
	 * 
	 */
	class HomeModel extends CI_Model {
		
		function __construct() {
			
			parent::__construct();

		}

		function login() {

			return $this->db->select("id, name, email")->from("usu_users")->where("email", $_POST['email'])->where("password", sha1($_POST['pass']))->get()->row();

		}

	}

?>