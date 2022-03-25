<?php

include 'baza.php';

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> List of debts </title>
</head>
<body>
<div class="container">
    <h1 class="text text-center">Qarzlar haqidagi ma'lumot</h1>
    <br>

    <div style="width: 100%; height: 30px">

        <div style="display: inline-block; width: 30%; padding-left: 50px">
            <a href=" creat_qarzdor.php" class="btn btn-primary" >qarzdor qo'shish </a>

        </div>

        <div class="col-lg-3 col-md-4" style="display: inline-block; width: 34%;padding-left: 70px">
            <div class="b-search">

                <form action="search.php" method="post">

                    <input style="height: 35px" type="text" placeholder="Qidiruv.." name="search">
                    <button style="height: 35px; margin-bottom: 5px;"  type="submit" class="btn btn-primary"> ok </button>

                </form>
            </div>
        </div>

        <div style="display: inline-block; width: 33%; padding-left: 200px">
            <a   href="history.php" class="btn btn-primary">Hisobotlar</a>

        </div>
    </div>
    <br>
    <br>

    <?php

    $sql="SELECT * FROM qarzlar ";

    $result=mysqli_query($conn,$sql);

    ?>
            <div class="container">
                <table class=" table table-striped table-hover">
                    <tr style="text-align: center; border-bottom: black">
                        <th>Tartib</th>
                        <th>Qarzdor</th>
                        <th>Qarz miqdori </th>
                        <th>Amallar</th>
                    </tr>


                            <?php
                    if (mysqli_num_rows($result) > 0) {
                        $d=0;
                        $data1=mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($data1 as $data)
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
                        }
                    }
                    else { ?>
                        <h1 class="text text-center m-3">Hozircha qarzdorlar yo'q</h1>

                    <?php } ?>



                </table>
            </div>

</div>
</body>
</html>


