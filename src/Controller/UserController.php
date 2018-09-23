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

    /**
    @SWG\Get(
        path="/users",
        summary="List of users",
        description="Retrieve list of user",
        tags={"Users"},
        consumes={"application/json"},
        produces={"application/json"},
        @SWG\Response(
            response="200",
            description="Successful operation",
            @SWG\Schema(
                type="array",
                @SWG\Items(
                    type="object",
                    @SWG\Property(property="id",
                        type="integer",
                        description="Id of user"
                    ),
                    @SWG\Property(
                        property="username",
                        type="string",
                        description="Username of user"
                    ),
                    @SWG\Property(
                        property="firstName",
                        type="string",
                        description="First name of user"
                    ),
                    @SWG\Property(
                        property="lastName",
                        type="string",
                        description="Last name of user"
                    ),
                    @SWG\Property(
                        property="state",
                        type="boolean",
                        description="State of user"
                    )
                )
            )
        ),
        @SWG\Response(
            response="500",
            description="Server error occured"
        )
    )
    */
    public function index()
    {
        $limitRecords = 10;
        $users = $this->userTableObj->find('all')->limit($limitRecords);
        $this->renderResponse([
            'users' => $users,
            '_serialize' => 'users'
        ], 200);
    }

    /**
    @SWG\Get(
        path="/users/{id}",
        summary="Details of user",
        description="Retrieve details of user",
        tags={"Users"},
        consumes={"application/json"},
        produces={"application/json"},
        @SWG\Parameter(
            name="id",
            description="Primary key of User table",
            in="path",
            required=true,
            type="integer",
            default=""
        ),
        @SWG\Response(
            response="200",
            description="Successful operation",
            @SWG\Schema(
                type="array",
                @SWG\Items(
                    type="object",
                    @SWG\Property(property="id",
                        type="integer",
                        description="Id of user"
                    ),
                    @SWG\Property(
                        property="username",
                        type="string",
                        description="Username of user"
                    ),
                    @SWG\Property(
                        property="firstName",
                        type="string",
                        description="First name of user"
                    ),
                    @SWG\Property(
                        property="lastName",
                        type="string",
                        description="Last name of user"
                    ),
                    @SWG\Property(
                        property="state",
                        type="boolean",
                        description="State of user"
                    )
                )
            )
        ),
        @SWG\Response(
            response="404",
            description="Not found"
        )
    )
    */
    public function view($id)
    {
        $response = [];
        $statusCode = 500;
        if (!empty($id))
        $userEnt = $this->userTableObj->findById($id)->first();
                
        // check if request resource exists or not
        if (!empty($userEnt)) {
            $response = [
                'user' => $userEnt,
                '_serialize' => 'user'
            ];
            $statusCode = 200;
        } else {
            $statusCode = 404;
            $message = __('Resource not found.');
            $response = [
                'message' => $message,
                '_serialize' => ['message']
            ];
        }
        $this->renderResponse($response, $statusCode);
    }
    
    private function renderResponse(array $body, int $code) {
        $this->set($body);
        $this->response->statusCode($code);
    }    
}