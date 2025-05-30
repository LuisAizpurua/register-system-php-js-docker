<?php
require_once(__DIR__."/../../db/conexion.php");

class Operacion extends Conexion
{

    private function conexionDb(string $query,array $data)   {
        $conectDb = Conexion::Conector();
        
        $exec = $conectDb->prepare($query);
        $exec->execute($data);
        
        return ["exec"=> $exec,'conn'=> $conectDb];
    }

    public function saveAspirante(array $aspirante)
    {

        try{
            // Insertar en la base de datos
            $sql = "INSERT INTO aspirante (
               cuenta_id, datos_id, cedula_pasaporte, nombre, apellido, fecha_nacimiento,
                telefono, email
            ) VALUES (
                :cuenta_id, :datos_id, :cedula, :nombre, :apellido, :fecha_nacimiento, :telefono, :correo
            )";


            $stmt = $this->conexionDb($sql,
        [
                ':cuenta_id'      => $aspirante['cuenta_id'], 
                ':datos_id'       => $aspirante['datos_id'],
                ':cedula'         => $aspirante['cedula'],
                ':nombre'         => $aspirante['nombre'],
                ':apellido'       => $aspirante['apellido'],
                ':fecha_nacimiento' => $aspirante['fecha_nacimiento'],
                ':telefono'       =>  $aspirante['telefono'],
                ':correo'         =>  $aspirante['email']
            ]
        );

            return $stmt['conn']->lastInsertId();
   } catch (PDOException $e) {
        error_log("PDO Error en saveAspirante: " . $e->getMessage());
        echo "Error de base de datos: " . $e->getMessage();
        return false;
    } catch (Exception $e) {
        error_log("Error en saveAspirante: " . $e->getMessage());
        echo "Error: " . $e->getMessage();
        return false;
    }
        }

 public function saveCuenta(array $cuenta)
    {
        try{
            $sql = "INSERT INTO cuenta (
               usuario, contrasena, role, creadoEn
            ) VALUES (
                :usuario, :contrasena, :role, :creadoEn
            )";

            $stmt = $this->conexionDb($sql,
            [
                ':usuario'      => $cuenta['usuario'], 
                ':contrasena'   => $cuenta['contrasena'],
                ':role'       => $cuenta['role']??'aspirante',
                ':creadoEn'   => $cuenta['creadoEn'],
            ]);

           return $stmt['conn']->lastInsertId();
        }catch(PDOException  $e){
            return null;
        }
    }


     public function saveDatosPersonal(array $datos)
    {
        try{
            $sql = "INSERT INTO datos_personales (
                residencia, nacionalidad, estado_civil, genero, tipo_sangre
            ) VALUES (
                :residencia, :nacionalidad, :estado_civil, :genero, :tipo_sangre
            )";

            $stmt = $this->conexionDb($sql,[
                ':residencia'      => $datos['residencia'], 
                ':nacionalidad'   => $datos['nacionalidad'],
                ':estado_civil'       => $datos['estado_civil'],
                ':genero'   => $datos['genero'],
                ':tipo_sangre'   => $datos['tipo_sangre']
            ]);
            
            return $stmt['conn']->lastInsertId();
        }catch(PDOException  $e){
            return null;
        }
    }

       public function saveSolicitud(array $solicitud)
    {

        try{
            $sql = "INSERT INTO solicitudes (
                aspirante_id, estado, fecha
            ) VALUES (
                :aspirante_id, :estado, :fecha
            )";

            $stmt = $this->conexionDb($sql,
        [
                ':aspirante_id'    => $solicitud['aspirante_id'], 
                ':estado'   => $solicitud['estado'],
                ':fecha'       => $solicitud['fecha']
            
        ]);
          return $stmt['conn']->lastInsertId();
        }catch(PDOException $e){
            echo 'Error de conexión: ' . $e->getMessage();;
        }            
    }

    public function ejecutarSinRetorno($sql, $mapUnico)
{
    try {
        $consulta = $this->conexionDb($sql,$mapUnico);
        return $consulta['exec'];
    } catch (PDOException $e) {
        return false;
    }
}

    public function getAllByColumn($sql, $mapUnico)
    {
        try{
            $consulta = $this->conexionDb($sql,$mapUnico);        
            return $consulta['exec']->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return null;
        }
    }


public function aspiranteExistePorUsuario($username)
    {
        $stmt = $this->conexionDb("SELECT id FROM cuenta WHERE usuario = :usuario",[':usuario' => $username])['exec'];
        // $stmt->execute([':usuario' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }

    public function aspiranteExiste($password)
    {
        $stmt = $this->conexionDb("SELECT id FROM cuenta WHERE contrasena = :password",[':password' => $password])['exec'];
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }

    public function updateToken($data){
        var_dump($data);
        $stmt = $this->conexionDb("UPDATE cuenta SET token = :token, activo = :activo WHERE contrasena = :password", $data)['exec'];
        return $stmt->fetchColumn();
    }

}
?>