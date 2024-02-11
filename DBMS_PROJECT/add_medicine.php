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
	//print("Connection to MYSQL successful!<br>");
	$med_id=$_POST['mid'];
	$med_code=$_POST['mcode'];
	$med_name=$_POST['mname'];
	$comp_id=$_POST['cid'];
	$sup_id=$_POST['sid'];
	$m_date=$_POST['mdate'];
	$e_date=$_POST['edate'];
	$qty=$_POST['qty'];
	$query="INSERT INTO medicine values('$med_id','$med_name','$med_code','$comp_id','$sup_id','$m_date','$e_date','$qty');";
	mysqli_query($con,$query);
	if(mysqli_error($con)){
		print(mysqli_error($con));
	}
	else{
		echo "<script>window.onload = function() { alert('Medicine added successfully!'); }</script>";
		//print("Medicine added!!");
		//header("Location: F:\NISHAT\V SEM\WP\NOTEPAD++ PROGRAMS\add_medicine.html");
    exit; 
	}
}
?>
</body>

</html>