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
|	https://codeigniter.com/user_guide/general/routing.html
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

// 기본 컨트롤러를 변경해서 localhost/ci3 를 타고가면 site의 index 호출
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// 함수에서 매개변수 받는 법
$route["site/product/(:any)"] = "site/product/$1";
$route["site/service/(:num)/(:any)"] = "site/service/$1/$2";


// http://localhost/ci3-board/index.php/site/boardwrite
$route["site/write"] = "site/write";
// http://localhost/ci3-board/index.php/site/boardmodify
$route["site/modify/(:any)"] = "site/modify/$1";


// http://localhost/ci3-board/index.php/site/boardmodify
$route["site/join"] = "site/join";
// http://localhost/ci3-board/index.php/site/boardmodify
$route["site/login"] = "site/login";

// 테스트
$route["test/home"] = "test";
// 테스트 모델로
$route["test/model/(:any)"] = "test/model/$1";


// 유저
// 
// 가입
$route['action/register'] = "action/register";
// 로그인
$route['action/login'] = "action/login";
// 로그아웃
$route['action/logout'] = "action/logout";
// 회원탈퇴
$route['action/withdrawal'] = "action/withdrawal";



// $route["추가 할 url 컨트롤러 이름이랑 무관"] = "컨트롤러/함수"


// 데이터 추가
// http://localhost/ci3/index.php/action/insert-data
$route["action/insert-data"] = "action/insert_data_into_table";

// 데이터 조회
// http://localhost/ci3/index.php/action/select-all
$route["action/select-all"] = "action/get_all_data";

// 데이터 업데이트
// http://localhost/ci3/index.php/action/update-data
$route["action/update-data"] = "action/update_data";

// 데이터 삭제
// http://localhost/ci3/index.php/action/delete-single
$route["action/delete-single"] = "action/delete_single_user";

// 데이터 조회 조건
// http://localhost/ci3/index.php/action/codition
$route["action/codition"] = "action/codition";