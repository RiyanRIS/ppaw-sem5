<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="javascript:void(0)">ASAPIN.COM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item active"> -->
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url() ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if(isLogin()){ 
            if(session()->has('admin')){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("pemesanan") ?>">Pemesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("ikan") ?>">Ikan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("pembeli") ?>">Pembeli</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("admin") ?>">Admin</a>
          </li>
          <?php }else{ ?>
            <li class="nav-item">
            <a class="nav-link" href="<?= site_url("pemesanan-user") ?>">Pemesanan</a>
          </li>
          <?php } ?>
          <?php } ?>

          <?php if(isLogin()){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("logout") ?>">Logout</a>
          </li>
          <?php }else{ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("login") ?>">Login</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
