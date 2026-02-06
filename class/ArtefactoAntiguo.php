<?php

// Clase ArtefactoAntiguo que hereda
class ArtefactoAntiguo extends EntidadEstelar {

    // Atributo privado que guarda la antigüedad
    private $antiguedad;

    // Constructor 
    public function __construct($id, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad) {

        // Constructor de la clase padre
        parent::__construct($id, $nombre, $planetaOrigen, $nivelEstabilidad);
        $this->antiguedad = $antiguedad;
    }

    // Devuelve antiguedad
    public function getAntiguedad() {
        return $this->antiguedad;
    }

    public function setAntiguedad($antiguedad) {
        $this->antiguedad = $antiguedad;
    }
    
    // Método devuelve reacción
    public function reaccionar() {
        return "El artefacto '{$this->nombre}' resuena con energía ancestral de hace {$this->antiguedad} años.";
    }

    // Devuelve tipo de entidad
    public function getTipo() {
        return 'ArtefactoAntiguo';
    }

    public function getCampoEspecial() {
        return $this->antiguedad;
    }

    public function setCampoEspecial($valor) {
        $this->antiguedad = $valor;
    }

    public function getNombreCampoEspecial() {
        return 'Antigüedad (años)';
    }
}