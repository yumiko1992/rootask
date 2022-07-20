<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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

        <main class="h-100 w-50 mx-auto mt-5">
            <h1 class="text-center mb-4">Sign Up</h1>

                <div class="container mx-auto">
                    <form action="../actions/sign-up.php" method="post">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="first_name" id="first-name" placeholder="FIRST NAME" class="form-control mb-4" required autofocus>
                            </div>
                            <div class="col">
                                <input type="text" name="last_name" id="last-name" placeholder="LAST NAME" class="form-control mb-4" required>
                            </div>
                        </div>

                        <input type="email" class="form-control mb-4" id="email" name="email" placeholder="EMAIL">

                        <input type="text" name="username" id="username" placeholder="USERNAME" class="form-control mb-4" required>

                        <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-4" required>

                        
                        <div class="d-grid col-6 mx-auto">
                            <input type="submit" class="btn" name="btn_sign_up" value="Sign UP">
                            <!-- <button type="submit" class="btn" name="btn_sign_up">Sign Up</button> -->
                        </div>
                    
                    
                    </form>
                </div>

                <p class="text-white mt-4 text-center">Have an account? <a href="index.php">Sign In</a></p>

        </main>
    
</body>
</html>