<?php
/********************************************************************************

* Filename : db.pdo.php                                                       *
* Usage    : Class file for database connectivity and operations like 
*Created By Mohamed Rafeeque PT
* CopyRight @ Mohamed Rafeeque        *
* Dated on : 09/12/2013                                                       *
*********************************************************************************/


class myconnection 
{

	var $host      =  "localhost";
	var $username  =  'root';
	var $password  =  '';
	var $dbname    =  "db1";

function myconnection()/// Constructor Intilise the conection 
 {
 	try{
             
   $this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."",$this->username,$this->password);
   return $this->con;
       }
 	   catch(PDOException $e) {return $e->getMessage();}
 }

////////////////////SELECT FUNCTION WITH SQL///////////////////////////
 function select($sql)
 {
 	try{
		$sth = $this->con->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
    	}
 	catch(PDOException $e) {
 		return $e->getMessage();
 		}
 }

/////////////////////INSERT FUNCTION//////////////////////////////////

function insert($table,$values)
{
	try{	
		$this->tableName =trim($table);
		$this->value = $values;
        if(!is_array($this->value)){return 0;}
	    $count = 0;
	    foreach($this->value as $key => $val )
	    {
	    if($count == 0)
			          { $this->field1 = ":".$key."";
			          $this->field2 = "`".$key."`";
				      $this->fieldsValues = $val;
				      }
				  else{
					$this->fieldsValues.= ", ".$val." ";
					$this->field1.= ",:".$key."";
					$this->field2.= ",`".$key."`";
				    }
				$count++;
		}
	$this->query =sprintf("insert into %s (%s) values (%s)",$this->tableName,$this->field2,$this->fieldsValues);
	$res=$this->con->query($this->query); 
	return $this->con->lastInsertId(); 
     }
	catch(PDOException $e){return $e->getMessage();}
}

///////////////////////////////////////////////////////// INSERTION OVER//////


//////////////////UPDATE FUNCTION/////////////////////////////////////////////
function update($table , $values , $where = 1 , $limit = 1)
{
	try{	
		$this->tableName = trim($table);
		$this->value = $values;
		$this->where = $where;
		$this->limit = $limit;
		if(!is_array($this->value)){return 0;}
       $count = 0;
        $this->query = 'update '.$this->tableName.' set ';
        foreach($this->value as $key => $val )
            {
		    if($count == 0){$this->query.=" `$key`= ".$val." " ;}
			else{$this->query.=" , `$key`= ". $val ." " ;}
			$count++;
		    }
		$this->query.="  WHERE $this->where  LIMIT $this->limit ";
        $res=$this->con->query($this->query);	
	      return 1;
      }
	catch(PDOException $e)
     {return $e->getMessage();}
}


////////////////////////////////UPDATION IS OVER//////////////


/////////////////////////////////DELETE ROW ////////////////

function delete($table,$where)
{
	try
	{
	    $this->table = trim($table);
		$this->where = $where;	
		$this->query = "DELETE FROM ".$this->table." WHERE ".$this->where;
        $res=$this->con->query($this->query);	
	    return $res; 
    }catch(PDOException $e)
     {return $e->getMessage();}

}
///////////////////////////////////////////////////DELETE OVER///////////


///////////////////////////////////////////////CONNECTION CLOSE

function close(){try{$this->con=null;}catch(PDOException $e){return $e->getMessage();}}
///////////////////////connection Close Over/////

/////////////////////SQL SAFE/////////////
function sqlSafe($value, $quote="'")
	{try{
		$value = str_replace(array("\'","'"),"&#39;",$value);
	     if (get_magic_quotes_gpc()){$value = stripslashes($value);}
	     $value = $quote . $value . $quote;
         return $value;
	   }catch(PDOException $e)
        {return $e->getMessage();}
  }
/////////////////////SQL SAFE OVER/////////////
}//// CLASS CLOSE


///////////       OBJECT INTILIZATION
$db   =   new myconnection();



?>