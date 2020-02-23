<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class libraryActions extends CI_Controller {

	// Default view or table view will be loaded based on default call or filter call
	public function index() {
		$arrBooks = $this->books->fetchAllBooksList();

		(true == isset($_POST['checked'])) ? $this->load->view('libraryBookDeatils', [ 'books' => $arrBooks]) : $this->load->view('libraryHome', [ 'books' => $arrBooks]);
	}

	// This will handle Issue and Return functionality
	function issueOrReturnBook() {
		$actionType = $_POST['action_type'];
		$bookId = (int) ( $_POST['book_id'] );
		$email = trim(( $_POST['email']));
		$response = false;
		$userId = NULL;

		if (!empty($actionType) && !empty($bookId)) {
			$response = ('return' == $actionType) ? $this->bookHistory->updateStatus($bookId) : $this->bookHistory->insert($bookId, $email);
		}

		// For Toggle purpose we are sending user ID for Action Issue
		if (is_int($response)) {
			$userId = $response;
			$response = true;
		}

		$message = (false != $response) ? 'Updated Successfully.' : 'Unable to update. Please try again.';

		echo json_encode([ 'status' => $response, 'message' => $message, 'user_id' => $userId]);
	}

	// Additional ajax calls can be sent here which can be redirected as per called action
	function handleAjaxRequests() {
		if ($_POST) {
			switch ($_POST['action']) {
				case 'issue_or_return':
					$this->issueOrReturnBook();
					break;

				default;
					echo json_encode([ 'status' => false, 'message' => 'Invalid Action']);
			}
		} else {
			echo json_encode([ 'status' => false, 'message' => 'Invalid Action']);
		}
	}
}

?>