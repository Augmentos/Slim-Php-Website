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

   
Slim::get('/notable-alumni', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('notable-alumni.html');
});




Slim::get('/service-request', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('service-request.html');
});





Slim::get('/alumni-hub', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('alumni-hub.html');
});

Slim::get('/events', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('events.html');
});

Slim::get('/exhibitions', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('exhibitions.html');
});


Slim::get('/groups-and-networks', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('groups-and-networks.html');
});

Slim::get('/alumni-services', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
    Slim::render('alumni-services.html');
});

Slim::get('/parent-and-family-programme', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
    Slim::render('parent-and-family-programme.html');
});

Slim::get('/stay-in-touch', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('stay-in-touch.html');
});

Slim::get('/reunions', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('reunions.html');
});

Slim::get('/meet-the-team', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('meet-the-team.html');
});



Slim::get('/career-mentoring', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('career-mentoring.html');
});

Slim::get('/general-council', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('general-council.html');
});

Slim::get('/ambassadors', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('ambassadors.html');
});

Slim::get('/get-involved', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('get-involved.html');
});

Slim::get('/campus-benefits', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('campus-benefits.html');
});

Slim::get('/giving', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('giving.html');
});


Slim::get('/benefits-and-services', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('benefits-and-services.html');
});

Slim::get('/', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  // Slim::render('home.html');
  Slim::redirect("notable-alumni");
});

Slim::get('/honor-graduates', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('honor-graduates.html');
});

Slim::get('/voice', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('voice.html');
});

Slim::get('/our-alumni', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('our-alumni.html');
});

Slim::get('/volunteering', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('volunteering.html');
});

Slim::get('/voice-magazine', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('voice-magazine.html');
});

Slim::get('/alumni-profiles', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('alumni-profiles.html');
});


Slim::get('/giving', function () {

  // Slim::view()->setData(array("baseURL" => $baseurl,"username"=> $username));
  Slim::render('giving.html');
});

Slim::run();

?>
