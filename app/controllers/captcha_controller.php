<?php

/***
	* Captcha Controller (test) class
	* 
	*
	* PHP versions 5.1.4
	* @filesource
	* @author     Arvind K Thakur
	* @link       http://www.smartdatainc.net/
	* @copyright  Copyright © 2009 Smartdata
	* @version 0.0.1 
	*   - Initial release
	*/

class CaptchaController extends AppController {

	var $name="Captcha"; // test controller name.

	var $uses = null; //i am not using a table here

	var $components = array("Captcha"); //calling captcha component
	
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('captcha_test');
        }

	/**
	 * Creates object of Captcha Component class  
	 *
	 * @return void
	 * @access protected
	 */
	
	function create_captcha()	{
			App::import("Component","Captcha"); //including captcha class
			$this->Captcha =  new CaptchaComponent(); //creating an object instance
			$this->Captcha->controller = & $this; //assign this conroller(CaptchaController) object to its captcha object's controller property.
			$this->set('captcha_src',$captcha_src=$this->Captcha->create()); //create a capthca and assign to a variable
	}

	/**
	 * Process the form to check user has entered a valid captcha code  
	 *
	 * @return void
	 * @access public
	 */

	function captcha_test()	{		
		if(!empty($this->data))	{ //if form is submitted
			if($this->data['User']['ver_code']==$this->Session->read('ver_code'))	{ //comparing both codes
				$this->flash(__("Captcha verification success",true),"captcha_test"); //user has entered a valid verification code
			}	else	{
				$this->flash(__("Captcha verification failure",true),"captcha_test"); //invalid code
			}
		}
		$this->create_captcha(); //not form action performed, create a captch code and show the form
		$this->render();
	}
}
?>