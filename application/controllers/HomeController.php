<?php

	/**
	 * 
	 */
	class HomeController extends CI_Controller {
		
		function __construct() {
			
			parent::__construct();

			$this->load->model("HomeModel", "model");

		}

		public function index() {
			
			redirect("inicio", "refresh");

		}

		public function home() {
			
			if($this->session->userdata('user')){

				redirect(base_url()."lista_procesos", "refresh");
				
			}else {

				$data['title'] = "Inicio";

				$this->load->view("home/homeView", compact('data'));

			}			

		}

		public function login() {
			
			if($this->input->is_ajax_request()){

				$data = $this->model->login();

				if($data != false){

					$this->session->set_userdata("user", $data->id);

					echo "true";

				}else {

					echo "false";

				}

			}else {

				show_404();

			}

		}

		public function logOut() {
			
			$this->session->unset_userdata("user");

			redirect(base_url(), "refresh");

		}

	}

?>