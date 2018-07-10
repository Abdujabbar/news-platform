<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 11:32 AM
 */

require_once __DIR__ . "/../config/defines.php";

require_once APP_ROOT . DIRECTORY_SEPARATOR . "bootstrap.php";

$configs = require_once  CONFIG_PATH . DIRECTORY_SEPARATOR . "app.php";


\core\App::getInstance(\core\Configs::getInstance($configs))->run();
