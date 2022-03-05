<?php
require_once "models/Farm.php";

class farmController
{
    public function registrarFinca($newFarm)
    {
        try {
            $farm = new Farm();
            $farm::create($newFarm);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function obtenerFincas()
    {
        try {
            $farm = new Farm();
            return $farm::find('all');
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function obtenerFinca($id)
    {
        try {
            $farm = new Farm();
            return $farm::find(array("id" => $id));
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function actualizarFinca($id, $updateFinca)
    {
        try {
            $farm = new Farm();
            $farm::find(array("id" => $id))->update_attributes($updateFinca);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function eliminarFinca($id)
    {
        try {
            $farm = new Farm();
            $farm::find(array("id" => $id))->delete();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}