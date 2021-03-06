<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Fiestas extends REST_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->model('fiestas_model');
	}

	public function index_get() //*Nos va a mostrar todas las fiestas *//
	{
	    $fiestas = $this->fiestas_model->get(); //*El siguiente metodo nos devuelve todas las fiestas*//

       	    if (!is_null($fiestas)) {
          	$this->response(array('response' => $fiestas), 200); //*Array que contiene las fiestas*//
       	    } else {
           	$this->response(array('error' => 'No hay fiestas en la base de datos...'), 404); //*Array de muestra si no encuentra datos*//
            }
	}

	public function find_get($id) //*Nos va a dar una fiesta en concrreto y le pasamos un id*//
	{
	    if (!$id) { //*Metodo para encontrar una sola fiesta en concreto, aqui le indicamos que necesita una id, sino nos va a tirar error*//
            	$this->response(null, 400);
            }
            	$fiesta = $this->fiestas_model->get($id);

       	    if (!is_null($fiesta)) {
                $this->response(array('response' => $fiesta), 200);
       	    } else {
                $this->response(array('error' => 'Fiesta no encontrada...'), 404);
            }
	}

	public function index_post() //*Se va a encargar de añadir una nueva fiesta*//
	{
	   if (!$this->post('fiesta')) { //*Metodo para comprobar que nos viene un dato fiesta*//
           	$this->response(null, 400);
	    }

             $id = $this->fiestas_model->save($this->post('fiesta')); //*Si viene un dato fiesta lo insertamos en la BD*//

       	   if (!is_null($id)) {
           	$this->response(array('response' => $id), 200);
       	    } else {
           	$this->response(array('error', 'Algo va mal...'), 400);
            }
	}
	public function index_put() //*Este va actualizar un registro en la BD*//
	{
	  if (!$this->put('fiesta')) { //* Con este metodo vamos a indicarle cual es la fiesta en concreto que queremos editar, y no nos edita todos*//
            	$this->response(null, 400);
	}
        $update = $this->fiestas_model->update($this->put('fiesta'));

          if (!is_null($update)) {
            $this->response(array('response' => 'fiesta actualizada!'), 200);
          } else {
            $this->response(array('error', 'Algo va mal...'), 400);
        }


	}
	public function index_delete() //*Encargado de borrar *//
	{
	 if (!$id) { //*En este caso es lo mismo que el anterior pero borrando la fiesta en concreto, y no nos borra todas*//
            $this->response(null, 400);
         }

         $delete = $this->fiestas_model->delete($id);

         if (!is_null($delete)) {
            $this->response(array('response' => 'Fiesta eliminado!'), 200);
         } else {
            $this->response(array('error', 'Algo va mal...'), 400);
         }

   }
}
