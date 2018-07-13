<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:39 PM
 */
namespace controllers;

use core\Controller;
use models\Posts;

class MainController extends Controller
{
    public function actionIndex()
    {

        $post = new Posts();
        if($post->validate()) {
            echo "valid";
        } else {
            var_dump($post->getErrors());
        }

//        $postInstance = $post->findByCondition('id', '=', 3);

//        var_dump($postInstance->content);
//        $this->render("index", ["welcome" => "You are welcome to index page!"]);
    }
}
