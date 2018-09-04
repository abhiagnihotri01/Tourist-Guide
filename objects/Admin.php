<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/objects/Utility.php');
	class Admin {
		public function getAdminDetails($user, $conn) {
			if($user->authenticate()) {
				$user_array = json_decode($_COOKIE['user_details'], true);
				$utility = new Utility();
				$id = $utility->string_encrypt_decrypt($user_array['id'], false);
				$rows = $user->readById($id);
				$row = $rows->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return array('status' => true, 'id' => $id, 'name' => ucwords($name), 'username' => $username, 'email' => $email, 'contact' => $contact, 'image_name' => $image_name);
			}
			else {
				return array('status' => false, 'message' => 'Admin is not logged in');
			}
		}

		// public function addOrUpdateTags($tagArray) {
			
		// }

		// public function deleteTags($tagArray) {
			
		// }

		public function deleteFeedback($feedback_id, $conn) {
			$query = "UPDATE feedback SET is_deleted = 1 WHERE id=:id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $feedback_id);
			if($stmt->execute()) {
				// $stmt->debugDumpParams();
				return true;
			}
			// $stmt->debugDumpParams();
			return false;
		}

		public function deletePhobia($phobia_id, $conn) {
			$query = "UPDATE tags_phobia SET is_deleted = 1 WHERE id=:id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $phobia_id);
			if($stmt->execute()) {
				return true;
			}
			return false;
		}

		public function addPhobia($phobia_name, $tags, $conn) {
			for($i = 0; $i < count($tags); $i++) {
				$query = "INSERT INTO tags_phobia SET tag_id=:tagId, phobia=:phobia_name";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(":tagId", $tags[$i]);
				$stmt->bindParam(":phobia_name", $phobia_name);
				if(!$stmt->execute()) {
					return array('status' => false, 'message' => 'Sorry, some error occured');
				}				
			}
			return array('status' => true);
		}

		public function deleteRestriction($restriction_id, $conn) {
			$query = "UPDATE restrictions SET is_deleted = 1 WHERE id=:id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $restriction_id);
			if($stmt->execute()) {
				return true;
			}
			return false;			
		}

		public function addRestriction($restriction_name, $conn) {
			$query = "INSERT INTO restrictions SET restriction_name=:restriction_name";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":restriction_name", $restriction_name);
			if(!$stmt->execute()) {
				return array('status' => false, 'message' => 'Sorry, some error occured');
			}				
			return array('status' => true);
		}

		public function deleteUser($user_id, $conn) {
			$query = "UPDATE users SET is_deleted = 1 WHERE id=:id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $user_id);
			if($stmt->execute()) {
				// $stmt->debugDumpParams();
				return true;
			}
			// $stmt->debugDumpParams();
			return false;
		}

		public function getAllSubtags($conn) {
			$query = "SELECT id, name FROM tags WHERE hash IS NOT NULL";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

	}