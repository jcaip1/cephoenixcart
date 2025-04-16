<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2024 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_shop_progress_progress_hooks {

  function listen_progressBar($arr) {

    $checkout_bar_delivery     = CHECKOUT_BAR_DELIVERY;
    $checkout_bar_payment      = CHECKOUT_BAR_PAYMENT;
    $checkout_bar_confirmation = CHECKOUT_BAR_CONFIRMATION;

    $output_progress = <<<eod
      <div class="progress-hooks pt-2">
        <div class="progress rounded-0" role="progressbar" aria-label="{$arr['markers']['now']}%" aria-valuenow="{$arr['markers']['now']}" aria-valuemin="{$arr['markers']['min']}" aria-valuemax="{$arr['markers']['max']}" style="height: 10px">
          <div class="progress-bar text-bg-secondary" style="width: {$arr['markers']['now']}%"></div>
        </div>
        <div class="row">
          <div class="col text-center">{$checkout_bar_delivery}</div>
          <div class="col text-center">{$checkout_bar_payment}</div>
          <div class="col text-center">{$checkout_bar_confirmation}</div>
        </div>
      </div>
eod;

    return $output_progress;
  }

}
