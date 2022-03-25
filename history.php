<?php

include "baza.php";

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
        <title> List of debts </title>
    </head>

    <body>
        <div class="container">
        <h1 class="text text-center">Qarzlar haqidagi ma'lumot</h1><br>

        <div style="display: inline-block; margin-left: 20px" >
            <a href="show.php" class="btn btn-primary">Orqaga </a>
        </div>

        <div class="col-lg-3 col-md-4" style="display: inline-block; width: 40%; margin-left: 600px">
            <div class="b-search">

                <form action="search_history.php" method="post">

                    <input style="height: 35px; display: inline-block" type="date" placeholder="Dan.." name="search1">
                    <b>Dan..</b>
                    <input style="height: 35px; margin-left: 20px;" type="date" placeholder="Gacha.." name="search2">
                    <b>Gacha..</b>

                    <button style="height: 35px; margin-bottom: 5px; margin-left: 40px"  type="submit" name="submit" class="btn btn-primary" > ok </button>

                </form>
            </div>
        </div>

        <br>
        <br>

        <?php

        $sql = "select * from history  ";


        $result=mysqli_query($conn,$sql);

        ?>
        <div class="container">
            <table class="table">
                <tr style="text-align: center">
                    <th>Tartibi</th>
                    <th>ismi</th>
                    <th>Qarz miqdori </th>
                    <th>Tavsilotlar</th>
                    <th>Telefoni</th>
                    <th>Vaqti</th>
                </tr>

                <?php

                if (mysqli_num_rows($result) > 0) {

                    $data1=mysqli_fetch_all($result, MYSQLI_ASSOC);

                    foreach ($data1 as $data){
                        $dd=$data['qarzdor_id'];
                        $sql1 = "select * from qarzdor where id='$dd'";
                        $result1=mysqli_query($conn,$sql1);
                        $data2 = mysqli_fetch_assoc($result1);

                        ?>
                        <tr style="border: 1px solid silver; text-align: center">
                            <td style="border: 1px solid silver">
                                <?php echo  $data['id']  ?>
                            </td>
                            <td style="border: 1px solid silver">
                                <?php

                                $q_name = $data2['name'] ?? '';
                                $q_id = $data2['id'] ?? 0; // qarzdorni id si
                                echo "<a href='edit.php?id=$q_id' class='btn btn-light' style='text-decoration: none' > $q_name</a>";
                                  ?>
                            </td>
                            <td style="border: 1px solid silver; ">
                                <?php  echo $data['sum']." $";  ?>
                            </td>

                            <?php
                            if ( $data['sum'] < 0){
                            ?>
                                <td style="border: 1px solid silver; color: #00bf00">
                                    <?php  echo  $data['descc'];  ?>
                                </td>
                            <?php
                            }
                            elseif($data['sum'] > 0){
                            ?>
                                <td style="border: 1px solid silver; color: red">
                                    <?php  echo  $data['descc'];  ?>
                                </td>
                            <?php
                            }
                            else{
                            ?>
                            <td style="border: 1px solid silver; color: blue">
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
                else { ?>
                    <h1 class="text text-center m-3">Hozircha qarzdorlar yo'q</h1>

                <?php } ?>
            </table>
        </div>

        <button onclick="
                            this.style.display='none';
                            document.getElementById('orqaga').style.display='none';
                            window.print();
                            document.getElementById('orqaga').style.display='unset';

                            this.style.display='none';"  class="btn btn-primary">PDF shaklida chop etish
        </button>

    </div>
    </body>

</html>

