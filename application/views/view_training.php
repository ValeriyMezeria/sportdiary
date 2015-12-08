<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

//работа с датами
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

function status($data, $date)
{
	
	for($i = 0; $i < count($data) - 1; $i++)
	{
		if($data[$i]['date'] == $date)
			if($data[$i]['status'] == 'done')
				return 'training_done';
			else if ($data[$i]['status'] == 'missed')
				return 'training_missed';
			else if ($data[$i]['status'] == 'sheduled')
				return 'training_sheduled';
	}
	
	return '';
}


echo '<div id="info_training">
Number of completed training in month:</h3> <br> <text>'.$data[count($data) - 1]['num'].'</text> <br>
Total time on trainings in month:<br> <text>'.$data[count($data) - 1]['time'].'</text>
<div id="info_kind_of_sports">
Kinds of sports:<br>';

extract($data[count($data) - 1], EXTR_OVERWRITE);

if(isset($icons))
	for($i = 0; $i < count($icons); $i++)
		echo'<img src="http://'.$host.'/images/'.$icons[$i].'">';
else
	echo 'No sports!';

echo '</div>
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
					
					echo '<td class="'.status($data, date('Y-'.$cur_month_num.'-'.(($i < 10) ? ('0'.$i) : $i).'')).'"><a href="#">'.$i.'</a></td>';
					
					if($count % 7 == 0)
						echo '</tr>';
				}
				
			echo '	</table>
					<a href="http://'.$host.'/Training/add_training"><div id="button_add_training">add training</div></a>
					</div>
					
					<table class="status_training">
						<tr>
							<td class="select_status_training"><a href="index.html?select=missed">Missed</a></td>
							<td><a href="index.html?select=done">Done</a></td>
							<td style="border-right: 1px solid white;"><a href="index.html?select=scheduled">Scheduled</a></td>
						</tr>			
					</table>';
					

for($i = 0; $i < count($data) - 1; $i++)
{
	extract($data[$i], EXTR_OVERWRITE);
	
	echo '<!-- пост с тренировкой ---------------------------------------------------------------->
		<div id="post_body">
			<div id="post_header">
				
				<div id="post_header_info">
					<div id="name">
						<a href="#">'.$name.'</a>
					</div>
					
					<div id="date">
						'.$date.'
					</div>
				</div>
				<div id="post_header_close">
						<a href="http://'.$host.'/Training/training?delete_training='.$id.'">delete</a>
				</div>
			</div>
			
			<div id="post_body_training">
				
				<b>Total time:</b> '.$time.'<br>
				<b>Feeling:</b> '.$feeling.'<br>
				<b>Calories:</b> '.$calories.' <br>
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
							<td>'.$approach.'</td>
							<td>'.$repetition.'</td>
							<td>'.(isset($koe_mov) ? ($value.' '.$koe_mov) : '-').'</td>
							<td>'.(isset($koe_mor) ? ($result.' '.$koe_mor) : '-').'</td>
							<td>'.$intensity.'</td>
						</tr>';
					
						if($data[$i]['id'] != $data[$i + 1]['id'])
							break;
					}
				
				
				echo '</table>
				<b>Description:</b> '.$description.'
			</div>
			
			<div id="post_footer">
				<div id="post_footer_icon">
					<a href="http://'.$host.'/Training/training?add_post='.$id.'"><img src="http://'.$host.'/images/Share.png"></a> 	<text class="isPressed"> share </text>
				</div>
			</div>
		</div>
			';
}