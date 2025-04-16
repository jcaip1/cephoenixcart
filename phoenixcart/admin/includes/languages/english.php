<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// Array examples which should work on all servers:
// 'en_US.UTF-8', 'en_US.UTF8', 'enu_usa'
// 'en_GB.UTF-8', 'en_GB.UTF8', 'eng_gb'
// 'en_AU.UTF-8', 'en_AU.UTF8', 'ena_au'

setlocale(LC_ALL, ['en_US.UTF-8', 'en_US.UTF8', 'enu_usa']);

$long_date_formatter = new IntlDateFormatter('en', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$short_date_formatter = new IntlDateFormatter('en', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
$date_time_formatter = new IntlDateFormatter('en', IntlDateFormatter::SHORT, IntlDateFormatter::LONG);

// Global entries for the <html> tag
const HTML_PARAMS = 'dir="ltr" lang="en"';

// charset for web pages and emails
const CHARSET = 'utf-8';

// page title
const TITLE = 'CE Phoenix Cart Administration Tool';

// header text in includes/hooks/admin/siteWide/hMenu.php
const HEADER_TITLE_ONLINE_CATALOG = '<i class="fas fa-shopping-cart me-1 text-primary" aria-hidden="true" title="Your Shop"></i><span class="border-bottom border-primary">Your Shop</span>';
const HEADER_TITLE_PHOENIX_CLUB = '<i class="fas fa-question-circle me-1 text-primary" aria-hidden="true" title="Phoenix Forum"></i><span class="border-bottom border-primary d-none d-md-inline">Phoenix Forum</span>';
const HEADER_TITLE_PHOENIX_WIKI = '<i class="fas fa-school me-1 text-primary" aria-hidden="true" title="User Guide"></i><span class="border-bottom border-primary d-none d-md-inline">User Guide</span>';
const HEADER_TITLE_CERTIFIED_DEVELOPERS = '<i class="fas fa-laptop-code me-1 text-primary" aria-hidden="true" title="Partners"></i><span class="border-bottom border-primary d-none d-md-inline">Certified Partners</span>';
const HEADER_TITLE_CERTIFIED_ADDONS = '<i class="fas fa-folder-plus me-1 text-primary" aria-hidden="true" title="Add-ons"></i><span class="border-bottom border-primary d-none d-md-inline">Add-ons</span>';
const HEADER_TITLE_LOGOFF = '<i class="fas fa-lock me-1" aria-hidden="true" title="Log off"></i><span class="border-bottom border-danger">%s, securely log off</span>';

// images
const IMAGE_BACK = 'Back';
const IMAGE_BACKUP = 'Backup';
const IMAGE_CANCEL = 'Cancel';
const IMAGE_COPY = 'Copy';
const IMAGE_COPY_TO = 'Copy To';
const IMAGE_DETAILS = 'Details';
const IMAGE_DELETE = 'Delete';
const IMAGE_EDIT = 'Edit';
const IMAGE_EMAIL = 'Email';
const IMAGE_EXPORT = 'Export';
const IMAGE_INSERT = 'Insert';
const IMAGE_LOCK = 'Lock';
const IMAGE_MODULE_INSTALL = 'Install Module';
const IMAGE_MODULE_REMOVE = 'Remove Module';
const IMAGE_MOVE = 'Move';
const IMAGE_NEW_CATEGORY = 'New Category';
const IMAGE_NEW_COUNTRY = 'New Country';
const IMAGE_NEW_CURRENCY = 'New Currency';
const IMAGE_NEW_CUSTOMER_DATA_GROUP = 'New Customer Data Group';
const IMAGE_NEW_LANGUAGE = 'New Language';
const IMAGE_NEW_NEWSLETTER = 'New Newsletter';
const IMAGE_NEW_PRODUCT = 'New Product';
const IMAGE_NEW_TAX_CLASS = 'New Tax Class';
const IMAGE_NEW_TAX_RATE = 'New Tax Rate';
const IMAGE_NEW_ZONE = 'New Zone';
const IMAGE_ORDERS = 'Orders';
const IMAGE_ORDERS_INVOICE = 'Invoice';
const IMAGE_ORDERS_PACKINGSLIP = 'Packing Slip';
const IMAGE_PREVIEW = 'Preview';
const IMAGE_RESTORE = 'Restore';
const IMAGE_RESET = 'Reset';
const IMAGE_SAVE = 'Save';
const IMAGE_SELECT = 'Select';
const IMAGE_SEND = 'Send';
const IMAGE_SEND_EMAIL = 'Send Email';
const IMAGE_UNLOCK = 'Unlock';
const IMAGE_UPDATE = 'Update';
const IMAGE_UPDATE_CURRENCIES = 'Update Exchange Rate';
const IMAGE_UPLOAD = 'Upload';

const ICON_FILE = 'File';
const ICON_FILE_DOWNLOAD = 'Download';

// constants for use in pagination
const TEXT_RESULT_PAGE = 'Page %s of %d';
const TEXT_DISPLAY_NUMBER_OF_COUNTRIES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> countries)';
const TEXT_DISPLAY_NUMBER_OF_CUSTOMER_DATA_GROUPS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> customer data groups)';
const TEXT_DISPLAY_NUMBER_OF_CUSTOMERS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> customers)';
const TEXT_DISPLAY_NUMBER_OF_CURRENCIES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> currencies)';
const TEXT_DISPLAY_NUMBER_OF_ENTRIES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> entries)';
const TEXT_DISPLAY_NUMBER_OF_LANGUAGES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> languages)';
const TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> manufacturers)';
const TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> newsletters)';
const TEXT_DISPLAY_NUMBER_OF_ORDERS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders)';
const TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders status)';
const TEXT_DISPLAY_NUMBER_OF_PRODUCTS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products)';
const TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products expected)';
const TEXT_DISPLAY_NUMBER_OF_REVIEWS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> product reviews)';
const TEXT_DISPLAY_NUMBER_OF_SPECIALS = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products on special)';
const TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax classes)';
const TEXT_DISPLAY_NUMBER_OF_TAX_ZONES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax zones)';
const TEXT_DISPLAY_NUMBER_OF_TAX_RATES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax rates)';
const TEXT_DISPLAY_NUMBER_OF_ZONES = 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> zones)';

const SPLIT_PAGES = 'Select Page';

const TEXT_DEFAULT = 'default';
const TEXT_SET_DEFAULT = 'Set as default';

const TEXT_NONE = '--none--';
const TEXT_TOP = 'Top';
const TEXT_ALL = 'All';

const ERROR_DESTINATION_DOES_NOT_EXIST = '<strong>Error:</strong> Destination does not exist.';
const ERROR_DESTINATION_NOT_WRITEABLE = '<strong>Error:</strong> Destination not writeable.';
const ERROR_FILE_NOT_SAVED = '<strong>Error:</strong> File upload not saved.';
const ERROR_FILETYPE_NOT_ALLOWED = '<strong>Error:</strong> File upload type not allowed.';
const SUCCESS_FILE_SAVED_SUCCESSFULLY = '<strong>Success:</strong> File upload saved successfully.';
const WARNING_NO_FILE_UPLOADED = '<strong>Warning:</strong> No file uploaded.';

// bootstrap helper
const MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION = <<<'EOT'
<p>Content Width can be 12 or less per column per row.</p>
<p>12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.</p>
<p>Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on).</p>
EOT;

// seo helper
const PLACEHOLDER_COMMA_SEPARATION = 'Must, Be, Comma, Separated';

// message for required inputs
const FORM_REQUIRED_INPUT = '<span class="form-control-feedback text-danger"><i class="fas fa-asterisk"></i></span>';

const TEXT_IMAGE_NON_EXISTENT = 'IMAGE DOES NOT EXIST';

const STAR_RATING = 'Rated %s Stars';

const GET_HELP = '<img alt="" src="images/icon_phoenix.png" class="me-2">Help';
const GET_ADDONS = '<img alt="" src="images/icon_phoenix.png" class="me-2">Addons';
const ADDONS_FREE = 'Free';
const ADDONS_COMMERCIAL = 'Paid';
const ADDONS_PRO = 'PRO';
