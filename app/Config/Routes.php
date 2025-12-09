<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


//user 
$routes->get('/', 'Home::index');
$routes->get('/chart', 'Chart::index');
$routes->get('/chart/(:num)', 'Chart::index/$1');
$routes->get('/Privacy', 'Privacy::index');
$routes->get('/Contact', 'Contact::index');
$routes->get('/check', 'Home::home');
$routes->post('/auth/admin_register', 'Auth::admin_register');
$routes->post('/auth/admin_login', 'Auth::admin_login');
$routes->post('/auth/login', 'Auth::login');
$routes->post('/auth/register', 'Auth::register');
$routes->post('/auth/user_update/(:num)','Auth::user_update/$1');
$routes->post('/auth/delete/(:num)','Cart::distroy/$1');  // user deleted
$routes->post('/auth/user_pin_update/(:num)','Auth::user_up_pin/$1');
$routes->post('/auth/adminuser_update/(:num)','Auth::adminuser_update/$1');

// game 

$routes->get('/users/get_service','Users::index');// for all games
$routes->get('/users/get_stype','Users::g_type');
$routes->get('/users/star_stype','Users::sg_type');
$routes->post('/users/service_add','Users::store'); // add game
$routes->get('/users/g_id/(:num)','Users::show/$1');// by id game
$routes->post('/users/g_update/(:num)','Users::update/$1');
$routes->post('/users/g_published/(:num)','Users::g_published/$1'); // stauts send
$routes->post('/users/g_market/(:num)','Users::g_market/$1'); // stauts send for market
$routes->delete('/users/delete', 'Users::destroy');

/// star line
$routes->get('/users/gets_service','Users::sindex');// for all games
$routes->post('/users/sservice_add','Users::sstore'); // add game
$routes->post('/users/gs_update/(:num)','Users::supdate/$1'); // update game
$routes->post('/users/gs_published/(:num)','Users::gs_published/$1'); // stauts send
$routes->post('/users/gs_market/(:num)','Users::gs_market/$1'); // stauts send for market
$routes->get('/users/gs_id/(:num)','Users::sshow/$1');// by id game

// for otp
$routes->post('/basic/otp', 'Basic::otp_send');

$routes->post('/basic/otp_v', 'Basic::otp_val');


// for wall.. 
$routes->get('/cart', 'Cart::index');
$routes->get('/cart/user_id/(:num)','Cart::show/$1');
$routes->post('/cart/w_update/(:num)','Cart::store/$1');// w_id

$routes->get('/cart/tran','Cart::tr_all');  ///all trazaction without any id
$routes->get('/cart/wt_id/(:num)','Cart::t_all/$1');  ///all trazaction
$routes->post('/cart/w_published/(:num)','Cart::w_published/$1');
$routes->delete('/cart/delete', 'Cart::destroy');
$routes->post('/cart/complant', 'Cart::save_com');

// widrow 
$routes->get('/cart/wd_all','Cart::wd_all');
$routes->get('/cart/uwd_all/(:num)','Cart::uwd_all/$1');   // by user id
$routes->post('/cart/wd_approve/(:num)','Cart::wd_give/$1');// widrow approved by wd_id

// for pay method.. 

$routes->get('/method', 'Method::index');
$routes->get('/method/user_id/(:num)','Method::show/$1');
$routes->post('/method/add','Method::store');// methdo store
$routes->get('/method/update/(:num)','Method::update/$1');  ///for update
$routes->delete('/method/delete', 'Method::destroy');


// for number 
$routes->get('/number', 'Number::index'); //find all
$routes->get('/number/num_gt_id/(:num)','Number::gt_id/$1'); // number by game type id
$routes->get('/number/num_ank/(:num)','Number::show_ank/$1'); // number by game ank 
$routes->get('/numberh','Number::hindex'); // number by game half sanagm 
$routes->get('/number/num_full/(:num)','Number::show_half_panna/$1'); // number by game full sangm 



// for bid..
$routes->get('/bid', 'Bid::index'); //find all
$routes->get('/bid_today', 'Bid::today'); //find today all
$routes->post('/bid/bid_add','Bid::store'); // bid store
$routes->post('/bid/update_num/(:num)','Bid::update_num/$1'); //num upadte by bid id
$routes->get('/bid/user_id/(:num)','Bid::B_all/$1'); //bid all by user id
$routes->delete('/bid/bid_delete_id/(:num)', 'Bid::destroy/$1'); //by bid id

// result data
$routes->get('/result', 'Result::index'); //find all
$routes->get('/result_admin', 'Result::index1'); //find all for admin
$routes->get('/result/g_id/(:num)', 'Result::by_g_id/$1'); //find all by game id
$routes->post('/result/result_add','Result::store'); // result store
$routes->post('/result/user_id/(:num)','Result::R_all/$1'); //result all by user id
$routes->post('/result/result_delete_id/(:num)', 'Result::destroy/$1'); //by bid id


// win data
$routes->get('/win', 'Win::index'); //find all
$routes->get('/win_admin', 'Win::index1'); //find all for admin
$routes->get('/win/g_id/(:num)', 'Win::by_g_id/$1'); //find all by game id

$routes->get('/win/user_id/(:num)','Win::win_user/$1'); //result all by user id
$routes->get('/swin/user_id/(:num)','Win::swin_user/$1'); //result all by user id


// for startline bid..
$routes->get('/sbid', 'Bid::sindex'); //find all
$routes->post('/sbid/bid_add','Bid::sstore'); // bid store
$routes->post('/sbid/update_num/(:num)','Bid::supdate_num/$1'); //num upadte by bid id
$routes->get('/sbid/user_id/(:num)','Bid::sB_all/$1'); //bid all by user id
$routes->post('/sbid/bid_delete_id/(:num)', 'Bid::sdestroy/$1'); //by bid id

// result data startline
$routes->get('/sresult', 'Result::sindex'); //find all
$routes->get('/sresult_admin', 'Result::sindex2'); //find all for admin
$routes->get('/sresult_all', 'Result::result_all'); //find all by game id
$routes->post('/sresult/result_add','Result::sstore'); // result store
$routes->post('/sresult/user_id/(:num)','Result::sR_all/$1'); //bid all by user id
$routes->post('/sresult/result_delete_id/(:num)', 'Result::sdestroy/$1'); //by bid id

// basic information all 
$routes->get('/basic', 'Basic::index');
$routes->post('/basic/update/(:num)', 'Basic::update/$1');
$routes->get('/banners', 'Users::banners'); // banner
$routes->post('/banner_add', 'Users::banner_add'); // banner add
$routes->post('/banner_update', 'Users::update_banner'); // banner update
$routes->post('/banner_delete/(:num)', 'Users::destroy_banner/$1');
/*
 *Admin Routing
 * --------------------------------------------------------------------
*/
$routes->get('/user_all/(:num)', 'AUsers::user_a/$1'); //find all
$routes->get('/user_core_satus/(:num)', 'AUsers::st_bt/$1'); //user status and wallet status
$routes->get('/bid_admin', 'Bid::index_admin'); //find all
$routes->post('/revert/(:num)', 'Bid::revert/$1'); // bid revert for if market is close or bid is open
$routes->get('/sbid_admin', 'Bid::sindex_admin'); //find all
$routes->get('/user_m', 'AUsers::index'); //find all user managmnet
$routes->post('/user_m_activity/(:num)', 'AUsers::update_a/$1'); //user status managmnet
$routes->post('/user_m_Batting/(:num)', 'AUsers::update_w/$1'); //wallet status managmnet
$routes->get('/user_rate', 'Basic::rate'); //rate managmnet
$routes->get('/user_rates', 'Basic::rates'); //rate managmnet for star line
$routes->post('/user_rates_u', 'Basic::rates_u'); //rate edit managmnet for star line
$routes->post('/user_rate_u', 'Basic::rate_u'); //rate edit managmnet
$routes->post('/wallet/update_by_user/(:num)', 'Cart::update_by_user/$1'); //fund add by admin managmnet
$routes->get('/complaint', 'AUsers::compant'); //fund add by admin managmnet
$routes->get('/sgame', 'Result::sindex1'); ///  star laine game 
$routes->get('/last_status/(:num)', 'Basic::latest_log/$1'); ///  star laine game 
$routes->post('/auth/auser_pin_update/(:num)','Auth::auser_up_pin/$1');  // user pin set by admin
$routes->post('/bid_win','Win::bid_win');  // bid and win report by date and game

















// for lotus user 
$routes->post('/authlotus/login', 'AuthLotus::login');
$routes->post('/authlotus/register', 'AuthLotus::register');
$routes->post('/authlotus/user_update/(:num)','AuthLotus::user_update/$1');
$routes->get('/authlotus/basic','AuthLotus::lot_b');

/*
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}



