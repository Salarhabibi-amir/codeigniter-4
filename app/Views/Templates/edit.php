<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit</title>
</head>

<body class=" bg-dark">

    <!-- Create your account section -->
    <section class="container-fluied">
        <div class="container">
            <div class="signUp-container text-center border shadow-lg p-3 mb-5 bg-white rounded my-5">
                <?php $validation =  \Config\Services::validation(); ?>

                <div class="col-md-12 ">
                    <h1 class="text-center">Edit Profile</h1>
                </div>
                <br>
                <form action="update" method="post" class="form-group w-100" enctype="multipart/form-data">
                    <fieldset class="p-4">
                        <legend>Edit Your Acount</legend>
                        <input type="hidden" name="id" value="<?= $currentUser['id'] ?>">
                        <div>
                            <label for="firstName" class="w-75">
                                <input type="text" name="firstName" id="firstName" require class="form-control" placeholder="Enter Your First Name" value="<?= $currentUser['firstName'] ?>">
                            </label>
                        </div>
                        <?php if ($validation->hasError('firstName')) : ?>
                            <p class="text-danger"><?= $validation->getError('firstName') ?></p>
                        <?php endif ?>
                        <div>
                            <label for="lastName" class="w-75"> <input type="text" name="lastName" id="lastName" require class="form-control" placeholder="Enter Your Last Name" value="<?= $currentUser['lastName'] ?>">
                            </label>
                        </div>
                        <?php if ($validation->hasError('lastName')) : ?>
                            <p class="text-danger"><?= $validation->getError('lastName') ?></p>
                        <?php endif ?>
                        <div>
                            <label for="email" class="w-75">
                                <input type="email" name="email" id="email" require class="form-control" placeholder="Enter Your E-mail" value="<?= $currentUser['email'] ?>">
                            </label>
                        </div>
                        <?php if ($validation->hasError('email')) : ?>
                            <p class="text-danger"><?= $validation->getError('email') ?></p>
                        <?php endif ?>
                        <?php 
                        if(session('user')['type'] != 'A' | $currentUser['type'] == session('user')['type']){?>
                        <div>
                            <label class="w-75"> <input type="file" name="image" require class="form-control">
                            </label>
                        </div>
                        <?php if ($validation->hasError('image')) : ?>
                            <p class="text-danger"><?= $validation->getError('image') ?></p>
                        <?php endif ?>
                        <?php }?>
                        <div> <input type="submit" value="Update" class="btn btn-info w-25">
                    </fieldset>
                </form>




            </div>
        </div>
    </section>
</body>

</html>