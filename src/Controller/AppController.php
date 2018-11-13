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

use Cake\Controller\Controller;
use Cake\Controller\Exception\SecurityException;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Event\Event;
use Cake\Http\Exception\UnauthorizedException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Utility\Inflector;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 *
 * @property \Cake\ORM\Table $Table
 * @property \App\Model\Entity\User $current_user
 */
class AppController extends Controller
{

    protected $using_api;
    protected $entity_name;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->using_api = substr($this->getRequest()->getRequestTarget(), 0, strlen('/api')) === '/api';
        $this->entity_name = Inflector::singularize(lcfirst($this->getName()));
        $this->Table = $this->{$this->getName()};

        // load components
        if ($this->using_api) {
//        $this->loadComponent('Auth', [
//            'authenticate' => [
//                'Digest' => [
//                    'fields' => ['username' => ['email', 'phone_number'], 'password' => 'digest_hash'],
//                    'userModel' => 'Users'
//                ],
//            ],
//            'storage' => 'Memory',
//            'unauthorizedRedirect' => false
//        ]);
        } else {
//            $this->loadComponent('Auth', [
//                'authenticate' => [
//                    'Form'
//                ]
//            ]);
        }

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
//        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Flash');

        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get(1);
//        $this->user = $this->Auth->user();
        $this->current_user = $user;
        Configure::write('user_id', $this->current_user->id);
    }

    //======================================================================
    // Default Functions
    //======================================================================

    public function beforeFilter(Event $event)
    {
//        $this->Security->requireSecure();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->load();
    }

    /**
     * View method
     *
     * @param string|null $id Entity id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->get($id);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->create();
    }

    /**
     * Edit method
     *
     * @param string|null $id Entity id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->update($id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Entity id.
     * @return void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->remove($id);
    }

    //======================================================================
    // CRUD Functions
    //======================================================================

    /**
     * Index method
     *
     * @param array|Query $query
     * @param array $options
     * @return \Cake\Http\Response|void
     */
    public function load($query = [], $options = [])
    {
        if ($query instanceof \ArrayObject)
            $query = $this->Table->find('all', $query);
        $entities = $this->paginate($query, $options['pagination'] ?? []);
        if ($this->using_api) {
            $this->setSerialized($entities);
            return;
        }
        $this->set(strtolower($this->getName()), $entities);
    }

    /**
     * View method
     *
     * @param string|null $id Entity id.
     * @param array|Query $query
     * @param array $options
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\UnauthorizedException When the user is not the owner of the entity.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function get($id = null, $query = [], $options = [])
    {
        if ($query instanceof Query) {
            $entity = $query->where(["{$this->getName()}.id" => $id])->first();
            if (is_null($entity))
                throw new RecordNotFoundException("Record not found in table {$this->getName()}");
        } else {
            $entity = $this->Table->get($id, $query);
        }

        if (!$entity->isViewableBy($this->current_user))
            throw new UnauthorizedException();

        if ($this->using_api) {
            $this->setSerialized($entity);
            return;
        }
        $this->set($this->entity_name, $entity);
    }

    /**
     * Add method
     *
     * @param array $options
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create($options = [])
    {
        $entity = $this->Table->newEntity();
        if ($this->request->is('post')) {
            $entity = $this->Table->patchEntity($entity, $this->getRequest()->getData(), $options['objectHydration'] ?? []);

            if (!$entity->isCreatableBy($this->current_user))
                throw new UnauthorizedException();

            if ($this->Table->save($entity)) {
                if ($this->using_api) {
                    return $this->setSerialized(['id' => $entity->id]);
                }
                $this->Flash->success(__("The $this->entity_name has been saved."));
                return $this->redirect(['action' => 'index']);
            }

            $error_message = "The $this->entity_name could not be saved. Please, try again.";
            if ($this->using_api) {
                return $this->setSerialized($error_message, 400);
            }
            $this->Flash->error(__($error_message));
        }

        $this->set($this->entity_name, $entity);
        foreach ($options['viewVars'] ?? [] as $field => $varOptions) {
            if (is_numeric($field)) {
                $field = $varOptions;
                $varOptions = ['limit' => 200];
            }
            $this->set(strtolower($field), $this->Table->{strtoupper($field)}->find('list', $varOptions));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Entity id.
     * @param array $options
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\UnauthorizedException When the user is not the owner of the entity.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update($id = null, $options = [])
    {
        $entity = $this->Table->get($id);

        if (!$entity->isEditableBy($this->current_user))
            throw new UnauthorizedException();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $entity = $this->Table->patchEntity($entity, $this->getRequest()->getData(), $options['ObjectHydration'] ?? []);

            if ($this->Table->save($entity)) {
                if ($this->using_api) {
                    return $this->setSerialized(204);
                }
                $this->Flash->success(__("The $this->entity_name has been saved."));
                return $this->redirect(['action' => 'index']);
            }

            $error_message = "The $this->entity_name could not be saved. Please, try again.";
            if ($this->using_api) {
                return $this->setSerialized($error_message, 400);
            }
            $this->Flash->error(__($error_message));
        }

        $this->set($this->entity_name, $entity);
        foreach ($options['viewVars'] ?? [] as $field => $varOptions) {
            if (is_numeric($field)) {
                $field = $varOptions;
                $varOptions = ['limit' => 200];
            }
            $this->set(strtolower($field), $this->Table->{strtoupper($field)}->find('list', $varOptions));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Entity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function remove($id = null, $options = [])
    {
        $this->request->allowMethod(['post', 'delete']);
        $entity = $this->Table->get($id);

        if (!$entity->isDeletableBy($this->current_user))
            throw new UnauthorizedException();

        if ($this->Table->delete($entity)) {
            if ($this->using_api) {
                return $this->setSerialized(204);
            }
            $this->Flash->success(__("The $this->entity_name has been saved."));
        } else {
            $error_message = "The $this->entity_name could not be deleted. Please, try again.";
            if ($this->using_api) {
                return $this->setSerialized($error_message, 400);
            }
            $this->Flash->error(__($error_message));
        }

        return $this->redirect(['action' => 'index']);
    }

    //======================================================================
    // Utility Functions
    //======================================================================

    /**
     * @param string $error
     * @param SecurityException|null $exception
     * @return \Cake\Http\Response|null
     */
    public function forceSSL($error = '', SecurityException $exception = null)
    {
        if ($exception instanceof SecurityException && $exception->getType() === 'secure') {
            return $this->redirect('https://' . env('SERVER_NAME') . Router::url($this->request->getRequestTarget()));
        }

        throw $exception;
    }

    /**
     * @param array|int|string|EntityInterface|ResultSetInterface $data
     * @param int $status
     */
    protected function setSerialized($data = [], $status = 200)
    {
        if (is_numeric($data) && 100 <= $data && $data < 600) {
            $status = $data;
            $data = [];
        }
        elseif (is_string($data))
            $data = ['message' => $data];
        elseif ($data instanceof EntityInterface || $data instanceof ResultSetInterface)
            $data = $data->toArray();
        elseif (!$data)
            $data = [];

        $this->setResponse($this->getResponse()->withStatus($status)->withType('application/json'));
        $this->set(array_merge($data, ['_serialize' => array_keys($data)]));
    }

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                                                         :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles (default)                         :*/
    /*::                  'K' is kilometers                                      :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at https://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: https://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2017		   		     :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    function greatCircleDistance($lat1, $lng1, $lat2, $lng2, $unit = 'M')
    {
        $theta = $lng1 - $lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == 'K') {
            return ($miles * 1.609344);
        } else if ($unit == 'N') {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
