<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container" style="padding-top:50px;">
        <h1>Export excel</h1>
        <div class="row">
            <div class="col-12 col-md-4">

                <form action="config.php" method="POST" enctype="multipart/form-data">
                    <input class="form-control mb2" type="text" name="name" id="name" placeholder="Name" require>
                    <input class="form-control mb2" type="email" name="email" id="email" placeholder="Email" require>
                    <label for="name">Profile image</label>
                    <small>(image size must be 100x120)</small>
                    <input class="form-control mb2" type="file" name="dp" id="dp">
                    <button class="btn btn-primary mb-2" require type="submit" name="save" accept="image/jpeg">Save</button>
                </form>

                <?php
                    if (isset($_GET['success'])) {
                ?>
                    <div class="alert alert-success">Record inserted successfully</div>
                <?php
                    }

                    if (isset($_GET['fail'])) {
                ?>
                    <div class="alert alert-danger">Fail!...Recode not insert</div>
                <?php
                }
                ?>
            </div>

            <div class="col-12 col-md-8">
                <form action="exportdata.php" method="POST">
                    <button class="btn btn-success mb-2" type="submit" name="export">Export to Excel</button>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Image</th>
                    </thead>

                    <tbody>
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'export_excel');
                        $select_query = "SELECT * FROM user_detail";
                        $result_query = mysqli_query($con, $select_query);

                        print_r($result_query);

                        if(mysqli_num_rows($result_query)>0){
                            while($data = mysqli_fetch_array($result_query)){
                                $name = $data['name'];
                                $email = $data['email'];
                                $dp = $data['dp'];
                                ?>
                                <tr>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $email;?></td>
                                    <td><img src="<?php echo $dp;?>" alt="img_main"></td>
                                </tr>
                                <?php
                            }
                        }
                        else 
                        {
                            ?>
                            <tr>
                                <td colspan="3">Recode Not Found</td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>