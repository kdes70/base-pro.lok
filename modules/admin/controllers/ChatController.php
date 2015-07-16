<?php
    namespace app\modules\admin\controllers;
    /**
     * Created by PhpStorm.
     * User: ִלטענטי
     * Date: 14.07.2015
     * Time: 20:34
     */

    use yii\web\Controller;
    use sintret\chat\ChatRoom;
    use sintret\chat\models\Chat;

class ChatController extends Controller
{


    public function actionSendChat() {
        $message = $_POST['message'];
        if (empty($message)) {

            echo ChatRoom::data();

        } elseif(!empty($message)) {
            $model = new Chat;
            $model->message = $message;
            if ($model->save()) {
                echo ChatRoom::data();
            } else {
                print_r($model->getErrors());
                exit(0);
            }
        }
    }
}