<?php
function obtener_users_paginados($conn, $users_por_pagina, $pagina) {
    $offset = ($pagina - 1) * $users_por_pagina;
    $consulta = $conn->prepare("SELECT * FROM tusuarios LIMIT ?, ?");
    $consulta->bind_param('ii', $offset, $users_por_pagina);
    $consulta->execute();
    return $consulta->get_result();
}

function obtener_total_user($conn) {
    $resultado = $conn->query("SELECT COUNT(*) as total FROM tprodu");
    return $resultado->fetch_assoc()['total'];
}

function generar_enlaces_paginacion($total_registros, $users_por_pagina, $pagina_actual) {
    $total_paginas = ceil($total_registros / $users_por_pagina);
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
