<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!--FontAwesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!--Chartjs CDN-->
   <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>-->

    <!--Custome CSS-->
    <link rel="stylesheet" href="./style.css">

    <title>Customers</title>
</head>
<body style="background-color : #616247;>
    <!--Navbar-->
    <?php
        include 'nav.html'
    ?>
<!--End Navbar-->
<div class="container">
    <div class="row my-4">
        
            
        </div>
        <div class="col-md-8">
            <table  class="table bg-white">
                <thead style="border: 1px solid black;" class="bg-dark">
                    <tr  class="text-white">
                        <th scope="col">S.No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Current balance</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <!-- Loop statement -->
                    <?php
                        include 'config.php';
                        $sql ="select * from customers";
                        $query =mysqli_query($conn, $sql);

                     while($rows = mysqli_fetch_assoc($query))
                        {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $rows['id']; ?></th>
                        
                        <td ><?php echo $rows['name']; ?></td>
                        <td ><?php echo $rows['email']; ?></td>
                        <td ><?php echo $rows['balance']; ?></td>
                        <td ><a class="btn btn-success btn-sm" href="transaction.php?id=<?php echo $rows['id'] ;?>">Login</a></td>
                        
                        
                    </tr>
                    <!-- end loop -->
                    <?php
                        }

                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>