<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($entidad) ? 'Editar' : 'Crear' ?> Entidad Estelar</title>
</head>
<body>
    <h1><?= isset($entidad) ? 'Editar' : 'Crear' ?> Entidad Estelar</h1>
    
    <?php if (isset($entidad)): ?>
        <p>Estás editando una entidad existente. El ID no puede ser modificado.</p>
    <?php endif; ?>
    
    <form method="POST" action="index.php?accion=<?= isset($entidad) ? 'actualizar' : 'guardar' ?>">        <?php if (isset($entidad)): ?>
            <input type="hidden" name="id" value="<?= $entidad->getId() ?>">
            
            <p>
                <label for="id_display">ID de la Entidad:</label><br>
                <input type="text" id="id_display" value="<?= $entidad->getId() ?>" readonly>
            </p>
        <?php endif; ?>
          <p>
            <label for="tipo">Tipo de Entidad Estelar: *</label><br>
            <select name="tipo" id="tipo" required <?= isset($entidad) ? 'disabled' : '' ?>>
                <option value="">Seleccione un tipo...</option>
                <option value="FormaDeVida" <?= (isset($entidad) && $entidad->getTipo() == 'FormaDeVida') ? 'selected' : '' ?>>
                    Forma de Vida
                </option>
                <option value="MineralRaro" <?= (isset($entidad) && $entidad->getTipo() == 'MineralRaro') ? 'selected' : '' ?>>
                    Mineral Raro
                </option>
                <option value="ArtefactoAntiguo" <?= (isset($entidad) && $entidad->getTipo() == 'ArtefactoAntiguo') ? 'selected' : '' ?>>
                    Artefacto Antiguo
                </option>
            </select>            
            <?php if (isset($entidad)): ?>
                <input type="hidden" name="tipo" value="<?= $entidad->getTipo() ?>">
            <?php endif; ?>
        </p>
        
        <p>
            <label for="nombre">Nombre: *</label><br>
            <input type="text" name="nombre" id="nombre" 
                   value="<?= isset($entidad) ? $entidad->getNombre() : '' ?>" 
                   required placeholder="Ej: Criatura Zeta-7">
        </p>
        
        <p>
            <label for="planeta_origen">Planeta de Origen: *</label><br>
            <input type="text" name="planeta_origen" id="planeta_origen" 
                   value="<?= isset($entidad) ? $entidad->getPlanetaOrigen() : '' ?>" 
                   required placeholder="Ej: Kepler-442b">
        </p>
        
        <p>
            <label for="nivel_estabilidad">Nivel de Estabilidad (1-10): *</label><br>
            <input type="number" name="nivel_estabilidad" id="nivel_estabilidad" 
                   min="1" max="10" 
                   value="<?= isset($entidad) ? $entidad->getNivelEstabilidad() : '5' ?>" 
                   required><br>
            <small>Niveles inferiores a 3 se consideran inestables</small>
        </p>
            <p>
            <label for="dieta">Dieta (solo para Forma de Vida):</label><br>
            <input type="text" name="dieta" id="dieta" 
                   value="<?= (isset($entidad) && $entidad->getTipo() == 'FormaDeVida') ? $entidad->getDieta() : '' ?>" 
                   placeholder="Ej: Herbívoro, Carnívoro, Fotosintético">
        </p>
        
        <p>
            <label for="dureza">Dureza (solo para Mineral Raro):</label><br>
            <input type="text" name="dureza" id="dureza" 
                   value="<?= (isset($entidad) && $entidad->getTipo() == 'MineralRaro') ? $entidad->getDureza() : '' ?>" 
                   placeholder="Ej: 9 (escala Mohs), Diamantino">
        </p>
        
        <p>
            <label for="antiguedad">Antigüedad en años (solo para Artefacto Antiguo):</label><br>
            <input type="number" name="antiguedad" id="antiguedad" 
                   value="<?= (isset($entidad) && $entidad->getTipo() == 'ArtefactoAntiguo') ? $entidad->getAntiguedad() : '' ?>" 
                   placeholder="Ej: 1000000">
        </p>
        
        <p>
            <button type="submit">
                <?= isset($entidad) ? 'Actualizar' : 'Crear' ?> Entidad
            </button>
            <a href="index.php">Volver</a>
        </p>
    </form>
</body>
</html>