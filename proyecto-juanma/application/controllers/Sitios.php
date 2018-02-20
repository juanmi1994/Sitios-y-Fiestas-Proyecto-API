<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Sitios extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sitios_model');
	}

	public function index_get() //*Nos va a mostrar todos los sitios *//
	{
	    $sitios = $this->sitios_model->get(); //*El siguiente metodo nos devuelve todas los sitios*//

       	    if (!is_null($sitios)) {
          	$this->response(array('response' => $sitios), 200); //*Array que contiene los sitios*//
       	    } else {
           	$this->response(array('error' => 'No hay sitios en la base de datos...'), 404); //*Array de muestra si no encuentra datos*//
            }
	}

	public function find_get($id) //*Nos va a dar un sitio en concrreto y le pasamos un id*//
	{
	    if (!$id) { //*Metodo para encontrar un solo sitio en concreto, aqui le indicamos que necesita una id, sino nos va a tirar error*//
            	$this->response(null, 400);
            }
            	$sitio = $this->sitios_model->get($id);

       	    if (!is_null($sitio)) {
                $this->response(array('response' => $sitio), 200);
       	    } else {
                $this->response(array('error' => 'Sitio no encontrada...'), 404);
            }
	}

	public function index_post() //*Se va a encargar de añadir un nuevo sitio*//
	{
	   if (!$this->post('sitio')) { //*Metodo para comprobar que nos viene un dato sitio*//
           	$this->response(null, 400);
	    }

             $id = $this->sitios_model->save($this->post('sitio')); //*Si viene un dato sitio lo insertamos en la BD*//

       	   if (!is_null($id)) {
           	$this->response(array('response' => $id), 200);
       	    } else {
           	$this->response(array('error', 'Algo va mal...'), 400);
            }
	}
	public function index_put() //*Este va actualizar un registro en la BD*//
	{
	  if (!$this->put('sitio')) { //* Con este metodo vamos a indicarle cual es el sitio en concreto que queremos editar, y no nos edita todos*//
            	$this->response(null, 400);
	}
        $update = $this->sitios_model->update($this->put('sitio'));

          if (!is_null($update)) {
            $this->response(array('response' => 'Sitio actualizada!'), 200);
          } else {
            $this->response(array('error', 'Algo va mal...'), 400);
        }


	}
	public function index_delete() //*Encargado de borrar *//
	{
	 if (!$id) { //*En este caso es lo mismo que el anterior pero borrando el sitio en concreto, y no nos borra todos*//
            $this->response(null, 400);
         }

         $delete = $this->sitios_model->delete($id);

         if (!is_null($delete)) {
            $this->response(array('response' => 'Sitio eliminado!'), 200);
         } else {
            $this->response(array('error', 'Algo va mal...'), 400);
         }

   }
}
