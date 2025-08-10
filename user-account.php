
<?php include ('../includes/config.php') ?>

<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5(1234567890);
    $type = $_POST['type'];


    mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`password`,`type`) VALUES ('$name','$email','$password','$type')") or die(mysqli_error($db_conn));
    $_SESSION['success_msg'] = 'User has been successfuly registered';
    header('location: user-account.php?user=' . $type);
    exit;
}

?>

<?php include ('header.php') ?>
<?php include ('sidebar.php') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-flex">
                    <h1 class="m-0">Manage Account</h1><br>
                    <a href="user-account.php?user=<?php echo $_REQUEST['user'] ?>&action=add-new"
                        class="btn btn-primary btn-sm">Add New</a>
                </div>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($_REQUEST['user']) ?></li>
                </ol>
            </div><!-- /.col -->
            <?php
            if (isset($_SESSION['success_msg'])) { ?>
                <div class="col-12">
                    <small class="text-success" style="font-size:16px"><?= $_SESSION['success_msg'] ?></small>
                </div>
                <?php
                unset($_SESSION['success_msg']);
            }
            ?>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="container-fluid">
        <?php if (isset($_GET['action']) && $_GET['action']) { ?>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" required class="form-control" placeholder="Email Address" name="email">
                        </div>
                        <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
                        <input type="submit" name="submit" class="btn btn-primary" value="Register">
                    </form>

                </div>
            </div>

        <?php } else { ?>
            <div class="table-responsive bg-white">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $user_query = 'SELECT * FROM accounts WHERE type =  "' . $_REQUEST['user'] . '" ';
                        $user_result = mysqli_query($db_conn, $user_query);
                        while ($users = mysqli_fetch_object($user_result)) { ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $users->name ?></td>
                                <td><?= $users->email ?></td>
                                <td></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php } ?>



    </div>




    <?php include ('footer.php') ?>