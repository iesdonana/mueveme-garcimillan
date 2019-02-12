<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticias;

/**
 * NoticiasSearch represents the model behind the search form of `app\models\Noticias`.
 */
class NoticiasSearch extends Noticias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'usuario_id'], 'integer'],
            [['titulo', 'extracto', 'url', 'created_at'], 'safe'],
            [['votos'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Noticias::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'votos' => $this->votos,
            'categoria_id' => $this->categoria_id,
            'usuario_id' => $this->usuario_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'extracto', $this->extracto])
            ->andFilterWhere(['ilike', 'url', $this->url]);

        return $dataProvider;
    }
}
