<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../backend/model/roles_model.php';
require '../../backend/controller/roles.php';

$app = new \Slim\App;

// get car_type all car
$app->get('/api/getRoles', function(Request $request, Response $response)
{
    $all_roles = new roles();
    $all_roles->getRoles();
    $status = $response->getStatusCode();
});

//get role
$app->get('/api/getRole/{id}', function(Request $request, Response $response)
{
    $id_roles = $request->getAttribute('id');
    $getRole = new roles();
    $getRole->getRole($id_roles);
});

//post cart_type insert new cars_type
$app->post('/api/roles/setRoles', function(Request $request, Response $response)
{
    $id_roles = $request->getParam('idRole');
    $name_role = $request->getParam('name_role');
    $description_role = $request->getParam('description_role');
    $role_status = $request->getParam('role_status');
    $arrData = array($id_roles, $name_role, $description_role, $role_status);
    $roles = new roles();
    $roles->setRole($arrData);
});

//delete role
$app->delete('/api/deleteRole/{id}', function(Request $request, Response $response)
{
    $id_roles = $request->getAttribute('id');
    $getRole = new roles();
    $getRole->delRole($id_roles);
});