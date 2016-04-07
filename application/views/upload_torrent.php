<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/torrents_left_nav'); ?>
</div>

<div class='large-10 columns'>
	<?php if(!empty($status)) {
		echo "<div data-alert class='alert-box success radius'>
  Upload Successful
  <a href='#' class='close'>&times;</a></div>";
	} ?>
	
<div class='panel'>
		<h1>Upload Single Local Torrent File</h1>
</div>

<?php
	echo form_open_multipart('labmgr/do_upload');
	echo "<input type='file' name='torrent_file'>";
	//echo "<label>Hash: </label><input name='hash' type='text'>";
	echo "<input type='submit' class='button' value='Upload'>";
	echo "</form>";

?>
<br>

<div class='panel'>
	<h1>Load Torrents From Server</h1>
	<br>
	Torrents can be bulk uploaded to the labmgr server file system and then from there, 
	bulk uploaded into the labmgr DB.<br><br>
	Use scp to upload the torrent files from your local system the the labmgr and put them into 
	the /home/labmgr/uploads directory.  Once uploaded, the torrent files will appear in this list below.  
	Select the torrent and click Submit to enter them into the DB.
</div>
<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
<?php
	echo form_open_multipart('labmgr/process_uploaded_torrents');
	foreach($uploaded_torrents as $torrent) {
		echo "<input type='checkbox' class='checkbox' name='torrents[]' value='".$torrent."'><label>".$torrent."</label><br>";
	}
	echo "<input type='submit' class='button' value='Submit'>";
	echo "</form>";
?>

</div>