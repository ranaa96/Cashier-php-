<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    input{
        display:block;
    }
    table{
        border: 1px solid black;
    }
    </style>
</head>
<body>
    <form method='POST'>
    
        <label>Enter Client name</label>
        <input type="text" name="txtname"  value="<?php echo isset($_POST['txtname'])?$_POST['txtname']:'' ?>" >
        <label>Number of products</label>
        <input type="number" name="nproduct" value="<?php echo isset($_POST['nproduct'])?$_POST['nproduct']:'' ?>">
        <label>Select delivery city</label>
        <select name="txtcity">
            <option>Cairo</option>
            <option>Giza</option>
            <option>Others</option>
        </select>
        <input type="submit" value="Enter products" name="btnproduct">
        <input type="submit" value="calculate discound percentage" name="btncalc">
    <?php

    if(isset($_POST['btnproduct'])){
      
        $count;
        $count=$_POST['nproduct'];
        echo ("<table border=1px><tr><td>Product name</td><td>Quantity</td><td>Price</td></tr>");
        for($x=1 ; $x<=$count;$x++){
            
            echo("<tr>
            <td><input type='text' name='txtproduct$x' >
            </td>
            <td><input type='number' name='txtquantity$x'></td>
            <td><input type='number' name='txtprice$x'></td>
            </tr>");

        }
        echo("</table>");

    }

    if(isset($_POST['btncalc'])){
        
        $cName;$pName;$quantity;$price;$city;
        $subtotal=0;
        $total=0;
        $dPercent;
        $dValue;
        $tAfter;
        $delivery;
        $net;
        $cName=$_POST['txtname'];
        $city=$_POST['txtcity'];

        echo("<h1>Recipt</h1>
        <table><tr>
        <td>Name</td>
        <td>$cName</td></tr><tr><td>Product name</td><td>Quantity</td><td>Price per item</td><td>Totalprice</td></tr>");
        $count;
        $count=$_POST['nproduct'];
        for($x=1 ; $x<=$count;$x++){
            $pName=$_POST['txtproduct'.$x];
            $quantity=$_POST['txtquantity'.$x];
            $price=$_POST['txtprice'.$x];
            $subtotal=$quantity*$price;
            $total+= $subtotal;
            echo("<tr><td>$pName</td><td>$quantity</td><td>$price</td><td>$subtotal</td></tr>");
        }
        if($total<1000)
            $dPercent=0;
        else if ($total<3000)
            $dPercent=.10;
        else if ($total<4500)
            $dPercent=.15;
        else 
            $dPercent=.20;

        $dValue=$total*$dPercent;
        $tAfter=$total-$dValue;
        switch($city){
            case "Cairo":
                $delivery=50;
            break;
            case "Giza":
                $delivery=30;
            break;
            case "Others":
                $delivery=40;
            break;
        }

        $net=$tAfter+$delivery;
     
      
  
        
        echo("
        <tr><td>Total</td>
        <td>$total</td>
        </tr>
        <tr> <td>Discount percent</td>
        <td>$dPercent</td>
        </tr>
        <tr> <td>Discount value</td>
        <td>$dValue</td>
        </tr>
        <tr> <td>Total after discound</td>
        <td>$tAfter</td>
        </tr>
        <tr> <td>Delivery value</td>
        <td> $delivery</td>
        </tr>
        <tr> <td>Net total</td>
        <td> $net</td>
        </tr>
        </table>");





    }


    ?>
    
    </form>
</body>
</html>