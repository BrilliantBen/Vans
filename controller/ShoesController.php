<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'OverviewDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'DesignDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'ShoeDAO.php';


class ShoesController extends Controller {

	private $overviewDAO;
	private $designDAO;
	private $shoeDAO;


	function __construct() {
		$this->overviewDAO = new OverviewDAO();
		$this->designDAO = new DesignDAO();
		$this->shoeDAO = new ShoeDAO();
	}

	//PAGES

	public function gallery() {
		$mostRecent = $this->overviewDAO->selectMostRecent();
		$this->set('mostRecent', $mostRecent);

		if (isset($_POST['upload'])) {
			$this->formHandler();
		}
		$this->searchHandler();
	}

	public function searchHandler(){
		$page = 1;

		if(empty($_GET['size'])){
			$schoen = 37;
		}
		else{
			$schoen = $_GET['size'];
		}
		if(isset($_POST['search'])){
			$schoen = $_POST['schoen'];
		}
		if(!empty($_GET['p'])) {
			$page = $_GET['p'];
		}

		$this->set('posts', $this->shoeDAO->selectAll($page, $schoen));
		$this->set('p', $page);
		$this->set('count', $this->shoeDAO->countAll($schoen));

		if(isset($_POST['search'])){
			$this->redirect('index.php?page=gallery&size='.$schoen);
		}
	}

	public function formHandler(){
		$errors = [];

		if(!empty($_POST['imageName'])) {

			$dataURL = $_POST['image'];
			$data = explode(',', $dataURL)[1];
			$data = base64_decode($data);
			$file = uniqid() . '.png';
		}
		else{
			$file= $_FILES['image']['name'];
		}



		$upload = array(
			"maat"=>$_POST['maat'],
			"email"=>$_POST['email'],
			"image"=> $file,


			);

		$errors = $this->shoeDAO->getValidationErrors($upload);
		$_SESSION['error'] = "Vul het formulier juist in";
		$this->set('errors', $errors);


		if(!empty($_FILES['image']['name'])){
			if(!empty($_FILES['image']['error'])){
				$errors['image'] = "Upload afbeelding.";
				$_SESSION['error'] = "Fout type...";
			}

			if(empty($errors['image'])){
				$size = getimagesize($_FILES["image"]["tmp_name"]);
				if(empty($size)){
					$errors['image'] = "Fout type...";
					$this->set('errors', $errors);
					$_SESSION['error'] = "Vul het formulier juist in.";
				}
			}
		}

		if(empty($errors['image'])){
			$insertedUpload = $this->shoeDAO->insertShoe($upload);
			if(!empty($insertedUpload)){



				if(!empty($_POST['imageName'])) {
					$location = WWW_ROOT . 'gallery/' . $file;
					$success = file_put_contents($location, $data);
				}
				else{

					move_uploaded_file($_FILES['image']['tmp_name'],WWW_ROOT.'gallery'.DS.$_FILES['image']['name']);
				}

				$_SESSION['error'] = "";
				$_SESSION['info'] = "Je afbeelding is geüpload!";

				if(empty($_GET['size'])){
					$schoen = 37;
				}
				else{
					$schoen = $_GET['size'];
				}

				if(empty($_GET['p'])){
					$page = 1;
				}
				else{
					$page = $_GET['p'];
				}
				$this->redirect('index.php?page=gallery&size='.$schoen.'&p='.$page);
			}

		}
		else{
			$errors = $this->shoeDAO->getValidationErrors($_POST);
		}
	}


}
