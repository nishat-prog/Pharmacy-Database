<html>
<head><title>Supplier Info</title>
 <style>     
table{
	width:30%;
	border-collapse:collapse;
}
td,th{
	text-align:center;
	font-family:Serif;
	border:2px solid rgb(56, 118, 234);
}
</style>
</head>

<body style="background-color: rgb(223, 236, 247);color:blue">
<?php
$con=mysqli_connect("localhost","root","","pharmacy");
if(mysqli_connect_errno()){
	printf("Connection failed:%s",mysqli_connect_errno());
	exit();
}
else{
$supplier=$_POST['sname'];
$query="Select m.medicine_name from medicine m,supplier s where m.supplier_id=s.supplier_id and s.supplier_name='$supplier'";
$res=mysqli_query($con,$query);
if(mysqli_error($con)){
		print(mysqli_error($con));
	}
	else{
		echo "<br><br><strong>Medicines supplied by ".$supplier.":</strong><br><br><br>";
		echo "<center><table><tr><th>Medicine name</th></tr>";
	while($row=mysqli_fetch_assoc($res)){
	    
		echo "<tr><td>".$row['medicine_name']."</td></tr>";
       
	}
	echo "</table></center>";
	}
}
?>
</body>
</html>