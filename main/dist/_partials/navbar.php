<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-center text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item ml-2 mt-1">
            <h4 class="text-uppercase text-white fw-bold" id="greetings"></h4>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </li>
        <li class="nav-item mr-4">
            <a href="../test.php" class="btn btn-primary">test page for ADMIN</a>
            <button type="button" data-toggle="modal" data-target="#LogoutModal" class="btn btn-danger text-uppercase fw-bold">signout</button>
        </li>
    </ul>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="font-weight-bold text-danger text-uppercase">Logout Alert</h4>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="dist/img/logout-img2.gif" alt="LogoutImage" style="width: 300px; height: fit-content; border-radius: 7px;">
                
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-danger mr-3" data-dismiss="modal"><i class="fas fa-times-circle"></i> NO</button>
                    <a href="signout" class="btn btn-success"><i class="fas fa-check-circle"></i> YES</a>
                </div>
            </div>
        </div>
    </div>
</div>