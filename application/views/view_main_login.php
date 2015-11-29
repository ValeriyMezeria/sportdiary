<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

echo '
			<div id="login_position">
				<div id="login">
					'.$options['result'].'
					<form action="http://'.$host.'/Main/index?recieve=1" method="post">
						<p><div id="login_text">E-mail</div> <input type="text" name="email" value="'.$options['def_login'].'"></p> 
						<p><div id="login_text">Password</div> <input type="password" name="password"  value=""></p>
						<p><input type="submit" value="Login"></p>
					</form>
					
					<p>Do you have account? &nbsp;&nbsp;<a href="http://'.$host.'/Main/registration">Registration -></a></p>
				</div>
			</div>
		';