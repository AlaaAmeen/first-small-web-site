
<?php

ob_start();
ini_set('display_errors', true);

include("config/db.pdo.php");



	if(isset($_POST['submit']))
	{
	
	
	
	$tit= $_POST['title'];
	$cat=$_POST['category1'];
	
	echo $cat;
	$det= $_POST['det'];
	//$zip=$_REQUEST['txt_zip'];
	
	if(isset($_FILES['img']))
	{
		$filename=$_FILES['img']['name'];
		
		move_uploaded_file($_FILES['img']['tmp_name'],'images/'.$filename);
		
		
		}
		else{$filename="";}
		
		 $arrayinsert = array( 'cid'         => $db->sqlSafe($cat),
							  'title'    => $db->sqlSafe($tit),
							  'det'     	=> $db->sqlSafe($det),
							  'image'           =>$db->sqlSafe($filename)
							  
						  );
						  
						//  print_r($arrayinsert);
	$resads = $db->insert('book',$arrayinsert);
	// return inserted id
	//echo $resads;
	  $msg= '<span class="alerts">inserted </span>';
		
		
		
		
		
	//$msg= 'type';
	
	
	//echo $msg;
	}else{
		$msg= '';	
	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<style>
.alerts{
	background:#F00;
	color:#CCC;
}

</style>

<body>
    <h2>Adding Book</h2>
    
    <div><?php echo $msg;?></div>
    
    <form  name="adding" method="post"  action="add-book.php"  enctype="multipart/form-data" >
    <label>Title</label>
    <input type="text" name="title">
    <br><br>
    <label>Category</label>
    <select name="category1">
       
       <?php
	   $sql="select *from category";
	   
	      $cats =$db->select($sql);//Fetch list
	 foreach($cats as $val){
		
		
		echo '<option value="'.$val['cid'].'">'.$val['name'].'</option>'; 
	 }
	   
	   ?>
       
       
    </select>
    <br><br>
    <label>Detail</label>
    <br>
    <textarea rows="8"  name="det" cols="30"></textarea>
    <br><br>
    <input type="file"  name="img">
    <br><br>
    <input type="Submit" name="submit" value="Add">
    
    </form>
    <br><br>
    <button><a href="index.php">Back</a></button>

</body>
</html>