<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//user routes
$route['users/register'] = 'users/register';
$route['users/dashboard'] = 'users/dashboard';
$route['users/profile'] = 'users/profile';
$route['users/resetpassword'] = 'users/resetpassword';
// $route['comments/create/(:any)'] = 'comments/create/$1';
// $route['categories'] = 'category/index';
// $route['categories/create'] = 'category/create';
// $route['categories/posts/(:any)'] = 'category/posts/$1';
// $route['categories/delete/(:any)'] = 'category/delete/$1';
// $route['posts/index'] = 'posts/index';
// $route['posts/update'] = 'posts/update';
// $route['posts/delete/(:any)'] = 'posts/delete/$1';
// $route['posts/create'] = 'posts/create';
// $route['posts/(:any)'] = 'posts/view/$1';
// $route['posts'] = 'posts/index';
$route['page/(:any)'] = 'pages/details/$1';
$route['default_controller'] = 'pages/view';
$route['category/(:any)'] = 'pages/view_category/$1';
$route['addcart/(:any)'] = 'cart/addToCart/$1';
$route['cart/remove/(:any)'] = 'cart/remove/$1';
$route['cart/buypaypal/(:any)'] = 'cart/buypaypal/$1';
$route['cart/ipnpaypal/(:any)'] = 'cart/ipnpaypal/$1';
$route['cart/cancelpaypal/(:any)'] = 'cart/cancelpaypal/$1';
$route['cart/pending/pay/(:any)'] = 'cart/pending_billing_view/$1';
$route['cart/pending/delete/(:any)'] = 'cart/pending_order_delete/$1';
$route['magazine/(:any)/(:any)/(:any)'] = 'pages/view_magazine/$1/$2/$3';
$route['articles_reports'] = 'pages/articles_reports';
$route['articles_reports/(:any)/(:any)'] = 'pages/article_details/$1/$2';
$route['search'] = 'pages/search';

//admin routs
$route['administrator'] = 'administrator/view';
//$route['default_controller'] = 'administrator/view';
$route['administrator/home'] = 'administrator/home';
$route['administrator/index'] = 'administrator/view';
$route['administrator/forget-password'] = 'administrator/forget_password';

$route['administrator/dashboard'] = 'administrator/dashboard';
$route['administrator/magazines/add-magazines'] = 'administrator/add_magazines';
$route['administrator/magazines'] = 'administrator/magazines';
$route['administrator/magazines/update/(:any)'] = 'administrator/update_magazines/$1';
$route['administrator/new-issue/(:any)'] = 'administrator/add_issue/$1';
$route['administrator/issues/(:any)'] = 'administrator/issues/$1';
$route['administrator/update/issues/(:any)'] = 'administrator/update_issues/$1';

$route['administrator/change-password'] = 'administrator/get_admin_data';
$route['administrator/update-profile'] = 'administrator/update_admin_profile';

$route['administrator/publishers/list_publisher'] = 'administrator/list_publisher';
$route['administrator/publishers/add-publisher'] = 'administrator/add_publisher';
$route['administrator/publishers/update-publisher/(:any)'] = 'administrator/update_publisher/$1';
$route['administrator/publishers/view-publisher/(:any)'] = 'administrator/view_publisher/$1';

$route['administrator/users'] = 'administrator/users';
$route['administrator/users/add-user'] = 'administrator/add_user';
$route['administrator/users'] = 'administrator/users';
$route['administrator/users/update-user/(:any)'] = 'administrator/update_user/$1';

$route['administrator/blogs/add-blog'] = 'administrator/add_blog';
$route['administrator/blogs/list-blog'] = 'administrator/list_blog';
$route['administrator/blogs/update-blog'] = 'administrator/update_blog';
$route['administrator/blog-categories/create'] = 'administrator/create_blog_category';
$route['administrator/blog-categories/update/(:any)'] = 'administrator/update_blog_category/$1';
$route['administrator/blog-categories'] = 'administrator/blog_categories';

$route['administrator/magazine-categories/create'] = 'administrator/create_product_category';
$route['administrator/magazine-categories/update/(:any)'] = 'administrator/update_product_category/$1';
$route['administrator/magazine-categories'] = 'administrator/product_categories';
// //not use $route['administrator/magazine-categories/(:any)'] = 'administrator/update_product_category/$1';

// $route['administrator/products/create'] = 'administrator/create_product';
// $route['administrator/products'] = 'administrator/get_products';
// $route['administrator/products/update/(:any)'] = 'administrator/update_products/$1';

// $route['administrator/faq-categories/create'] = 'administrator/create_faq_category';
// $route['administrator/faq-categories/update/(:any)'] = 'administrator/update_faq_category/$1';
// $route['administrator/faq-categories'] = 'administrator/faq_categories';

// $route['administrator/faq/create'] = 'administrator/create_faq';
// $route['administrator/faqs'] = 'administrator/get_faqs';
// $route['administrator/faqs/update/(:any)'] = 'administrator/update_faqs/$1';

// $route['administrator/scopages'] = 'administrator/get_scopages';
// $route['administrator/sco-pages/update/(:any)'] = 'administrator/update_scopages/$1';

// $route['administrator/sociallinks'] = 'administrator/get_sociallinks';
// $route['administrator/sociallinks/update/(:any)'] = 'administrator/update_sociallinks/$1';

// $route['administrator/sliders/create'] = 'administrator/create_slider';
// $route['administrator/sliders'] = 'administrator/get_sliders';
// $route['administrator/sliders/update/(:any)'] = 'administrator/update_slider/$1';

$route['administrator/site-configuration'] = 'administrator/get_siteconfiguration';
$route['administrator/site-configuration/update/(:any)'] = 'administrator/update_siteconfiguration/$1';

$route['administrator/page-contents'] = 'administrator/get_pagecontents';
$route['administrator/page-contents/update/(:any)'] = 'administrator/update_pagecontents/$1';
$route['administrator/order/cancel/(:any)'] = 'administrator/pending_order_delete/$1';

// $route['administrator/galleries/add'] = 'galleries/galleriesLoad';
// $route['administrator/galleries'] = 'galleries/get_gallery_images';

// $route['administrator/blogs/blog-comments'] = 'administrator/list_blog_comments';
// $route['administrator/blogs/view-comment/(:any)'] = 'administrator/view_blog_comments/$1';

// $route['administrator/team/add'] = 'administrator/add_team';
$route['administrator/team/list'] = 'administrator/list_team';
$route['administrator/team/update/(:any)'] = 'administrator/update_team/(:any)';

// $route['administrator/testimonials/add'] = 'administrator/add_testimonial';
// $route['administrator/testimonials/list'] = 'administrator/list_testimonial';
// $route['administrator/testimonials/update/(:any)'] = 'administrator/update_testimonial/(:any)';

// $route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// publisher routes
$route['publisher/dashboard'] = 'publisher/dashboard';
$route['publisher/change-password'] = 'publisher/change_password';
$route['publisher/update-profile'] = 'publisher/update_publisher_profile';

$route['publisher/magazines/add-magazines'] = 'publisher/add_magazines';
$route['publisher/magazines'] = 'publisher/magazines';
$route['publisher/magazines/update/(:any)'] = 'publisher/update_magazines/$1';
$route['publisher/bankdetails'] = 'publisher/update_bank_details';
$route['publisher/new-issue/(:any)'] = 'publisher/add_issue/$1';
$route['publisher/issues/(:any)'] = 'publisher/issues/$1';
$route['publisher/update/issues/(:any)'] = 'publisher/update_issues/$1';

$route['publisher/blogs/add-blog'] = 'publisher/add_blog';
$route['publisher/blogs/list-blog'] = 'publisher/list_blog';
$route['publisher/blogs/update-blog'] = 'publisher/update_blog';
$route['publisher/register'] = 'publisher/register';








