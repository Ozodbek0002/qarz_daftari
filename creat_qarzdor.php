
<?php

include 'baza.php';


if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];
    $sum = $_POST['sum'];
    $date = $_POST['date'];


    $sql = "select * from qarzdor where phone = '$phone' ";
    $result = mysqli_query($conn, $sql);

    // bu foydalanuvchini bor yoqligini bazadan tekshiramiz

    if (!mysqli_num_rows($result) > 0) {  // qarzdorlarda bo'masa

// Qarzdor jadvali ga qoshish

        $sql = "INSERT INTO qarzdor (  name, phone )
            values ( '$name','$phone')";
        $result_qarzdor = mysqli_query($conn, $sql);

        $sql_top = "select * from qarzdor where phone = '$phone' ";
        $result_top = mysqli_query($conn, $sql_top);
        $d = mysqli_fetch_assoc($result_top);
        $d_id = $d['id'];


//qarzlar jadvali ga qoshish

        $sql = "INSERT INTO qarzlar ( qarzdor_id, sum )
            values ( '$d_id', '$sum') ";
        $result_qarzlar = mysqli_query($conn, $sql);


// history jadvali ga qoshish

        $sql = "INSERT INTO history ( qarzdor_id, sum, descc, dataa)
                values (  '$d_id', '$sum', '$desc', '$date')  ";
        $result_history = mysqli_query($conn, $sql);

        if ( $result_history ) {
            echo "<script>alert('Ma\'lumot  saqlandi!.') </script>";
            $sum = "";
            $desc = "";
            $date = "";
        }
        else
        {
            echo "<script>alert('O`O`! Nimadr xato ketti!.') </script>";
        }
        // yana royhatga qaytish
        header("Location:show.php");

    }

    else {  // bazada bor bolsa


        $sql_top = "select * from qarzdor where phone = '$phone' ";
        $result_top = mysqli_query($conn, $sql_top);
        $d = mysqli_fetch_assoc($result_top);
        $d_id = $d['id'];


// history jadvali ga qoshish

        $sql = "INSERT INTO history ( qarzdor_id, sum, descc, dataa)
            values (  '$d_id', '$sum', '$desc', '$date')  ";
        $result_history = mysqli_query($conn, $sql);

//qarzlar jadvali ga qoshib tahrirlash


        $sql = "select * from qarzlar where qarzdor_id = '$d_id' ";
        $result_qarzlar = mysqli_query($conn, $sql);
        $s = mysqli_fetch_assoc($result_qarzlar);

        if ( $sum < 0) {
            $summ = $s['sum']+$sum;
        }
        else{
            $summ = $s['sum']+$sum;
        }

        $sql_up="UPDATE qarzlar   SET sum = '$summ'   WHERE qarzdor_id = '$d_id' ";
        $result_update = mysqli_query($conn, $sql_up);

        if ( $result_update ) {
            echo "<script>alert('Ma\'lumot  saqlandi!.') </script>";

        }
        else
        {
            echo "<script>alert('O`O`! Nimadr xato ketti!.') </script>";
        }

        // yana royhatga qaytish
        header("Location:show.php");

    }

}


mysqli_close($conn);

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> Yangi qarzdor </title>
</head>

<body>

<div class="container " >
    <a href="show.php" class="btn btn-primary" style=" margin-left: 100px; ">  ortga   </a>

    <div style="width: 32%; margin: auto; margin-top: 60px; padding: 50px 20px; border-radius: 20px; border: 1px solid #0000ff">

        <form class="login-email" action="" method="post" >

            <div class="mb-3 " >
                <label for="exampleInputEmail1" class="form-label">Ismi:</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="username" >
            </div>

            <div class="mb-3 " >
                <label for="exampleInputEmail1" class="form-label">telefoni:</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" >
            </div>

            <div class="mb-3 " >
                <label for="exampleInputEmail1" class="form-label">tavsifi:</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="desc" >
            </div>

            <div class="mb-3 " >
                <label for="exampleInputEmail1" class="form-label">summasi:</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="sum" >
            </div>

            <div class="mb-3 " >
                <label for="exampleInputEmail1" class="form-label">Vaqti:</label>
                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="date" >
            </div>

            <div class="input-group" >
                <button name="submit" type="submit" class="btn btn-outline-primary" style="width: 90%; margin: auto; border-radius: 10px;">Qo'shish</button>
            </div>

        </form>

    </div>

</div>

</body>
</html>

