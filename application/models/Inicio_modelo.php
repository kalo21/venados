<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio_modelo extends CI_Model{

    public function ingresar($usuario) {
        try{
            $this->db->select('usuarios.id, usuarios.nombre, usuarios.idperfil, perfiles.nombre as nombrePerfil, usuarios.contraseña');
            $this->db->join('perfiles', 'perfiles.id = usuarios.idperfil');
            $this->db->where('usuarios.nombre', $usuario['inpUsuario']);
            $this->db->where('usuarios.estatus', 1);
            $this->db->where('perfiles.estatus', 1);
            $q = $this->db->get('usuarios')->row();
            if(!is_null($q)){
                $encrypted_pass = $q->contraseña;
                if(password_verify($usuario['inpContrasena'], $encrypted_pass)){
                    $query = $q;
                    $session_data = array(
                        'nombre' => $query->nombre,
                        'idUsuario' => $query->id,
                        'idPerfil' => $query->idperfil,
                        'nombrePerfil' => $query->nombrePerfil,
                        'contrasena' => $query->contraseña,
                        'loginStatus' => true
                    );
                    if($query->idperfil == 2) {
                        $this->db->where('id_usuario', $query->id);
                        $datos = $this->db->get('empresas')->row();
                        if(!is_null($datos)){
                            $empresa_data = array(
                                'nombreEmpresa' => $datos->nombre,
                                'imagen' => $datos->logotipo,
                                'idEmpresa' =>$datos->id
                            );
                            $session_data = array_merge($session_data, $empresa_data);
                            
                        }
                        else{
                            return $obj = array('code'=>false, 'message'=>'Error, usuario sin empresa');
                        }
                    }
                    $this->session->set_userdata($session_data);
                    return $obj = array('code'=>true, 'message'=>'Correcto');
                }
                else{
                    $obj = array('code'=>false, 'message'=>'Usuario o contraseña incorrecta.');
                    return $obj;
                }
            }
            else{
                $obj = array('code'=>false, 'message'=>'No se encontró el usuario.');
                return $obj;
            }
        }
        catch(Exception $e){
            return $this->db->error();
        }
        
    }
}