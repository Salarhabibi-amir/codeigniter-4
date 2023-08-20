<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
    <style>
    .profile {
        width: 100%;
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body class="bg-dark profile">
    <div class="container-fluid">
        <div class="container bg-light p-4 rounded rounded-5">
            <div class="row p-3">
                <div class="col-4 fs-3 text-success"><b>Profile</b></div>
                <div class="col-8 text-end">
                    <a href="" class="link link-dark text-decoration-none px-3">
                        <?php
                        if (session('user')) {
                            if (session('user')['firstName'] != null) { ?>
                                <img src="/uploads/<?php echo ($currentUser['img']); ?>" alt="user picture" width="50" height="50" class="rounded rounded-5">
                        <?php
                            } else {
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
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail address</th>
                        <th>Edit</th>
                        <th>Change Password</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <?php
                        if ($currentUser) echo $currentUser['firstName'];
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($currentUser) echo $currentUser['lastName'];
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($currentUser) echo   $currentUser['email'];
                        ?>
                    </td>
                    <td><a href="edit/<?php if ($currentUser) echo $currentUser['id']; ?>" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <a href="editPassword/<?php if ($currentUser) echo $currentUser['id']; ?>"
                            class="btn btn-info">Change Password</a>
                    </td>
                    <td><a href="deleteProfile/<?php if ($currentUser) echo $currentUser['id']; ?>"
                            class="btn btn-danger">Delete</a></td>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>