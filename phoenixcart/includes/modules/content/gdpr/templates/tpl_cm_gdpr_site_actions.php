<div class="<?= MODULE_CONTENT_GDPR_SITE_ACTIONS_CONTENT_WIDTH ?> cm-gdpr-site-actions">
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th colspan="2"><?= MODULE_CONTENT_GDPR_SITE_ACTIONS_PUBLIC_TITLE ?></th>
      </tr>
      <tr>
        <td><?= MODULE_CONTENT_GDPR_SITE_ACTIONS_ACTION ?></td>
        <td><?= MODULE_CONTENT_GDPR_SITE_ACTIONS_DATE ?></td>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($port_my_data['YOU']['ACTIONS']['LIST'] as $k => $v) {
        echo '<tr>';
          echo '<th class="w-50">' . $v['ACTION'] . '</th>';
          echo '<td>' . $v['DATE'] . '</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
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
