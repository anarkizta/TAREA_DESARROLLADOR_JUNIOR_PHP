<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud_UForiginal extends CI_Model
{
    public function SelectUForiginal()
    {
        return $this->db->get("originales_indicadores")->result();
    }
    public function InsertUForiginal($codigo, $medida, $fecha, $valor)
    {
        $datos = array(
            "codigo" => $codigo,
            "medida" => $medida,
            "fecha" => $fecha,
            "valor" => $valor
        );
        $this->db->trans_start();
        $this->db->insert("originales_indicadores", $datos);
        $last_Id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_Id;
    }
    public function UpdateUForiginal($Id, $codigo, $medida, $fecha, $valor)
    {
        $datos = array(
            "Id" => $Id,
            "codigo" => $codigo,
            "medida" => $medida,
            "fecha" => $fecha,
            "valor" => $valor
        );
        $this->db->where("Id", $Id);
        return $this->db->update("originales_indicadores", $datos);
    }
    public function DeleteUForiginal($Id)
    {
        $this->db->where('Id', $Id);
        return $this->db->delete("originales_indicadores");
    }
}
