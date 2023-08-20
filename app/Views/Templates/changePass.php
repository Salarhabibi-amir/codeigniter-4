<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Change Password</title>
</head>

<body class=" bg-dark">

    <!-- Create your account section -->
    <section class="container-fluied">
        <div class="container">
            <div class="signUp-container text-center border shadow-lg p-3 mb-5 bg-white rounded my-5">
                <?php $validation =  \Config\Services::validation(); ?>

                <div class="col-md-12 ">
                    <h1 class="text-center">Change Password</h1>
                </div>
                <br>
                <div class="row text-danger">
                        <?php if (session('Err')) echo session('Err'); ?>
                    </div>
                <form action="updatePass" method="post" class="form-group w-100">
                    <fieldset class="p-4">
                        <legend>Change Your Password</legend>
                        <input type="hidden" name="id" value="<?= $currentUser['id'] ?>">
                        <div>
                            <label  class="w-75">
                                <input type="password" name="currentPass"  require class="form-control" placeholder="Enter your current password" >
                            </label>
                        </div>
                        <?php if ($validation->hasError('currentPass')) : ?>
                            <p class="text-danger"><?= $validation->getError('currentPass') ?></p>
                        <?php endif ?>
                        <div>
                            <label  class="w-75"> 
                                <input type="password" name="newPass"  require class="form-control" placeholder="Enter your new password" >
                            </label>
                        </div>
                        <?php if ($validation->hasError('newPass')) : ?>
                            <p class="text-danger"><?= $validation->getError('newPass') ?></p>
                        <?php endif ?>
                        <div>
                            <label  class="w-75">
                                <input type="password" name="confirmPass"  require class="form-control" placeholder="Confirm new password" >
                            </label>
                        </div>
                        <?php if ($validation->hasError('confirmPass')) : ?>
                            <p class="text-danger"><?= $validation->getError('confirmPass') ?></p>
                        <?php endif ?>
                       
                        <div> <input type="submit" value="Change Password" class="btn btn-info w-25">
                    </fieldset>
                   
                </form>

               


            </div>
        </div>
    </section>
</body>

</html>
