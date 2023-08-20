<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Login</title>
</head>
<div class="container-login text-center shadow-lg p-3 mb-5 bg-white rounded">
    <?php $validation =  \Config\Services::validation(); ?>

    <form action="logedIn" method="post">
        <fieldset class="form-group">
            <legend><b>Login</b></legend>
            <div>
                <label for="username" class="w-75">
                    <input type="email" placeholder="Your user name" require id="username" class="form-control"
                        name="userName">
                </label>
            </div>
            <div class="text-danger">
                <p>
                    <?php if (($validation)->hasError('userName')) {
                        echo ($validation->getError('userName'));
                    } ?>
                    <?php if (isset($errMessage)) {
                        echo ($errMessage['err']);
                    }  ?>
                </p>
            </div>
            <div>
                <label for="password" class="w-75"><input type="password" placeholder="Your password" require
                        id="password" class="form-control" name="password">
                </label>
            </div>
            <div class="text-danger">
                <p>
                    <?php if (($validation)->hasError('password')) {
                        echo ($validation->getError('password'));
                    }
                    ?>
                </p>
            </div>
            <div> <a href=""><input type="submit" value="Login" class="btn btn-info"></a></div>
        </fieldset>
        <label for="remember-me"> <input type="checkbox" id="remember-me"> Remember me</label>
        <a href="signup">Create account</a>
        <div class="row text-danger text-center">
            <?php if (session('Err')) echo session('Err'); ?>
        </div>
    </form>
</div>
</body>

</html>