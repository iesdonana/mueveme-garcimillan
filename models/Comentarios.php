<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $opinion
 * @property int $usuario_id
 * @property int $noticia_id
 * @property string $created_at
 *
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opinion'], 'string'],
            [['usuario_id', 'noticia_id'], 'default', 'value' => null],
            [['usuario_id', 'noticia_id'], 'integer'],
            [['created_at'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'opinion' => 'Opinion',
            'usuario_id' => 'Usuario ID',
            'noticia_id' => 'Noticia ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('comentarios');
    }
}
