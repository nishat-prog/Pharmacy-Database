<!DOCTYPE html>
<html>
<head>
<style>
    table {
        width: 75%;
        border-collapse: collapse;
    }

    td, th {
        text-align: center;
        font-family: Serif;
        border: 2px solid rgb(56, 118, 234);
    }
</style>
</head>
<body style="background-color:rgb(223, 236, 247); color:blue">
<?php
$con = mysqli_connect("localhost", "root", "", "pharmacy");
if (mysqli_connect_errno()) {
    printf("Connection failed:%s", mysqli_connect_errno());
    exit();
} else {
   // $today = date("2023-12-22");
    $med_name=$_GET['search'];
    $q1="Select * from medicine where medicine_name='$med_name'";
	$res1=mysqli_query($con,$q1);
	$row=mysqli_fetch_assoc($res1);
	$code=$row['m_code'];
    $query = "Select medicine_name, company_id,supplier_id,quantity FROM medicine where m_code='$code'";
    $res=mysqli_query($con,$query);
    if(mysqli_error($con)){
        print(mysqli_error($con));
    }
    else{
        echo "<br><br><strong> Related Medicines are</strong><br><br><br>";
        echo "<center><table><tr><th>Medicine name</th><th>Company ID</th><th>Supplier ID</th><th>Quanitity</th></tr>";
		
    while($row=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$row['medicine_name']."</td><td>".$row['company_id']."</td><td>".$row['supplier_id']."</td><td>".$row['quantity']."</td></tr>";
    }
	
    echo "</table></center>";
        }
    }
?>
</body>
</html>