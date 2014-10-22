<?php

require_once 'init.php';

/***
 * Creating/Inserting into Database
 *
 * Using PDO
 *
 **/
echo '<h1><u>CREATE</u></h1>';
echo 
	'
	<form action="" method="post">
		<table>
			<tr>
				<td>Name<td>: <input type="text" name="name" required></td>
			</tr>
			<tr>
				<td>Email<td>: <input type="email" name="email" required></td>
			</tr>
			<tr>
				<td><td>&nbsp; <input type="submit" name="create" value="Create"></td>
			</tr>
		</table>
	</form>
	';

if(isset($_POST['create']))
{
	/***
	 * Pass values from Form
	 *
	 * name and email values
	 *
	 **/
	$crud->create($_POST['name'], $_POST['email']);
}