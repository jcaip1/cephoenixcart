<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2024 Phoenix Cart

  Released under the GNU General Public License
*/

  $breadcrumb->add(NAVBAR_TITLE_1, $Linker->build('account.php'));
  $breadcrumb->add(NAVBAR_TITLE_2, $Linker->build('address_book.php'));
  $breadcrumb->add($navbar_title_3, $navbar_link_3);

  require $Template->map('template_top.php', 'component');
?>

<h1 class="display-4 mb-4"><?= $page_heading ?></h1>

<?php
  if ($messageStack->size($message_stack_area) > 0) {
    echo $messageStack->output($message_stack_area);
  }

  if (isset($_GET['delete'])) {
?>

  <div class="row">
    <div class="col-sm-8">
      <div class="alert alert-danger" role="alert"><?= DELETE_ADDRESS_DESCRIPTION ?></div>
    </div>
    <div class="col-sm-4">
      <div class="card mb-2">
        <div class="card-header"><?= DELETE_ADDRESS_TITLE ?></div>

        <div class="card-body">
          <?= $customer->make_address_label((int)$_GET['delete'], true, ' ', '<br>') ?>
        </div>
      </div>
    </div>
  </div>

  <div class="d-grid">
    <?= new Button(IMAGE_BUTTON_DELETE, 'fas fa-trash-alt', 'btn-danger btn-lg', [], $Linker->build('address_book_process.php', ['delete' => $_GET['delete'], 'action' => 'deleteconfirm', 'formid' => $_SESSION['sessiontoken']])) ?>
  </div>
  
  <div class="my-2">
    <?= new Button(IMAGE_BUTTON_BACK, 'fas fa-angle-left', 'btn-light', [], $Linker->build('address_book.php')) ?>
  </div>

<?php
  } else {
    $form = new Form('addressbook', $Linker->build('address_book_process.php', (isset($_GET['edit']) ? ['edit' => $_GET['edit']] : [])), 'post', ['class' => 'was-validated']);
    $form->hide('formid', $_SESSION['sessiontoken']);
    if (is_numeric($_GET['edit'] ?? null)) {
      $form->hide('action', 'update')->hide('edit', $_GET['edit']);
      $action_button = new Button(IMAGE_BUTTON_UPDATE, 'fas fa-sync', 'btn-success btn-lg');
    } else {
      $form->hide('action', 'process');
      $action_button = new Button(IMAGE_BUTTON_CONTINUE, 'fas fa-angle-right', 'btn-success btn-lg');
    }
    echo $form;

    include $Template->map('address_book_details.php', 'component');
?>

  <div class="d-grid">
    <?= $action_button ?>
  </div>
  
  <div class="my-2">
    <?= new Button(IMAGE_BUTTON_BACK, 'fas fa-angle-left', 'btn-light', [], $back_link) ?>
  </div>

</form>

<?php
  }
?>

<?php
  require $Template->map('template_bottom.php', 'component');
?>
