<?php

    class usuarios extends Controllers{
        public function __construct()
        {
            parent::__construct();
        }

        public function usuarios()
        {
            $data['page_id'] = 1;
            $data['page_tag'] = "Usuarios";           
            $data['page_title'] = "Usuarios <small> Parkingsoft </small>";
            $data['page_name'] = "usuarios"; 
            $this->views->getView($this,"usuarios",$data);
        }

    }

?>