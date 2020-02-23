// Issue or Return of book, Currently it is considered as per admin use but in case of individual user login, user id can be taken from login user details.
$('.action').off('click').on('click', function () {

	var email = '';
	var validEmail = true;
	var baseUrl = $('#base_url').val() + 'libraryActions/handleAjaxRequests';
	var bookId = $(this).data('book_id');
	var actionType = ('number' != typeof ($(this).data('user_id'))) ? 'issue' : 'return';

	// Ask for user email to issue a book
	if ('issue' == actionType) {
		email = prompt("Please enter email of the borrower:");
		if (null == email) {
			return;
		}

		var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		email = email.trim();
		validEmail = pattern.test(email);
	}

	if (true == validEmail) {
		$.ajax({
			url: baseUrl,
			method: 'post',
			data: 'action=issue_or_return&action_type=' + actionType + '&book_id=' + bookId + '&email=' + email,
			success: function (result) {
				var response = $.parseJSON(result);

				// Disable multiple clicks within success/error message time period
				$('.action').css('pointer-events', 'none');

				if (true == response.status) {
					$(".response").html(response.message).fadeIn(50).fadeOut(3000);
					$(".response").css("background-color", "#5cb85c");
					if ('issue' == actionType) {
						$('#status_' + bookId).html('<span>&#9746;</span>');
						$('#action_' + bookId).html('<a href="#">Return</a>');
						$('#action_' + bookId).data('user_id', response.user_id);
					} else {
						$('#status_' + bookId).html('<span>&#9745;</span>');
						$('#action_' + bookId).html('<a href="#">Issue</a>');
						$('#action_' + bookId).data('user_id', '');
					}
				} else {
					$(".response").html(response.message).fadeIn(50).fadeOut(3000);
					$(".response").css("background-color", "#f0ad4e");
				}

				setTimeout(function () {
					$('.action').css('pointer-events', '')
				}, 3000);
			}
		});
	} else {
		$(".response").html('Please enter a valid email.').fadeIn(50).fadeOut(3000);
		$(".response").css("background-color", "#f0ad4e");
	}

});

// Filter results
$('.filter input').off('click').on('click', function () {
	$('.filter input').css('pointer-events', 'none');
	var checked = $('.filter input').is(":checked");
	var baseUrl = $('#base_url').val() + 'libraryActions';
	$.ajax({
		url: baseUrl,
		method: 'post',
		data: 'checked=' + checked,
		success: function (result) {
			$('#book_list').html(result);
			setTimeout(function () {
				$('.filter input').css('pointer-events', '');
			}, 500);
		}
	});
});