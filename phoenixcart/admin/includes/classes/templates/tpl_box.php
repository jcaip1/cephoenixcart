<div class="table-responsive">
  <?php
  if ('' !== $form_start) {
    echo $form_start;
  }
  ?>
  <table class="table table-striped table-hover">
    <thead class="table-light">
      <tr>
        <th><?= $heading ?></th>
      </tr>
    </thead>
    <tbody>
      <?= $contents ?>
    </tbody>
  </table>
  <?php
  if ('' !== $form_close) {
    echo $form_close;
  }
  ?>
</div>

<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/
?>