<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class n_update_order extends abstract_module {

    const CONFIG_KEY_BASE = 'MODULE_NOTIFICATIONS_UPDATE_ORDER_';

    const TRIGGERS = [ 'update_order' ];
    const REQUIRES = [ 'address', 'name', 'email_address' ];

    public function notify($data) {
      if (isset($_POST['notify_comments']) && ('on' === $_POST['notify_comments'])) {
        $data['notify_comments'] = sprintf(MODULE_NOTIFICATIONS_UPDATE_ORDER_TEXT_COMMENTS_UPDATE, $data['notify_comments']) . "\n\n";
      } else {
        $data['notify_comments'] = '';
      }

      // templates are shop side
      Guarantor::ensure_global('hooks', 'shop');

      ob_start();
      include Guarantor::ensure_global('Template')->map(__FILE__);
      echo ($GLOBALS['admin_hooks'] ?? $GLOBALS['hooks'])->cat('statusUpdateEmail', $data);

      return Notifications::mail($data['customers_name'], $data['customers_email_address'], MODULE_NOTIFICATIONS_UPDATE_ORDER_TEXT_SUBJECT, ob_get_clean(), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }

    protected function get_parameters() {
      return [
        static::CONFIG_KEY_BASE . 'STATUS' => [
          'title' => 'Enable Order Update Notification module',
          'value' => 'True',
          'desc' => 'Do you want to add the module to your shop?',
          'set_func' => "Config::select_one(['True', 'False'], ",
        ],
      ];
    }

  }

