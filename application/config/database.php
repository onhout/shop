<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$active_group = 'default';
$active_record = TRUE;
if(ENVIRONMENT == 'production')
{
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'root';
    $db['default']['password'] = 'root';
    $db['default']['database'] = 'ecommerce';
}
else
{
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'adminkzgEF4X';
    $db['default']['password'] = 'WxZ4mMhyS_k4';
    $db['default']['database'] = 'ecommerce';
}
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;