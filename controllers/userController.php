<?php
require_once "models/User.php";

class userController
{
    public function registrarUsuario ($newUser) {
        try {
            $user = new User();
            $user::create($newUser);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function obtenerUsuarios () {
        try {
            $user = new User();
            return $user::find('all');
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function obtenerUsuario ($id) {
        try {
            $user = new User();
            return $user::find(array("id" => $id));
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function actualizarUsuario ($id, $usuarioActualizado) {
        try {
            $user = new User();
            $user::find(array("id" => $id))->update_attributes($usuarioActualizado);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function eliminarUsuario ($id) {
        try {
            $user = new User();
            $user::find(array("id" => $id))->delete();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}