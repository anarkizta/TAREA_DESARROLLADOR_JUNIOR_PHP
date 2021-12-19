<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud_UFmodificada extends CI_Model
{
    public function SelectUFmodificadas()
    {
        return $this->db->get("modificados_indicadores")->result();
    }
    public function consultaJoin()
    {
        $this->db->select('m.Id as Id_mod, m.codigo as cod_mod, m.medida as med_mod, m.fecha as fec_mod, m.valor as val_mod, m.Original_Id as Id_original, o.codigo as cod_ori, o.medida as med_ori, o.fecha as fec_ori, o.valor as val_ori ');
        $this->db->from('modificados_indicadores m');
        $this->db->join('originales_indicadores o', ' m.Original_Id = o.Id');
        return $this->db->get()->result();
    }
    public function InsertUFmodificadas($codigo, $medida, $fecha, $valor, $Original_Id)
    {
        $datos = array(
            "codigo" => $codigo,
            "medida" => $medida,
            "fecha" => $fecha,
            "valor" => $valor,
            "Original_Id" => $Original_Id
        );
        return $this->db->insert("modificados_indicadores", $datos);
    }
    public function UpdateUFmodificadas($Id, $valor)
    {
        $datos = array(
            "Id" => $Id,
            "valor" => $valor,
        );
        $this->db->where("Id", $Id);
        return $this->db->update("modificados_indicadores", $datos);
    }
    public function DeleteUFmodificada($Id)
    {
        $this->db->where("Id", $Id);
        return $this->db->delete("modificados_indicadores");
    }
}
