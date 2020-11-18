<?php

    class roles extends roles_model{

        public function __construct()
        {
            $this->model = new roles_model();
            parent::__construct();
        }

        public function getRoles()
        { 
            $arrData = $this->model->selectRoles();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getRole(int $idRole)
        {
            $id_roles = intval(strClean($idRole));
            if ($id_roles > 0) 
            {
                $arrData = $this->model->selectRole($id_roles);
                if (empty($arrData)) 
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setRole(array $arrData)
        {
            
            $id_roles = intval($arrData[0]);
            $name_role = strval($arrData[1]);
            $description_role = strval($arrData[2]);
            $role_status = intval($arrData[3]);
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");

            if ($id_roles == 0) 
            {
                //crear rol
                $request_role = $this->model->insertRole($name_role, $description_role, $role_status, $created_at, $updated_at);
                $option = 1;
            }else {
                //Actualizar
                $request_role = $this->model->updateRole($id_roles, $name_role, $description_role, $role_status, $updated_at);
                $option = 2;
            }


            if ($request_role > 0) 
            {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                }
            } else if($request_role == 'exist') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención el rol ya existe!');
            }else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }

            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
            die();
            
        }

        public function delRole(int $id_role)
        {
                $id_roles = intval($id_role);
                $requestDelete = $this->model->deleteRole($id_roles);
                if ($requestDelete == 'ok') 
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol.');
                } else if($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un rol asociado a un usuario.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar rol.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

    }

?>