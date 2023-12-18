<?php

require 'Conexion.php';

class Empleados extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function getALL(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_empleados_listar");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e ->getMessage());
    }
  }
  

  public function add($data = []) {
    try {
        $consulta = $this->pdo->prepare("CALL spu_empleados_registrar(?,?,?,?,?,?)");
        $consulta->execute([
            $data['idsede'],
            $data['apellidos'],
            $data['nombres'],
            $data['nrodocumento'],
            $data['fechanac'],
            $data['telefono']
        ]);
        return $consulta->rowCount(); // Devuelve el número de filas afectadas
    } catch(Exception $e) {
        die($e->getMessage());
    }
}

  public function search($data = []){
    try{
      $consulta =$this->pdo->prepare("CALL spu_empleados_buscar(?)");
      $consulta->execute(
        array($data['nrodocumento'])
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
 
  public function getResumenTotalSedes(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_resumen_sedes()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}

?>