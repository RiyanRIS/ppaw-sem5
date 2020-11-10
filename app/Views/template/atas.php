<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">ASAPIN.COM</a>
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
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("login") ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php if(!empty(session()->getFlashdata('info'))){ ?>
  <div role="alert" class="toast" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="3000" style="position: absolute; top: 20px; right: 10px; z-index:999">
        <div class="toast-body">
            <?= session()->getFlashdata('info') ?>
        </div>
  </div>
  <?php } ?>