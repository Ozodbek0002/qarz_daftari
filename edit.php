<?php

include "baza.php";

    $idd = $_GET['id'];

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
    <a href="show.php" class="btn btn-primary">Orqaga </a>
    <?php

    $sql = "select * from history where qarzdor_id = '$idd' ";
    $sql1 = "select * from qarzdor where id = '$idd' ";

    $result=mysqli_query($conn,$sql);
    $result1=mysqli_query($conn,$sql1);

    ?>
    <div class="container">
        <table class="table">
            <tr style="text-align: center">
                <th>Tartibi</th>
                <th>Qarz miqdori </th>
                <th>Tavsilotlar</th>
                <th>Telefoni</th>
                <th>Vaqti</th>
            </tr>

            <?php

            if (mysqli_num_rows($result) > 0) {

                $data1=mysqli_fetch_all($result, MYSQLI_ASSOC);
                $data2 = mysqli_fetch_assoc($result1);

                foreach ($data1 as $data){
                    if ($data['sum'] !=0){
                    ?>
                    <tr style="border: 1px solid silver; text-align: center">
                        <td style="border: 1px solid silver"><?php echo  $data['id']  ?></td>

                        <td style="border: 1px solid silver">
                            <?php  echo  $data['sum']." $";  ?>
                        </td>
                        <?php
                        if ( $data['sum'] < 0){
                            ?>
                            <td style="border: 1px solid silver; color: #00bf00">
                                <?php  echo  $data['descc'];  ?>
                            </td>
                            <?php
                        }
                        else{
                            ?>
                            <td style="border: 1px solid silver; color: red">
                                <?php  echo  $data['descc'];  ?>
                            </td>
                            <?php
                        }
                        ?>
                        <td style="border: 1px solid silver">
                            <?php  echo  $data2['phone'];  ?>
                        </td>
                        <td style="border: 1px solid silver">
                            <?php  echo  $data['dataa'];  ?>

                        </td>

                    </tr>
                    <?php
                }
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

