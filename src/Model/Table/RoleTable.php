<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RoleTable extends Table
{
    public function initialize(array $config)
    {
        $this->setTable('Role');
    }
}
