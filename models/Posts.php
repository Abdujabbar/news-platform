<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/13/18
 * Time: 3:40 PM
 */

namespace models;

use \core\database\ActiveRecord;

/**
 * Class Posts
 * @package models
 */
class Posts extends ActiveRecord
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content'];


    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            ['title', 'string', 'min' => 3, 'max' => 30],
        ];
    }
}
