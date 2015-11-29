<?php
session_start();

class Model_Training extends Model
{
	
	public function get_training()
	{	
		$i = 0;
		$user_id = 2;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT  training.id, training.name, training.date, training.total_time, training.calories, training.feeling, training.description, training.status, training.program_id, 
													exercises.approach, exercises.repetition, exercises.value, exercises.result, exercises.intensity, 
													kinds_of_exercises.name as name_kind_of_ex, kinds_of_exercises.description as desc_kind_of_ex, kinds_of_exercises.measure_of_value, kinds_of_exercises.measure_of_result, 
													kinds_of_sport.name as name_kind_of_sp, kinds_of_sport.description as desc_kind_of_sp,kinds_of_sport.icon 
											FROM training 
											JOIN exercises ON training.id = exercises.training_id 
											JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id
											JOIN kinds_of_sport ON kinds_of_exercises.kind_of_sport = kinds_of_sport.id
											WHERE training.user_id = '.$user_id.';
											');
		
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i]['training_id'] = $row['id'];
			$result[$i]['training_name'] = $row['name'];
			$result[$i]['training_date'] = $row['date'];
			$result[$i]['training_time'] = $row['total_time'];
			$result[$i]['training_calories'] = $row['calories'];
			$result[$i]['training_feeling'] = $row['feeling'];
			$result[$i]['training_description'] = $row['description'];
			$result[$i]['training_status'] = $row['status'];
			$result[$i]['training_program'] = $row['program_id'];
			
			$result[$i]['exercises_approach'] = $row['approach'];
			$result[$i]['exercises_repetition'] = $row['repetition'];
			$result[$i]['exercises_value'] = $row['value'];
			$result[$i]['exercises_intensity'] = $row['intensity'];
			
			$result[$i]['koe_name'] = $row['name_kind_of_ex'];//koe is "kinds of exercises"
			$result[$i]['koe_description'] = $row['desc_kind_of_ex'];
			$result[$i]['koe_name'] = $row['name_kind_of_ex'];
			$result[$i]['koe_mov'] = $row['measure_of_value'];//mov is "measure of value"
			$result[$i]['koe_mor'] = $row['measure_of_result'];
			
			$result[$i]['kos_name'] = $row['name_kind_of_sp'];//kos is "kind of sport"
			$result[$i]['kos_description'] = $row['desc_kind_of_sp'];
			$result[$i++]['kos_icon'] = $row['icon'];	
		}
		
		$query_result = $connection->query('SELECT SEC_TO_TIME(sum(TIME_TO_SEC(total_time))) as time, count(id) training_num  FROM training WHERE user_id ='.$user_id.';');
		$row = $query_result->fetch_assoc();
		
		$result[$i]['training_num'] = $row['training_num'];
		$result[$i]['training_time'] = $row['time'];
		
		return $result;
	}

}