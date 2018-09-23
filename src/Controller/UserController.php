<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Http\Response;
use Cake\Datasource\Exception\RecordNotFoundException;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */

/**
    @SWG\Swagger(
        host=SWAGGER_API_PATH,
        schemes={"http","https"},
        basePath=SWAGGER_BASE_PATH,
        @SWG\Info(
            title="Navitas User Management APIs",
            description="Navitas User Management APIs description",
            termsOfService="https://www.navitas.com/",
            version="1.0.0"
        )
    )
*/
class UserController extends AppController
{

    private $userTableObj = null;

    public function initialize()
    {        
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->viewBuilder()->className('Json');
        $this->userTableObj = TableRegistry::getTableLocator()->get('Users');
    }

}