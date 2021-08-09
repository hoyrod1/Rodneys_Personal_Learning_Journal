<?php 

/*---------------------------------------------- INSERT ENTRY ----------------------------------------------*/

function insert_entry($title, $date, $time_spent, $learned, $resources)
{
	include("inc/journal.db.php");

	$sql_i = "INSERT INTO journal_entries(title, date, time_spent, learned, resources)VALUES(?, ?, ?, ? , ?)";
	try 
	{
		$results = $db->prepare($sql_i);
		$results->bindParam(1, $title, PDO::PARAM_STR);
		$results->bindParam(2, $date, PDO::PARAM_STR);
		$results->bindParam(3, $time_spent, PDO::PARAM_STR);
		$results->bindParam(4, $learned, PDO::PARAM_STR);
		$results->bindParam(5, $resources, PDO::PARAM_STR);
		$results->execute();

	} catch (Exception $e) 
	{
	  echo "Insert failed: " . $e->getMessage();
	  return false;	
	}

	return true;
}

/*------------------------------------------------ READ LIST ENTRY ------------------------------------------------*/

function read_list_entry()
{
	include("inc/journal.db.php");

	$sql_r = "SELECT id, title, date FROM journal_entries ORDER BY date DESC";
	try 
	{
		$results = $db->query($sql_r);

	} catch (Exception $e) 
	{
		echo "Query failed: " . $e->getMessage();
		return false;
	}

	return $results;
}

/*------------------------------------------------ READ DETAILED ENTRY ------------------------------------------------*/

function read_detail_entry($id)
{
	include("inc/journal.db.php");

	$sql_r_d = "SELECT * FROM journal_entries WHERE id = ?";
	try 
	{
		$results = $db->prepare($sql_r_d);
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) 
	{
		echo "Query failed: " . $e->getMessage();
		return false;
	}
	return $results->fetch(PDO::FETCH_ASSOC);
}

/*-------------------------------------------------- UPDATE ENTRY -------------------------------------------------*/

function update_entry($id, $title, $date, $time_spent, $learned, $resources)
{
	include("inc/journal.db.php");

	$sql_u = 'UPDATE journal_entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE id = ?';
	try 
	{
		$results = $db->prepare($sql_u);
		$results->bindParam(1, $title, PDO::PARAM_STR);
		$results->bindParam(2, $date, PDO::PARAM_STR);
		$results->bindParam(3, $time_spent, PDO::PARAM_STR);
		$results->bindParam(4, $learned, PDO::PARAM_STR);
		$results->bindParam(5, $resources, PDO::PARAM_STR);
		$results->bindParam(6, $id, PDO::PARAM_INT);
		$results->execute();

	} catch (Exception $e) 
	{
		echo "Update failed: " . $e->getMessage();
		return false;	
	}
	return true;
}

/*---------------------------------------------- DELETE ENTRY ----------------------------------------------*/

function delete_entry($entry_id)
{
	include("inc/journal.db.php");
	$sql_d = "DELETE FROM journal_entries WHERE id = ?";
	try 
	{
		$results = $db->prepare($sql_d);
		$results->bindParam(1, $entry_id, PDO::PARAM_INT);
		$results->execute();

	} catch (Exception $e) 
	{
		echo "Execution failed: " . $e->getMessage();
		return false;	
	}
	return true;
}