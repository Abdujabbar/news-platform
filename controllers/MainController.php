<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:39 PM
 */
namespace controllers;

use core\App;
use core\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $this->render("index", ['welcome' => 'Hi!']);
    }

    public function actionLogin()
    {
        if (App::getInstance()->getAuth()->isGuest()) {
            echo "You already logged in";
        } else {
            $this->redirect("/");
        }
    }

    public function actionLogout()
    {
    }
}
