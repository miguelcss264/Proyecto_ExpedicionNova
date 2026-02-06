<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eco-Sistema Galáctico: Expedición Nova</title>
</head>
<body>
    <h1>Eco-Sistema Galáctico: Expedición Nova</h1>
    
    <a href="index.php?accion=crear">Crear Nueva Entidad Estelar</a>
    <br></br>
    <div>
        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="index">
            
            <label>Tipo:</label>
            <select name="tipo">
                <option value="">Todos</option>
                <option value="FormaDeVida" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'FormaDeVida') ? 'selected' : '' ?>>Forma de Vida</option>
                <option value="MineralRaro" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'MineralRaro') ? 'selected' : '' ?>>Mineral Raro</option>
                <option value="ArtefactoAntiguo" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'ArtefactoAntiguo') ? 'selected' : '' ?>>Artefacto Antiguo</option>
            </select>
            
            <label>Estabilidad Mínima:</label>
            <input type="number" name="estabilidad_min" min="1" max="10" value="<?= $_GET['estabilidad_min'] ?? '' ?>" placeholder="1">
            
            <label>Estabilidad Máxima:</label>
            <input type="number" name="estabilidad_max" min="1" max="10" value="<?= $_GET['estabilidad_max'] ?? '' ?>" placeholder="10">
            
            <button type="submit">Filtrar</button>
            <a href="index.php">Limpiar filtros</a>
        </form>
    </div>
    
    <p>
        Mostrando <?= count($paginador->obtenerElementos()) ?> de <?= $paginador->obtenerTotalElementos() ?> entidades estelares
    </p>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Planeta de Origen</th>
                <th>Nivel de Estabilidad</th>
                <th>Campo Especial</th>
                <th>Reacción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($paginador->obtenerElementos())): ?>
                <tr>
                    <td colspan="8">
                        No hay entidades estelares para mostrar. ¡Crea una nueva!
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($paginador->obtenerElementos() as $entidad): ?>                   
                    <tr>
                        <td><?= $entidad->getId() ?></td>
                        <td>
                            <?php
                            $tipoNombre = '';
                            switch($entidad->getTipo()) {
                                case 'FormaDeVida': $tipoNombre = 'Forma de Vida'; break;
                                case 'MineralRaro': $tipoNombre = 'Mineral Raro'; break;
                                case 'ArtefactoAntiguo': $tipoNombre = 'Artefacto Antiguo'; break;
                            }
                            echo $tipoNombre;
                            ?>
                        </td>
                        <td><?= $entidad->getNombre() ?></td>
                        <td><?= $entidad->getPlanetaOrigen() ?></td>
                        <td>
                            <?= $entidad->getNivelEstabilidad() ?>
                            <?php if ($entidad->getNivelEstabilidad() < 3): ?>
                                (INESTABLE)
                            <?php endif; ?>
                        </td>                        <td>
                            <strong><?= $entidad->getNombreCampoEspecial() ?>:</strong>
                            <?= $entidad->getCampoEspecial() ?>
                        </td>
                        <td>
                            <?= $entidad->reaccionar() ?>
                        </td>                        <td>
                            <a href="index.php?accion=editar&id=<?= $entidad->getId() ?>">Editar</a>
                            <a href="index.php?accion=eliminar&id=<?= $entidad->getId() ?>" 
                               onclick="return confirm('¿Estás seguro de que deseas eliminar esta entidad estelar?')">
                                Lanzar al Espacio Exterior
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>    

    <?php if ($paginador->obtenerTotalPaginas() > 1): ?>
        <div>            <?php if ($paginador->tienePaginaAnterior()): ?>
                <a href="?accion=index&pagina=<?= $paginador->obtenerPaginaActual() - 1 ?><?= isset($_GET['tipo']) ? '&tipo=' . $_GET['tipo'] : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . $_GET['estabilidad_min'] : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . $_GET['estabilidad_max'] : '' ?>">
                    Anterior
                </a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $paginador->obtenerTotalPaginas(); $i++): ?>
                <?php if ($i == $paginador->obtenerPaginaActual()): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>                    
                    <a href="?accion=index&pagina=<?= $i ?><?= isset($_GET['tipo']) ? '&tipo=' . $_GET['tipo'] : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . $_GET['estabilidad_min'] : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . $_GET['estabilidad_max'] : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
              <?php if ($paginador->tienePaginaSiguiente()): ?>
                <a href="?accion=index&pagina=<?= $paginador->obtenerPaginaActual() + 1 ?><?= isset($_GET['tipo']) ? '&tipo=' . $_GET['tipo'] : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . $_GET['estabilidad_min'] : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . $_GET['estabilidad_max'] : '' ?>">
                    Siguiente
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
