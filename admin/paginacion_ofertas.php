<?php
function obtener_productos_paginados($conn, $ofertas_por_pagina, $pagina) {
    $offset = ($pagina - 1) * $ofertas_por_pagina;
    $consulta = $conn->prepare("SELECT * FROM tofertas LIMIT ?, ?");
    $consulta->bind_param('ii', $offset, $ofertas_por_pagina);
    $consulta->execute();
    return $consulta->get_result();
}

function obtener_total_productos($conn) {
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tofertas");
    return $resultado->fetch_assoc()['total'];
}

function generar_enlaces_paginacion($total_registros, $ofertas_por_pagina, $pagina_actual) {
    $total_paginas = ceil($total_registros / $ofertas_por_pagina);
    $enlaces = '';

    // Botón para la página anterior
    if ($pagina_actual > 1) {
        $enlaces .= '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_actual - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    // Enlaces para cada página
    for ($i = 1; $i <= $total_paginas; $i++) {
        $clase_activo = ($pagina_actual == $i) ? ' active' : '';
        $enlaces .= '<li class="page-item' . $clase_activo . '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
    }

    // Botón para la página siguiente
    if ($pagina_actual < $total_paginas) {
        $enlaces .= '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_actual + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
    }

    return $enlaces;
}

?>
