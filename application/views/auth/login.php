<form class='' action="/login" enctype="multipart/form-data" method="post">

	<label>ID:</label>
	<span><input name="username" size="40" placeholder="somebody@us.ibm.com" type="text" value='<?php echo set_value('ibm_username'); ?>'></span>

	<label>Password:</label>
	<span><input type='password' name='password'></span>

	<input type='submit' value='Login' class='ibm-btn-arrow-pri'>
</form>