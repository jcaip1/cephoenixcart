<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_admin_languages_add_adverts {

  public function listen_insertAction() {
    global $lID;

    $GLOBALS['db']->query("INSERT INTO advert_info (advert_id, languages_id) SELECT advert_id, " . (int)$lID . " FROM advert_info WHERE languages_id = " . (int)$_SESSION['languages_id']);
  }

  public function listen_deleteConfirmAction() {
    global $lID;

    $GLOBALS['db']->query("DELETE FROM advert_info WHERE languages_id = " . (int)$lID);
  }

}
