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

		<table id='datatable'>
			<thead>
				<tr>
					<th>URL ID</th>
					<th>Name</th>
					<th>Path</th>
					<th>Edit</th>
					<th>Delete</th>
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
						echo "</tr>";
					}
				}
				?>

			</tbody>
		</table>
		</div>
</div>

