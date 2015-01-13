<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
        Router::connect('/', array('controller' => 'home', 'action' => 'index'));
        Router::connect('/admin', array('controller' => 'users', 'action' => 'login'));
        Router::connect('/manager', array('controller' => 'users', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        Router::connect('/nganluong.txt', array('controller' => 'nganluong', 'action' => 'index'));
        
        Router::connect('/ds_san_pham',
                            array('controller' => 'products', 'action' => 'index'),
                            array(
                               
                            )
                         );
        
        Router::connect('/dasach_san_pham',
                            array('controller' => 'products', 'action' => 'reset'),
                            array(
                               
                            )
                         );
        
        Router::connect('/tin_tuc',
                            array('controller' => 'contents', 'action' => 'index'),
                            array(
                               
                            )
                         );
        
        Router::connect('/du_an',
                            array('controller' => 'projects', 'action' => 'index'),
                            array(
                               
                            )
                         );
        
        Router::connect('/gioi_thieu',
                            array('controller' => 'home', 'action' => 'aboutus'),
                            array(
                               
                            )
                         );
        Router::connect('/lien_he/:id',
                            array('controller' => 'contacts', 'action' => 'view'),
                            array(
                               'pass' => array('id'),
                               'id' => '\d+'
                            )
                         );
        
        Router::connect('/san_pham/:filter_category_id-:category',
                            array('controller' => 'products', 'action' => 'index'),
                            array(
                               'pass' => array('filter_category_id'),
                               'filter_category_id' => '\d+',
                               'category' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/san_pham/tinh-thanh/:filter_city_id-:city',
                            array('controller' => 'products', 'action' => 'index'),
                            array(
                               'pass' => array('filter_city_id'),
                               'filter_city_id' => '\d+',
                               'city' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/san_pham/tinh-thanh/:filter_city_id-:city/:filter_district_id-:district',
                            array('controller' => 'products', 'action' => 'index'),
                            array(
                               'pass' => array('filter_city_id', 'filter_district_id'),
                               'filter_city_id' => '\d+',
                               'city' => '[^-]+',
                               'filter_district_id' => '\d+',
                               'district' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/san_pham/loai/:filter_category_id-:category',
                            array('controller' => 'products', 'action'=>'productsByCategory'),
                            array(
                               'pass' => array('filter_category_id'),
                               'filter_category_id' => '\d+',
                               'category' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/du_an/:city/:id-:name',
                            array('controller' => 'projects', 'action' => 'details'),
                            array(
                               'pass' => array('id'),
                               'id' => '\d+',
                               'name' => '[^-]+',
                               'city' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/chi_tiet_sp/:city/:id-:name',
                            array('controller' => 'products', 'action' => 'details'),
                            array(
                               'pass' => array('id'),
                               'id' => '\d+',
                               'name' => '[^-]+',
                               'city' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/tin_tuc/:category/:id-:name',
                            array('controller' => 'contents', 'action' => 'details'),
                            array(
                               'pass' => array('id'),
                               'id' => '\d+',
                               'name' => '[^-]+',
                               'category' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/tin_tuc/:id-:category',
                            array('controller' => 'contents', 'action' => 'category'),
                            array(
                               'pass' => array('id'),
                               'id' => '\d+',                               
                               'category' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );
        
        Router::connect('/san_pham/du_an/:filter_project_id-:project',
                            array('controller' => 'products', 'action' => 'productsByProject'),
                            array(
                               'pass' => array('filter_project_id'),
                               'filter_project_id' => '\d+',
                               'project' => '[^-]+'
                               //'title' => '[^-]+'
                            )
                         );