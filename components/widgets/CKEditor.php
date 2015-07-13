<?php
    /**
     * Created by PhpStorm.
     * User: ִלטענטי
     * Date: 14.07.2015
     * Time: 0:16
     */
    namespace app\components\widgets;

    use yii\helpers\ArrayHelper;

    use iutbay\yii2kcfinder\KCFinderAsset;

use Yii;
    use iutbay\yii2kcfinder\KCFinderInputWidget ;



    class CKEditor extends \mihaildev\ckeditor\CKEditor
    {

        public $enableKCFinder = true;

        /**
         * Registers CKEditor plugin
         */
        public function init()
        {


            if ($this->enableKCFinder)
            {
                $this->registerKCFinder();
            }
            parent::init();
        }

        /**
         * Registers KCFinder
         */
        protected function registerKCFinder()
        {
            $register = KCFinderAsset::register($this->view);
            $kcfinderUrl = $register->baseUrl;

            $browseOptions = [
                'filebrowserBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=files',
                'filebrowserUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=files',
            ];

            $this->editorOptions = ArrayHelper::merge($browseOptions, $this->editorOptions);


        }

    }