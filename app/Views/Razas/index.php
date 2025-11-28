<h1 class="text-h1">Razas</h1>
<a href="<?= BASE_URL ?>/Razas/crear">Agregar nueva</a>
<ul>
<?php foreach ($razas as $r): ?>
    <li>
        <?= $r->Nombre ?> - 
        <a href="<?= BASE_URL ?>/Razas/editar/<?= $r->Id ?>">Editar</a> | 
        <a href="<?= BASE_URL ?>/Razas/eliminar/<?= $r->Id ?>">Eliminar</a>
    </li>
<?php endforeach; ?>
</ul>
