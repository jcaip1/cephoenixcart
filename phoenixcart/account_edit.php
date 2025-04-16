<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  require 'includes/application_top.php';

  $hooks->register_pipeline('loginRequired');

  $message_stack_area = 'account_edit';
// needs to be included earlier to set the success message in the messageStack
  require language::map_to_translation('account_edit.php');

  if (Form::validate_action_is('process')) {
    $customer_details = $customer_data->process($customer_data->get_fields_for_page('account_edit'));
    $hooks->cat('injectFormVerify');

    if (Form::is_valid()) {
      $customer_data->update($customer_details, ['id' => $customer->get_id()], 'customers');
      $db->query("UPDATE customers_info SET customers_info_date_account_last_modified = NOW() WHERE customers_info_id = " . (int)$customer->get_id());

      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      Href::redirect($Linker->build('account.php'));
    }
  }

  require $Template->map(__FILE__, 'page');

  require 'includes/application_bottom.php';
