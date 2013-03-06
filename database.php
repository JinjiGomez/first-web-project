<?php

  define('DBINFO',  "mysql:host=localhost;dbname=store" );
	define('DBUSER',  "root");
	define('DBPASS',  "");
	
	function loginUser($username, $password)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='SELECT * FROM user WHERE username=? AND password=?';
			$stmt = $db->prepare($sql);
			$stmt->execute(array($username, $password));
			$user = $stmt->fetch();
			$db = null;	
			return $user;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function addRecord($dress_desc, $category, $dress_price, $dress_qty, $filename, $active)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='INSERT INTO dress( dress_desc, category, dress_price, dress_qty, $filename, active) VALUES(?,?,?,?,?,?)';
			$stmt = $db->prepare($sql);
			$stmt->execute(array($dress_desc, $category, $dress_price, $dress_qty, $filename, $active));
			$db = null;	
			return  "New Record added.";
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function getRecord($dress_id)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='SELECT * FROM dress WHERE  dress_id=?';
			$stmt = $db->prepare($sql);
			$stmt->execute(array($dress_id));
			$t = $stmt->fetch();
			$db = null;
			
			return $t;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function deleteRecord($dress_id)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='DELETE FROM dress WHERE  dress_id=?';
			$stmt = $db->prepare($sql);
			$stmt->execute(array($dress_id));
			$db = null;
			return true;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function editRecord($dress_id, $dress_desc, $category, $dress_price, $dress_qty, $filename, $active)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='UPDATE dress 
					   SET dress_desc=?, category=?, dress_price=?, dress_qty=?, $filename=?, active=? 
					   WHERE  dress_id=?';
			$stmt = $db->prepare($sql);
			$stmt->execute(array( $dress_desc, $category, $dress_price, $dress_qty, $filename, $active, $dress_id));
			$db = null;
			return $dress_desc. " has been updated.";
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function getAllRecords()
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='SELECT * FROM dress';
			$stmt = $db->prepare($sql);
			$stmt->execute();			
			$list = $stmt->fetchAll();
			$db = null;		
			
			return $list;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function searchRecords($keyword)
	{
		try
		{
			$keyword = '%' . $keyword . '%';
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='SELECT * FROM dress WHERE name LIKE  ? OR assigned  LIKE ?';
			$stmt = $db->prepare($sql);
			$stmt->execute(array($keyword, $keyword));			
			$list = $stmt->fetchAll();
			$db = null;				
			return $list;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	function searchRecordsAdvanced($keyword)
	{
		try
		{
			$words = explode(' ', $keyword);
			$condition = array();
			foreach($words as $i => $w)
			{
				$words[$i] = "%{$w}%";
				$condition[] = "NAME LIKE ? ";
			}
			//uli nata  => name like '%uli%' or name like '%walay%"
			 $where = implode(" OR ", $condition);
			 
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			$sql ='SELECT * FROM dress WHERE ' . $where;
			
			$stmt = $db->prepare($sql);
			$stmt->execute($words);			
			$list = $stmt->fetchAll();
			$db = null;				
			return $list;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
	
	function getSortedRecords($orderby="dress_desc desc")
	{
		try
		{
			//connect
			$db = new PDO(DBINFO, DBUSER,DBPASS);
			//execute query
			$sql ='SELECT * FROM dress ORDER BY ' . $orderby;
			echo "<br><br><br><br>",$sql;
			$stmt = $db->prepare($sql);
			$stmt->execute();			
			$list = $stmt->fetchAll();
			//close
			$db = null;				
			return $list;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	
?>
