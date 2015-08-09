<?php
    namespace app\behaviors;
    use yii;
    use yii\base\Behavior;

    class DModuleUrlRules extends Behavior
    {
        public function events()
        {
            return array_merge(parent::events(),array(
                'onBeginRequest'=>'beginRequest',
            ));
        }

        public function beginRequest($event)
        {


            $moduleName = $this->_getCurrentModuleName();
            var_dump($moduleName);
            if(Yii::app()->hasModule($moduleName))
            {
                $class = ucfirst($moduleName) . 'Module';
                Yii::import($moduleName . '.' . $class);
                if(method_exists($class, 'rules'))
                {
                    $urlManager = Yii::app()->getUrlManager();
                    $urlManager->addRules(call_user_func($class .'::rules'));
                }
            }
        }

        protected function _getCurrentModuleName()
        {
            $route = Yii::app()->getRequest()->getPathInfo();
            $domains = explode('/', $route);
            $moduleName = array_shift($domains);
            return $moduleName;
        }
    }