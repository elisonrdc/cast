<?php

namespace app\models;

use app\utils\Utils;
use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $id
 * @property int|null $id_categoria
 * @property string $descricao
 * @property string $data_inicio
 * @property string $data_fim
 * @property int|null $qtd_alunos_turma
 *
 * @property Categoria $categoria
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'qtd_alunos_turma'], 'integer'],
            [['descricao', 'data_inicio', 'data_fim'], 'required'],
            [['data_inicio', 'data_fim'], 'safe'],
            ['data_inicio', 'verificaDataInicio'],
            [['data_inicio', 'data_fim'], 'verificaPeriodoCurso'],
            [['descricao'], 'string', 'max' => 100],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id']],
            [['descricao'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'id_categoria' => 'Categoria',
            'descricao' => 'Descrição',
            'data_inicio' => 'Data Início',
            'data_fim' => 'Data Fim',
            'qtd_alunos_turma' => 'Qtd Alunos Turma',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }

    public function beforeSave($insert) {

        if($this->data_inicio) { $this->data_inicio = Utils::getDate($this->data_inicio); }
        if($this->data_fim) { $this->data_fim = Utils::getDate($this->data_fim); }

        return parent::beforeSave($insert);
    }

    public function verificaPeriodoCurso($attribute, $params)
    {
        if($this->id) {
            $cursos = Curso::find()->where(['=', 'data_inicio', Utils::getDate($this->data_inicio)])->andWhere(['=', 'data_fim', Utils::getDate($this->data_fim)])->andWhere(['<>', 'id', $this->id])->all();
        } else {
            $cursos = Curso::find()->where(['=', 'data_inicio', Utils::getDate($this->data_inicio)])->andWhere(['=', 'data_fim', Utils::getDate($this->data_fim)])->all();
        }

        if(count($cursos)) {
            $this->addError($attribute, 'Existe(m) curso(s) planejados(s) dentro do período informado.');
        }
    }

    public function verificaDataInicio($attribute, $params)
    {
        if(Utils::getDate($this->data_inicio) < date('Y-m-d')) {
            $this->addError($attribute, '"'.$this->getAttributeLabel($attribute).'"'.' não pode ser menor que a data atual.');
        }
    }
}
