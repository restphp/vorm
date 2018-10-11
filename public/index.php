<pre><?php

    use VORM\Users as Users;


    setlocale(LC_ALL, 'pl_PL');

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    define('APP_PATH', realpath('..') . '/');
    define("APP_ENV", 'dev');

    if (APP_ENV === "dev") {
        error_reporting(E_ALL);
        ini_set('error_reporting', E_ALL);
        ini_set("display_errors", 1);
    }

    require_once APP_PATH . 'vendor' . DS . 'autoload.php';


    $vorm = new \VORM\Autoload();

    \VORM\Database\Collection::add(
        (new \VORM\Database\Item())
            ->setUrl("mysql://trendwise:test1234@127.0.0.1:3306/trendwise")
            ->setName('default')
    );

    $result = \VORM\Articles::find();
    var_dump($result);

    // var_dump(\VORM\Database\Collection::list());
    die();

    $users = new Users();
    var_dump($users->getUserName());

    //var_dump($users->table()->getName());

    $fake = new \VORM\Articles();
    // var_dump($fake->table()->getName());

    //RestPHP::DI()->get('module')->setDefault(new App/Frontend/Module());
    //RestPHP::DI()->get('config')->addDir(APP_PATH.'config');
    try {
        // Handle the request
        // $response = $restPHP->handle();
        //$response->send();
    } catch (\Exception $e) {
        // echo 'Exception: ', $e->getMessage();
    }

    ?></pre>