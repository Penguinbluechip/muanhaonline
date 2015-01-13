<?php

class EmailsController extends AppController {
    
    public $components = array(
        'Email' => array(
           'delivery' => 'smtp',
           'smtpOptions' => array(
              'host' => 'ssl://smtp.gmail.com',
              'port' => 465,
              'username' => 'minhluan@hoangkhang.com.vn',
              'password' => 'gauheo'
           )
        )
    );
    
    public $uses = null;
    
    public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('index');
        }
    public function index() {
        $this->Email->to = 'Destination <email@gmail.com>';
        $this->Email->subject = 'Testing the Email component';
        $sent = $this->Email->send('Hello world!');
        if (!$sent) {
           echo 'ERROR: ' . $this->Email->smtpError . '<br />';
        } else {
           echo 'Email sent!';
        }
        $this->_stop();
    }
   
}