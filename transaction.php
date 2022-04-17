<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amt = $_POST['amt'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql_from = mysqli_fetch_array($query);

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql_to = mysqli_fetch_array($query);



    
    if (($amt)<=0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Transfer amount must be greater than zero")'; 
        echo '</script>';
    }
    else if($amt > $sql_from['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';
        echo '</script>';
    }
    else {
                $new_bal = $sql_from['balance'] - $amt;
                $sql = "UPDATE customers set balance=$new_bal where id=$from";
                mysqli_query($conn,$sql);
             
                $new_bal = $sql_to['balance'] + $amt;
                $sql = "UPDATE customers set balance=$new_bal where id=$to";
                mysqli_query($conn,$sql);                
                $sender = $sql_from['name'];
                $receiver = $sql_to['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amt')";
                $query=mysqli_query($conn,$sql);
                if($query){
                     echo "<script> alert('Fund transferred Successfully');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $new_bal= 0;
                $amt =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style type="text/css">
    	
		button{
		    padding: 15px 25px;
            font-size: 24px;
            text-align: center;
            cursor: pointer;
            outline: none;
            color: red;
            background-color: #04AA6D;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
		}
	    button:hover{
			background-color: #3e8e41
		}
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        .text-left-1{
            margin-left: 275px;
        }

    </style>
</head>

<body style="background-color : #616247 ;">
 
<?php
  include 'nav.html';
?>

	<div class="container">
        <h2 class="text-left pt-4" style="color : black;">Fund Transfer</h2>
            <?php
                include 'config.php';
                $cust_id=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$cust_id";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Sorry: ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="transfer" class="tabletext" ><br>
            <div class="col-md-8">
            <table class="table bg-white">                
                <thead class="bg-dark">
                    <tr class="text-white">
                    <th style="border: 2px  black;"class="text-left">Account number</th>
                    <th style="border: 2px  black;"class="text-left">Customer Name</th>
                    <th style="border: 2px  black;"class="text-left">Email</th>
                    <th style="border: 2px  black;"class="text-left">Available Balance</th>
                </tr>
                <tr class="text-white">
                    <td ><?php echo $rows['id'] ?></td>
                    <td ><?php echo $rows['name'] ?></td>
                    <td ><?php echo $rows['email'] ?></td>
                    <td ><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : black;"><b>Transfer To:</b></label>
        <select name="to" class="bg-dark text-white"  required>
            <option class="text-white" value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $cust_id=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$cust_id";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Sorry ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table bg-dark text-white" value="<?php echo $rows['id'];?>" >
                
                Account number: <?php echo  $rows['id'] ;?> Name:     
                <?php echo $rows['name'] ;?>
                     
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : black;"><b>amt:</b></label>
            <input type="number" class="bg-dark text-white" name="amt" required>   
            <br><br>
                <div class="text-left-1" >
            <button class="btn btn-danger btn-sm" name="submit" type="submit" >Transfer</button>
            </div>
        </form>
    </div>
    

</body>
</html>
