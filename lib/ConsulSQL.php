<?php
/* Clase para ejecutar las consultas a la Base de Datos*/
class ejecutarSQL {
    public static function conectar(){
        if(!$con=  mysqli_connect(SERVER,USER,PASS,BD)){
            echo "Error en el servidor, verifique sus datos";
        }
        /* Codificar la información de la base de datos a UTF8*/
        mysqli_set_charset($con, "utf8");
        return $con;  
    }
    public static function consultar($query) {
        //print $query. '<br>';
        if (!$consul = mysqli_query(ejecutarSQL::conectar(), $query)) {
            echo 'Error en la consulta SQL ejecutada';
        }
        return $consul;
    }  
}
/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */
class consultasSQL{

    public static function SelectSQL($tabla, $campos, $condicion)
    {
        $return = '';
        if((strlen($campos)>0) && (strlen($condicion)==0)){
            if(!$consul = ejecutarSQL::consultar("SELECT $campos FROM $tabla")){
                //die("Ha ocurrido un error al insertar los datos en la tabla ".$tabla);
                $msg =  "Ha ocurrido un error al recuperar los datos en la tabla ".$tabla;
                die('<script language="javascript">
                document.location.href="../index.php?id=0&msg='.$msg.'"</script>');
            }
            $return = $consul;
        }else{
            if((strlen($campos)>0) && (strlen($condicion)>0)){
                if(!$consul = ejecutarSQL::consultar("SELECT $campos FROM $tabla WHERE $condicion")){
                    //die("Ha ocurrido un error al insertar los datos en la tabla ".$tabla);
                    $msg =  "Ha ocurrido un error al recuperar los datos en la tabla ".$tabla;
                    die('<script language="javascript">
                    document.location.href="../index.php?id=0&msg='.$msg.'"</script>');
                }
                $return = $consul;
            }
        }

        return $return;    
    }

    public static function InsertSQL($tabla, $campos, $valores) {
        //print $campos;
        //print "INSERT INTO $tabla ($campos) VALUES($valores)";
        if (!$consul = ejecutarSQL::consultar("INSERT INTO $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla ".$tabla);
            //$msg =  "Ha ocurrido un error al insertar los datos en la tabla ".$tabla;
            //die('<script language="javascript">
            //document.location.href="../index.php?id=0&msg='.$msg.'"</script>');
        }
        return $consul;
    }
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("DELETE FROM $tabla WHERE $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla ".$tabla);
        }
        return $consul;
    }
    public static function UpdateSQL($tabla, $campos, $condicion) {
        print "UPDATE $tabla SET $campos WHERE $condicion". '<br>';
        if (!$consul = ejecutarSQL::consultar("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla *** ".$tabla);
        }
        return $consul;
    }
    public static function Procedure($SP,$exec){
        $sql = "CALL ".$SP."(".$exec.");";
        if(!$consul = ejecutarSQL::consultar($sql)){
            die("Ha ocurrido un error al actualizar los datos en la tabla");
        }
        return $consul;
    }
    public static function clean_string($val){
        $val=trim($val);
        $val=stripslashes($val);
        $val=str_ireplace("<script>", "", $val);
        $val=str_ireplace("</script>", "", $val);
        $val=str_ireplace("<script src", "", $val);
        $val=str_ireplace("<script type=", "", $val);
        $val=str_ireplace("SELECT * FROM", "", $val);
        $val=str_ireplace("DELETE FROM", "", $val);
        $val=str_ireplace("INSERT INTO", "", $val);
        $val=str_ireplace("--", "", $val);
        $val=str_ireplace("^", "", $val);
        $val=str_ireplace("[", "", $val);
        $val=str_ireplace("]", "", $val);
        $val=str_ireplace("==", "", $val);
        $val=str_ireplace(";", "", $val);
        return $val;
    }
}