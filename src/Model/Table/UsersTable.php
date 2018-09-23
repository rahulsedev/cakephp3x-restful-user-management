<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->setTable('User');
        $this->hasMany('UserRole', [
            'className' => 'UserRole'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('username')
            ->notEmpty('username');
        $validator
            ->requirePresence('firstName')
            ->notEmpty('firstName');

        $validator
            ->requirePresence('lastName')
            ->notEmpty('lastName');

        $validator
            ->requirePresence('state')
            ->notEmpty('state');

        return $validator;
    }

    /**
     * checkUnique method
     * @param string $username to check uniqueness
     * @param int $uId for update case
     * @return true/false
     */
    public function checkUnique(string $username, int $uId = 0): bool {
        $conditions = $fields = [];
        $fields = ['id'];
        $conditions = ['username' => $username];
        if (isset($uId) && !empty($uId)) {
            $extra['id <>'] = $uId;
            $conditions = array_merge($conditions, $extra);
        }
        $isExists = $this->find('all')->select($fields)->where($conditions)->toArray();
        if (!empty($isExists)) {
            return false;
        } else {
            return true;
        }
    }

}
