<?php

require_once 'dao/DAO.php';

class OverviewDAO extends DAO {


	public function selectByHeaderId($id) {
		$sql = "SELECT * FROM `br_header`
				WHERE br_header.id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

		public function selectMostRecent() {
		$sql = "SELECT * FROM `br_header`
		ORDER BY `id` DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

		public function emptyDatabase() {
		$sql = "TRUNCATE `br_header`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
	}

	public function insertHeader($data) {
			$sql = "INSERT INTO `br_header` (`file_name`)
					VALUES (:file_name)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(":file_name", $data["file"]);
			if($stmt->execute()){
				$lastInsertId = $this->pdo->lastInsertId();
				return $this->selectByHeaderId($lastInsertId);
			}
	}

}
