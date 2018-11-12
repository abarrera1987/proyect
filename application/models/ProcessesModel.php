<?php 

	/**
	 * 
	 */
	class ProcessesModel extends CI_Model {
		
		function __construct() {
			
			parent::__construct();

		}

		public function getUser() {
			
			return $this->db->select("name")->from("usu_users")->get()->row();

		}

		function getProcess($start, $perPage){

			$dateFilter = "'a.create_date' != ''";

			if(isset($_GET['dateFilter'])){

				$dateFilter = "a.create_date = '".$_GET['dateFilter']."'";

			}
			
			return $this->db->select("a.id, a.process_number, a.description, b.name, a.create_date, a.budget, a.state")
			->from("conf_process a")
			->join("conf_headquarters b", 'b.id = a.id_headquarters')
			->where($dateFilter)
			->where("state", "active")
			->order_by("a.id", "DESC")
			->limit($perPage, ($start-1)*$perPage)
			->get()
			->result();

		}

		function totalProcess(){

			$dateFilter = "'a.create_date' != ''";

			if(isset($_GET['dateFilter'])){

				$dateFilter = "a.create_date = '".$_GET['dateFilter']."'";

			}

			return $this->db->select("a.id, a.process_number, a.description, b.name, a.create_date, a.budget, a.state")
			->from("conf_process a")
			->join("conf_headquarters b", 'b.id = a.id_headquarters')
			->where($dateFilter)
			->where("state", "active")
			->order_by("a.id", "DESC")
			->get()
			->num_rows();

		}

		function getHeadquarters() {
			
			return $this->db->select("id, name")->from("conf_headquarters")->get()->result();

		}

		function createProcess() {

			$data = array(

				"create_date" => date("Y-m-d"),
				'description' => $_POST['descriptionProcess'],
				'id_headquarters' => $_POST['headquartersProcess'],
				'budget' => str_replace(".", "", $_POST['budgetProcess']),

			);

			$this->db->insert("conf_process", $data);

			if($this->db->affected_rows() > 0){

				$idProcess = $this->db->insert_id();

				$data = array(

					"process_number" => sprintf("%08d",$idProcess),
					'state' => "active"

				);

				$this->db->where("id", $idProcess);

				if($this->db->update("conf_process", $data)){

					return sprintf("%08d",$idProcess);

				}else {

					return false;

				}

			}else {

				return false;

			}
			
		}

		function updateProcess() {
			
			$data = array(

					'description' => $_POST['descriptionProcessEdit'],
					'id_headquarters' => $_POST['headquartersProcessEdit'],
					'budget' => str_replace(".", "", $_POST['budgetProcessEdit']),
					'state' => "active"

			);

			$this->db->where("id", $_POST['idProcessNumberEdit']);

			if($this->db->update("conf_process", $data)){

				return true;

			}else {

				return false;

			}

			
		}

		function getProcessData(){
			
			return $this->db->select("a.id, a.process_number, a.description, b.name, b.id as id_hq, a.create_date, a.budget, a.state")
			->from("conf_process a")
			->join("conf_headquarters b", 'b.id = a.id_headquarters')
			->where("a.id", $_POST['idProcess'])
			->where("state", "active")
			->get()
			->result();

		}

	}

	?>