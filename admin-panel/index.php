<?php
session_start();
/*
*
 * Application and layout framework includes...
 */
require 'Slim/Slim.php';

require 'Views/TwigView.php';

/*
 * Initialize Slim to use the TwigView handler
 */
Slim::init(array('view' => 'TwigView'));

/*
 * Set up default route
 */

/* Setting base url*/

/*Error Pages*/
Slim::notFound(function () {
    Slim::render('404.html');
});


Slim::get('/manage-admins', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('manage-admins.html');
});

Slim::get('/add-home-slider', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('add-home-slider.html');
});

Slim::get('/manage-home-slider', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('manage-home-slider.html');
});


Slim::get('/add-news', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('add-news.html');
});

Slim::get('/manage-news', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('manage-news.html');
});

Slim::get('/contact-request', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('/contact-request.html');
});


Slim::get('/dashboard', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('a_index.html');
});

Slim::get('/login', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('login.html');
});

Slim::get('/logout', function () {

session_destroy();
  Slim::render('login.html');
});

Slim::get('/add-admin', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('add-admin.html');
});

Slim::get('/add-event', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('add-event.html');
});

Slim::get('/manage-event', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('manage-event.html');
});

Slim::get('/profile', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('profile.html');
});


Slim::get('/service-requests', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('service-request.html');
});

Slim::get('/', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::redirect('dashboard');
});



Slim::run();

?>