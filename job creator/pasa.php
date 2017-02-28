<?php

 if(isset($_POST['SaveChanges'])){
echo $_POST['Question_info'];

foreach($_POST['answer'] as $value) {
					echo  $value;			
				//$sql = mysql_query("INSERT INTO answer ( answer_info, Question_id) VALUES ( '$value', '$lastQID')")or die(mysql_error());;
	
					
									}
 }

?>