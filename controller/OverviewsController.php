<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'OverviewDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'DesignDAO.php';


class OverviewsController extends Controller {

	private $overviewDAO;
	private $designDAO;


	function __construct() {
		$this->overviewDAO = new OverviewDAO();
		$this->designDAO = new DesignDAO();
	}

	//PAGES

	public function home() {
		$mostRecent = $this->overviewDAO->selectMostRecent();
		$this->set('mostRecent', $mostRecent);

	}

	public function design(){
	$mostRecent = $this->overviewDAO->selectMostRecent();
		$this->set('mostRecent', $mostRecent);

	$three = $this->designDAO->selectThree();
	$this->set('three', $three);
	}


	public function save() {

		if(!empty($_POST)) {

			$errors = [];
			$class = $_POST['class'];

			if(isset($_POST['image']) && !empty($_POST['image'])){
				$errors['image'] = 'Gelieve image mee te geven';
			}

			//errors in console
			header('Content-Type: application/json');

			if(!empty($errors)){

				$dataURL = $_POST['image'];
			    $data = explode(',', $dataURL)[1];
			    $data = base64_decode($data);
			    $file = uniqid() . '.png';

			    if($class == "app"){
			    $location = WWW_ROOT . 'uploads/' . $file;
			    $locationB = WWW_ROOT . 'uploads/*';
				}
				else{
				$location = WWW_ROOT . 'uploadsgallery/' . $file;
			    $locationB = WWW_ROOT . 'uploadsgallery/*';
				}

			    //empty folder
			    if($class == "app"){
			    $files = glob($locationB); // get all file names
				foreach($files as $filea){ // iterate files
 					if(is_file($filea));
   					unlink($filea); // delete file
				}
				}

				//fill folder
			    $success = file_put_contents($location, $data);

				$data = array(
					'file' => $file
				);

				if($class == "app"){
					$this->overviewDAO->emptyDatabase();
					$header = $this->overviewDAO->insertHeader($data);

					if(!empty($header)){
					$this->redirect("index.php?page=view&id=" . $header['id']);
					echo json_encode(array('result' => true, 'id' => $shirt['id']));
					die();
					}
				}
				else{
				$img = $this->designDAO->insertImage($data);
				if(!empty($img)){
					$this->redirect("index.php?page=design&id=" . $img['id']);
					echo json_encode(array('result' => true, 'id' => $shirt['id']));
					die();
					}
				}


			}
			else {
				$this->set('errors', $errors);
			}
			echo json_encode(array('result' => false));
			die();
		}

	}


}
