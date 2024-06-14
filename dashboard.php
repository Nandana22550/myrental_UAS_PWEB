<?php
    include_once 'config/Connection.php';
    include_once 'models/Kaset.php';
    include_once 'models/Users.php';
    include_once 'models/Sewa.php';

    $sewa = new Sewa();
    $kaset = new Kaset();
    $user = new Users();
    $waiting = $sewa->getData('Menunggu');
    $approved = $sewa->getData('Disetujui');
    $rejected = $sewa->getData('Ditolak');
    $result = $kaset->getData();
    $getAdmin = $user->getAdmin();
    $getUser = $user->getUser();
    session_start();
    if(!isset($_SESSION["name"]) OR $_SESSION["status"] == 'User'){header("location:index.php");}
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
    <header class="navbar sticky-top bg-dark flex-md-nowrap py-2 bg-dark" data-bs-theme="dark">
        <h2><a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 txtBrand fs-1 text-white" href="#">MyRental</span></a></h2>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                    <i class="bi bi-search"></i>
                </button>
            </li>
            <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            </li>
        </ul>

        <div id="navbarSearch" class="navbar-search w-100 collapse">
            <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right border-dark col-md-3 col-lg-2 p-0 bg-dark" style="min-height: 100vh">
                <div class="offcanvas-md offcanvas-end bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fs-1 text-white" id="sidebarMenuLabel">MyRental</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-white active" aria-current="page" href="dashboard.php">
                                    <i class="bi bi-house"></i>
                                    Dashboard 
                                </a>
                            </li>
                        </ul>

                    <hr class="my-3 border-white">

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 text-white" href="controllers/actionUsers.php?act=logout">
                                <i class="bi bi-door-closed"></i>
                                Sign out
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="row g-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data Kaset</h2>
                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="bi bi-plus-square-fill"></i> Tambah Data</button>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $res) { ?>
                                        <tr class="data-<?php echo $res['id'] ?> align-middle">
                                            <td class="text-center"><?php echo $res['id'] ?></td>
                                            <td><?php echo $res['judul'] ?></td>
                                            <td><?php echo $res['genre'] ?></td>
                                            <td><?php echo $res['kategori'] ?></td>
                                            <td><?php echo $res['deskripsi'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-dark m-1" data-bs-toggle="modal" data-bs-target="#imgModal<?php echo $res['id'] ?>"><i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-title="View Photo" ></i></a>
                                                <a class="btn btn-sm btn-info text-white m-1" data-bs-toggle="modal" data-bs-target="#editDataModal<?php echo $res['id'] ?>"><i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-title="Edit Data"></i></a>
                                                <a id="<?php echo $res['id'] ?>" class="btn btn-sm btn-danger m-1 btnDeleteKaset" data-bs-toggle="tooltip" data-bs-title="Delete Data"><i class="bi bi-trash3-fill"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data Admin</h2>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <?php
                                        if($_SESSION["status"] == 'SuperAdmin'){
                                    ?>
                                    <th scope="col">Password</th>
                                    <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getAdmin as $key => $res) { ?>
                                    <tr class="data-admin-<?php echo $res['id'] ?> align-middle">
                                        <td class="text-center"><?php echo $res['id'] ?></td>
                                        <td><?php echo $res['nama'] ?></td>
                                        <td><?php echo $res['email'] ?></td>
                                        <?php
                                            if($_SESSION["status"] == 'SuperAdmin'){
                                        ?>
                                        <td><?php echo $res['password'] ?></td>
                                        <td class="text-center">
                                            <a href="controllers/actionUsers.php?act=demote&id=<?php echo $res['id'] ?>" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-title="Demote to User"><i class="bi bi-person-fill-down"></i></a>
                                            <a id="<?php echo $res['id'] ?>" class="btn btn-sm btn-danger btnDeleteAdmin" data-bs-toggle="tooltip" data-bs-title="Delete Data"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data User</h2>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <?php
                                        if($_SESSION["status"] == 'SuperAdmin'){
                                    ?>
                                    <th scope="col">Password</th>
                                    <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getUser as $key => $res) { ?>
                                    <tr class="data-user-<?php echo $res['id'] ?> align-middle">
                                        <td class="text-center"><?php echo $res['id'] ?></td>
                                        <td><?php echo $res['nama'] ?></td>
                                        <td><?php echo $res['email'] ?></td>
                                        <?php
                                            if($_SESSION["status"] == 'SuperAdmin'){
                                        ?>
                                        <td><?php echo $res['password'] ?></td>
                                        <td class="text-center">
                                            <a href="controllers/actionUsers.php?act=promote&id=<?php echo $res['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-title="Promote to Admin"><i class="bi bi-person-fill-up"></i></a>
                                            <a id="<?php echo $res['id'] ?>" class="btn btn-sm btn-danger btnDeleteUser" data-bs-toggle="tooltip" data-bs-title="Delete Data"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data Penyewaan (Menunggu)</h2>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Penyewa</th>
                                    <th scope="col">Judul Game</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($waiting as $key => $res) { ?>
                                    <tr class="data- align-middle">
                                        <td class="text-center"><?php echo $res['sewaID'] ?></td>
                                        <td><?php echo $res['nama'] ?></td>
                                        <td><?php echo $res['judul'] ?></td>
                                        <td class="text-center">
                                            <a href="controllers/actionSewa.php?act=update&id=<?php echo $res['sewaID'] ?>&status=Disetujui" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-title="Approve"><i class="bi bi-check-lg"></i></a>
                                            <a href="controllers/actionSewa.php?act=update&id=<?php echo $res['sewaID'] ?>&status=Ditolak" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-title="Reject"><i class="bi bi-x-lg"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data Penyewaan (Disetujui)</h2>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Penyewa</th>
                                    <th scope="col">Judul Game</th>
                                    <?php
                                        if($_SESSION["status"] == 'SuperAdmin'){
                                    ?>
                                    <th scope="col">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($approved as $key => $res) { ?>
                                    <tr class="data-app-<?php echo $res['sewaID'] ?> align-middle">
                                        <td class="text-center"><?php echo $res['sewaID'] ?></td>
                                        <td><?php echo $res['nama'] ?></td>
                                        <td><?php echo $res['judul'] ?></td>
                                        <?php
                                            if($_SESSION["status"] == 'SuperAdmin'){
                                        ?>
                                        <td class="text-center">
                                            <a id="<?php echo $res['sewaID'] ?>" class="btn btn-sm btn-danger btnDelete1" data-bs-toggle="tooltip" data-bs-title="Delete Data"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-between mt-5">
                            <h2>Data Penyewaan (Ditolak)</h2>
                        </div>
                        <div class="table-responsive small mt-3">
                            <table class="table table-striped-columns table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Penyewa</th>
                                    <th scope="col">Judul Game</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rejected as $key => $res) { ?>
                                    <tr class="data-rej-<?php echo $res['sewaID'] ?> align-middle">
                                        <td class="text-center"><?php echo $res['sewaID'] ?></td>
                                        <td><?php echo $res['nama'] ?></td>
                                        <td><?php echo $res['judul'] ?></td>
                                        <td class="text-center">
                                            <a href="controllers/actionSewa.php?act=update&id=<?php echo $res['sewaID'] ?>&status=Disetujui" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-title="Approve"><i class="bi bi-check-lg"></i></a>
                                            
                                            <?php
                                                if($_SESSION["status"] == 'SuperAdmin'){
                                            ?>
                                            <a id="<?php echo $res['sewaID'] ?>" class="btn btn-sm btn-secondary btnDelete2" data-bs-toggle="tooltip" data-bs-title="Delete Data"><i class="bi bi-trash3-fill"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="addDataModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controllers/actionKaset.php?act=add" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="judul" placeholder="" required>
                                    <label for="floatingInput">Judul</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select type="text" class="form-control" id="floatingInput" name="genre" placeholder="" required>
                                        <option selected disabled>...</option>
                                        <option value="Action">Action</option>
                                        <option value="Adventure">Adventure</option>
                                        <option value="Fighting">Fighting</option>
                                        <option value="Fps">Fps</option>
                                        <option value="Racing">Racing</option>
                                        <option value="RPG">RPG</option>
                                        <option value="Simulation">Simulation</option>
                                        <option value="Strategy">Strategy</option>
                                        <option value="Horror">Horror</option>
                                    </select>
                                    <label for="floatingInput">Genre</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select type="text" class="form-control" id="floatingInput" name="kategori" placeholder="" required>
                                        <option selected disabled>...</option>
                                        <option value="PS2">PS2</option>
                                        <option value="PS3">PS3</option>
                                        <option value="PS4">PS4</option>
                                    </select>
                                    <label for="floatingInput">Kategori</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="floatingInput" name="deskripsi" placeholder="" rows="10" style="height:100%; resize: none;" required></textarea>
                                    <label for="floatingInput">Deskripsi</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-2">
                                    <input class="form-control" type="file" id="formFile" name="img" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Simpan"></input>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php foreach ($result as $key => $res) { ?>
        <div class="modal fade" id="editDataModal<?php echo $res['id'] ?>" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="editDataModalLabel">Edit Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="controllers/actionKaset.php?act=update" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="id" class="visually-hidden" value="<?php echo $res['id'] ?>">
                                        <input type="text" class="form-control" id="floatingInput" name="judul" value="<?php echo $res['judul'] ?>" required>
                                        <label for="floatingInput">Judul</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select type="text" class="form-control" id="floatingInput" name="genre" placeholder="" required>
                                            <option <?php if($res['genre'] == "Action"){echo 'selected';} ?> value="Action">Action</option>
                                            <option <?php if($res['genre'] == "Adventure"){echo 'selected';} ?> value="Adventure">Adventure</option>
                                            <option <?php if($res['genre'] == "Fighting"){echo 'selected';} ?> value="Fighting">Fighting</option>
                                            <option <?php if($res['genre'] == "Fps"){echo 'selected';} ?> value="Fps">Fps</option>
                                            <option <?php if($res['genre'] == "Racing"){echo 'selected';} ?> value="Racing">Racing</option>
                                            <option <?php if($res['genre'] == "RPG"){echo 'selected';} ?> value="RPG">RPG</option>
                                            <option <?php if($res['genre'] == "Simulation"){echo 'selected';} ?> value="Simulation">Simulation</option>
                                            <option <?php if($res['genre'] == "Strategy"){echo 'selected';} ?> value="Strategy">Strategy</option>
                                            <option <?php if($res['genre'] == "Horror"){echo 'selected';} ?> value="Horror">Horror</option>
                                        </select>
                                        <label for="floatingInput">Genre</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select type="text" class="form-control" id="floatingInput" name="kategori" placeholder="" required>
                                            <option <?php if($res['kategori'] == "PS2"){echo 'selected';} ?> value="PS2">PS2</option>
                                            <option <?php if($res['kategori'] == "PS3"){echo 'selected';} ?> value="PS3">PS3</option>
                                            <option <?php if($res['kategori'] == "PS4"){echo 'selected';} ?> value="PS4">PS4</option>
                                        </select>
                                        <label for="floatingInput">Kategori</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="floatingInput" name="deskripsi" rows="10" style="height:100%; resize: none;" required><?php echo $res['deskripsi'] ?></textarea>
                                        <label for="floatingInput">Deskripsi</label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="my-2">
                                        <input class="form-control" type="file" id="formFile" name="img">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grip my-2 text-end">
                                        <a href="" class="btn btn-dark ms-auto me-0" data-bs-toggle="modal" data-bs-target="#imgModal<?php echo $res['id'] ?>"><i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-title="View Photo" ></i></a>
                                        <input type="text" name="oldfile" class="visually-hidden" value="<?php echo $res['img'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Simpan"></input>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <?php foreach ($result as $key => $res) { ?>
        <div class="modal fade modal-lg" id="imgModal<?php echo $res['id'] ?>" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <img src="assets/img/upload/<?php echo $res['img'] ?>" class="img-fluid" alt="...">
                </div>
            </div>
        </div>
    <?php } ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnDeleteKaset').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah anda yakin menghapus data ini?")) {
                $.ajax({
                    type: "GET",
                    url: "controllers/actionKaset.php?act=delete",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".data-" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
        $('.btnDelete1').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah anda yakin menghapus data ini?")) {
                $.ajax({
                    type: "GET",
                    url: "controllers/actionSewa.php?act=delete",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".data-app-" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
        $('.btnDelete2').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah anda yakin menghapus data ini?")) {
                $.ajax({
                    type: "GET",
                    url: "controllers/actionSewa.php?act=delete",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".data-rej-" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
        $('.btnDeleteUser').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah anda yakin menghapus data ini?")) {
                $.ajax({
                    type: "GET",
                    url: "controllers/actionUsers.php?act=delete",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".data-user-" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });$('.btnDeleteAdmin').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah anda yakin menghapus data ini?")) {
                $.ajax({
                    type: "GET",
                    url: "controllers/actionUsers.php?act=delete",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $(".data-admin-" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
</html>