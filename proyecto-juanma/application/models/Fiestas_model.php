<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiestas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id_sitio = null) //*Metodo para obtner una o todas las fiestas*//
    {
        if (!is_null($id_sitio)) { //*Realizamos una cosnulta en base al id del sitio a la BD para poder mostras los datos*//
            $query = $this->db->select('*')->from('fiestas')->where('id_sitio', $id_sitio)->order_by('date', 'ASC')->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('fiestas')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($fiestas) //* Metodo para insertar una nueva fiesta*//
    {
        $this->db->set($this->_setFiestas($fiestas))->insert('fiestas'); //*Realizamos un insert a la BD de los nuevos datos*//

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($id, $fiestas) //*Metodo para actualizar una fiesta ya existente*//
    {
        $this->db->set($this->_setFiestas($fiestas))->where('id', $id)->update('fiestas'); //*Realizamos una consulta y update a la BD*//

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($id) //*Metodo para borrar una fiesta*//
    {
        $this->db->where('id', $id)->delete('fiestas'); //*Realizamos un delete del dato a la BD*//

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return false;
    }

    private function _setFiestas($fiestas) //*Metodo para ahorrarnos codigo con el save y update *//
    {
        return array(
            'fiestas'    => $fiestas['fiestas'],
            'date'    => $fiestas['date'],
            'id_sitio' => $fiestas['id_sitio']
        );
    }
}


