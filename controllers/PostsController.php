<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/17/18
 * Time: 10:48 AM
 */

namespace controllers;

use core\Controller;
use models\Posts;

class PostsController extends Controller
{
    public function actionIndex()
    {
        $this->render('list', ['posts' => Posts::findByConditions()]);
    }


    public function actionCreate()
    {
    }

    public function actionUpdate()
    {
    }

    public function actionDelete()
    {
    }
}
