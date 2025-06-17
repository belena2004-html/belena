<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'AuthController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Route Frontend
 */

$route['register'] = 'AuthController/register';
$route['dashboard_pasien'] = 'welcome/dashboard';
$route['pendaftaran_berobat'] = 'welcome/pendaftaran';
$route['pendaftaran_berobat/proses'] = 'welcome/proses_pendaftaran';

/**
 * Route Authentication
 */
$route['login'] = 'AuthController/index';
$route['auth/process_login'] = 'AuthController/process_login';
$route['logout'] = 'AuthController/logout';

/**
 * Route Backend
 */
$route['dashboard'] = 'DashboardController/index';

$route['profile'] = 'DashboardController/profile';
$route['update_profile'] = 'DashboardController/update_profile';

$route['jadwal'] = 'DashboardController/jadwal';

$route['poli'] = 'PoliController';
$route['poli/add'] = 'PoliController/add';
$route['poli/edit/(:num)'] = 'PoliController/edit/$1';
$route['poli/delete/(:num)'] = 'PoliController/delete/$1';

$route['dokter'] = 'DokterController';
$route['dokter/add'] = 'DokterController/add';
$route['dokter/edit/(:num)'] = 'DokterController/edit/$1';
$route['dokter/delete/(:num)'] = 'DokterController/delete/$1';

$route['user'] = 'UserController';
$route['user/add'] = 'UserController/add';
$route['user/edit/(:num)'] = 'UserController/edit/$1';
$route['user/delete/(:num)'] = 'UserController/delete/$1';

$route['pendaftaran'] = 'PendaftaranController';
$route['pendaftaran/detail/(:num)'] = 'PendaftaranController/detail/$1';
$route['pendaftaran/approve/(:num)'] = 'PendaftaranController/approve/$1';
$route['pendaftaran/reject_process'] = 'PendaftaranController/reject_process';
$route['pendaftaran/delete/(:num)'] = 'PendaftaranController/delete/$1';

$route['pendaftaran/export_csv'] = 'PendaftaranController/export_csv';
$route['pendaftaran/export_pdf'] = 'PendaftaranController/export_pdf';
$route['pendaftaran/calendar_events'] = 'PendaftaranController/calendar_events';

$route['pasien'] = 'PasienController';
$route['pasien/detail/(:num)'] = 'PasienController/detail/$1';
$route['pasien/add'] = 'PasienController/add';
$route['pasien/edit/(:num)'] = 'PasienController/edit/$1';
$route['pasien/delete/(:num)'] = 'PasienController/delete/$1';
