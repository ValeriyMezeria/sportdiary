<?php
session_start();

class Model_Statistica extends Model
{
	
	public function get_sport_statistic()
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
			
		
		$query_result = $connection->query('SELECT count(user_with_sport_table.name) AS count_users, user_with_sport_table.name as name
											FROM (SELECT training.user_id, kinds_of_sport.name 
											FROM (((training LEFT JOIN exercises ON training.id = exercises.training_id)  
												LEFT JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id) 
												LEFT JOIN kinds_of_sport ON kinds_of_sport.id = kinds_of_exercises.kind_of_sport)
												RIGHT JOIN addresses ON training.user_id = addresses.user_id
												WHERE training.status = \'done\' 
																				AND training.user_id IN (SELECT users.id 
																											FROM users 
																											WHERE '.(($gender != 2) ? 'users.gender = '.$gender.'' : 'true').' 
																														'.(!empty($age_min) ? 'AND age(users.id) >= '.$age_min.'' : '').'
																														'.(!empty($age_max) ? 'AND age(users.id) <= '.$age_max.'' : '').'
																														AND users.id IN (SELECT user_id 
																																			FROM followers 
																																			'.(($only_subscribes == 1) ? 'WHERE follower_id = '.$only_subscribes.'))' : '))').'
																				AND training.date > back_date('.$period.')
																				AND training.date <= '.(($period == 0) ? 'CURDATE()' : 'back_date(0)') .'
																				'.((!empty($country)) ? 'AND addresses.country LIKE("%'.$country.'%")' : '').'
																				'.((!empty($city)) ? 'AND addresses.city LIKE("%'.$city.'%")' : '').'
																				'.((!empty($kos_name)) ? 'AND kinds_of_sport.name LIKE("%'.$kos_name.'%")' : '').'
												GROUP BY training.user_id, kinds_of_sport.id) user_with_sport_table
										GROUP BY user_with_sport_table.name
										ORDER BY count_users DESC;');
		
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}
		
		
		return $result;
	}
	
	function get_exercise_statistic()
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		$query_result = $connection->query('SELECT table_with_exercise.name_exercise as name, table_with_exercise.exercises_description as description, count(table_with_exercise.count_exercise) AS count_people 
											FROM (SELECT count(training.user_id) AS count_exercise, kinds_of_exercises.name AS name_exercise, kinds_of_exercises.description AS exercises_description 
												FROM (((training LEFT JOIN exercises ON training.id = exercises.training_id)  
													LEFT JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id) 
													LEFT JOIN kinds_of_sport ON kinds_of_sport.id = kinds_of_exercises.kind_of_sport)
													RIGHT JOIN addresses ON training.user_id = addresses.user_id
													WHERE training.status = \'done\' AND kinds_of_sport.name = \''.$kos_name.'\'
																				AND training.user_id IN (SELECT users.id 
																											FROM users 
																											WHERE '.(($gender != 2) ? 'users.gender = '.$gender.'' : 'true').' 
																															'.(!empty($age_min) ? 'AND age(users.id) >= '.$age_min.'' : '').'
																															'.(!empty($age_max) ? 'AND age(users.id) <= '.$age_max.'' : '').'
																																AND users.id IN (SELECT user_id 
																																					FROM followers 
																																					'.(($only_subscribes == 1) ? 'WHERE follower_id = '.$only_subscribes.'))' : '))').'
																				AND training.date > back_date('.$period.')
																				AND training.date <= '.(($period == 0) ? 'CURDATE()' : 'back_date(0)') .' 
																				'.((!empty($country)) ? 'AND addresses.country LIKE("%'.$country.'%")' : '').'
																				'.((!empty($city)) ? 'AND addresses.city LIKE("%'.$city.'%")' : '').'
																				'.((!empty($koe_name)) ? 'AND kinds_of_exercises.name LIKE("%'.$koe_name.'%")' : '').'
													GROUP BY kinds_of_exercises.name, training.user_id) table_with_exercise
											GROUP BY table_with_exercise.name_exercise;');
			
			
		$query_result_kos = $connection->query('SELECT name FROM kinds_of_sport;');
		
		$j = 0;
		while($row = $query_result_kos->fetch_assoc())
			$kos[$j++] = $row['name'];
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}
		
		$result[$i]['kos'] = $kos;
		
		return $result;
	}
	
	function get_all_kos()
	{
		$i = 0;
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result_kos = $connection->query('SELECT name FROM kinds_of_sport;');
		
		$j = 0;
		while($row = $query_result_kos->fetch_assoc())
			$kos[$j++] = $row['name'];
		
		$result[$i]['kos'] = $kos;
		
		return $result;
	}
	
	function get_people_statistic($sort_by, $sort_dir)
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		$query_result = $connection->query('SELECT first_name, last_name, approach, repetition, value, measure_of_value, result, measure_of_result, intensity
											FROM ((((training LEFT JOIN exercises ON training.id = exercises.training_id)  
											LEFT JOIN kinds_of_exercises ON exercises.kind_of_exercise = kinds_of_exercises.id) 
											LEFT JOIN kinds_of_sport ON kinds_of_sport.id = kinds_of_exercises.kind_of_sport)
											RIGHT JOIN addresses ON training.user_id = addresses.user_id)
											LEFT JOIN users ON training.user_id = users.id
											WHERE training.status = \'done\' 
													AND training.user_id IN (SELECT users.id 
																			FROM users 
																			WHERE '.(($gender != 2) ? 'users.gender = '.$gender.'' : 'true').' 
																					'.(!empty($age_min) ? 'AND age(users.id) >= '.$age_min.'' : '').'
																					'.(!empty($age_max) ? 'AND age(users.id) <= '.$age_max.'' : '').'
																					AND users.id IN (SELECT user_id 
																									FROM followers 
																									'.(($only_subscribes == 1) ? 'WHERE follower_id = '.$only_subscribes.'))' : '))').'                                              
													AND training.date > back_date('.$period.')
													AND training.date <= '.(($period == 0) ? 'CURDATE()' : 'back_date(0)') .' 
													'.((!empty($country)) ? 'AND addresses.country LIKE("%'.$country.'%")' : '').'
													'.((!empty($city)) ? 'AND addresses.city LIKE("%'.$city.'%")' : '').'
													'.((!empty($first_name)) ? 'AND first_name LIKE("%'.$first_name.'%")' : '').'
													AND kinds_of_exercises.name = \''.$koe_name.'\'
													'.((!empty($min_height)) ? 'AND users.height >= '.$min_height.'' : '').'
													'.((!empty($max_height)) ? 'AND users.height <= '.$max_height.'' : '').'
													'.((!empty($min_weight)) ? 'AND users.height >= '.$min_weight.'' : '').'
													'.((!empty($max_weight)) ? 'AND users.height <= '.$max_weight.'' : '').'
											 ORDER BY '.$sort_by.' '.$sort_dir.';');
		
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}
		
		$result = $this->get_all_koe($i, $result);
		
		return $result;
	}
	
	function get_all_koe($i, $result = null)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result_koe = $connection->query('SELECT name FROM kinds_of_exercises;');
		
		$j = 0;
		while($row = $query_result_koe->fetch_assoc())
			$koe[$j++] = $row['name'];
		
		$result[$i]['koe'] = $koe;
		
		return $result;
	}
	
	function get_program_statistic()
	{
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		
		$query_result = $connection->query('SELECT count(programs.user_id) AS count_people, users.id as id, templates_programs.name as name, templates_programs.id as t_prog_id, templates_programs.description as description, users.first_name as first_name, users.last_name as last_name
											FROM (programs RIGHT JOIN templates_programs ON templates_programs.id = programs.template_program_id) 
											JOIN users ON users.id = templates_programs.author_id
											WHERE programs.is_finish = 1 
														'.((!empty($first_name)) ? 'AND (first_name LIKE("%'.$first_name.'%") OR first_name LIKE("%'.$first_name.'%"))' : '').'
														AND programs.user_id IN (SELECT users.id 
																							FROM users 
																							WHERE '.(($gender != 2) ? 'users.gender = '.$gender.' AND ' : '').' 
																									'.(!empty($age_min) ? 'age(users.id) >= '.$age_min.' AND ' : '').'
																									'.(!empty($age_max) ? 'age(users.id) <= '.$age_max.' AND ' : '').'
																											users.id IN (SELECT user_id 
																															FROM followers 
																															'.(($only_subscribes == 1) ? 'WHERE follower_id = '.$_SESSION['user_id'].'))' : '))').'
											GROUP BY templates_programs.name
											UNION 
											SELECT 0 , users.id as id, templates_programs.name as name, templates_programs.id as t_prog_id, templates_programs.description as description, users.first_name as first_name, users.last_name as last_name 
											FROM templates_programs JOIN users ON users.id = templates_programs.author_id
											WHERE'.((!empty($first_name)) ? '(first_name LIKE("%'.$first_name.'%") OR first_name LIKE("%'.$first_name.'%")) AND' : '').'
																templates_programs.id NOT IN (SELECT templates_programs.id 
																FROM programs RIGHT JOIN templates_programs ON templates_programs.id = programs.template_program_id
																				WHERE programs.is_finish = 1 
																					AND programs.user_id IN (SELECT users.id 
																											FROM users 
																											WHERE '.(($gender != 2) ? 'users.gender = '.$gender.' AND ' : '').' 
																													'.(!empty($age_min) ? 'age(users.id) >= '.$age_min.' AND ' : '').'
																													'.(!empty($age_max) ? 'age(users.id) <= '.$age_max.' AND ' : '').' 
																															users.id IN (SELECT user_id 
																																			FROM followers 	
																																			'.(($only_subscribes == 1) ? 'WHERE follower_id = '.$_SESSION['user_id'].')))' : ')))').'
											ORDER BY count_people DESC;');
		
	
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i++] = $row;
		}

		
		return $result;
		
	}
	
	function apply_program($t_prog_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('CALL apply_program('.$_SESSION['user_id'].', '.$t_prog_id.')');
	}
	
	function has_program()
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT * FROM programs WHERE user_id = '.$_SESSION['user_id'].' AND is_finish = 0;');
		
		
		while($row = $query_result->fetch_assoc())
		{
			return true;
		}
		
		return false;
	}
}