<?php

class Sitios_model extends CI_Model
{
  public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null) //*Metodo para obtner una o todas los sitios*//
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('sitios')->where('id', $id)->get(); //*Realizamos una cosnulta a la BD para poder mostras los datos*//
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('sitios')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($sitio) //* Metodo para insertar una nueva ciudad*//
    {
        $this->db->set($this->_setSitio($sitio))->insert('sitios'); //*Realizamos un insert a la BD de los nuevos datos*//

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($sitio) //*Metodo para actualizar un sitio ya existente*//
    {
        $id = $sitio['id'];

        $this->db->set($this->_setSitio($sitio))->where('id', $id)->update('sitios'); //*Realizamos una consulta y update a la BD*//

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($id) //*Metodo para borrar un sitio*//
    {
        $this->db->where('id', $id)->delete('sitios'); //*Realizamos un delete del dato a la BD*//

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setSitio($sitio) //*Metodo para ahorrarnos codigo con el save y update *//
    {
        return array(
            'name' => $sitio['name']
        );
    }
}

