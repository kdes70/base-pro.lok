<?php
    /**
     * Created by PhpStorm.
     * User: Äìèòğèé
     * Date: 14.07.2015
     * Time: 0:16
     */
    namespace app\components\widgets;

    use Yii;
    use yii\helpers\ArrayHelper;
    use iutbay\yii2kcfinder\KCFinderAsset;

    class KCFinder extends \iutbay\yii2kcfinder\KCFinderInputWidget
    {

      //  public $enableKCFinder = true;
      //  public static $kcfBrowseOptions =
        /**
         * Registers CKEditor plugin
         */
        public function init()
        {


            parent::init();

            $kcfOptions = ArrayHelper::merge(KCFinder::$kcfDefaultOptions,
            [
                'uploadURL' => Yii::getAlias('@web').'/upload',
                'disabled'=>false,
                'access' => [
                    'files' => [
                        'upload' => true,
                        'delete' => true,
                        'copy' => true,
                        'move' => true,
                        'rename' => true,
                    ],
                    'dirs' => [
                        'create' => true,
                        'delete' => true,
                        'rename' => true,
                    ],
                ],
                'lang'=> 'ru',
            ]);


            Yii::$app->session->set('KCFINDER', $kcfOptions);



         //   $kcfBrowseOptions = ArrayHelper::merge(KCFinder::$kcfBrowseOptions,['lang'=> 'ru']);



        }

    }