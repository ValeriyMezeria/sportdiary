<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

	echo '<script>
			function openbox(id){
			  display = document.getElementById(id).style.display;
			  if(display==\'none\'){
				 document.getElementById(id).style.display=\'block\';
			  }else{
				 document.getElementById(id).style.display=\'none\';
			  }
			}
			</script>

<form action="http://'.$host.'/People/people?recieve=1" method="post">
		<div id="search_box"> 
			<input type="text" name="name" value="" id="text_search_people" placeholder="enter user name you want to search">
			<input type="submit" value="Search" id="submit_search_people">
		</div>
		<div id="search_box_with_people">';
			
			if(isset($data))
			{
				for($i = 0; $i < count($data); $i++)
				{
					extract($data[$i], EXTR_OVERWRITE);
					
					echo '<div id="found_people">
						<div id="found_people_ava">
							<img src="http://'.$host.'/'.$user_avatar.'">
						</div>
						
						<div id="found_people_info">
							<div id="found_people_name">
								<a href="#">'.$user_first_name.' '.$user_last_name.'</a>
							</div>
							
							<div id="found_people_age">
								'.$user_country.', '.$user_city.'
							</div>
						</div>
						<div id="found_people_add">
							<input type="submit" value="Add to friends" id="submit_add_people">
						</div>
						
					</div>';
				}
			}
			else
			{
				echo '<div id="not_found_people">
							A person can not be found!
						</div>
						';
			}
			
			
			
			
		echo '</div>
		

		<div id="filter_box"> 
			<p>Country:<br>
			<input type="text" name="country" value="" pattern="^[A-Za-zÀ-ßà-ÿ¨¸\s]+$" placeholder="Ukraine"></p>
			<p>City:<br>
			<input type="text" name="city" value="" pattern="^[A-Za-zÀ-ßà-ÿ¨¸\s]+$" placeholder="Kyiv"></p>
			
			<p>Age from
			<input type="text" name="min_age" value="" id="text_age" pattern="[0-9]{2}" placeholder="16">
			to
			<input type="text" name="max_age" value="" id="text_age" pattern="[0-4]{2}" placeholder="40"></p>
			
			<p>Gender:
			<input type="radio"  name="gender" value="1" checked> Man
			<input type="radio" name="gender" value="0"> Woman </p>
			
			<p align="center"><a href="#" onclick="openbox(\'box\'); return false">Other</a></p>
			
			<div id="box" style="display: none;">
			
				<p>Heigth from
					<input type="text" name="min_height" value="" id="text_age" pattern="^[0-9]+$" placeholder="120">
					to
					<input type="text" name="max_height" value="" id="text_age" pattern="^[0-9]+$" placeholder="190">
				</p>
				
				<p>Weight from
					<input type="text" name="min_weight" value="" id="text_age" pattern="^[0-9]+$" placeholder="60">
					to
					<input type="text" name="max_weight" value="" id="text_age" pattern="^[0-9]+$" placeholder="90">
				</p>
				
			</div>
			
		</div>
	</form>
		';