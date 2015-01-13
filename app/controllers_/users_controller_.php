<?php
class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('dashboard', 'admin_login');
    }
    
    public function add() {
      if (!empty($this->data)) {
        $this->User->create();
        if ($this->User->save($this->data)) {
          $this->Session->setFlash('User created!');
          $this->redirect(array('action'=>'login'));
        } else {
          $this->Session->setFlash('Please correct the errors');
        }
      }
      $this->set('groups', $this->User->Group->find('list'));
    }
    public function login() {
    }
    
    public function admin_login() {
        $this->redirect(array('action'=>'login'));
    }
    
    public function logout() {
      $this->redirect($this->Auth->logout());
    }
    public function dashboard() {
        $user = $this->Auth->user();
        if(empty($user))
        {
            $this->redirect(array('action'=>'login'));
        }
        $groupName = $this->User->Group->field('name',
          array('Group.id'=>$this->Auth->user('group_id'))
        );
        $this->redirect(array('action'=>strtolower($groupName)));
    }
    public function user() {
    }
    public function manager() {
    }
    public function administrator() {
    }
}
?>