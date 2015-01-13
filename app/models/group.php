<?php
class Group extends AppModel {
  public $actsAs = array('Acl' => 'requester');
  public function parentNode() {
    if (empty($this->id) && empty($this->data)) {
      return null;
    }
  $data = $this->data;
    if (empty($data)) {
      $data = $this->find('first', array(
        'conditions' => array('id' => $this->id),
        'fields' => array('parent_id'),
        'recursive' => -1
      ));
    }
    if (!empty($data[$this->alias]['parent_id'])) {
      return $data[$this->alias]['parent_id'];
    }
    return null;
  }
}
?>