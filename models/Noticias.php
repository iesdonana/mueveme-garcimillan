<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string $votos
 * @property string $extracto
 * @property int $autor
 * @property string $created_at
 *
 * @property Usuarios $autor0
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['votos'], 'number'],
            [['extracto'], 'string'],
            [['autor'], 'default', 'value' => null],
            [['autor'], 'integer'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
            [['autor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['autor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'votos' => 'Votos',
            'extracto' => 'Extracto',
            'autor' => 'Autor',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'autor']);
    }
}
