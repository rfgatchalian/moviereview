<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Navbar</title> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./users/assets/css/navbar.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top mb-4 p-1">
        <div class="container">
           
                <img class="logo" src="./assets/img/cslogo.png" alt="logo">
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="font-weight:bold;">

                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userAbout.php">About</a>     
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./global-includes/logout.php">Logout</a>  
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <script>
        window.onscroll = function() {
            var navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('gradient-bg');
            } else {
                navbar.classList.remove('gradient-bg');
            }
        };
    </script>
</body>

</html>