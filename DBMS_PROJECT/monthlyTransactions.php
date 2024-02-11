<html>
<head>
<style>
table{
	width:75%;
	border-collapse:collapse;
}
td,th{
	text-align:center;
	font-family:Serif;
	border:2px solid rgb(56, 118, 234);
}
</style>
</head>
<body style="background-color:rgb(223, 236, 247) ;color:blue">
<?php
$con=mysqli_connect("localhost","root","","pharmacy");
if(mysqli_connect_errno()){
	printf("Connection failed:%s",mysqli_connect_errno());
	exit();
}
else{
	
	$firstDayOfMonth = date('Y-m-01');
    $lastDayOfMonth = date('Y-m-t');

// Query to retrieve transactions for the current month
    $query = "SELECT * FROM transactions WHERE transaction_date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'";
	$res=mysqli_query($con,$query);
	if(mysqli_error($con)){
		print(mysqli_error($con));
	}
	else{
		echo "<center><br><br><strong>Transactions of this month</strong><br><br><br>";
		echo "<table><tr><th>Transaction ID</th><th>Medicine ID</th><th>Supplier ID</th><th>Company ID</th><th>Quantity</th><th>Transaction date</th><th>Transaction Type</th></tr>";
	while($row=mysqli_fetch_assoc($res)){
	    
		echo "<tr><td>".$row['transaction_id']."</td><td>".$row['medicine_id']."</td><td>".$row['supplier_id']."</td><td>".$row['company_id']."</td><td>".$row['quantity']."</td><td>".$row['transaction_date']."</td><td>".$row['transaction_type']."</td></tr>";
        }
		echo "</table></center>";
	}
	}
?>
</body>
</html>
