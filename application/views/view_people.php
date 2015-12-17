<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

function is_subscribe($id, $options)
{
	extract($options, EXTR_OVERWRITE);
	
	for($i = 0; $i < count($subscribes); $i++)
	{
		if($id == $subscribes[$i]['user_id'] || $id == $_SESSION['user_id'])
			return true;
	
	}
	
	return false;
}

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
						';
						
						if(!is_subscribe($id, $options))
						{
							echo '<div id="found_people_add">
									<a href="http://'.$host.'/Profile/profile?user_id='.$id.'&subscribe='.$id.'"><div  id="submit_add_people"> Subscribe </div></a>
								</div>';
						}
						
					echo '
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
			<input type="text" name="country" value=""  placeholder="Ukraine"></p>
			<p>City:<br>
			<input type="text" name="city" value=""  placeholder="Kyiv"></p>
			
			<p>Age from
			<input type="text" name="age_min" value="" id="text_age" pattern="[0-9]{2}" placeholder="16">
			to
			<input type="text" name="age_max" value="" id="text_age" pattern="[0-9]{2}" placeholder="40"></p>
			
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