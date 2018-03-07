<html>
	<head>
		<title>Submit</title>
	</head>
	<body>
		<h1>submited DATA</h1>
		
		<?php
		echo "test";
		$name=$_POST['firstname'];
		echo $name;
		
		$add=$_POST['address'];
		echo $add;echo '<br>';
		
		$coun=$_POST['country'];
		echo $coun;echo '<br>';
		
		$gen=$_POST['gender'];
		echo $gen;
		
		$mob=$_POST['mobile'];
		echo $mob;
		
		$feed=$_POST['feedback'];
		echo $feed;
		
		?>

    
  </body>

</html>
