<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Santiago');
class Welcome extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model("Crud_UFmodificada");
        $this->load->model("Crud_UForiginal");
    }
    public function test()
    {
    }
    public function index()
    {
        $this->load->view('welcome_message');
    }
    ####################--->Tabla Modificada<---####################### 
    public function VerUFmodificadas()
    {
        echo json_encode($this->Crud_UFmodificada->SelectUFmodificadas());
    }
    public function verJoin()
    {
        echo json_encode($this->Crud_UFmodificada->consultaJoin());
    }
    public function InsertUFmodificadas($last_id, $valor_mod)
    {
        $valor = $valor_mod;
        $codigo = "uf";
        $medida = "pesos";
        $fecha = date('Y-m-d');
        $Original_Id = $last_id;

        if (isset($codigo) || isset($medida) || isset($fecha) || isset($valor) || isset($Original_Id)) {
            $this->Crud_UFmodificada->InsertUFmodificadas($codigo, $medida, $fecha, $valor, $Original_Id);
            echo json_encode(array('msg' => 'Registro Realizada'));
        } else {
            echo json_encode(array('msg' => 'Registro NO Realizada'));
        }
    }

    public function UpdateUFmodificadas()
    {
        $Id = $this->input->post("id");
        $valor = $this->input->post("valor");

        if (isset($Id) || isset($valor)) {

            $this->Crud_UFmodificada->UpdateUFmodificadas($Id, $valor);

            echo json_encode(array('msg' => 'Actualizacion Realizada'));
        } else {
            echo json_encode(array('msg' => 'Actualizacion NO Realizada'));
        }
    }
    public function DeleteModificada()
    {
     $Id_Modificada = $this->input->post('id_mod');
     $Id_Original = $this->input->post('id_ori');
     if (isset($Id_Modificada)|| isset($Id_Original)) {
         $this->Crud_UFmodificada->DeleteUFmodificada($Id_Modificada);
         $this->Crud_UForiginal->DeleteUForiginal($Id_Original);
         echo json_encode(array('msg' => 'Uf Modificada Eliminada'));
     } else {
         echo json_encode(array('msg' => 'Uf Modificada NO Eliminada'));
     }
     
     
        
    }


    #########################----> Tabla Original <---#########################

    public function VerUForiginal()
    {
        echo json_encode($this->Crud_UForiginal->SelectUForiginal());
    }
    public function InsertUForiginal()
    {
        $codigo = "uf";
        $medida = "pesos";
        $fecha = $this->input->post("fecha") . "";
        $valor = $this->input->post("valor");
        $valor_m = $this->input->post("valor_m");

        if (isset($codigo) || isset($medida) || isset($fecha) || isset($valor)) {
            $last_id = $this->Crud_UForiginal->InsertUForiginal($codigo, $medida, $fecha, $valor);
            echo json_encode(array('msg' => "" . $last_id));
            $this->InsertUFmodificadas($last_id, $valor_m);
        } else {
            echo json_encode(array('msg' => 'Original no Ingresada'));
        }
    }
    public function UpdateUForiginal()
    {
        $Id = $this->input->post("id");
        $codigo = $this->input->post("codigo");
        $medida = $this->input->post("medida");
        $fecha = $this->input->post("fecha");
        $valor = $this->input->post("valor");
        $Original_Id = $this->input->post("Original_Id");

        if (isset($Id) || isset($codigo) || isset($medida) || isset($fecha) || isset($valor)) {

            $this->Crud_UForiginal->UpdateUForiginal($Id, $codigo, $medida, $fecha, $valor, $Original_Id);

            echo json_encode(array('msg' => 'Original Actualizado'));
        } else {
            echo json_encode(array('msg' => 'Original NO Actualizada'));
        }
    }
}
