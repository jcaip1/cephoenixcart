<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  if (!is_array($GLOBALS['order_total_modules']->modules)) {
    return;
  }

  $GLOBALS['order']->totals = [];
  foreach ($GLOBALS['order_total_modules']->modules as $value) {
    $class = pathinfo($value, PATHINFO_FILENAME);
    if (!$GLOBALS[$class]->enabled) {
      continue;
    }

    foreach ($GLOBALS[$class]->output as $order_total) {
      if (!Text::is_empty($order_total['title']) && !Text::is_empty($order_total['text'])) {
        $GLOBALS['order']->totals[] = [
          'code' => $GLOBALS[$class]->code,
          'title' => $order_total['title'],
          'text' => $order_total['text'],
          'value' => $order_total['value'],
          'sort_order' => $GLOBALS[$class]->sort_order,
        ];
      }
    }
  }
