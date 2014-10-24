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


/***
 * Reading/Viewing Database Contents
 *
 * Using PDO::FETCH_OBJ, PDO::FETCH_NUM
 *
 **/
echo '<h1><u>READ</u></h1>';

/***
 * Viewing Values in the database
 *
 * Using PDO::FETCH_OBJ
 *
 **/
echo '<h3>PDO::FETCH_OBJ</h3>';
if($crud->read())
{
	$query = $crud->read();
	echo '<table border=1 style="border-collapse:collapse;" cellpadding=3>';
	echo '
		<tr>
			<th>Name<th>Email</th>
		</tr>';
		while($r = $query->fetch(PDO::FETCH_OBJ))
		{
			echo '
				<tr>
					<td>'.$r->name.'<td>'.$r->email.'</td>
				</tr>';
		}

	echo '</table>';

} else 'No Record Found';

/***
 * Viewing Values in the database
 *
 * Using PDO::FETCH_NUM
 *
 **/
echo '<h3>PDO::FETCH_NUM</h3>';
if($crud->read())
{
	$query = $crud->read();

	echo '<table border=1 style="border-collapse:collapse;" cellpadding=3>';
	echo '
		<tr>
			<th>Name<th>Email</th>
		</tr>';
		while($r = $query->fetch(PDO::FETCH_NUM))
		{
			echo '
				<tr>
					<td>'.$r[1].'<td>'.$r[2].'</td>
				</tr>';
		}

	echo '</table>';

} else 'No Record Found';


/***
 * Updataing Records
 *
 **/
echo '<h1 id="ud"><u>Update & Delete Record</u></h1>';
if($crud->read())
{
	$query = $crud->read();

	echo '<table border=1 style="border-collapse:collapse;" cellpadding=3>';
	echo '
		<tr>
			<th>Name<th>Email</th>
		</tr>';
		while($r = $query->fetch(PDO::FETCH_NUM))
		{
			echo '
				<tr id="r'.$r[0].'">
					<form action="" method="post">
					<td><input type="text" name="name" value="'.$r[1].'" required />
					<td><input type="email" name="email" value="'.$r[2].'" required />
					<td><input type="hidden" name="id" value="'.$r[0].'" required />
					<input type="submit" name="update" value="Update" />
					<td><a href="?delId='.$r[0].'" >Delete</a>
					</td>
					</form>
				</tr>';
		}

	echo '</table>';

} else 'No Record Found';

// For Update record
if(isset($_POST['update']))
{
	$vals = array(
		$_POST['name'],
		$_POST['email'],
		$_POST['id']
	);
	$crud->update($vals);
}

// For Delete record
if(isset($_GET['delId']))
{
	$crud->delete($_GET['delId']);
}