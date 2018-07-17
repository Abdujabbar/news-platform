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
        $this->render(
            "index",
            [   'welcome' =>
                'Hi ' . (
                App::getInstance()->getAuth()->isGuest() ?
                "Guest" :
                App::getInstance()->getAuth()->getUser()->getId()
                )]
        );
    }

    public function actionLogin()
    {
    }

    public function actionLogout()
    {
    }
}
