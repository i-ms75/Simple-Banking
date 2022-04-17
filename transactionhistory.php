<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body style="background-color : #616247;">

<?php
  include 'nav.html';
?>

	<div class="container">
        <h2 class="text-left pt-4" style="color : black;">Transaction History</h2>
        
       <br>
       <div class="table-responsive-sm">
    <table style="border: 2px solid black; " class="table bg-white">
        <thead class="bg-dark">
            <tr >
                <th style="color:white;" class="text-center;border: 2px solid black;">S.No.</th>
                <th style="color:white;" class="text-center;border: 2px solid black;">Sender</th>
                <th style="color:white;" class="text-center;border: 2px solid black;">Receiver</th>
                <th style="color:white;" class="text-center;border: 2px solid black;">Amount(INR)</th>
                <th style="color:white;" class="text-center;border: 2px solid black;">Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr  style="border: 2px solid black;">
            <td style="border: 2px solid black;" class="py-2"><?php echo $rows['sno']; ?></td>
            <td style="border: 2px solid black;"><?php echo $rows['sender']; ?></td>
            <td style="border: 2px solid black;"><?php echo $rows['receiver']; ?></td>
            <td style="border: 2px solid black;"><?php echo $rows['balance']; ?> </td>
            <td style="border: 2px solid black;"><?php echo $rows['datetime']; ?> </td>
                
        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>


</body>
</html>