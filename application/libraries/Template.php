<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
  * Template
  * 
  * Wordpress like template for CodeIgniter
  * 
  * @package  Template
  * @version  0.1.0
  * @author  TutsforWeb <http://tutsforweb.blogspot.comt>
  * @link   
  * @copyright  Copyright (c) 2011, TutsforWeb
  * @license  http://opensource.org/licenses/mit-license.php MIT Licensed
  * 
  */

  class Template
  {
   private $ci;
   private $tp_name;
   private $data = array();

   public function __construct() {
    $this->ci = &get_instance();
   }

   public function set($name='') {
    $this->tp_name = $name;
   }

   public function load($name = 'index') {
    $this->load_file($name);
   }

   public function get_header($name) {
    if(isset($name)) {
     $file_name = "header-{$name}.php";
     $this->load_file($file_name);
    }
    else {
     $this->load_file('header');
    }
   }

   public function get_sidebar($name) {
    if(isset($name)) {
     $file_name = "sidebar-{$name}.php";
     $this->load_file($file_name);
    }
    else {
     $this->load_file('sidebar');
    }
   }

   public function get_footer($name) {
    if(isset($name)) {
     $file_name = "footer-{$name}.php";
     $this->load_file($file_name);
    }
    else {
     $this->load_file('footer');
    }
   }

   public function get_template_part($slug, $name) {
    if(isset($name)) {
     $file_name = "{$slug}-{$name}.php";
     $this->load_file($file_name);
    }
    else{
     $this->load_file($slug);
    }
   }

   public function load_file($name)
   {
    if($this->get_data($name))
    {
     $data = $this->get_data($name);
     $this->ci->load->view($this->tp_name.'global/'.$name,$data);
    }
    else {
     $this->ci->load->view($this->tp_name.'global/'.$name);
    }
   }

   public function set_data($key, $data) {
    $this->data[$key] = $data;
   }

   public function get_data($key) {
    if(isset($this->data[$key])) {
     return $this->data[$key];
    }
    else {
     return false;
    }
   }
  }
?>