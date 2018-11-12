<?php

	/**
	 * 
	 */
	class ProcessesController extends CI_Controller {
		
		function __construct() {
			
			parent::__construct();

			$this->load->model("ProcessesModel", "model");

			if(!$this->session->userdata('user')){

				redirect(base_url(), "refresh");
				
			}

		}

		public function processesList() {
			
			$data['title'] = "Lista de procesos";
			
			$data['user'] = $this->model->getUser();

			if($data['user']){

				$pages = 50; //Número de registros mostrados por páginas

				$dateFilter = "";

				if(isset($_GET['dateFilter'])){

					$dateFilter = "?dateFilter=".$_GET['dateFilter'];

				}

				$this->load->library('pagination'); //Cargamos la librería de paginación
				
				$config['base_url'] = base_url().'lista_procesos/';
				$config['first_url'] = base_url().'lista_procesos/'.'?'.http_build_query($_GET);
				$config['prefix'] = '/page/';
				$config['use_page_numbers'] = TRUE;
				$config['total_rows'] = $this->model->totalProcess();
				$config['per_page'] = $pages;
				$config['num_links'] = 3;
				$config['uri_segment'] = 3;
				$config['reuse_query_string'] = true;
				$config['full_tag_open'] = '<div class="nav-scroller py-1 mb-2"> <nav class="nav d-flex justify-content-center "><ul class="pagination pagination-sm flex-sm-wrap">';
				$config['full_tag_close'] = '</ul></div>';
				$config['num_tag_open'] = '<li class="page-item">';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#!">';
				$config['cur_tag_close'] = '</a></li>';
				$config['next_tag_open'] = '<li class="page-item">';
				$config['next_tagl_close'] = '</a></li>';
				$config['prev_tag_open'] = '<li class="page-item">';
				$config['prev_tagl_close'] = '</li>';
				$config['last_link'] = false;
				$config['first_link'] = false;
				$config['attributes'] = array('class' => 'page-link');

				$start = 1;

				if($this->uri->segment(3)) {

					$start = $this->uri->segment(3);

				}

				if(!$this->session->userdata("currency")){

					$get = file_get_contents("http://free.currencyconverterapi.com/api/v5/convert?q=USD_COP&compact=y");
					$get = json_decode($get);
					$this->session->set_userdata("currency", round($get->USD_COP->val));

				}
				
				$data['process'] = $this->model->getProcess($start, $config['per_page']);

				$data['headquarters'] = $this->model->getHeadquarters();

				$this->pagination->initialize($config);

				$this->load->view("process/listProcessView", compact('data'));

			}else {

				redirect(base_url(), "refresh");
				
			}

		}

		function newProcessModal() {

			if($this->input->is_ajax_request()){

				$data = $this->model->newProcessModal();

				if($data != false){

					echo $data;

				}else {

					echo "false";

				}

			}else{

				show_404();
			}

		}

		function createProcess() {

			if($this->input->is_ajax_request()){

				$data = $this->model->createProcess();

				if($data != false){

					echo $data;

				}else {

					echo "false";

				}

			}else{

				show_404();
			}

		}

		function getProcessData() {

			if($this->input->is_ajax_request()){

				$data = $this->model->getProcessData();

				if($data != false){

					echo json_encode($data);

				}else {

					echo "false";

				}

			}else{

				show_404();
			}

		}

		function updateProcess() {

			if($this->input->is_ajax_request()){

				$data = $this->model->updateProcess();

				if($data){

					echo "true";

				}else {

					echo "false";

				}

			}else{

				show_404();
			}

		}

	}

?>