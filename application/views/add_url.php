<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/url_left_nav'); ?>
</div>


<div class='large-10 columns'>

		<div class='panel'>
			<h1>Add URL</h1>
		</div>

		<form method='POST' action='/labmgr/add_url'>

			<div class='row'>
				<div class='large-6 columns'>
					<label>Name</label>
					<input type='text' name='name'>
				</div>

				<div class='large-6 columns'>
					<label>Path</label>
					<input type='text' name='path'>
				</div>
				
			</div>

			<div class='row'>
				<div class='large-12 columns'>
					<label>Add Multiple </label>
					<textarea name='multiple' rows='3'></textarea>
					<br>
				</div>
			</div>

			<div class='row'>
				<div class='large-1 columns'>
					<input type='submit' class='button' value='Submit'>
				</div>
			</form>
			</div>


<div class='panel'>
	<h1>Existing URLs</h1>
</div>
	<div class='large-12 columns'>
		<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
		<a href='#' id='delete_urls_btn' class='button'>Delete Selected</a>
		<table id='datatable'>
			<thead>
				<tr>
					<th>URL ID</th>
					<th>Name</th>
					<th>Path</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($urls)) {
					
					foreach($urls as $url) {
						echo "<tr>";
						echo "<td>".$url['url_id']."</td>";
						echo "<td>". $url['name'] ."</td>";
						echo "<td>". $url['path'] ."</td>";

						echo "<td><form method='POST' action='/labmgr/edit_url'>
						<input type='hidden' name='url_id' value='".$url['url_id']."'>
						<input type='submit' class='button tiny radius' value='Edit'></form></td>";
						echo "<td><form method='POST' action='/labmgr/delete_url'>
						<input type='hidden' name='url_id' value='".$url['url_id']."'>
						<input type='submit' class='button tiny radius alert' value='Delete'></form>
						</td>";
						echo "<td><input class='checkbox' type='checkbox' name='url_ids[]' value='".$url['url_id']."'></td>";
						echo "</tr>";
					}
				}
				?>

			</tbody>
		</table>
		</div>
</div>

