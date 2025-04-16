<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  $dir_fs_document_root = rtrim($_POST['DIR_FS_DOCUMENT_ROOT'], '/\\') . '/';
?>

<div class="row">
  <div class="col-sm-9">
    <div class="alert alert-info" role="alert">
      <h1><?= TEXT_NEW_INSTALLATION ?></h1>

      <?= sprintf(TEXT_WEB_INSTALL, Versions::get('Phoenix')) ?>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card mb-2">
      <ol class="list-group list-group-flush list-group-numbered">
        <li class="list-group-item bg-light text-muted"><?= TEXT_DATABASE_SERVER ?></li>
        <li class="list-group-item bg-light text-muted"><?= TEXT_WEB_SERVER ?></li>
        <li class="list-group-item active"><?= TEXT_STORE_SETTINGS ?></li>
        <li class="list-group-item"><?= TEXT_FINISHED ?></li>
      </ol>
      <div class="card-footer">
        <div class="progress">
          <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="<?= sprintf(INSTALLATION_PROGRESS, '75%') ?>" style="width: 75%">75%</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-9">

    <h2 class="display-4"><?= TEXT_STORE_SETTINGS ?></h2>

    <form name="install" class="was-validated" id="installForm" action="install.php?step=4" method="post">

      <div class="form-floating mb-3">
        <?= (new Input('CFG_STORE_NAME', ['id' => 'CFG_STORE_NAME', 'placeholder' => TEXT_STORE_NAME_PLACEHOLDER]))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_STORE_NAME_EXPLANATION ?>
        <label for="CFG_STORE_NAME"><?= TEXT_STORE_NAME ?></label>
      </div>

      <div class="form-floating mb-3">
        <?= (new Input('CFG_STORE_OWNER_NAME', ['id' => 'CFG_STORE_OWNER_NAME', 'placeholder' => TEXT_OWNER_NAME_PLACEHOLDER]))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_OWNER_NAME_EXPLANATION ?>
        <label for="CFG_STORE_OWNER_NAME"><?= TEXT_OWNER_NAME ?></label>
      </div>

      <div class="form-floating mb-3">
        <?= (new Input('CFG_STORE_OWNER_EMAIL_ADDRESS', ['id' => 'CFG_STORE_OWNER_EMAIL_ADDRESS', 'placeholder' => TEXT_OWNER_EMAIL_PLACEHOLDER]))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_OWNER_EMAIL_EXPLANATION ?>
        <label for="CFG_STORE_OWNER_EMAIL_ADDRESS"><?= TEXT_OWNER_EMAIL ?></label>
      </div>

      <hr>

      <div class="form-floating mb-3">
        <?= (new Input('CFG_ADMINISTRATOR_USERNAME', ['id' => 'CFG_ADMINISTRATOR_USERNAME', 'placeholder' => TEXT_ADMIN_USERNAME_PLACEHOLDER]))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_ADMIN_USERNAME_EXPLANATION ?>
        <label for="CFG_ADMINISTRATOR_USERNAME"><?= TEXT_ADMIN_USERNAME ?></label>
      </div>

      <div class="form-floating mb-3">
        <?= (new Input('CFG_ADMINISTRATOR_PASSWORD', ['id' => 'CFG_ADMINISTRATOR_PASSWORD', 'placeholder' => '']))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_ADMIN_PASSWORD_EXPLANATION ?>
        <label for="CFG_ADMINISTRATOR_PASSWORD"><?= TEXT_ADMIN_PASSWORD ?></label>
      </div>

      <hr>

<?php
  if (Path::is_writable($dir_fs_document_root) && Path::is_writable($dir_fs_document_root . 'admin')) {
?>
      <div class="form-floating mb-3">
        <?= (new Input('CFG_ADMIN_DIRECTORY', ['value' => 'admin', 'id' => 'CFG_ADMIN_DIRECTORY']))->require(),
              TEXT_REQUIRED_INFORMATION,
              TEXT_ADMIN_DIRECTORY_EXPLANATION ?>
        <label for="CFG_ADMIN_DIRECTORY"><?= TEXT_ADMIN_DIRECTORY ?></label>
      </div>
<?php
  }
?>

      <div class="form-floating mb-3">
        <?= (new Select('CFG_TIME_ZONE', Installer::load_time_zones(), ['id' => 'CFG_TIME_ZONE']))->set_default_selection(date_default_timezone_get()),
              TEXT_REQUIRED_INFORMATION,
              TEXT_TIME_ZONE_EXPLANATION ?>
        <label for="CFG_TIME_ZONE"><?= TEXT_TIME_ZONE ?></label>
      </div>

      <p class="d-grid"><?= new Button(TEXT_CONTINUE_STEP_4, 'fas fa-angle-right', 'btn-success') ?></p>

      <?php
      foreach ( array_diff_key($_POST, ['x' => 0, 'y' => 1]) as $key => $value ) {
        echo new Input($key, ['value' => $value], 'hidden');
      }
      ?>

    </form>
  </div>
  <div class="col-12 col-sm-3">
    <h3 class="display-4"><?= TEXT_STEP_3 ?></h3>
    
    <div class="card mb-2 card-body">
      <?= TEXT_STORE_SETTINGS_EXPLANATION ?>
    </div>
  </div>
</div>
