<?php

namespace app\modules\blog;

class BlogModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\blog\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public static function rules()
    {
        return array(
            'blog'=>'blog/default/index',
            'blog/feed'=>'blog/feed/index',
            'blog/search'=>'blog/default/search',
            'blog/tag/<tag:[\w-]+>'=>'blog/default/tag',
            'blog/date/<date:[\w-]+>'=>'blog/default/date',
         //   'blog/<slug:[\w+_-]+>' => 'blog/default/view',
            'blog/<slug:[\w-]+>' => 'blog/view',
            'blog/<id:[\d]+>'=>'blog/post/view',
            'blog/category/<category:.+>'=>'blog/default/category',
        );
    }
}
