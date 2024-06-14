<?php
    include_once 'config/Connection.php';
    include_once 'models/Kaset.php';
    include_once 'models/Sewa.php';

    $sewa = new Sewa();
    $kaset = new Kaset();
    session_start();
    $result = $kaset->getData();
    if(isset($_SESSION["id"])){
        $ticket = $sewa->getDatabyUser($_SESSION['id']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-dark text-white">
        <div class="container">
            <a class="navbar-brand text-white txtBrand fs-1" href="#">MyRental</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-underline ms-auto mb-2 mb-lg-0" id="nav">
                    <li class="nav-item mx-3">
                        <a class="nav-link fw-thin text-white text-uppercase active" href="#home"><small>Home</small></a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link fw-thin text-white text-uppercase" href="#product"><small>Our Product</small></a>
                    </li>
                    <li class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle fw-bold text-white text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <small>
                                <?php
                                    if(!isset($_SESSION["name"]) OR !isset($_SESSION["email"])){
                                        echo 'Login';
                                    }
                                    else{
                                        echo $_SESSION["name"];
                                    }
                                ?>
                            </small>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                if(!isset($_SESSION["name"]) OR !isset($_SESSION["email"])){?>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#sign"><i class="bi bi-door-open-fill me-2"></i><small>Login / Register</small></a></li>
                            <?php 
                                }
                                else{ 
                            ?>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ticketModal<?php echo $_SESSION['id'] ?>"><i class="bi bi-cart-fill me-2" aria-expanded="false"></i><small>Orderan saya</small></a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="controllers/actionUsers.php?act=logout"><i class="bi bi-door-closed-fill me-2"></i><small>Logout</small></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="scrollspy-example py-4" data-bs-spy="scroll" data-bs-target="#nav" data-bs-offset="0" data-bs-smooth-scroll="true" tabindex="0">
        <div class="container">
            <div class="row py-5 my-5 align-items-center">
                <div class="col-md-7">
                    <h2 class="fs-1 fw-bold mb-4" id="home">MyRental</h2>
                    <p class="fw-thin text-secondary">
                        MyRental adalah destinasi utama untuk menyewa kaset PlayStation, yang didedikasikan untuk menyediakan pengalaman gaming yang tak terlupakan dengan kaset berkualitas tinggi dan layanan pelanggan yang luar biasa. Dengan fokus pada kemudahan, keamanan, dan kepuasan pelanggan, kami memungkinkan para gamer untuk menikmati berbagai judul game terbaru tanpa beban kepemilikan perangkat secara penuh. Dengan tim ahli dalam industri game, kami menyediakan pengalaman pemesanan yang cepat dan mudah, serta menjamin kualitas dan keamanan kaset melalui pemeriksaan ketat sebelum disewakan. Apakah Anda seorang gamer hardcore atau pemula, MyRental siap menyediakan semua yang Anda butuhkan untuk menjalani petualangan gaming Anda dengan lancar dan menyenangkan.
                    </p>
                </div>
                <div class="col-md-5">
                    <img src="assets/img/1.jpg" class="object-fit-cover rounded-3 w-100" alt="..." style="width: 500px; height: 500px;">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="mt-5 py-3">
                <span class="bg-dark rounded-2 fs-4 fw-bold text-white px-3 py-1" id="product">Our Product</span>
            </div>
            <div class="row justify-content-center">
                <?php foreach ($result as $key => $res) { ?>
                    <div class="col-md-3 col-sm-6 g-3">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="#" class="image">
                                    <img class="object-fit-cover" src="assets/img/upload/<?php echo $res['img'] ?>">
                                </a>
                                <ul class="product-links">
                                    <li><a data-tip="Sewa Kaset" data-bs-toggle="modal" data-bs-target="#kasetModal<?php echo $res['id'] ?>"><i class="bi bi-cart-plus-fill"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <span class="fw-bold m-1 text-uppercase fs-5"><?php echo $res['judul']?> <small class="badge text-bg-dark"><?php echo $res['kategori']?></small></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            </div>
        </div>
    </div>
    
    <!-- MODAL -->

    <div class="modal fade" id="sign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="fs-1 mt-2 mb-5 fw-bold text-center txtBrand">MyRental</span></h1>
                    <ul class="nav nav-pills row mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item col-6 d-grid" role="presentation">
                            <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
                        </li>
                        <li class="nav-item col-6 d-grid" role="presentation">
                            <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
                        </li>
                    </ul>
                    <div class="tab-content mb-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                            <form class="text-center" action="controllers/actionUsers.php?act=signin" method="post">
                                <div class="form-floating my-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="email@gmail.com" required>
                                    <label for="floatingInput">Email</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input class="btn btn-secondary w-100 py-2 my-3  text-white border-0" type="submit" value="Login"></input>
                            </form> 
                        </div>
                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                            <form class="text-center" action="controllers/actionUsers.php?act=signup" method="post">
                                <div class="form-floating my-3">
                                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Your Name" required>
                                    <label for="floatingInput">Nama Lengkap</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="email@gmail.com" required>
                                    <label for="floatingInput">Email</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password" min="8" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input class="btn btn-secondary w-100 py-2 my-3  text-white border-0" type="submit" value="Register"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION["id"])){?>
    <div class="modal fade" id="ticketModal<?php echo $_SESSION['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row g-3">
                        <?php 
                            if(empty($ticket)){
                                echo "<span>No Data</span>";
                            }else{
                                foreach ($ticket as $key => $res) { ?>
                                <div class="col-5">
                                    <img class="object-fit-cover w-100" src="assets/img/upload/<?php echo $res['img'] ?>" style="height: 250px;">
                                </div>
                                <div class="col-7">
                                    <h5 class="fw-bold text-uppercase fs-5">
                                        <?php
                                            if($res['status'] == 'Menunggu'){
                                                echo "<span class='badge fw-thin mt-2 fs-6 text-bg-warning me-2 text-white'>Menunggu</span>";
                                            }
                                            elseif($res['status'] == 'Disetujui'){
                                                echo "<span class='badge fw-thin mt-2 fs-6 text-bg-success me-2'>Disetujui</span>";
                                            }
                                            elseif($res['status'] == 'Ditolak'){
                                                echo "<span class='badge fw-thin mt-2 fs-6 text-bg-danger me-2'>Ditolak</span>";
                                            }
                                        ?>
                                        <?php echo $res['judul'] ?>
                                    </h5>
                                    <p class="text-secondary">
                                        <strong>Kategori:</strong> <?php echo $res['kategori'] ?><br>
                                        <strong>Genre:</strong> <?php echo $res['genre'] ?><br>
                                        <strong>Deskripsi:</strong> <?php echo $res['deskripsi'] ?><br>
                                    </p>
                                </div>
                                <hr>
                        <?php 
                                }
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php foreach ($result as $key => $res) { ?>
        <div class="modal fade" id="kasetModal<?php echo $res['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5">
                                <img class="object-fit-cover w-100" src="assets/img/upload/<?php echo $res['img'] ?>" style="height: 426px;">
                                <?php if(isset($_SESSION["id"])){?>
                                <form action="controllers/actionSewa.php?act=buy" method="post">  
                                    <input type="text" class="visually-hidden" name="userID" value="<?php if(!isset($_SESSION["id"])){echo '';}else{echo $_SESSION["id"];} ?>">
                                    <input type="text" class="visually-hidden" name="filmID" value="<?php echo $res['id'] ?>">
                                    <button class="btn btn-dark border-0 rounded-0 w-100 fw-bold text-white"><small><i class="bi bi-cart-fill"></i> SEWA</small></button>
                                </form>
                                <?php } ?>
                            </div>
                            <div class="col-7">
                                <h5 class="fw-bold text-uppercase fs-5">
                                    <small><span class="badge mt-2 fs-6 text-bg-success"></span></small>
                                    <?php echo $res['judul'] ?>
                                </h5>
                                <p class="text-secondary">
                                    <strong>Kategori:</strong> <?php echo $res['kategori'] ?><br>
                                    <strong>Genre:</strong> <?php echo $res['genre'] ?><br>
                                    <strong>Deskripsi:</strong> <?php echo $res['deskripsi'] ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
