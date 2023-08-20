<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Login</title>
</head>
<!-- Create your account section -->
<section class="container-fluied">
    <div class="container ">
        <div class="signUp-container text-center border shadow-lg p-3 mb-5 bg-white rounded">
            <?php $validation =  \Config\Services::validation(); ?>

            <div class="row">
                <h1>Sign Up</h1>
            </div>
            <br>
            <form action="rigester" method="post" class="form-group w-100" >
                <fieldset class="p-4">
                    <legend>Create Your Acount</legend>
                    <div>
                        <label for="firstName" class="w-75"> <input type="text" name="firstName" id="firstName" require class="form-control" placeholder="Enter Your First Name">
                        </label>
                    </div>
                    <?php if ($validation->hasError('firstName')) : ?>
                        <p class="text-danger"><?= $validation->getError('firstName') ?></p>
                    <?php endif ?>
                    <div>
                        <label for="lastName" class="w-75"> <input type="text" name="lastName" id="lastName" require class="form-control" placeholder="Enter Your Last Name">
                        </label>
                    </div>
                    <?php if ($validation->hasError('lastName')) : ?>
                        <p class="text-danger"><?= $validation->getError('lastName') ?></p>
                    <?php endif ?>
                    <div>
                        <label for="email" class="w-75"> <input type="email" name="email" id="email" require class="form-control" placeholder="Enter Your E-mail">
                        </label>
                    </div>
                    <?php if ($validation->hasError('email')) : ?>
                        <p class="text-danger"><?= $validation->getError('email') ?></p>
                    <?php endif ?>
                    <div>
                        <label for="password" class="w-75"> <input type="password" name="password" id="password" require class="form-control" placeholder="Enter Your Password">
                        </label>
                    </div>
                    <?php if ($validation->hasError('password')) : ?>
                        <p class="text-danger"><?= $validation->getError('password') ?></p>
                    <?php endif ?>
                   
                    <input type="submit" value="Rigester" class="btn btn-info w-25">
                </fieldset>
            </form>

        </div>
    </div>
</section>
</body>

</html>