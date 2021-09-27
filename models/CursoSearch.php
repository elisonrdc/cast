<?php

namespace app\models;

use app\utils\Utils;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CursoSearch represents the model behind the search form of `app\models\Curso`.
 */
class CursoSearch extends Curso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_categoria', 'qtd_alunos_turma'], 'integer'],
            [['descricao', 'data_inicio', 'data_fim'], 'safe'],
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
        $query = Curso::find()
            ->leftJoin('categoria', 'categoria.id = curso.id_categoria');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'descricao',
                    'data_inicio',
                    'data_fim',
                    'qtd_alunos_turma',
                    'categoria.descricao' => [
                        'asc' => ['categoria.descricao' => SORT_ASC],
                        'desc' => ['categoria.descricao' => SORT_DESC]
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'curso.id' => $this->id,
            'curso.id_categoria' => $this->id_categoria,
            'curso.qtd_alunos_turma' => $this->qtd_alunos_turma,
        ]);

        $query->andFilterWhere(['like', 'curso.descricao', $this->descricao]);

        if($this->data_inicio) {
            $query->andFilterWhere(['=', 'curso.data_inicio', Utils::getDate($this->data_inicio)]);
        }

        if($this->data_inicio) {
            $query->andFilterWhere(['=', 'curso.data_fim', Utils::getDate($this->data_fim)]);
        }

        return $dataProvider;
    }
}
