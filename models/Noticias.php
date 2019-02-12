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
 * @property string $url
 * @property int $categoria_id
 * @property int $usuario_id
 * @property string $created_at
 *
 * @property Categorias $categoria
 * @property Usuarios $usuario
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
            [['titulo', 'url', 'categoria_id'], 'required'],
            [['votos'], 'number'],
            [['extracto', 'url'], 'string'],
            [['categoria_id', 'usuario_id'], 'default', 'value' => null],
            [['categoria_id', 'usuario_id'], 'integer'],
            [['created_at'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
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
            'titulo' => 'Titulo',
            'votos' => 'Votos',
            'extracto' => 'Extracto',
            'url' => 'Url',
            'categoria_id' => 'Categoria ID',
            'usuario_id' => 'Usuario ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id']);
    }
}
