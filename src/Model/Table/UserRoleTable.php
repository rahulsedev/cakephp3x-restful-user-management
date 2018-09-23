<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UserRoleTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Role', [
            'className' => 'Role'
        ]);
        $this->setTable('User_Role');
    }

}
