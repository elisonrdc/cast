<?php

namespace app\models\definitions;

/**
 * @SWG\Definition(required={"descricao", "data_inicio", "data_fim"})
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="id_categoria", type="integer")
 * @SWG\Property(property="descricao", type="string")
 * @SWG\Property(property="data_inicio", type="string")
 * @SWG\Property(property="data_fim", type="string")
 * @SWG\Property(property="qtd_alunos_turma", type="integer")
 */
class Curso
{
}