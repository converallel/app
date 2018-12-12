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
use Cake\Datasource\ResultSetInterface;
use Cake\Event\Event;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Query;
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
 * @property \App\Model\Entity\User|null $current_user
 * @property \Cake\ORM\Table $Table
 * @property boolean $using_api
 */
class AppController extends Controller
{

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

        $acceptsContentTypes = $this->getRequest()->accepts();
        $this->using_api = !empty(array_intersect(['application/json', 'application/xml'], $acceptsContentTypes));
        if (in_array('text/html', $acceptsContentTypes)) {
            $this->using_api = false;
        }
        $this->Table = $this->{$this->getName()};
        $this->entity_name = Inflector::singularize(lcfirst($this->getName()));

        // load components
        if ($this->using_api) {
//            $this->loadComponent('Auth', [
//                'authenticate' => ['JWT'],
//                'storage' => 'Memory',
//                'unauthorizedRedirect' => false,
//            ]);
        }

//        $this->loadComponent('Auth', [
//            'authenticate' => [
//                'OAuth2' => [
//                    'providers' => [
//                        'Native' => [
//                            'className' => '\Native\OAuth2\Client\Provider\Native',
//                            // all options defined here are passed to the provider's constructor
//                            'options' => [
//                                'clientId' => 'foo',
//                                'clientSecret' => 'bar',
//                            ],
//                            'mapFields' => [
//                                'username' => 'login', // maps the app's username to github's login
//                            ],
//                            // ... add here the usual AuthComponent configuration if needed like fields, etc.
//                        ],
//                    ]
//                ]
//            ]
//        ]);

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
//        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Flash');

        $users = \Cake\ORM\TableRegistry::getTableLocator()->get('Users');
        $user = $users->get(1);
        $this->current_user = $user;
//        $this->current_user = $this->Auth->user();
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
     * @return \Cake\Http\Response|null
     */
    public function load($query = [], $options = [])
    {
        if (is_array($query)) {
            $query = $this->Table->find('all', $query);
        }
        $entities = $this->paginate($query, $options['pagination'] ?? []);
        if ($this->using_api) {
            return $this->setSerialized($entities);
        }
        $this->set(lcfirst($this->getName()), $entities);
    }

    /**
     * View method
     *
     * @param string|null $id Entity id.
     * @param array|Query $query
     * @param array $options
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When the user is not the authorized to view this entity.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function get($id = null, $query = [], $options = [])
    {
        if ($query instanceof Query) {
            $entity = $query->where(["{$this->getName()}.id" => $id])->first();
            if (is_null($entity)) {
                throw new NotFoundException();
            }
        } else {
            $entity = $this->Table->get($id, $query);
        }

        if (!$entity->isViewableBy($this->current_user)) {
            throw new ForbiddenException();
        }

        if ($this->using_api) {
            return $this->setSerialized($entity);
        }

        $this->set($this->entity_name, $entity);
    }

    /**
     * Add method
     *
     * @param array $options
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Cake\Http\Exception\ForbiddenException When the user is not the authorized to create this entity.
     */
    public function create($options = [])
    {
        $entity = $this->Table->newEntity();
        if ($this->getRequest()->is('post')) {
            $entity = $this->Table->patchEntity($entity, $this->getRequest()->getData(),
                $options['objectHydration'] ?? []);

            if (!$entity->isCreatableBy($this->current_user)) {
                throw new ForbiddenException();
            }

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
        $this->setExtraViews($options['viewVars']);
    }

    public function addMany($options = [])
    {
        $entities = $this->Table->newEntities($this->getRequest()->getData());
        if ($this->getRequest()->is('post')) {
            foreach ($entities as $entity) {
                if (!$entity->isCreatableBy($this->current_user)) {
                    throw new ForbiddenException();
                }
            }

            if ($this->Table->saveMany($entities)) {
                $ids = array_map(function ($entity) {
                    return ['id' => $entity->id];
                }, $entities);

                if ($this->using_api) {
                    return $this->setSerialized($ids);
                }
                $this->Flash->success(__("The {$this->getName()} has been saved."));

                return $this->redirect(['action' => 'index']);
            }

            $error_message = "The {$this->getName()} could not be saved. Please, try again.";
            if ($this->using_api) {
                return $this->setSerialized($error_message, 400);
            }

            $this->Flash->error(__($error_message));
        }

        $this->set($this->entity_name, $entity);
        $this->setExtraViews($options['viewVars']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Entity id.
     * @param array $options
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\ForbiddenException When the user is not the authorized to edit this entity.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update($id = null, $options = [])
    {
        $entity = $this->Table->get($id);

        if (!$entity->isEditableBy($this->current_user)) {
            throw new ForbiddenException();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $entity = $this->Table->patchEntity($entity, $this->getRequest()->getData(),
                $options['ObjectHydration'] ?? []);

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
        $this->setExtraViews($options['viewVars']);
    }

    /**
     * Delete method
     *
     * @param array|string|null $id Entity id.
     * @param array $options options accepted by `Table::find()`.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Http\Exception\ForbiddenException When the user is not the authorized to delete this entity.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function remove($id = null, $options = [])
    {
        $this->request->allowMethod(['post', 'delete']);

        if (is_array($id)) {
            $entity = $this->Table->find('all', $options)->where($id)->first();
            if (is_null($entity)) {
                throw new NotFoundException();
            }
        } else {
            $entity = $this->Table->get($id, $options);
        }

        if (!$entity->isDeletableBy($this->current_user)) {
            throw new ForbiddenException();
        }

        if ($this->Table->delete($entity)) {
            if ($this->using_api) {
                return $this->setSerialized(204);
            }
            $this->Flash->success(__("The $this->entity_name has been deleted."));
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
    public function setSerialized($data = [], $status = 200)
    {
        if (is_int($data) && 100 <= $data && $data < 600) {
            $status = $data;
            $data = [];
        } elseif (is_string($data)) {
            $data = ['message' => $data];
        } elseif ($data instanceof EntityInterface || $data instanceof ResultSetInterface) {
            $data = $data->toArray();
        } elseif (!$data) {
            $data = [];
        }

        $this->setResponse($this->getResponse()->withStatus($status));
        $this->set(array_merge($data, ['_serialize' => array_keys($data)]));
    }

    /**
     * `find()` the fields of the table and `set()` them .
     * @param array $viewVars e.g. ['tags', 'files' => ['contain' => 'Users'], ...]
     */
    public function setExtraViews($viewVars = [])
    {
        foreach ($viewVars as $field => $options) {
            if (is_numeric($field)) {
                $field = $options;
                $options = ['limit' => 10];
            }
            $this->set(lcfirst($field), $this->Table->{ucfirst($field)}->find('list', $options));
        }
    }

    /**
     * Incorporates the routing parameters into the request body if they exist
     * @param array|string $params
     */
    public function incorporateRoutingParams(...$params)
    {
        $body = $this->getRequest()->getParsedBody();
        foreach ($params as $param) {
            if ($value = $this->getRequest()->getParam($param)) {
                $body[$param] = $value;
            }
        }
        $this->setRequest($this->getRequest()->withParsedBody($body));
    }
}
