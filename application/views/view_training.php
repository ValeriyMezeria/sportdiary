<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

//������ � ������
function days_in_month($cur)
{
	$cur_month_num = $cur;
	//$cur_month_num += $cur;
	

	
	if($cur_month_num % 2 == 0 || $cur_month_num == 8)
		return 31;
	else
	{
		if($cur_month_num == 2)
			if(date('L') == 1)
				return 29;
			else 
				return 28;
		else
			return 30;
	}
}

function training_status($data, $date)
{
	
	for($i = 0; $i < count($data) - 1; $i++)
	{
		if($data[$i]['training_date'] == $date)
			if($data[$i]['training_status'] == 'done')
				return 'training_done';
			else if ($data[$i]['training_status'] == 'missed')
				return 'training_missed';
			else if ($data[$i]['training_status'] == 'sheduled')
				return 'training_sheduled';
	}
	
	return '';
}



echo '<div id="info_training">
Number of completed training in month:</h3> <br> <text>'.$data[count($data) - 1]['training_num'].'</text> <br>
Total time on trainings in month:<br> <text>'.$data[count($data) - 1]['training_time'].'</text>
<div id="info_kind_of_sports">
Kinds of sports:<br>
<img src="images/KindsOfSports1.png">
<img src="images/KindsOfSports2.png">
<img src="images/KindsOfSports3.png">
<img src="images/KindsOfSports1.png">
<img src="images/KindsOfSports2.png">

</div>
</div>


<div id="calendar">
	<table border="1">
				<tr>
					<td><b>Mo</b></td>
					<td><b>Tu</b></td>
					<td><b>We</b></td>
					<td><b>Th</b></td>
					<td><b>Fr</b></td>
					<td><b>Sa</b></td>
					<td><b>Su</b></td>
				</tr>
				<tr>';

				$cur_day_num = date('j');
				$cur_week_day = date('N');
				$cur_month_num = date('m');
				$cur_year_num = date('Y');
				
				$prev_month = days_in_month(-1);
				$next_month = days_in_month(1);
				
				$back = 6 + $cur_week_day;
				$forward = 20 - $back;
				
				
				if($back >= $cur_day_num)
				{
					$cur_month_num -= 1;
					$start = days_in_month($cur_month_num) - $back + $cur_day_num;
				}
				else
					$start = $cur_day_num - $back;
				
				if($cur_day_num + $forward > days_in_month($cur_month_num))
					$end = $cur_day_num + $forward - days_in_month($cur_month_num);
				else
					$end = $cur_day_num + $forward;
				
				$count = 0;
				for($i = $start; $count < 21; $i++)
				{
					$count++;
					
					if($i > days_in_month($cur_month_num) && $i > $cur_day_num)
					{
						$i = 1;
						if($cur_month_num != 12)
							$cur_month_num += 1;
						else
							$cur_month_num = 1;
					}
					
					/*if($i == $back + 1)
					{
						$i = $cur_day_num;
						$cur_month_num = date('m');
					}*/
					
					echo '<td class="'.training_status($data, date('Y-'.$cur_month_num.'-'.(($i < 10) ? ('0'.$i) : $i).'')).'"><a href="#">'.$i.'</a></td>';
					
					if($count % 7 == 0)
						echo '</tr>';
				}
				
			echo '	</table>
					<a href="http://'.$host.'/Training/add_training"><div id="button_add_training">add training</div></a>
					</div>';
					

for($i = 0; $i < count($data) - 1; $i++)
{
	extract($data[$i], EXTR_OVERWRITE);
	
	echo '<!-- ���� � ����������� ---------------------------------------------------------------->
		<div id="post_body">
			<div id="post_header">
				
				<div id="post_header_info">
					<div id="training_name">
						<a href="#">'.$training_name.'</a>
					</div>
					
					<div id="training_date">
						'.$training_date.'
					</div>
				</div>
				<div id="post_header_close">
						<a href="http://'.$host.'/Training/training?delete_training='.$training_id.'">delete</a>
				</div>
			</div>
			
			<div id="post_body_training">
				
				<b>Total time:</b> '.$training_time.'<br>
				<b>Feeling:</b> '.$training_feeling.'<br>
				<b>Calories:</b> '.$training_calories.' <br>
				<table border="1">
					<tr>
						<td><b>Sport</b></td>
						<td><b>Exercise</b></td>
						<td><b>Approache</b></td>
						<td><b>Repetition</b></td>
						<td><b>Value</b></td>
						<td><b>Result</b></td>
						<td><b>Intensity</b></td>
					</tr>';
					
					
					for(; $i < count($data) - 1; $i++)
					{
						extract($data[$i], EXTR_OVERWRITE);
						
						echo '<tr>
							<td>'.$kos_name.'</td>
							<td>'.$koe_name.'</td>
							<td>'.$exercises_approach.'</td>
							<td>'.$exercises_repetition.'</td>
							<td>'.(isset($koe_mov) ? ($exercises_value.' '.$koe_mov) : '-').'</td>
							<td>'.(isset($koe_mor) ? ($exercises_result.' '.$koe_mor) : '-').'</td>
							<td>'.$exercises_intensity.'</td>
						</tr>';
					
						if($data[$i]['training_id'] != $data[$i + 1]['training_id'])
							break;
					}
				
				
				echo '</table>
				<b>Description:</b> '.$training_description.'
			</div>
			
			<div id="post_footer">
				<div id="post_footer_icon">
					<a href="http://'.$host.'/Training/training?add_training_post='.$training_id.'"><img src="http://'.$host.'/images/Share.png"></a> 	<text class="isPressed"> share </text>
				</div>
			</div>
		</div>
			';
}