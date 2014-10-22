<?php

class Crud extends Database
{

	/**
	 * Recieved values from the create form
	 *
	 * $name and $email
	 *
	 **/
	public function create($name, $email)
	{
		$vals = array(null, $name, $email); // values to be passed and inserted, null auto incremented value in database
		try
		{
			$q = $this->conn->prepare("INSERT INTO users VALUES (?,?,?)");
			$q->execute($vals); //passed values on array
			if($q)
			{
				header('Location: '.$_SERVER['PHP_SELF'].'');
			}
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function read()
	{
		try
		{
			$query = $this->conn->prepare("SELECT * FROM users");
			$query->execute();
			
			if($query->rowCount())
			{
				return $query;
			}
			else return false;

		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

}