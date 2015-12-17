<?php
session_start();

class Model_Training extends Model
{
	
	public function get_training($user_id, $status)
	{	
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		
		
		$tmp = $this->get_data_from_table('training', 'id', 'date = '.date('Y').'-'.date('m').'-'.(date('d') - 1).'');
		if(isset($tmp))
			$this->update_by_id($tmp[0]['id'], 'training', 'ststus', 'missed');
		
		$query_result = $connection->query('SELECT  training.id as id, training.name as name, date, total_time, calories, feeling, training.description as description, status, program_id, 
													approach, repetition, value, result, intensity, 
													kinds_of_exercises.name as koe_name, kinds_of_exercises.description as koe_description, kinds_of_exercises.measure_of_value as koe_mov, kinds_of_exercises.measure_of_result as koe_mor, 
													kinds_of_sport.name as kos_name, kinds_of_sport.description as kos_description, kinds_of_sport.icon as kos_icon
											FROM training 
											JOIN exercises ON training.id = exercises.training_id 
											JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id
											JOIN kinds_of_sport ON kinds_of_exercises.kind_of_sport = kinds_of_sport.id
											WHERE training.user_id = '.$user_id.' AND training.status = \''.$status.'\' 
											ORDER BY training.date DESC;
											');
	
		while($row = $query_result->fetch_assoc())
		{	
			$result[$i++] = $row;	
		}
		
		$query_result = $connection->query('SELECT SEC_TO_TIME(sum(TIME_TO_SEC(total_time))) as time, count(id) training_num  FROM training WHERE user_id ='.$user_id.' AND status=\'done\';');
		$row = $query_result->fetch_assoc();
		
		$result[$i]['num'] = $row['training_num'];
		$result[$i]['time'] = $row['time'];
		
		$query_result = $connection->query('SELECT kinds_of_sport.icon FROM ((training
											LEFT JOIN exercises ON training.id = exercises.training_id)
											LEFT JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id)
											LEFT JOIN kinds_of_sport ON kinds_of_sport.id = kinds_of_exercises.kind_of_sport
											WHERE training.user_id = '.$_SESSION['user_id'].' AND training.date > back_date(0)
											GROUP BY kinds_of_sport.id;');
		
		$j = 0;
		while($row = $query_result->fetch_assoc())
		{
			$icons[$j++] = $row['icon'];
		}
		
		$result[$i]['icons'] = $icons;
		
		return $result;
	}
	
	function get_all_exercises()
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT id, name FROM kinds_of_exercises;');
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}
		
		return $result;
	}
	
	function add_training()
	{
		$i = 0;
		$user_id = $_SESSION['user_id'];
		
		extract($_POST, EXTR_OVERWRITE);
	
	
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		
		$connection->query('INSERT INTO training (name, total_time, calories, status, feeling, date, description, user_id) 
											VALUES(\''.$name.'\', \''.$total_time.'\', \''.$calories.'\', \''.$status.'\', \''.$feeling.'\', \''.$date.'\', \''.$description.'\', \''.$user_id.'\');
											');
		
		
		$query_result = $connection->query('SELECT id FROM training ORDER by id DESC LIMIT 1;');	
		$row = $query_result->fetch_assoc();
		$training_id  = $row['id'];
			
		for($i = 0; $i < count($approach); $i++)
		{
			$connection->query('INSERT INTO exercises (approach, repetition, value, result, intensity, kind_of_exercise, training_id)
								VALUES(\''.$approach[$i].'\', \''.$repetition[$i].'\', \''.$value[$i].'\', \''.$result[$i].'\', \''.$intensity[$i].'\',\''.$exercise[$i].'\', \''.$training_id.'\');');
		}
		
	}
	
	function add_training_post($training_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$connection->query('INSERT INTO posts (user_id, training_id) VALUES('.$_SESSION['user_id'].', '.$training_id.');');
	}
	
	function delete_training($training_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$connection->query('DELETE FROM exercises WHERE training_id='.$training_id.';');
		$connection->query('DELETE FROM training WHERE id='.$training_id.';');
	}
	
	function get_all_sports()
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT id, name FROM kinds_of_sport;');
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}
		
		return $result;
	}
	
	function add_exercise()
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		if(!empty($kos) && !empty($ex_name) && !empty($description) && !empty($mov) && !empty($mor))
			$connection->query('INSERT INTO kinds_of_exercises (name, description, measure_of_value, measure_of_result, kind_of_sport) VALUES(\''.$ex_name.'\', \''.$description.'\', \''.$mov.'\', \''.$mor.'\', \''.$kos.'\');');
	}
	
	function done_training($training_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$connection->query('UPDATE training SET status = \'done\' WHERE id = '.$training_id.';');
	}
	
	function get_cur_program()
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT programs.id as id, templates_programs.name as name FROM programs 
							JOIN templates_programs ON templates_programs.id = programs.template_program_id
								WHERE programs.user_id = '.$_SESSION['user_id'].' AND programs.is_finish = 0;');

								
		while($row = $query_result->fetch_assoc())
		{
			$result = $row;
		}
		
		return $result;
	}
	
	function delete_program($program_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		//$connection->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
		
		$connection->query('	START TRANSACTION;');
			$connection->query('DELETE FROM exercises WHERE exercises.training_id IN (SELECT training.id 
											  FROM training 
											  WHERE training.program_id = '.$program_id.' AND training.user_id = '.$_SESSION['user_id'].' AND training.status = \'sheduled\');');
								 
			$connection->query('					DELETE FROM training WHERE training.program_id = '.$program_id.' AND training.user_id = '.$_SESSION['user_id'].' AND training.status = \'sheduled\';');

			$connection->query('					DELETE FROM programs WHERE programs.user_id = '.$_SESSION['user_id'].' AND programs.is_finish = 0;');

			$connection->query('				COMMIT;');
		

		
	}
}