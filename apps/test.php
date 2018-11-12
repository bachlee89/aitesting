<?php
/**
 * @author Bach Lee <bach@balanceinternet.com.au>
 * @copyright  (c) 2018 Balance Internet (https://www.balanceinternet.com.au)
 */
require_once(__DIR__ . '/../apps/autoload.php');

use Testing\RbSellars\Pages\HomePage;

$homePage = new HomePage();
$homePage->run();