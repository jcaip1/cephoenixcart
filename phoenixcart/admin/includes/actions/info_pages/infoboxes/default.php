<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  if (isset($table_definition['info']->pages_id)) {
    $pInfo = $table_definition['info'];
    $heading = $pInfo->pages_title;
    $link = $GLOBALS['link']->set_parameter('pID', (int)$pInfo->pages_id);

    $contents[] = [
      'class' => 'text-center',
      'text' => $GLOBALS['Admin']->button(IMAGE_EDIT, 'fas fa-cogs', 'btn-warning me-2', (clone $link)->set_parameter('action', 'edit'))
              . $GLOBALS['Admin']->button(IMAGE_DELETE, 'fas fa-trash', 'btn-danger', (clone $link)->set_parameter('action', 'delete')),
    ];
    $contents[] = ['text' => sprintf(TEXT_INFO_DATE_ADDED, Date::abridge($pInfo->date_added))];
    if (!Text::is_empty($pInfo->last_modified)) {
      $contents[] = ['text' => sprintf(TEXT_INFO_LAST_MODIFIED, Date::abridge($pInfo->last_modified))];
    }
    $contents[] = ['text' => sprintf(TEXT_INFO_PAGE_SIZE, str_word_count($pInfo->pages_text))];
  }
