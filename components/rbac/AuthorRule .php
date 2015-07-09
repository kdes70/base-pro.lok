<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 17.06.2015
 * Time: 1:48
 */
    namespace app\components\rbac;

    use yii\rbac\Rule;

    /**
     * Checks if authorID matches user passed via params
     */
    class AuthorRule extends Rule
    {
        public $name = 'isAuthor';

        /**
         * @param string|integer $user the user ID.
         * @param Item $item the role or permission that this rule is associated with
         * @param array $params parameters passed to ManagerInterface::checkAccess().
         * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
         */
        public function execute($user, $item, $params)
        {
            return isset($params['post']) ? $params['post']->createdBy == $user : false;
        }
    }

//    $auth = Yii::$app->authManager;
//
//// add the rule
//    $rule = new \app\components\rbac\AuthorRule;
//    $auth->add($rule);
//
//// add the "updateOwnPost" permission and associate the rule with it.
//    $updateOwnPost = $auth->createPermission('updateOwnPost');
//    $updateOwnPost->description = 'Update own post';
//    $updateOwnPost->ruleName = $rule->name;
//    $auth->add($updateOwnPost);
//
//// "updateOwnPost" will be used from "updatePost"
//    $auth->addChild($updateOwnPost, $updatePost);
//
//// allow "author" to update their own posts
//    $auth->addChild($author, $updateOwnPost);