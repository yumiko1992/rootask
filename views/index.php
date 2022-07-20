<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="container-fluid">

        <main class="h-100 w-25 mx-auto mt-5">
        <h1 class="text-center">Sign In</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/sign-in.php" method="post">
                            <input type="text" name="username" id="username" placeholder="USERNAME" class="form-control mb-3" required autofocus>

                            <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-3">

                            <input type="submit" name="signin" class="btn w-100" value="Sign in">

                            <!-- <button type="submit" class="btn w-100">Sign In</button> -->
                        </form>

                        <p class="text-center mt-4 small"><a href="sign-up.php">Create Account</a></p>

                    </p>
                </div>
            </div> 

        </main>
    
</body>
</html>