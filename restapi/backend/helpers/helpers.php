<?php

    function base_url()
    {
        return BASE_URL;
    }

    //retorna la ruta + assets
    function media()
    {
        return BASE_URL."Assets";
    }
    //Template
    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    }
    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);
    }

    //Muestra informacion formateada
    function dep($data)
    {
        $format = print_r('<pre>');
        $format = print_r($data);
        $format = print_r('</pre>');
    }
    //obtener modal
    function getModal(string $nameModal , $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once ($view_modal);
    }

    // elimina exceso de espacio entre palabras
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''],$strCadena);
        $string = trim($strCadena);
        $string = stripslashes($strCadena);
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT FROM","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'=1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }
    //generar token
    function Token(){
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    //formato moneada
    function formatMoney($cantidad)
    {
        $cantidad = number_format($cantidad,0,SPD,SPM);
        return $cantidad;
    }


?>