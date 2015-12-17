<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

echo '<div id="add_training">
		<form action="http://'.$host.'/Training/add_training?recieve=1" method="post">
			'.$options['result'].'
			<table class="table_parametrs">
				<tr>
					<td width="120px"><b>Name training:</b></td>
					<td><input type="text" value="" name="name" placeholder="name training"></td>
				</tr>
				<tr>
					<td width="120px"><b>Total time:</b></td>
					<!--<td><input type="time" value="" name="total_time"></td>-->
					<td><input type="text" value="" name="total_time" pattern="[0-2][0-9]:[0-5][0-9]:[0-5][0-9]" placeholder="hh:mm:ss" ></td>
				</tr>
				<tr>
					<td width="120px"><b>Calories:</b></td>
					<td><input type="text" value="" name="calories" placeholder="number of calories"></td>
				</tr>
				<tr>
					<td width="120px"><b>Status:</b></td>
					<td><select type="status" name="status" >
							<option value="done"> Done </option>
							<option value="sheduled "> Sheduled  </option>	
						</select></td>
				</tr>
				<tr>
					<td width="120px"><b>Feeling:</b></td>
					<td><select type="feeling" name="feeling" >
																<option value="5"> Excellent </option>
																<option value="4"> Good </option>
																<option value="3"> Satisfactory </option>
																<option value="2"> Bad </option>
																<option value="1"> Awful </option>	
															</select></td>
				</tr>
				
				<tr>
					<td width="120px"><b>Date:</b></td>
					<!--<td><input type="date" value="" name="date" ></td>-->
					<td><input type="text" value="" name="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="yyyy-mm-dd" ></td>
				</tr>
			</table>


			<table border="1" class="table_exercise" id="table_exercise">
				<tr>
					<td><b>Exercise</b></td>
					<td "><b>Approache</b></td>
					<td "><b>Repetition</b></td>
					<td "><b>Value</b></td>
					<td "><b>Result</b></td>
					<td ><b>Intensity</b></td>
					<td class="training_done" onclick="addNewRow()"> add </td>
				</tr>
				<tr id="row">
					<td><select type="status" name="exercise[]" >';
					
					for($i = 0; $i < count($data); $i++)
					{
						extract($data[$i], EXTR_OVERWRITE);
						echo '<option value="'.$id.'"> '.$name.' </option>';
					}
											
								
					echo '</select></td></td>
					<td><input type="text" name="approach[]" ></td>
					<td><input type="text" name="repetition[]" ></td>
					<td><input type="text" name="value[]"></td>
					<td><input type="text" name="result[]" ></td>
					<td><select type="intensity" name="intensity[]" >
								<option value="5"> On limit </option>
								<option value="4"> Hard </option>
								<option value="3"> Medium </option>
								<option value="2"> Light </option>
								<option value="1"> Very light </option>
							</select></td>
					</td>
					<td class="training_missed" onclick="removeRow(this)">delete</td>
				</tr>
			</table><br>
		
			<a href="http://'.$host.'/Training/add_exercise">Do you have some new exercise? Add it.</a><br>
		
			<b>Description:</b> <br>
			<textarea rows="6" value="" name="description" id="description" placeholder=""></textarea><br>
			<input type="submit" value="Save">
		</form>
	</div>
	
	
	<script>

			function addNewRow()
			{
			  var table = document.getElementById("table_exercise");
			  var newNode = table.rows[1].cloneNode(true);
			  table.appendChild(newNode);
			}
			
			function removeRow(r) 
			{
				var i = r.parentNode.rowIndex;
				var table = document.getElementById("table_exercise");
				if(table.rows.length > 2)
					table.deleteRow(i);
			}
			
			
	</script>';