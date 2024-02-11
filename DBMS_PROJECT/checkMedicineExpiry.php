<html>
<head>
</head>
<body style="background-color:rgb(223, 236, 247) ;color:blue">
<?php
$con=mysqli_connect("localhost","root","","pharmacy");
if(mysqli_connect_errno()){
	printf("Connection failed:%s",mysqli_connect_errno());
	exit();
}
else{
	$med_id=$_POST['mid'];
	$query="Select expiry_date from medicine where medicine_id='$med_id';";
	$res=mysqli_query($con,$query);
	if(mysqli_error($con)){
		print(mysqli_error($con));
	}
	else{
	while($row=mysqli_fetch_assoc($res)){
	    //$ans=$row['medicine_id'];
		echo "<script>window.onload = function() { alert('Expiry date of the medicine is " . $row['expiry_date'] . "'); }</script>";
        exit; 
	}
	}
	}
?>
</body>
</html>