<?php

class Paginador {

    // Atributos
    private $elementos;
    private $elementosPorPagina;
    private $paginaActual;
    private $totalPaginas;

    public function __construct($elementos, $elementosPorPagina = 5, $paginaActual = 1) {
        $this->elementos = $elementos;
        $this->elementosPorPagina = $elementosPorPagina;
        $this->paginaActual = max(1, intval($paginaActual));
       
        // calcula el total de páginas
        $this->totalPaginas = ceil(count($elementos) / $elementosPorPagina);

        if ($this->paginaActual > $this->totalPaginas && $this->totalPaginas > 0) {
            $this->paginaActual = $this->totalPaginas;
        }
    }

    // Devuelve elementos de página actual
    public function obtenerElementos() {
        $offset = ($this->paginaActual - 1) * $this->elementosPorPagina;
        return array_slice($this->elementos, $offset, $this->elementosPorPagina);
    }

    public function obtenerPaginaActual() {
        return $this->paginaActual;
    }

    public function obtenerTotalPaginas() {
        return $this->totalPaginas;
    }

    public function tienePaginaSiguiente() {
        return $this->paginaActual < $this->totalPaginas;
    }

    public function tienePaginaAnterior() {
        return $this->paginaActual > 1;
    }

    public function obtenerTotalElementos() {
        return count($this->elementos);
    }
}
