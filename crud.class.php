<?php

/***
 * Extend Database Class 
 * to grab connection string
 **/
class Crud extends Database
{

	/***
	 * Recieved values from the create form
	 *
	 * $name and $email
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

	/***
	 * View database values
	 **/
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

	/***
	 * Updating record
	 *
	 * passing array values
	 **/
	public function update($vals)
	{
		$idI = count($vals)-1;
		$id = $vals[$idI];
		try
		{
			$query = $this->conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
			$query->execute($vals); //passed array values
			if($query)
			{
				header('Location: '.$_SERVER['PHP_SELF'].'#r'.$id.'');
			}
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	/***
	 * Deleting record
	 **/
	public function delete($id)
	{
		try
		{
			$query = $this->conn->prepare("DELETE FROM users WHERE id=?");
			$query->execute(array($id)); // id of the record to be deleted
			if($query)
			{
				header('Location: '.$_SERVER['PHP_SELF'].'#ud');
			}
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}
}