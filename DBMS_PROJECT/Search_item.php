
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 .search-container button {
  float: none;
  padding: 7px 10px;
  margin-top: 10px;
  margin-right: 16px;
  font-size: 30px;
  border: 3px solid rgb(143, 202, 247);
  border-radius: 1em;
  cursor: pointer;
}

 .search-container button:hover {
  background:rgb(143, 202, 247);
}
 .search-container {
  float: middle;
  height:50px;
  font-size: 20px;
  /* border-radius: 1em ; */
}
.text {
  color:black;
  padding: 10px;
  margin-top: 8px;
  font-size: 25px;
  width:58%;
  border: 5px solid rgb(143, 202, 247);
  height:50px;
  background-color:rgb(199, 227, 249);
  border-radius: 1em
}



  @media screen and (max-width: 600px) {
  .search-container {
    float: none;
  }
 .text,.search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .text {
    border: 1px solid #ccc;  
  }
}
</style>
</head>
<body style="background-color:rgb(223, 236, 247)">

<center>
<img src="pharm1.png" alt="pharmacy photo" height="500px" width="900px">
<div class="search-container">
 <form action="" method="GET">
<input type="text" class="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>"   placeholder="Search.." >
<button type="button"><i class="fa fa-search"></i></button>
</form>
</div>
 
<br><br>
<div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered" style='border-collapse:collapse; width:90%' border=2px solid black>
                            <thead>
                                <tr>
                                    <th style="background-color:grey">Medicine ID</th>
                                    <th style="background-color:grey">Medicine Name</th>
                                    <th style="background-color:grey">Quantity Present</th>
									<th style="background-color:grey">Quantity</th>
									<th style="background-color:grey">Buy</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $con = mysqli_connect("localhost", "root", "", "pharmacy");
                                if (mysqli_connect_errno()) {
                                    print("Failed to connect : " . mysqli_connect_error());
                                    exit();
                                }
                                
                                if (isset($_GET['search'])) {
									$filtervalues = $_GET['search'];
									
									$query1 = "SELECT medicine_id, medicine_name, m_code,quantity FROM medicine WHERE medicine_name='$filtervalues'";
									$query_run1 = mysqli_query($con, $query1);
									
									if ($query_run1) {
										$mysqli_results1 = mysqli_num_rows($query_run1);

										if ($mysqli_results1 > 0) {
											
											while ($items1 = mysqli_fetch_assoc($query_run1)) {

												?>
												<tr>
													<td style="text-align:center"><?= $items1['medicine_id']; ?></td>
													<td style="text-align:center"><?= $items1['medicine_name']; ?></td>
													<td style="text-align:center"><?= $items1['quantity']; ?></td>
													<td style="text-align:center"><input type="number" placeholder="Qty" style="width:50px" name="quantity"></td>
													<td style="text-align:center"><button type="button" name="buyBtn">Buy</button></td>
												</tr>
												<?php
											}
										} else {
											?>
											<tr>
												<td colspan="3">No Record Found</td>
											</tr>
											<?php
										}
									} else {
										// Print or log the SQL query and the error message
										echo "Query Error: " . mysqli_error($con);
									}
									
									$query = "SELECT medicine_id, medicine_name, m_code,quantity FROM medicine WHERE m_code IN (SELECT  m_code FROM medicine WHERE medicine_name LIKE '%$filtervalues%')";
									$query_run = mysqli_query($con, $query);

									if ($query_run) {
										$mysqli_results = mysqli_num_rows($query_run);

										if ($mysqli_results > 0) {
											
											while ($items = mysqli_fetch_assoc($query_run)) {
												if (strcasecmp($items['medicine_name'], $filtervalues) !== 0) {
												?>
												<tr>
													<td style="text-align:center"><?= $items['medicine_id']; ?></td>
													<td style="text-align:center"><?= $items['medicine_name']; ?></td>
													<td style="text-align:center"><?= $items['quantity']; ?></td>
													<td style="text-align:center"><input type="number" placeholder="Qty" style="width:50px" name="quantity"></td>
													<td style="text-align:center"><button type="button" name="buyBtn">Buy</button></td>
												</tr>
												<?php
												}
											}
										} else {
											?>
											<tr>
												<td colspan="3">No Record Found</td>
											</tr>
											<?php
										}
									} else {
										// Print or log the SQL query and the error message
										echo "Query Error: " . mysqli_error($con);
									}
								}
                                mysqli_close($con);
                            ?>
                            </tbody>
                        </table>
					</div>
                </div>
            </div>
</center>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $("button[name='buyBtn']").on("click", function () {
            var row = $(this).closest("tr");
            var medicineId = row.find("td:eq(0)").text();
            var quantity = parseInt(row.find("input[name='quantity']").val(), 10); // Parse as integer

          

            $.ajax({
                type: "POST",
                url: "update_quantity.php",
                data: { medicineId: medicineId, quantity: quantity },
                success: function (response) {
                    console.log(response);
                    alert(response);  // Add an alert to ensure you see the response
                },
                error: function (error) {
                    console.error("Error updating quantity: " + error);
                }
            });
        });
    });
</script>


</body>
</html>