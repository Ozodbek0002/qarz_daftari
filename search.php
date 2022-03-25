<?php

include 'baza.php';


$text = $_POST['search'];


$sql = " select * from qarzdor where  name like '%$text%'";
$result = mysqli_query($conn, $sql);



if ( mysqli_num_rows($result) > 0){
    $o = mysqli_fetch_all($result);


?>



    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            @page  {
                size:A4;
                margin: 0;
                padding: 20px;

            }
        </style>
        <title> Search results </title>
    </head>
    <body>
    <div class="container">
        <h1 class="text text-center">Qidiruv natijasi...</h1>
        <br>
        <a href="show.php" class="btn btn-primary">Orqaga </a>
        <br>
        <br>

        <div class="container">
            <table class=" table table-striped table-hover">
                <tr style="text-align: center; border-bottom: black">
                    <th>Tartib</th>
                    <th>Qarzdor</th>
                    <th>Qarz miqdori </th>
                    <th>Amallar</th>
                </tr>
                <?php
                foreach ($o as $item) {
                $q_idd = $item[0];


                $sql="SELECT * FROM qarzlar where id = '$q_idd' ";

                $result=mysqli_query($conn,$sql);

                ?>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    $d=0;
                    $data1=mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($data1 as $data){
                        if ($data['sum']!=0){
                            $d++;
                            ?>

                            <tr style=" text-align: center">
                                <td style=" width: 10%; " class="fw-bold"><?php echo $d ?></td>

                                <td style=" width: 25%">
                                    <?php
                                    $tt=$data['qarzdor_id'];

                                    $sql="SELECT * FROM qarzdor where id='$tt' ";
                                    $result=mysqli_query($conn,$sql);  // result2 jadvaldagi satrni ushlab oldi
                                    $dat = mysqli_fetch_assoc($result); // dat ga yukladi malumotlarni

                                    $q_name = $dat['name'] ?? '';
                                    $q_id = $dat['id'] ?? 0; // qarzdorni id si
                                    echo "<a href='edit.php?id=$q_id' class='btn btn-light' style='text-decoration: none' > $q_name </a>";
                                    ?>
                                </td>
                                <td style=" width: 25%">
                                    <?php
                                    echo  $data['sum']." $";
                                    ?>
                                </td>
                                <td style=" width: 40%">
                                    <?php
                                    $tt=$data['qarzdor_id'];
                                    $sql="SELECT * FROM qarzdor where id='$tt'";
                                    $result=mysqli_query($conn,$sql);  // result2 jadvaldagi satrni ushlab oldi
                                    $dat = mysqli_fetch_assoc($result); // dat ga yukladi malumotlarni

                                    $q_name = $dat['name'] ?? '';
                                    $q_id = $dat['id'] ?? 0;


                                    echo "<a style='width: 130px' href='creat.php?id=$q_id' class='btn  btn-warning' >Qarz berish</a>  ";

                                    echo " <a style='width: 130px' href='creat_1.php?id=$q_id' class='btn btn-success' >Qarz qaytarish</a>  ";

                                    echo "  <a style='width: 130px' href='delete.php?id=$q_id' class='btn btn-danger' >O'chirish</a>";

                                    ?>
                                </td>
                            </tr>
                            <?php
                        } ?>

                <?php } }}?>

            </table>
        </div>

        <button onclick="
                this.style.display='none';
                document.getElementById('orqaga').style.display='none';
                window.print();
                document.getElementById('orqaga').style.display='unset';
                this.style.display='none'; "
                class="btn btn-primary"> PDF shaklida chop etish
        </button>





<?php
}

else{
    echo "<script> alert('Ma\'lumot topilmadi') ;</script>";
    header("Location:show.php");

    }

?>
    </div>
    </body>
</html>