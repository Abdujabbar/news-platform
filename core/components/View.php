<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:05 PM
 */

namespace core\components;

class View
{
    protected $layout = "layouts/base";

    public function __construct($layout = "")
    {
        if ($layout) {
            $this->layout = $layout . PHP_EXT;
        }
    }




    public function relativelyPath($template = "")
    {
        return VIEWS_PATH . DIRECTORY_SEPARATOR . $template . PHP_EXT;
    }

    public function setLayout($template)
    {
        $this->layout = $template;
    }


    public function render($template = "", $data = [])
    {
        extract($data);

        ob_start();
        if (file_exists($this->relativelyPath($template))) {
            include $this->relativelyPath($template);
        } else {
            echo sprintf("View %s not exists", $template . PHP_EXT);
        }

        $content = ob_get_contents();

        ob_end_clean();

        if (!$this->layout) {
            echo $content;
            die();
        }
        $layout = $this->relativelyPath($this->layout);
        require_once $layout;
    }
}
