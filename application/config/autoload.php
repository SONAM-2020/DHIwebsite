<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'form_validation','pagination', 'session','xmlrpc','email','upload','encryption' );

$autoload['drivers'] = array();

$autoload['helper'] = array('url','file','form','security','string','inflector','directory','download');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('CommonModel');
