<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'usuarios';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['usuario_id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    // Cambia aquí para buscar por correo
    public static function findByCorreo($correo)
    {
        return static::findOne(['email' => $correo]);
    }

    public function getId()
    {
        return $this->usuario_id;
    }

    public function getAuthKey()
    {
        // Si no tienes auth_key, puedes retornar null o agregar un campo auth_key
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Si no usas auth_key, retorna siempre true
        return true;
    }

    public function validatePassword($password)
    {
        // Si usas hash:
        // return Yii::$app->security->validatePassword($password, $this->password_hash);

        // Si usas texto plano:
        return $this->password_hash === $password;
    }
    public function isAdmin() {
    return $this->rol === 'admin';
}
}