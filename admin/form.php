<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.css">
    <script src="../css/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="form container">
        <div class="row ">
            <div class="col">
                <form action="./login.php" method="post">
                    <h2 class="text-center text-warning">Login </h2>
                    <div class="form-group mt-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" required name="username">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" required name="password">
                    </div>
                    <div class="d-grid gap-2 ">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>
                </form>
            </div>
            <!--
            <div class="col">
                <form action="./signin.php" method="post" >
                    <h2 class="text-center text-warning">Signin</h2>
                    <div class="form-group mt-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" required name="password">
                    </div>
                    <div class="d-grid gap-2  ">
                        <button type="submit" class="btn btn-primary mb-1" name="signin">SignIn</button>
                    </div>
                </form>
            </div>-->
        </div>
    </div>
</body>
</html>