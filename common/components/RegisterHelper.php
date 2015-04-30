<?php

namespace common\components;

use Yii;
use common\modules\user\models\User;
use common\modules\user\models\Profile;
use yii\helpers\Url;
use common\models\UserBeforeregister;
use common\models\UserLanguage;

class RegisterHelper {

    // получает модели user и profile после валидации, сохраняет их и отправляет письмо с хеш-ссылкой
    public static function performerRegistrationStep1($user, $profile) {
        $role = Yii::$app->getModule('user')->model('Role');
        $user->setRegisterAttributes($role::EXT_ROLE_PERFORMER, Yii::$app->request->userIP)->save(false);
        $profile->setUser($user->id)->save(false);
        $email = $user->email;

        $obj = new RegisterHelper;
        $code = $obj->returnHash();
        // put first step hash into user_beforeregister
        $beforeRegister = new UserBeforeregister;
        $beforeRegister->user_id = $user->id;
        $beforeRegister->stage = 1;
        $beforeRegister->code = $code;
        if ($beforeRegister->validate()) {
            $beforeRegister->save(false);
            // letter prepare
            $features = [
                'view_path' => 'registration/performer_first',
                'email' => $email,
                'subject' => Yii::t('app', 'Registration Performer') . ' ' . Yii::t('app', 'Step' . ' 1')
            ];
            $data = [
                'title' => Yii::t('app', 'Registration Performer') . ' ' . Yii::t('app', 'Step' . ' 1'),
                'content' => 'passed the first stage of registration to complete the registration click the link below',
                'reference' => Url::to(['/', 'registrate' => 'performer', 'code' => $code], true)
            ];
            $obj->Mailer($features, $data);
        }
    }

    public static function customerRegistrationstep1($user, $profile) {
        $role = Yii::$app->getModule('user')->model('Role');
        $user->setRegisterAttributes($role::EXT_ROLE_CUSTOMER, Yii::$app->request->userIP)->save(false);
        $profile->setUser($user->id)->save(false);
        $email = $user->email;
        
        $obj = new RegisterHelper;
        $code = $obj->returnHash();
        // put first step hash into user_beforeregister
        $beforeRegister = new UserBeforeregister;
        $beforeRegister->user_id = $user->id;
        $beforeRegister->stage = 1;
        $beforeRegister->code = $code;
        if ($beforeRegister->validate()) {
            $beforeRegister->save(false);
            // letter prepare
            $features = [
                'view_path' => 'registration/performer_first',
                'email' => $email,
                'subject' => Yii::t('app', 'Registration Customer') . ' ' . Yii::t('app', 'Step' . ' 1')
            ];
            $data = [
                'title' => Yii::t('app', 'Registration Performer') . ' ' . Yii::t('app', 'Step' . ' 1'),
                'content' => 'passed the first stage of registration to complete the registration click the link below',
                'reference' => Url::to(['/', 'registrate' => 'customer', 'code' => $code], true)
            ];
            $obj->Mailer($features, $data);
        }
    }

    public static function performerRegistrationStep2($post, $user, $profile, $paymentProfile) {
        $arrayValidationErrors = []; // must be empty if validation ok

        $transaction = Yii::$app->db->beginTransaction();

        // действия по регистрации
        $profile->load($post);

        $paymentProfile->paymentProfileLoader($post);
        $paymentProfile->user_id = $user->id;

        if (!empty($post) && isset($post['languages'])) {
            $languages = array_filter($post['languages']);
            /* user language implementation process */
            UserLanguage::userLanguageImplements($languages, $user->id);
        }

        //общая проверка каскад валидации сбор сведений об ошибках
        if (!$profile->validate()) {
            $arrayValidationErrors[] = 'profile validation failure';
        }
        if (!$paymentProfile->validate()) {
            $arrayValidationErrors[] = 'payment profile validate error';
        }

        if (empty($arrayValidationErrors)) {
            $transaction->commit();
            return TRUE;
        } else {
            $transaction->rollback();
            return FALSE;
        }
    }
    public static function customerRegistrationStep2($post, $user, $profile, $paymentProfile) {
        $arrayValidationErrors = []; // must be empty if validation ok

        $transaction = Yii::$app->db->beginTransaction();

        // действия по регистрации
        $profile->load($post);

        $paymentProfile->paymentProfileLoader($post);
        $paymentProfile->user_id = $user->id;

        if (!empty($post) && isset($post['languages'])) {
            $languages = array_filter($post['languages']);
            /* user language implementation process */
            UserLanguage::userLanguageImplements($languages, $user->id);
        }

        //общая проверка каскад валидации сбор сведений об ошибках
        if (!$profile->validate()) {
            $arrayValidationErrors[] = 'profile validation failure';
        }
        if (!$paymentProfile->validate()) {
            $arrayValidationErrors[] = 'payment profile validate error';
        }

        if (empty($arrayValidationErrors)) {
            $transaction->commit();
            return TRUE;
        } else {
            $transaction->rollback();
            return FALSE;
        }
    }

    /*
     * вспомогательный метод определения перехода по ссылке для второй фазы на вход передавать хеш с первой ссылки 
     * проверка работает по надстройке user_beforeregister и возвращает id юзера, созданного по первой стадии регистрации
     * работает на странице индекса сайта
     */

    public static function checkFirstReference($hash) {
        $before = UserBeforeregister::find()->where([
                    'code' => \yii\helpers\Html::encode($hash),
                    'stage' => 1,
                    'completed' => UserBeforeregister::STAGE_OPEN,
                ])->one();
        if (is_null($before)) {
            throw new \yii\web\HttpException('404 activation reference not exists');
        } else {
            $user = User::find()->where('id = :id', [':id' => $before->user_id])->one();
            if (is_null($user)) {
                throw new \yii\web\HttpException('500 user will be not created');
            } else {
                return $user->id;
            }
        }
    }

    /* метод проставляет статус completed для отработанной стадии регистрации пользователя */

    public static function lockRegisterStage($user_id, $stage = 1) {
        UserBeforeregister::updateAll(['completed' => UserBeforeregister::STAGE_CLOSE], ['user_id' => (int) $user_id, 'stage' => (int) $stage]);
    }

    /* additions */
    /*
     * $features is array: 
     *     view_path - path to composed letter view: for example complaint/ban - all templates - common/mail directory
     *     email - string with competelly e-mail: admin@example.com.ua
     *     subject - letter subject
     * $data is array:
     *     key - mark in view
     *     value - value for render mark in view
     */

    private function Mailer($features = [], $data = []) {
        if (empty($features) || empty($data)) {
            throw new \yii\web\HttpException('500 mail features not set');
        }

        Yii::$app->mailer->compose($features['view_path'], $data)
                ->setTo($features['email'])
                ->setSubject($features['subject'])
                ->send();
    }

    private function returnHash() {
        $target = md5(date('Y-m-d H:i:s'));
        $arr = str_split($target, 1);
        shuffle($arr);
        $prepare = implode('', $arr);
        $hash = substr($prepare, 0, 30);
        return $hash;
    }

}
