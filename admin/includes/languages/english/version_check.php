<?php
/*
  $Id$

  CE Phoenix, E-Commerce Made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

const HEADING_TITLE = 'Version Checker';

const TABLE_HEADING_VERSION = 'Version';
const TABLE_HEADING_RELEASED = 'Release Date';
const TABLE_HEADING_ACTION = 'Action';

const TITLE_INSTALLED_VERSION = 'Installed Version: <strong>CE Phoenix v%s</strong>';

const VERSION_SERVER_FAILURE = 'Failed to load the available versions from the server.  Please check your internet or try again later.';
const VERSION_RUNNING_LATEST = 'You are running the latest version of CE Phoenix.';
const VERSION_UPGRADES_AVAILABLE = <<<'EOT'
<strong>CE Phoenix %s</strong> is the latest version available for you!<hr>
<a class="alert-link" target="_blank" href="https://phoenixcart.org/forum/viewforum.php?f=22">Certified Partners</a>
 and detailed "<a class="alert-link" target="_blank" href="https://phoenixcart.org/forum/app.php/tag/phoenix-update">Do It Yourself</a>"
 instructions are available in the Phoenix Forum.
EOT;

const GET_HELP_LINK = 'https://phoenixcart.org/phoenixcartwiki/index.php?title=Version_Checker';
