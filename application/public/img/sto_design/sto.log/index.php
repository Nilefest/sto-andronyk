<?php
mb_internal_encoding("UTF-8");

define('DIR', dirname(__FILE__) . '/');
define('ENGINE_DIR', dirname(__FILE__) . '/engine/');
define('APPLICATION_DIR', dirname(__FILE__) . '/application/');

require_once(ENGINE_DIR . 'main/controller.php');
require_once(ENGINE_DIR . 'main/model.php');

require_once(ENGINE_DIR . 'main/registry.php');
require_once(ENGINE_DIR . 'main/config.php');
require_once(ENGINE_DIR . 'main/request.php');
require_once(ENGINE_DIR . 'main/session.php');
require_once(ENGINE_DIR . 'main/response.php');
require_once(ENGINE_DIR . 'main/document.php');
require_once(ENGINE_DIR . 'main/db.php');
require_once(ENGINE_DIR . 'main/user.php');
require_once(ENGINE_DIR . 'main/load.php');
require_once(ENGINE_DIR . 'main/action.php');


$registry = new Registry();

$config = new Config();
$registry->config = $config;

$request = new Request();
$registry->request = $request;

$session = new Session();
$registry->session = $session;

$response = new Response();
$registry->response = $response;

$document = new Document();
$registry->document = $document;

$db = new DB($config->db_type, $config->db_hostname, $config->db_port, $config->db_username, $config->db_password, $config->db_database);
$registry->db = $db;

$load = new Load($registry);
$registry->load = $load;

$action = new Action($registry);
$registry->action = $action;

if(isset($request->post['ifin_login']) && isset($request->post['ifin_pass'])){
    $session->data['ifin_login'] = $request->post['ifin_login'];
    $session->data['ifin_pass'] = $request->post['ifin_pass'];
}

$user = new User($registry);
$registry->user = $user;

if(isset($request->get['logout'])) $registry->user->logout();

if(isset($session->data['lang'])) $config->lang = $session->data['lang'];

if(isset($request->get['lang'])){
    if($request->get['lang'] == 'eng') $config->lang = 'eng';
    else $config->lang = 'rus';
    $_SESSION['lang'] = $config->lang;
    $session->data['lang'] = $config->lang;
}

if(isset($request->get['action'])) $action->make($request->get['action']);
else $action->make('main/index');

$response->output($action->go());
?>
