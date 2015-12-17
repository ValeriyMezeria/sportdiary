<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

	echo '<div id="registration_position">
		<div id="login">
			<form action="http://'.$host.'/Main/registration?recieve=1" method="post">
			<div id="registration_block">
				<p><div id="login_text">First name</div> 	<input type="text" name="first_name" value=""></p> 
				<p><div id="login_text">Last name</div> 	<input type="text" name="last_name" value=""></p>
				<p><div id="login_text">E-mail</div> 		<input type="text" name="email" value=""></p> 
				<p><div id="login_text">Password</div> 		<input type="password" name="password"  value=""></p>
				<p><div id="login_text">Repeat password</div> 		<input name="repeat_password" type="password"  value=""></p>
			</div>
			
			<div id="registration_block"
				<p><div id="login_text">Birhtday</div>		 <input type="date" name="birth" value="" max="2010-01-01" min="1940-01-01"> </p>
				<p><div id="login_text">Height</div> 		<input pattern="[0-2][0-9][0-9]"type="text" name="height"  value="" placeholder="185 (cm)"></p>
				<p><div id="login_text">Weight</div> 		<input pattern="^[0-9]+$" type="text" name="weight" value="" placeholder="77 (rg)"></p> 
				<p><div id="login_text">Gender</div> 		<select type="gender" name="gender" >
																<option value="1"> Man </option>
																<option value="0"> Woman  </option>
															</select></p>
				
			</div>
			<div id="registration_block">
				<p><div id="login_text">Country</div> 	<input pattern="^[a-zA-ZА-Яа-яЁё\s]+$" name="country" type="text" value="" placeholder="Ukraine"></p> 
				<p><div id="login_text">City</div> 		<input pattern="^[a-zA-ZА-Яа-яЁё\s]+$" name="city" type="text" value="" placeholder="Kyiv"></p>
				<p><div id="login_text">Street</div> 	<input pattern="^[a-zA-ZА-Яа-яЁё\s]+$" name="street" type="text" value="" placeholder="пр-т Победы"></p>
				<p><div id="login_text">House</div> 	<input pattern="^[0-9]+$" type="text" name="house" value="" placeholder="10"></p>
				<p><div id="login_text">Apartment</div> <input pattern="^[0-9]+$" type="text" name="apartment" value="" placeholder="13"></p>
			</div>
				<p><input type="submit" value="Registration"></p>
				
			</form>
		</div>
	</div>';