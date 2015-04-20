<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\helpers;

/**
 * Description of ContactsHelper
 *
 * @author Andrey
 */
class ContactsHelper {
    
    /**
     * 
     * @param \common\modules\user\models\User $user
     * @return boolean
     */
    private static function checkUser(\common\modules\user\models\User $user){
        return $user->id === \Yii::$app->user->id;
    }
    
    /**
     * 
     * @param string $email
     * @return string
     */
    public static function hideEmail($email){
        $parts = explode('@', $email);
        $parts[0] = implode('', array_fill(0, mb_strlen($parts[0]), 'X'));
        return implode('@', $parts);
    }
    
    /**
     * 
     * @param string $phone
     * @return string
     */
    public static function hidePhone($phone){
        return preg_replace('/\d/', 'X', $phone);
    }
    
    /**
     * 
     * @param string $phone
     * @return string
     */
    public static function preparePhone($phone){
        $parts = explode('-', $phone);
        return '(' . array_shift($parts) . ') ' . implode('-', $parts);
    }
    
    /**
     * 
     * @param \common\modules\user\models\User $user
     * @param boolean $hidden* 
     * @return string
     */
    public static function getEmail(\common\modules\user\models\User $user, $hidden=null){
        $canView = $hidden === null ? self::checkUser($user) : $hidden;
        if($canView){
            return $user->email;
        }
        return self::hideEmail($user->email);
        
    }
    
    /**
     *
     * @param \common\modules\user\models\Profile $profile
     * @param boolean $hidden
     * @return string
     */
    public static function getPhone(\common\modules\user\models\Profile $profile, $hidden=null){
        $canView = $hidden === null ? self::checkUser($user) : $hidden;
        $phoneShown = self::preparePhone($profile->phone);
        if($canView){
            return $phoneShown;
        }
        return self::hidePhone($phoneShown);
    }
    
    /**
     * 
     * @param \common\modules\user\models\User $user
     * @return array
     */
    public static function getLanguages(\common\modules\user\models\User $user){
        $query = new \yii\db\Query;
        $languages = $query->select('user_language.is_native, language.name, language.full_name')
                ->from('user_language')
                ->innerJoin('language', 'language.id = user_language.language_id')
                ->where(['user_language.user_id' => $user->id])
                ->orderBy('user_language.is_native DESC')
                ->all();

        return $languages;
    }
    
    public static function getFullName(\common\modules\user\models\Profile $profile){
        $firstName = trim($profile->first_name);
        $lastName = trim($profile->last_name);
        $fullName = trim($profile->full_name);
        return (empty($firstName)|| empty($lastName))
            ? (!empty($fullName)? $fullName : $profile->user->username)
            : $firstName . ' ' . $lastName;
    }
}
