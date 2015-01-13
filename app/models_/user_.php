<?php
class User extends AppModel {
  public $belongsTo = array('Group');
  public $actsAs = array('Acl' => 'requester');
  var $displayField = 'username';
  public function parentNode() {
  }
  public function bindNode($object) {
    if (!empty($object[$this->alias]['group_id'])) {return array(
        'model' => 'Group',
        'foreign_key' => $object[$this->alias]['group_id']
      );
    }
  }
}
?>