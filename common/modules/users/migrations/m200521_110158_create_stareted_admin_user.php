<?php namespace modules\users\migrations;


use modules\users\models\BaseUsers;
use modules\users\models\console\Users;
use yii\db\Migration;

/**
 * Class m200521_110158_create_stareted_admin_user
 */
class m200521_110158_create_stareted_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $users = \modules\users\models\backend\Users::find()->exists();

        \Yii::$app->i18n->translations['modules/users/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/users/messages',
            'fileMap' => [
                'modules/users/main' => 'main.php',
                'modules/users/log'  => 'log.php',
            ]
        ];


        $mail = \Yii::$app->params['initData']['adminEmail'];
        $name = \Yii::$app->params['initData']['adminName'];
        $pass = \Yii::$app->params['initData']['adminPass'];
        if (!$users) {
            echo "\n No one users found. Create started ADMIN user with next auth data:\n    email: $mail \n    name: $name \n    pass: $pass \n\n";

            $newUser = new BaseUsers([
                'email'       => $mail,
                'first_name'  => $name,
                'password'    => \Yii::$app->security->generatePasswordHash($pass)
            ]);

            if ($newUser->save()) {
                echo "\n Saved successful \n";
                return true;
            } else {
                echo "\n Error on save \n";
                return false;
            }

        } else {
            echo "\n Some users found. Skip creating default Admin user \n\n";
        }
    }




    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200521_110158_create_stareted_admin_user cannot be reverted.\n";

        return false;
    }

}
