<?php

namespace app\models\definitions;

/**
 * @SWG\Definition(required={"nome", "matricula"})
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="nome", type="string")
 * @SWG\Property(property="matricula", type="string")
 * @SWG\Property(property="email", type="string")
 * @SWG\Property(property="telefone", type="string")
 */
class Aluno
{
}