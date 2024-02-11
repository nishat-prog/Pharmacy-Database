

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "pharmacy");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicineId = $_POST["medicineId"];
	$quantity = (int)$_POST["quantity"];
    // Echo received values
    //echo "Received POST request: medicineId=$medicineId, quantity=$quantity\n";

    // Assuming you have a 'quantity' column in your 'medicine' table
    $updateQuery = "UPDATE medicine SET quantity = (quantity-'$quantity') WHERE medicine_id = '$medicineId'";

    // Echo the update query
    //echo "Update query: $updateQuery\n";

    if (mysqli_query($con, $updateQuery)) {
        // Echo success message
        echo "Your Order Is Comformed!!";
    } else {
        // Echo error message
        $errorMessage = "Error updating quantity: " . mysqli_error($con);
        echo $errorMessage;
    }
}

mysqli_close($con);
?>