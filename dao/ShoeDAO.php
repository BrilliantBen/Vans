<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ShoeDAO extends DAO {

	// public function selectAll() {
	// 	$sql = "SELECT * FROM `br_uploads`";
	// 	$stmt = $this->pdo->prepare($sql);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }


		public function selectById($id) {
		$sql = "SELECT * FROM `br_uploads` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// public function selectRecentLimit($limit, $size){
	// 	$sql ="SELECT *
	// 	FROM `br_uploads`
	// 	WHERE `size` = $size
	// 	ORDER BY `date` DESC
	// 	LIMIT $limit,15";
	// 	$stmt = $this->pdo->prepare($sql);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	// 	public function countRows(){
	// 	$sql ="SELECT COUNT(*) as `nieuw` FROM `br_uploads`
	// 	WHERE `size` = $size
	// 	";
	// 	$stmt = $this->pdo->prepare($sql);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

	public function selectAll($page, $schoen) {
		$sql = "SELECT * FROM `br_uploads` WHERE `size` = :schoen ORDER BY `creation_date` DESC LIMIT :offset, 6";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':schoen', $schoen);
		$stmt->bindValue(':offset', ($page - 1) * 6);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// public function selectAll($page) {
	// 	$sql = "SELECT * FROM `br_uploads` WHERE `title` LIKE '%google%' ORDER BY `creation_date` DESC LIMIT :offset, 10";
	// 	$stmt = $this->pdo->prepare($sql);
	// 	$stmt->bindValue(':offset', ($page - 1) * 10);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }

		public function countAll($schoen) {
		$sql = "SELECT COUNT(`id`) AS `count` FROM `br_uploads` WHERE `size` LIKE :schoen";
		$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':schoen', $schoen);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['count'];
	}



	public function insertShoe($data) {
	$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `br_uploads` (`size`, `email`, `file_name`) VALUES (:size, :email, :file_name)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':size', $data['maat']);
			$stmt->bindValue(':email', $data['email']);
			$stmt->bindValue(':file_name', $data['image']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['maat'])) {
			$errors['maat'] = '37 - 47.';
		}
		if(empty($data['email'])) {
			$errors['email'] = 'Geen geldige email.';
		}else if(preg_match('/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*){1}([@]){1}([a-z0-9]+([_\-]{1}[a-z0-9]+)*)+(([\.]{1}[a-z]{2,6}){0,3}){1}$/i', $data['email'])){

	    }else{
	    	$errors['email'] = 'Geen geldig adres.';
	    }
		if(empty($data['image'])) {
			$errors['image'] = 'Upload afbeelding.';
		}

		return $errors;
	}


}
