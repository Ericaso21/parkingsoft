<?php

    class roles_model extends mysql
    {
        //variables para mapeardatos
        public $id_roles;
        public $name_role;
        public $description_role;
        public $role_status;
        public $created_at;
        public $updated_at;

        public function __construct()
        {
            parent::__construct();
        }

        public function selectRoles()
        {
            //extraer roles
            $sql = "SELECT * FROM roles WHERE role_status != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectRole(int $id_roles)
        {
            //buscar rol
            $this->id_roles = $id_roles;
            $sql = "SELECT * FROM roles WHERE id_roles = $this->id_roles";
            $request = $this->select($sql);
            return $request;
        }

        public function insertRole(string $name_role, string $description_role, int $role_status, string $created_at, string $updated_at)
        {
            $return = "";
            $this->name_role = $name_role;
            $this->description_role = $description_role;
            $this->role_status = $role_status;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;

            $sql = "SELECT * FROM roles WHERE name_role = '{$this->name_role}'";
            $request = $this->select_all($sql);

            if (empty($request)) 
            {
                $query_insert = "INSERT INTO roles(name_role, description_role, role_status, created_att, updated_att) VALUES(?,?,?,?,?)";
                $arrData = array($this->name_role, $this->description_role, $this->role_status, $this->created_at, $this->updated_at);
                $request_insert = $this->insert($query_insert,$arrData);
                return $request_insert;
            }else {
                $return = "exist";
            }
            return $return;
        }

        public function updateRole(int $id_roles, string $name_role, string $description_role, int $role_status, string $updated_at)
        {
            $this->id_roles = $id_roles;
            $this->name_role = $name_role;
            $this->description_role = $description_role;
            $this->role_status = $role_status;
            $this->updated_at = $updated_at;

            $sql = "SELECT * FROM roles WHERE name_role = '$this->name_role' AND id_roles != $this->id_roles";
            $request = $this->select_all($sql);

            if (empty($request)) 
            {
                $sql = "UPDATE roles SET name_role = ?, description_role = ?, role_status = ?, updated_att = ? WHERE id_roles = $this->id_roles";
                $arrData = array($this->name_role, $this->description_role, $this->role_status, $this->updated_at);
                $request = $this->update($sql, $arrData);
            } else {
                $request = "exist";
            }
            return $request;
        }

        public function deleteRole(int $id_roles)
        {
            $this->id_roles = $id_roles;
            $sql = "SELECT * FROM roles_users WHERE pk_fk_id_roles = $this->id_roles";
            $request = $this->select_all($sql);
            if (empty($request)) 
            {
                $sql = "UPDATE roles SET role_status = ? WHERE id_roles = $this->id_roles";
                $arrData = array(0);
                $request = $this->update($sql,$arrData);
                if ($request) 
                {
                    $request = 'ok';
                }else{
                    $request = 'error';
                }
            }else{
                $request = 'exist';
            }
            return $request;
        }
    }

?>