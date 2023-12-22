<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $fio;
    public $login;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;
    public $check;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        [['fio', 'login', 'email', 'password', 'phone'], 'required', 'message' => 'Должно быть заполнено!'],
        [['fio', 'login', 'email', 'password', 'phone'], 'string', 'max' => 255, 'message' => 'Слишком много символов'],
        ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Должно совпадать с паролем'],
        ['fio', 'match', 'pattern' => '/^[А-ЯЁа-яё\s\-]+$/u', 'message' => 'Только кириллические буквы, без цифр и знаков препинания.'],
        ['login', 'match', 'pattern' => '/^[A-Za-z]+$/i', 'message' => 'Только латиница'],
        ['phone', 'match', 'pattern' => '/^\+7\s\(\d{3}\)\s\d{3}(\-\d{2}){2}$/', 'message' => 'Неверный формат номера'],
        ['email', 'email', 'message'=>'Только валидный email адрес'],
        [['login', 'email'], 'unique','message' => 'Такой {attribute} уже зарегестрирован' ,'targetClass' => User::class],
        ['check', 'required', 'requiredValue' => 1, 'message' => 'Согласие на обработку персональных данных должно быть отмечено'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'Ф.И.О',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'password_repeat' => 'Повтор пароля',
            'check' => 'Согласие на обработку персональных данных',
        ];
    }

 
    public function register()
    {
        if ($this->validate()) {
            $user = new User();

            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->authKey = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('User');

            if(!$user->save()){
                Yii::$app->session->setFlash('danger', 'ашыбка');
                return "ашыбка";
            }
        }
        return $user ?? false;
    }
}
