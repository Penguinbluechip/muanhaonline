<?php
echo $this->Form->create();
echo $this->Form->inputs(array('legend' => 'Signup',
  'username',
  'password',
  'email',
  'group_id'
));
echo $this->Form->end('Submit');
?>