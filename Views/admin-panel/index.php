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

Slim::get('/contact-request', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('/contact-request.html');
});


Slim::get('/a_index', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('a_index.html');
});

Slim::get('/login', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('login.html');
});




Slim::get('/add-admin', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('add-admin.html');
});

Slim::get('/profile', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('profile.html');
});


Slim::get('/service-requests', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('service-request.html');
});



Slim::run();

?>