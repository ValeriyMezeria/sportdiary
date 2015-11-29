<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

	echo '<div id="registration_position">
		<div id="login">
			<form action="http://'.$host.'/Main/registration?recieve=1" method="post">
			<div id="registration_block">
				'.$options['result'].'
				<p><div id="login_text">First name</div> 	<input type="text" name="first_name" value=""></p> 
				<p><div id="login_text">Last name</div> 	<input type="text" name="last_name" value=""></p>
				<p><div id="login_text">Email</div> 		<input type="email" name="email"  value=""></p> 
				<p><div id="login_text">Password</div> 		<input type="password" name="password"  value=""></p>
				<p><div id="login_text">Repeat password</div> 		<input type="password" name="repeat_password" value=""></p>
			</div>
			<div id="registration_block">
				<p><div id="login_text">Birhtday</div>		 <input type="date" name="birth" value="" max="2010-01-01" min="1940-01-01"> </p>
				<p><div id="login_text">Height</div> 		<input type="text" name="height"  value=""></p>
				<p><div id="login_text">Weight</div> 		<input type="text" name="weight" value=""></p> 
				<p><div id="login_text">Gender</div> 		<select type="gender" name="gender" >
																<option value="1"> Man </option>
																<option value="0"> Woman  </option>
															</select></p>
				
			</div>
				<p><input type="submit" value="Registration"></p>
				
			</form>
		</div>
	</div>';