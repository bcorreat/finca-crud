<?php
require_once "controllers/userController.php";
$userCon = new userController();
$users = $userCon->obtenerUsuarios();

if ($_POST && !$_GET):
    if ($_POST['txtOrigen'] === "user"):
        $newUser = array(
            "nombre" => $_POST["txtPrimerNombre"],
            "apellido" => $_POST["txtPrimerApellido"],
            "email" => $_POST["txtEmail"],
            "nombre_completo" => $_POST["txtPrimerNombre"] . " " . $_POST["txtPrimerApellido"]
        );
        $userCon->registrarUsuario($newUser);
        header("Location: index.php");
        endif;
endif;
if ($_POST && $_GET):
    $action = $_GET['action'];
    $id = $_GET['id'];
    $origen = $_GET['origen'];

    if ($action === "update" && $origen === "user"):
        $updateUser = array(
            "nombre" => $_POST["txtPrimerNombre"],
            "apellido" => $_POST["txtPrimerApellido"],
            "email" => $_POST["txtEmail"],
            "nombre_completo" => $_POST["txtPrimerNombre"] . " " . $_POST["txtPrimerApellido"]
        );
        print_r($updateUser);
        $userCon->actualizarUsuario($id, $updateUser);
        header("Location: index.php");
    endif;
endif;
if ($_GET):
    $id = $_GET['id'];
    $action = $_GET['action'];
    $origen = $_GET['origen'];
    if ($action === "delete" && $origen === "user"):
        $userCon->eliminarUsuario($id);
        header("Location: index.php");
    endif;
    if ($action === "update" && $origen === "user"):
        $userUpdate = $userCon->obtenerUsuario($id);
    endif;
endif;
?>
<div class="container  margin-top-20px">

    <?php if (!$_GET): ?>
        <div>
            <a class="waves-effect waves-light btn-small btn modal-trigger" href="#modal1">
                <i class="material-icons right">
                    add_circle_outline
                </i>
                Agregar nuevo usuario
            </a>
        </div>
    <?php endif; ?>

    <?php
    if ($_GET):
        if ($_GET['action'] === "update" && $_GET['origen'] === "user"):
            ?>
            <div class="">
                <h4>Actualizar Usuario</h4>
                <div class="row margin-top-20px">
                    <form class="col s12" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                        id="txtPrimerNombre"
                                        name="txtPrimerNombre"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $userUpdate->nombre ?>"
                                        required
                                >
                                <label class="active" for="txtPrimerNombre">Primer Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input
                                        id="txtPrimerApellido"
                                        name="txtPrimerApellido"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $userUpdate->apellido ?>"
                                        required
                                >
                                <label class="active" for="txtPrimerApellido">Primer Apellido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtEmail"
                                        name="txtEmail"
                                        type="email"
                                        class="validate"
                                        value="<?php echo $userUpdate->email ?>"
                                        required
                                >
                                <label class="active" for="txtEmail">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="waves-effect waves-light btn" type="submit">Guardar</button>
                                <a class="waves-effect red btn" href="index.php#test2">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        endif;
    endif;
    ?>

    <section class="table">
        <table class="striped responsive-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $item): ?>
                <tr>
                    <td><?php echo $item->id ?></td>
                    <td><?php echo $item->nombre ?></td>
                    <td><?php echo $item->apellido ?></td>
                    <td><?php echo $item->nombre_completo ?></td>
                    <td><?php echo $item->email ?></td>
                    <td>
                        <a
                                class="waves-effect waves-light btn red"
                                href="index.php?id=<?php echo $item->id ?>&action=delete&origen=user#test2"
                        >
                            <i class="material-icons center">
                                delete
                            </i>
                        </a>
                        <a
                                class="waves-effect waves-light btn orange"
                                href="index.php?id=<?php echo $item->id ?>&action=update&origen=user#test2"
                        >
                            <i class="material-icons center">
                                create
                            </i>
                        </a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </section>

    <!-- Modal Register Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Registrar Usuario</h4>
            <div class="row margin-top-20px">
                <form class="col s12" method="POST">
                    <input
                            name="txtOrigen"
                            type="text"
                            class="hide"
                            value="user"
                            required
                    >
                    <div class="row">
                        <div class="input-field col s6">
                            <input
                                    placeholder="Ingrese su primer nombre"
                                    id="txtPrimerNombre"
                                    name="txtPrimerNombre"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtPrimerNombre">Primer Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input
                                    placeholder="ingrese su primero apellido"
                                    id="txtPrimerApellido"
                                    name="txtPrimerApellido"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtPrimerApellido">Primer Apellido</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    placeholder="ingrese su email"
                                    id="txtEmail"
                                    name="txtEmail"
                                    type="email"
                                    class="validate"
                                    required
                            >
                            <label for="txtEmail">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button class="waves-effect waves-light btn" type="submit">Guardar</button>
                            <button class="waves-effect red btn" type="reset">Limpiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>
</div>
