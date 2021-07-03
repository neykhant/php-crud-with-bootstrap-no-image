<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>CRUD</title>
</head>

<body>

    <?php require_once('process.php') ?>

    <?php
    $con = new mysqli("localhost", "root", "", "datatable") or die(mysqli_error($con));

    $result = $con->query("SELECT * FROM crud") or die(mysqli_error($con));
    ?>


    <?php if (isset($_SESSION['msg'])) { ?>
        <div class="alert alert-<?= $_SESSION['msg-type'] ?> ">
            <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </div>
    <?php } ?>

    <div class="container">

        <form action="" class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['id'] ?> </td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['location'] ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>

        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="Enter your Name">
                </div>

                <div class="form-group">
                    <label for="">Age</label>
                    <input type="text" name="age" class="form-control" value="<?php echo $age ?>" placeholder="Enter your Age">
                </div>

                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>" placeholder="Enter your Phone">
                </div>

                <div class="form-group">
                    <label for="">Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location ?>" placeholder="Enter your Location">
                </div>

                <?php if ($update === true) { ?>
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                <?php } ?>
            </form>
        </div>

    </div>
</body>

</html>