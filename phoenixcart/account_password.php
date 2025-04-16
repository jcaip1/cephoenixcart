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

  // if password is not enabled, then no reason to be on this page
  if (!$customer_data->has(['password'])) {
    Href::redirect($Linker->build('index.php'));
  }

// needs to be included earlier to set the success message in the messageStack
  require language::map_to_translation('account_password.php');

  $page_fields = [ 'password', 'password_confirmation' ];
  $message_stack_area = 'account_password';

  if (Form::validate_action_is('process')) {
    $password_current = Text::input($_POST['password_current']);

    $customer_details = $customer_data->process($page_fields);

    if (Form::is_valid()) {
      $check_customer_query = $db->query($customer_data->build_read(['password'], 'customers', ['id' => (int)$_SESSION['customer_id']]));
      $check_customer = $check_customer_query->fetch_assoc();

      if (Password::validate($password_current, $customer_data->get('password', $check_customer))) {
        $customer_data->update(['password' => $customer_data->get('password', $customer_details)], ['id' => (int)$_SESSION['customer_id']]);

        $db->query("UPDATE customers_info SET customers_info_date_account_last_modified = NOW() WHERE customers_info_id = " . (int)$_SESSION['customer_id']);

        $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED, 'success');

        Href::redirect($Linker->build('account.php'));
      } else {
        $messageStack->add($message_stack_area, ERROR_CURRENT_PASSWORD_NOT_MATCHING);
      }
    }
  }

  require $Template->map(__FILE__, 'page');

  require 'includes/application_bottom.php';
