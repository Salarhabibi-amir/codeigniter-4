<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <div class="container-fluied">
        <div class="container">

            <div class="row p-3">
                <div class="col-4 fs-3 text-success"><b>Dashboard</b></div>
                <div class="col-8 text-end">
                    <a href="" class="link link-dark text-decoration-none px-3">
                        <?php
                        if (session('user')) {
                            if (session('user')['firstName'] != null) { ?>
                                <img src="/uploads/<?= session('user')['img']; ?>?v=<?= time(); ?>" alt="" width="50" height="50" class="rounded rounded-5">          
                           <?php } else {
                                echo ('');
                            }
                        }
                        ?>
                    </a>
                    <a href=" <?php if (isset($_SESSION['user']))
                                    echo ('logOut');
                                else {
                                    echo ('login');
                                }
                                ?>" class="link link-dark text-decoration-none px-3">
                        <?php if (isset($_SESSION['user']))
                            echo ('Logout');
                        else {
                            echo ('Login');
                        }
                        ?>
                    </a>
                    <a href="signup" class="link link-dark text-decoration-none px-3">
                        <?php if (isset($_SESSION['user']))
                            echo ('');
                        else {
                            echo ('Signup');
                        }
                        ?>
                    </a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firs Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        <th>Picture</th>
                        <th>Edit</th>
                        <th>Change Password</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($allUsers) && is_array($allUsers) && !empty($allUsers)) {
                        foreach ($allUsers as $user) {    ?>
                            <tr>
                                <td><?php echo ($user['id']); ?></td>
                                <td><?php echo ($user['firstName']); ?></td>
                                <td><?php echo ($user['lastName']); ?></td>
                                <td><?php echo ($user['email']); ?></td>
                                <td><img src="/uploads/<?php echo ($user['img']);?>" alt="User profile picture" width="50" height="50"></td>
                                <td><a href="edit/<?php if ($user) echo $user['id']; ?>" class="btn btn-info">Edit</a></td>
                                <td><a href="editPassword/<?php if ($user) echo $user['id']; ?>" class="btn btn-info">Change Password</a></td>
                                <?php if(!$user['type']=='A'){?>
                                <td><a href="delete/<?= $user['id']; ?>" class="btn btn-danger">Delete</a></td>
                                <?php }?>
                                
                            </tr>

                    <?php }
                    } ?>
                    <div class="row text-info">
                        <?php if (session('Err')) echo session('Err'); ?>
                    </div>
                    
                </tbody>
            </table>
            <div>
                <?= $pager->links() ?>
            </div>
        </div>
    </div>

</body>

</html>