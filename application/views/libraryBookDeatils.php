<!-- Admin Login is considered by default. If we add user login, other user's information and action on the same will be restricted -->
<table>
	<tr>
		<th id="serial">#</th>
		<th>Book Title</th>
		<th>Author</th>
		<th>Available</th>
		<th>Action</th>
	</tr>
	<?php
	if (!empty($books)) {
		foreach ($books as $key => $book) {
			?>
			<tr>
				<td><?php echo ++$key; ?></td>
				<td><?php echo $book['name']; ?></td>
				<td><?php echo $book['author']; ?></td>
				<td id="status_<?php echo $book['id'] ?>" class="status"><span <?php echo (!empty($book['user_id'])) ? 'title="Issued For: ' . $book['user_name'] . ' ( ' . $book['email'] . ' )"' : ''; ?>> <?php echo (!empty($book['user_id'])) ? '&#9746;' : '&#9745;'; ?></span></td>
				<td class="center">
					<a href="#" id="action_<?php echo $book['id'] ?>" data-book_id="<?php echo $book['id'] ?>" data-user_id="<?php echo $book['user_id'] ?>" class="action"> <?php echo (!empty($book['user_id'])) ? 'Return' : 'Issue'; ?></a>
				</td>
			</tr>
			<?php
		}
	} else {
		echo '<tr><td class="status" colspan="5">No Records Found.</td></tr>';
	}
	?>
</table>

<script src="asset/3.4.1_jquery.min.js"></script>
<script src="asset/library.js"></script>