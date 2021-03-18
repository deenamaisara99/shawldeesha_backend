<?php
require __DIR__ . '/../vendor/autoload.php';

//instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

//set up dependencies
require __DIR__ . '/../src/dependencies.php';

//register routes
require __DIR__ . '/../src/routes.php';

// $app->add(new \Internal\OAuth\Middleware());

// $app->get('/', function(\Psr\Http\Message\ServerRequestInterface $req, \Psr\Http\Message\ResponseInterface $res, $args) {
//     $res->getBody()->write(json_encode(['url' => $req->getUri()->__toString(), 'args'=>$args]));
//     return $res->withHeader('content-type', 'application/json');
// });

$app->add(new Tuupola\Middleware\CorsMiddleware);

// $app->add(new Tuupola\Middleware\CorsMiddleware([
//     // "origin" => ["arjunphp.com","localhost"],
//     "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
//     "headers.allow" => [],
//     "headers.expose" => [],
//     "credentials" => false,
//     "cache" => 0,
// ]));

//run app
$app->run();

// $app->options('/{routes:.+}', function ($request, $response, $args) {
//     return $response;
// });

// $app->add(function ($req, $res, $next) {
//     $response = $next($req, $res);
//     return $response
//             ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
//             ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//             ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
// });

// // Catch-all route to serve a 404 Not Found page if none of the routes match
// // NOTE: make sure this route is defined last
// $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
//     $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
//     return $handler($req, $res);
// });