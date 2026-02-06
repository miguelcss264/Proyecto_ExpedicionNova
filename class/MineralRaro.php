<?php

// Clase que hereda
class MineralRaro extends EntidadEstelar {

    // indica la dureza
    private $dureza;

    public function __construct($id, $nombre, $planetaOrigen, $nivelEstabilidad, $dureza) {
        parent::__construct($id, $nombre, $planetaOrigen, $nivelEstabilidad);
        $this->dureza = $dureza;
    }

    public function getDureza() {
        return $this->dureza;
    }

    public function setDureza($dureza) {
        $this->dureza = $dureza;
    }

    // Método devuelve reacción
    public function reaccionar() {
        return "El mineral '{$this->nombre}' refleja luz cristalina con dureza {$this->dureza}.";
    }

    public function getTipo() {
        return 'MineralRaro';
    }

    public function getCampoEspecial() {
        return $this->dureza;
    }

    public function setCampoEspecial($valor) {
        $this->dureza = $valor;
    }

    public function getNombreCampoEspecial() {
        return 'Dureza';
    }
}
