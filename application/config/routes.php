<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//admin
$route['dashboard'] = 'Dashboard';
$route['jadwal'] = 'KelolaJadwal_admin';
$route['layanan'] = 'KelolaLayanan';
$route['member'] = 'KelolaMember_admin';
$route['tagihan'] = 'KelolaPembayaran';
$route['pembayaran'] = 'RekapPembayaran';
$route['absensi'] = 'KelolaAbsensi_admin';
$route['rekap'] = 'KelolaRekap';

//pemilik
$route['dashboard_pm'] = 'Dashboard_pm';
$route['member_pm'] = 'Murid_Pm';
$route['pembayaran_pm'] = 'Pembayaran_Pm';
$route['tentor'] = 'KelolaTentor_admin';
$route['rekap_pm'] = 'LihatRekap';
$route['about'] = 'About';

//API
$route['pembayaran_json/(:num)'] = 'api/Manage_all/get_pembayaran/$1';
$route['pembayaran_json'] = 'api/Manage_all/get_pembayaran';
$route['tagihan_json'] = 'api/Manage_all/get_tagihan';
$route['api/manage_all/insert_murid'] = 'api/manage_all/insert_murid_post';
$route['api/manage_all/KelolaLayanan'] = 'api/Manage_all/get_layanan';
$route['api/manage_all/KelolaRekap'] = 'api/Manage_all/get_rekap';
$route['api/manage_all/insert_user'] = 'api/manage_all/insert_user_post';

//ANDROID
//$route['login'] = 'api/Authh/login';
$route['api/manage_all/register'] = 'api/Manage_all/register_post';
$route['api/manage_all/login'] = 'api/Manage_all/login_post';
$route['kelola_android'] = 'api/Manage_all/get_layanan';
$route['kelola_daftar'] = 'api/Manage_all/daftar_post';
// $route['kelola_absen'] = 'api/Manage_all/insert_absen_post';
$route['kelola_absen'] = 'api/Manage_all/insert_absen';
$route['kelola_tentor_android'] = 'api/Manage_all/get_tentor';
$route['kelola_jadwal_ku'] = 'api/Manage_all/get_jadwal';


$route['rekap/(:num)'] = 'api/Manage_all/get_rekap/$1';




