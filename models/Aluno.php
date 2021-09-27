<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property int $id
 * @property string $nome
 * @property string $matricula
 * @property string|null $email
 * @property string|null $telefone
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'matricula'], 'required'],
            [['nome', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            [['matricula'], 'string', 'max' => 20],
            [['telefone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'nome' => 'Nome',
            'matricula' => 'Matrícula',
            'email' => 'E-mail',
            'telefone' => 'Telefone',
        ];
    }
}
