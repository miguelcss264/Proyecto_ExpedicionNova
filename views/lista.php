<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eco-Sistema Galáctico: Expedición Nova</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="pagina">
        <header class="barra-herramientas">
            <h1>Eco-Sistema Galáctico: Expedición Nova</h1>
            <a class="boton" href="index.php?accion=crear">Crear Nueva Entidad Estelar</a>
        </header>

        <section class="tarjeta filtros">
            <form method="GET" action="index.php">
                <input type="hidden" name="accion" value="index">

                <div>
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo">
                        <option value="">Todos</option>
                        <option value="FormaDeVida" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'FormaDeVida') ? 'selected' : '' ?>>Forma de Vida</option>
                        <option value="MineralRaro" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'MineralRaro') ? 'selected' : '' ?>>Mineral Raro</option>
                        <option value="ArtefactoAntiguo" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'ArtefactoAntiguo') ? 'selected' : '' ?>>Artefacto Antiguo</option>
                    </select>
                </div>

                <div>
                    <label for="estabilidad_min">Estabilidad Mínima</label>
                    <input id="estabilidad_min" type="number" name="estabilidad_min" min="1" max="10" value="<?= $_GET['estabilidad_min'] ?? '' ?>" placeholder="1">
                </div>

                <div>
                    <label for="estabilidad_max">Estabilidad Máxima</label>
                    <input id="estabilidad_max" type="number" name="estabilidad_max" min="1" max="10" value="<?= $_GET['estabilidad_max'] ?? '' ?>" placeholder="10">
                </div>

                <div class="acciones-filtro">
                    <button class="boton" type="submit">Filtrar</button>
                    <a class="boton secundario" href="index.php">Limpiar filtros</a>
                </div>
            </form>
        </section>

        <p class="conteo">
            Mostrando <?= count($paginador->obtenerElementos()) ?> de <?= $paginador->obtenerTotalElementos() ?> entidades estelares
        </p>

        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Planeta de Origen</th>
                        <th>Nivel de Estabilidad</th>
                        <th>Campo Especial</th>
                        <th>Reacción</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($paginador->obtenerElementos())): ?>
                        <tr>
                            <td class="estado-vacio" colspan="8">
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
                                    switch ($entidad->getTipo()) {
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
                                        <small>(INESTABLE)</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= $entidad->getNombreCampoEspecial() ?>:</strong>
                                    <?= $entidad->getCampoEspecial() ?>
                                </td>
                                <td><?= $entidad->reaccionar() ?></td>
                                <td class="acciones">
                                    <a class="boton secundario" href="index.php?accion=editar&id=<?= $entidad->getId() ?>">Editar</a>
                                    <a class="boton peligro" href="index.php?accion=eliminar&id=<?= $entidad->getId() ?>"
                                       onclick="return confirm('¿Estás seguro de que deseas eliminar esta entidad estelar?')">
                                        Lanzar al Espacio Exterior
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($paginador->obtenerTotalPaginas() > 1): ?>
            <nav class="paginador">
                <?php if ($paginador->tienePaginaAnterior()): ?>
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
            </nav>
        <?php endif; ?>
    </div>
</body>
</html>
