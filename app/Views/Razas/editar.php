<h1>Editar Raza</h1>
<form action="<?= BASE_URL ?>/Razas/actualizar/<?= $raza->Id; ?>" method="POST">
    Nombre: <input name="nombre" value="<?= $raza->Nombre; ?>"><br>
    <button type="submit">Actualizar</button>
</form>
