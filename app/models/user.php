<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
        public $actsAs = array('Acl' => 'requester');
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'unique' => array(
                              'rule'      => 'isUnique',
                              'message'   => 'Already taken',
                              'required' => true,
                          ),
		),
                'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'email' => array(
				'rule' => array('email'),
				'message' => 'dạng email chưa đúng',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'unique' => array(
                              'rule'      => 'isUnique',
                              'message'   => 'đã có người sử dụng',
                              'required' => true,
                          ),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'không để trống',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'confirm_password' => array(
                    'notempty' => array(
                        'rule' => 'notEmpty',
                        'required' => true,
                        'allowEmpty' => false,
                        'on' => 'create',
                        'message' => 'Nhập lại mật khẩu',
                    ),
                    'match' => array(
                        'rule' => 'validateConfirmPasswordMatch',
                        'required' => true,
                        'allowEmpty' => true,
                        'message' => 'Mật khẩu không trùng',
                    ),
                )
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'UserProfile' => array(
			'className' => 'UserProfile',
			'foreignKey' => 'user_id',
                        'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Online' => array(
			'className' => 'Online',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
		'District' => array(
			'className' => 'District',
			'joinTable' => 'districts_experts',
			'foreignKey' => 'expert_id',
			'associationForeignKey' => 'district_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'ExpertGroup' => array(
			'className' => 'ExpertGroup',
			'joinTable' => 'expert_groups_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'expert_group_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	
        
        function validateConfirmPasswordMatch() {
          
            return $this->data['User']['password'] == $this->data['User']['confirm_password'];
        }
        
        public function parentNode() {
  }
  public function bindNode($object) {
    if (!empty($object[$this->alias]['group_id'])) {return array(
        'model' => 'Group',
        'foreign_key' => $object[$this->alias]['group_id']
      );
    }
  }
  
  public static function isUserProduct($user_id, $product_id)
        {
          App::import('model','Product');
          $product = new Product();

          $product_user = $product->find("first", array(
					'conditions' => array(
						'Product.id' => $product_id
					),
					'contain' => array(
						'User' => array(
                  					'conditions' => array('User.id' => $user_id)
                                                        )
						)
					));
	  //var_dump($city_user);
          //echo "sdfsdfsf";
	  if(!empty($product_user["User"]) && $product_user["User"]["id"] == $user_id)
	  {
            return true;
	  }
          return false;
        }
	
	public static function isUserProject($user_id, $project_id)
        {
          App::import('model','Project');
          $p = new Project();

          $p_user = $p->find("first", array(
					'conditions' => array(
						'Project.id' => $project_id
					),
					'contain' => array(
						'User' => array(
                  					'conditions' => array('User.id' => $user_id)
                                                        )
						)
					));
	  //var_dump($city_user);
          //echo "sdfsdfsf";
	  if(!empty($p_user["User"]) && $p_user["User"]["id"] == $user_id)
	  {
            return true;
	  }
          return false;
        }
	
	public static function isUserImage($user_id, $image_id)
        {
		App::import('model','Project');
		$i = new ProductImage();
		$p = new Product();

		$image = $i->find("first", array(
					'conditions' => array(
						'ProductImage.id' => $image_id
				)));

		$product = $p->find("first", array(
					'conditions' => array(
						'Product.id' => $image["ProductImage"]["product_id"]
					),
					'contain' => array(
						'User' => array(
                  					'conditions' => array('User.id' => $user_id)
                                                        )
						)
					));
		
		//var_dump($product);
	  
		if(!empty($product["User"]) && $product["User"]["id"] == $user_id)
		{
			return true;
		}
		
		return false;
        }
	
	public static function isUserNeed($user_id, $need_id)
        {
          App::import('model','Need');
          $p = new Need();

          $p_user = $p->find("first", array(
					'conditions' => array(
						'Need.id' => $need_id
					),
					'contain' => array(
						'User' => array(
                  					'conditions' => array('User.id' => $user_id)
                                                        )
						)
					));
	  //var_dump($city_user);
          //echo "sdfsdfsf";
	  if(!empty($p_user["User"]) && $p_user["User"]["id"] == $user_id)
	  {
            return true;
	  }
          return false;
        }

	public static function isUserCustomer($user_id, $cus_id)
        {
          App::import('model','Customer');
          $product = new Customer();

          $cus_user = $product->find("first", array(
					'conditions' => array(
						'Customer.id' => $cus_id
					),
					'contain' => array(
						'User' => array(
                  					'conditions' => array('User.id' => $user_id)
                                                        )
						)
					));
	  //var_dump($city_user);
          //echo "sdfsdfsf";
	  if(!empty($cus_user["User"]) && $cus_user["User"]["id"] == $user_id)
	  {
            return true;
	  }
          return false;
        }
	
	function createRandomPassword() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    
		srand((double)microtime()*1000000);
	    
		$i = 0;
	    
		$pass = '' ;
	    
	    
	    
		while ($i <= 7) {
	    
		    $num = rand() % 33;
	    
		    $tmp = substr($chars, $num, 1);
	    
		    $pass = $pass . $tmp;
	    
		    $i++;
	    
		}
	    
	    
	    
		return $pass;
	    
	    
	    
	}
	
	public function getExpertGroups()
	{
		return 20;
	}
	
	public static function addPoint($user, $point = 1)
	{
		$udb = new User();
		$user = $udb->read(null, $user);
		
		$user['User']['point'] = $user['User']['point'] + $point;
		
		$udb->id    = $user['User']['id'];			
		if($udb->saveField('point', $user['User']['point']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}



}
