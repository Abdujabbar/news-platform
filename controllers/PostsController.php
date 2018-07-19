<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/17/18
 * Time: 10:48 AM
 */

namespace controllers;

use core\Controller;
use core\http\Response;
use models\Posts;

class PostsController extends Controller
{
    public function actionIndex()
    {
        $limit = $this->getParam("limit") ?? 10;
        $offset = $this->getParam("offset") ?? 0;
        Response::toJSON(['posts' => Posts::findByConditions([], $limit, $offset)]);
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
