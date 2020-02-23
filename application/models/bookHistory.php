<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Stores book issue and return details, Can be used for complete book history if needed.
class bookHistory extends CI_Model {

	// Default and filter list of books, user id value decides if book is available or not
	function fetchAllBooksList() {
		$sql = 'SELECT books.id, books.name, books.author, CASE WHEN bh.user_id IS NOT NULL THEN bh.user_id ELSE NULL END AS user_id
				FROM books
				LEFT JOIN book_history bh ON ( books.id = bh.book_id AND bh.returned_on IS NULL )
				WHERE
					books.published = true;
			';

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// Book history will be created whenever any book is issued.
	function insert($bookId, $email) {

		if (false == is_int($bookId) OR empty($email))
			return false;

		$sqlUserId = "SELECT id FROM users WHERE lower(email) = lower('$email')";
		$userDetail = $this->db->query($sqlUserId)->result_array();

		if (!empty($userDetail)) {
			$userId = $userDetail[0]['id'];
			$sql = "INSERT INTO book_history (book_id, user_id) VALUES($bookId, $userId)";

			return (true == $this->db->query($sql)) ? (int) $userId : false;
		}

		return false;
	}

	// Book History will be updated on return, returned on is used to identify is book is already issued.
	function updateStatus($bookId) {

		if (false == is_int($bookId))
			return false;

		$sql = 'UPDATE book_history SET returned_on = NOW() WHERE book_id = ?';

		return $this->db->query($sql, [$bookId]);
	}
}

?>