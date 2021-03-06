<?php
/**
 * Экшн, отвечающий за активацию аккаунта пользователя
 *
 * @category YupeComponents
 * @package  yupe.modules.user.controllers.account
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://yupe.ru
 *
 **/
class ActivateAction extends CAction
{
    public function run($key)
    {
        // пытаемся сделать выборку из таблицы пользователей
        $user = User::model()->notActivated()->find('activate_key = :activate_key', array(':activate_key' => $key));
        // процедура активации
        $module = Yii::app()->getModule('user');

        if (!$user)
        {
            Yii::app()->user->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('UserModule.user', 'Activation error! Maybe this account already activated! Try to register again')
            );

            $this->controller->redirect(array($module->accountActivationFailure));
        }

        if ($user->activate())
        {
            Yii::log(
                Yii::t('UserModule.user', 'Account with activate_key = {activate_key} was activated!', array('{activate_key}' => $key)),
                CLogger::LEVEL_INFO, UserModule::$logCategory
            );

            Yii::app()->user->setFlash(
                YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('UserModule.user', 'You activate account successfully. Now you can login!')
            );

            // отправить сообщение о активации аккаунта
            $emailBody = $this->controller->renderPartial('accountActivatedEmail', array('model' => $user), true);

            Yii::app()->mail->send($module->notifyEmailFrom, $user->email, Yii::t('UserModule.user', 'Account was activated!'), $emailBody);

            $this->controller->redirect(array($module->accountActivationSuccess));
        }
        else
        {
            Yii::app()->user->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('UserModule.user', 'Account activation error! Try again later!')
            );

            Yii::log(
                Yii::t('UserModule.user', 'There is an error when activating account with activate_key => {activate_key}', array('{activate_key}' => $key)),
                CLogger::LEVEL_ERROR, UserModule::$logCategory
            );

            $this->controller->redirect(array($module->accountActivationFailure));
        }
    }
}