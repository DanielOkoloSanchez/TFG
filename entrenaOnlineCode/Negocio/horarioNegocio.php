<?php
require_once("../../AccesoDatos/comidasAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");


class horarioReglasNegocio
{
    private $_id;
    private $_nombreHorario;
    private $_HorarioComidaLunes;
    private $_HorarioComidaLunesId;
    private $_HorarioComidaMartes;
    private $_HorarioComidaMartesId;
    private $_HorarioComidaMiercoles;
    private $_HorarioComidaMiercolesId;
    private $_HorarioComidaJueves;
    private $_HorarioComidaJuevesId;
    private $_HorarioComidaViernes;
    private $_HorarioComidaViernesId;
    private $_HorarioComidaSabado;
    private $_HorarioComidaSabadoId;
    private $_HorarioComidaDomingo;
    private $_HorarioComidaDomingoId;

	function __construct()
    {
    }

    public function init($id, $nombre, $idLunes, $nombreLunes, $idMartes, $nombreMartes, $idMiercoles, $nombreMiercoles, $idJueves, $nombreJueves, $idViernes, $nombreViernes, $idSabado, $nombreSabado, $idDomingo, $nombreDomingo) {
        // Aquí inicializas los datos utilizando los parámetros proporcionados
    
        $this->_id = $id;
        $this->_nombreHorario = $nombre;
        $this->_HorarioComidaLunesId = $idLunes;
        $this->_HorarioComidaLunes = $nombreLunes;
        $this->_HorarioComidaMartesId = $idMartes;
        $this->_HorarioComidaMartes = $nombreMartes;
        $this->_HorarioComidaMiercolesId = $idMiercoles;
        $this->_HorarioComidaMiercoles = $nombreMiercoles;
        $this->_HorarioComidaJuevesId = $idJueves;
        $this->_HorarioComidaJueves = $nombreJueves;
        $this->_HorarioComidaViernesId = $idViernes;
        $this->_HorarioComidaViernes = $nombreViernes;
        $this->_HorarioComidaSabadoId = $idSabado;
        $this->_HorarioComidaSabado = $nombreSabado;
        $this->_HorarioComidaDomingoId = $idDomingo;
        $this->_HorarioComidaDomingo = $nombreDomingo;
    }

 

    public function getId() {
        return $this->_id;
    }

    public function getNombreHorario() {
        return $this->_nombreHorario;
    }

    public function getHorarioComidaLunes() {
        return $this->_HorarioComidaLunes;
    }

    public function getHorarioComidaLunesId() {
        return $this->_HorarioComidaLunesId;
    }

    public function getHorarioComidaMartes() {
        return $this->_HorarioComidaMartes;
    }

    public function getHorarioComidaMartesId() {
        return $this->_HorarioComidaMartesId;
    }

    public function getHorarioComidaMiercoles() {
        return $this->_HorarioComidaMiercoles;
    }

    public function getHorarioComidaMiercolesId() {
        return $this->_HorarioComidaMiercolesId;
    }

    public function getHorarioComidaJueves() {
        return $this->_HorarioComidaJueves;
    }

    public function getHorarioComidaJuevesId() {
        return $this->_HorarioComidaJuevesId;
    }

    public function getHorarioComidaViernes() {
        return $this->_HorarioComidaViernes;
    }

    public function getHorarioComidaViernesId() {
        return $this->_HorarioComidaViernesId;
    }

    public function getHorarioComidaSabado() {
        return $this->_HorarioComidaSabado;
    }

    public function getHorarioComidaSabadoId() {
        return $this->_HorarioComidaSabadoId;
    }

    public function getHorarioComidaDomingo() {
        return $this->_HorarioComidaDomingo;
    }

    public function getHorarioComidaDomingoId() {
        return $this->_HorarioComidaDomingoId;
    }

   
    function obtenerHorarioComidas()
    {
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerHorarioComidas($cliente["id"]);
        $horarios =  array();
       

        foreach ($rs as $horario)
        {
          
            $horarioReglasNegocio = new horarioReglasNegocio();
            $horarioReglasNegocio->init(
                $horario['id'],
                $horario['nombreHorario'],
                $horario['idLunes'],
                $horario['nombreLunes'],
                $horario['idMartes'],
                $horario['nombreMartes'],
                $horario['idMiercoles'],
                $horario['nombreMiercoles'],
                $horario['idJueves'],
                $horario['nombreJueves'],
                $horario['idViernes'],
                $horario['nombreViernes'],
                $horario['idSabado'],
                $horario['nombreSabado'],
                $horario['idDomingo'],
                $horario['nombreDomingo']
            );
            
            array_push($horarios, $horarioReglasNegocio);
            
            

        }
       
        return $horarios;
        
    }


    function obtenerHorarioComidaById($id)
    {
      
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerHorarioComidaById($id);
        return $rs;
        
    }
        
    function createHorarioComidas($nombre,$comidaLunes,$comidaMartes,$comidaMiercoles,$comidaJueves, $comidaViernes,$comidaSabado,$comidaDomingo)
    {   
       
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        

        $comidasAccesoDatos = new comidasAccesoDatos();
        $comidasAccesoDatos->createHorarioComidas($nombre,$comidaLunes,$comidaMartes,$comidaMiercoles,$comidaJueves, $comidaViernes,$comidaSabado,$comidaDomingo,$cliente["id"]);
   
    }

    function deleteHorario($id)
    {   
        
        $comidasAccesoDatos = new comidasAccesoDatos();
        $comidasAccesoDatos->deleteHorario($id);
       
       
    }

    
}





?>


