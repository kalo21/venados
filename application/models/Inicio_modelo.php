<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio_modelo extends CI_Model{

    public function ingresar($usuario) {
        $this->db->select('usuarios.id, usuarios.nombre, usuarios.idperfil, perfiles.nombre as nombrePerfil, usuarios.contraseña');
        $this->db->join('perfiles', 'perfiles.id = usuarios.idperfil');
        $this->db->where('usuarios.nombre', $usuario['inpUsuario']);
        $this->db->where('usuarios.contraseña', $usuario['inpContrasena']);
        $this->db->where('usuarios.estatus', 1);
        $this->db->where('perfiles.estatus', 1);
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0) {
            $query = $query->row();
            $session_data = array(
                'nombre' => $query->nombre,
                'idPerfil' => $query->idperfil,
                'nombrePerfil' => $query->nombrePerfil,
                'contrasena' => $query->contraseña,
                'loginStatus' => true
            );
            if($query->idperfil == 2) {
                $this->db->where('id_usuario', $query->id);
                $datos = $this->db->get('empresas')->row();
                $empresa_data = array(
                    'nombreEmpresa' => $datos->nombre,
                    'imagen' => $datos->logotipo,
                    'idEmpresa' =>$datos->id
                );
                $session_data = array_merge($session_data, $empresa_data);
            }
            $this->session->set_userdata($session_data);
            return true;
        }
        else {
            return false;
        }
    }
}