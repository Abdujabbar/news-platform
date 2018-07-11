<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:39 PM
 */
namespace controllers;

use core\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $this->render("index", ["welcome" => "You are welcome to index page!"]);
    }
}
