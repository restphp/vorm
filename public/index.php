<pre><?php

    use VORM\Builder\{Column, Where};
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

    // \VORM\Transaction(function() {

    $builder = \VORM\Articles::builder();

    $builder->add((new Column('id'))->setAlias('IDK'));

    $contains1 = new Where('id = :id');
    $contains1->addParam(':id', 123);
    $contains1->or((new Where('id = :id'))->addParam(':id', 333));
    $contains1->and((new Where('id = :id'))->addParam(':id', 4444));

    $builder->add($contains1);

    $builder->add(new Where('id >= :id', [':id' => 77777]));

    $builder->add(new andWhere('id >= :id', [':id' => 77777]));



    /*
        $builder->add(
            (new Where('(@1 OR name = "@2")'))
                ->addParam("@1", new Where("1 = 1 OR 2 = 2"))
                ->addParam("@2", "Dzik")
        );
    */
    var_dump($builder->getSql());

    // });

    //  $result = \VORM\Articles::find();
    //  var_dump($result);

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