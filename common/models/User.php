<?php
namespace common\models;

use dektrium\user\models\User as DektriumUser;

class User extends DektriumUser
{

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'][]   = 'field';
        $scenarios['update'][]   = 'field';
        $scenarios['register'][] = 'field';
        return $scenarios;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['fieldLength']   = ['about_me', 'string'];

        return $rules;
    }

    /**
     * @return User
     */
    public function getAdmin(): User {
        return self::find()->one();
    }
}