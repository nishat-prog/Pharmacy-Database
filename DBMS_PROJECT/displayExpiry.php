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
    $today = date('y-m-d');
    $query = "Select medicine_id,medicine_name, company_id,supplier_id,expiry_date FROM medicine where expiry_date<'$today'";
    $res=mysqli_query($con,$query);
    if(mysqli_error($con)){
        print(mysqli_error($con));
    }
    else{
        echo "<br><br><strong>Expired Medicines are</strong><br><br><br>";
        echo "<center><table><tr><th>Medicine ID</th><th>Medicine name</th><th>Company ID</th><th>Supplier ID</th><th>Expiry date</th></tr>";
    while($row=mysqli_fetch_assoc($res)){
        echo "<tr><td>".$row['medicine_id']."</td><td>".$row['medicine_name']."</td><td>".$row['company_id']."</td><td>".$row['supplier_id']."</td><td>".$row['expiry_date']."</td></tr>";
       
    }
    echo "</table></center>";
        }
    }
?>
</body>
</html>

