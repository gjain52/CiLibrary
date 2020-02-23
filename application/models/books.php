<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class books extends CI_Model {

	// Fetch filter book list based on user filters or fetch all published books by default
	function fetchAllBooksList() {
		$whereCondition = (isset($_POST['checked']) AND 'false' !== $_POST['checked']) ? 'AND bh.user_id IS NULL' : '';

		$sql = 'SELECT books.id, books.name, books.author, bh.user_id, users.name AS user_name, users.email
				FROM books
				LEFT JOIN book_history bh ON ( books.id = bh.book_id AND bh.returned_on IS NULL )
				LEFT JOIN users ON (users.id = bh.user_id)
				WHERE books.published = true
				' . $whereCondition . '
				ORDER BY books.name
			';

		$query = $this->db->query($sql);

		return $query->result_array();
	}
}

?>