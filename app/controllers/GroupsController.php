<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GroupsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for groups
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Groups', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $groups = Groups::find($parameters);
        if (count($groups) == 0) {
            $this->flash->notice("The search did not find any groups");

            $this->dispatcher->forward([
                "controller" => "groups",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $groups,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a group
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $group = Groups::findFirstByid($id);
            if (!$group) {
                $this->flash->error("group was not found");

                $this->dispatcher->forward([
                    'controller' => "groups",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $group->id;

            $this->tag->setDefault("id", $group->id);
            $this->tag->setDefault("lable", $group->lable);
            $this->tag->setDefault("create_at", $group->create_at);
            
        }
    }

    /**
     * Creates a new group
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'index'
            ]);

            return;
        }

        $group = new Groups();
        $group->setLable($this->request->getPost("lable"));
        $group->setCreateAt($this->request->getPost("create_at"));
        

        if (!$group->save()) {
            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("group was created successfully");

        $this->dispatcher->forward([
            'controller' => "groups",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a group edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $group = Groups::findFirstByid($id);

        if (!$group) {
            $this->flash->error("group does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'index'
            ]);

            return;
        }

        $group->lable = $this->request->getPost("lable");
        $group->create_at = $this->request->getPost("create_at");
        

        if (!$group->save()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'edit',
                'params' => [$group->id]
            ]);

            return;
        }

        $this->flash->success("group was updated successfully");

        $this->dispatcher->forward([
            'controller' => "groups",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a group
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $group = Groups::findFirstByid($id);
        if (!$group) {
            $this->flash->error("group was not found");

            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'index'
            ]);

            return;
        }

        if (!$group->delete()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "groups",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("group was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "groups",
            'action' => "index"
        ]);
    }

}
