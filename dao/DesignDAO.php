<?php

require_once 'dao/DAO.php';

class DesignDAO extends DAO {


	public function selectByHeaderId($id) {
		$sql = "SELECT * FROM `br_main`
				WHERE br_main.id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

		public function selectThree() {
		$sql = "SELECT * FROM `br_main`
		ORDER BY `creation_date` DESC
		LIMIT 3";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function insertImage($data) {
			$sql = "INSERT INTO `br_main` (`file_name`)
					VALUES (:file_name)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":file_name", $data["file"]);
			if($stmt->execute()){
				$lastInsertId = $this->pdo->lastInsertId();
				return $this->selectByHeaderId($lastInsertId);
			}
	}

}
