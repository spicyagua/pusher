<?php


require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();


class AppResponse {
  public $isError = false;
  public $payload = null;
}

class AppError {
  public $code = 0;
  public $message = "";
}

class AuthMiddleware extends \Slim\Middleware
{
    public function call()
    {
      if(true) {
        $this->next->call();

        error_log("Resource accessed: " . $this->app->request->getResourceUri());
        return;
      }
        //The Slim application
        $app = $this->app;

        //The Environment object
        $env = $app->environment;

        //The Request object
        $req = $app->request;

        //The Response object
        $res = $app->response;

        //echo "I am middleware";
        $app->response->setStatus(401);

        $errorObj = new AppError();
        $errorObj->code = 1;
        $errorObj->message = "Authentication Required";

        $appResponse = new AppResponse();
        $appResponse->isError = true;
        $appResponse->payload = $errorObj;

        $app->response->headers->set('Content-Type', 'application/json');

        $app->response->write(json_encode($appResponse));


    }
}


//TODO: Nuke the "debug" stuff when in production
$app = new \Slim\Slim(array(
  "debug" => true,
  "log.level" => \Slim\Log::DEBUG,
  "log.enabled" => true
  ));

$app->add(new AuthMiddleware());

$app->get(
    "/a",
    function () use ($app) {

        error_log("get root");

        echo "You are getting root";

    }
);

// GET route
$app->get(
    "/moo/:foo",
    function ($foo) use ($app) {

        error_log("get moo");

        echo "Hello Worldx " . $foo . " doo: " . $app->request->params("doo");

        $someObj = new StdClass;

        $someObj->foo = "baloo";

        echo json_encode($someObj);
    }
);

// POST route
$app->post(
    '/something',
    function () use ($app) {
        $body = $app->request->getBody();
        $bodyJSON = json_decode($body, true);

        error_log(print_r($body, true));
        error_log(print_r($bodyJSON, true));

        $payload = array("saluatation" => "Hi There");
        $payload["orig"] = $bodyJSON["foo"];

        $appResponse = new AppResponse();
        $appResponse->isError = true;
        $appResponse->payload = $payload;

        $app->response->headers->set('Content-Type', 'application/json');

        $app->response->write(json_encode($appResponse));


    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

$app->run();
