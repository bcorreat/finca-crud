<?php
require_once "controllers/userController.php";
require_once "controllers/farmController.php";

$userCon = new userController();
$farmCon = new farmController();
$users = $userCon->obtenerUsuarios();
$farms = $farmCon->obtenerFincas();

try {
    // registrar item
    if ($_POST && !$_GET):
        if ($_POST['txtOrigen'] === "farm"):
            $propietario = $userCon->obtenerUsuario($_POST["txtPropietario"]);
            $newFarm = array(
                "id_usuario" => $_POST["txtPropietario"],
                "nombre" => $_POST["txtNombre"],
                "hectareas" => $_POST["txtHectareas"],
                "metros_cuadrados" => $_POST["txtMetrosCuadrados"],
                "pais" => $_POST["txtPais"],
                "departamento" => $_POST["txtDepartamento"],
                "ciudad" => $_POST["txtCiudad"],
                "si_produce_leche" => $_POST["txtSiProduceLeche"] === "on" ? "SI" : "NO",
                "si_produce_cereales" => $_POST["txtSiProduceCereal"] === "on" ? "SI" : "NO",
                "si_produce_frutas" => $_POST["txtSiProduceFrutas"] === "on" ? "SI" : "NO",
                "si_produce_verduras" => $_POST["txtSiProduceVerduras"] === "on" ? "SI" : "NO",
                "propietario_finca" => $propietario->nombre,
                "capataz" => $_POST["txtCapataz"],
            );
            $farmCon->registrarFinca($newFarm);

            header_remove();
            header("Location: ../index.php");
        endif;
    endif;

// actualizar
    if ($_POST && $_GET):
        $action = $_GET['action'];
        $id = $_GET['id'];
        if ($action === "update" && $_POST['txtOrigen'] === "farm"):
            $propietario = $userCon->obtenerUsuario($_POST["txtPropietario"]);
            $updateFarm = array(
                "id_usuario" => $_POST["txtPropietario"],
                "nombre" => $_POST["txtNombre"],
                "hectareas" => $_POST["txtHectareas"],
                "metros_cuadrados" => $_POST["txtMetrosCuadrados"],
                "pais" => $_POST["txtPais"],
                "departamento" => $_POST["txtDepartamento"],
                "ciudad" => $_POST["txtCiudad"],
                "si_produce_leche" => $_POST["txtSiProduceLeche"] === "on" ? "SI" : "NO",
                "si_produce_cereales" => $_POST["txtSiProduceCereal"] === "on" ? "SI" : "NO",
                "si_produce_frutas" => $_POST["txtSiProduceFrutas"] === "on" ? "SI" : "NO",
                "si_produce_verduras" => $_POST["txtSiProduceVerduras"] === "on" ? "SI" : "NO",
                "propietario_finca" => $propietario->nombre,
                "capataz" => $_POST["txtCapataz"],
            );
            $farmCon->actualizarFinca($id, $updateFarm);

            header_remove();
            header("Location: ../index.php");
        endif;
    endif;

// eliminar o llamar metodo para obtener informacion del item
    if ($_GET):
        $id = $_GET['id'];
        $action = $_GET['action'];
        $origen = $_GET['origen'];
        if ($action === "delete" && $origen === "farm"):
            $farmCon->eliminarFinca($id);

            header_remove();
            header("Location: ../index.php");
        endif;
        if ($action === "update"):
            $farmUpdate = $farmCon->obtenerFinca($id);
        endif;
    endif;
} catch (Exception $e) {

}
?>

<div class="container  margin-top-20px">

    <?php if (!$_GET): ?>
        <div>
            <a class="waves-effect waves-light btn-small btn modal-trigger" href="#registerModal">
                <i class="material-icons right">
                    add_circle_outline
                </i>
                Agregar nueva finca
            </a>
        </div>
    <?php endif; ?>

    <?php
    if ($_GET):
        if ($_GET['action'] === "update" && $_GET['origen'] === "farm"):
            ?>
            <div class="">
                <h4>Actualizar Finca</h4>
                <div class="row margin-top-20px">
                    <form class="col s12" method="post">
                        <input
                                name="txtOrigen"
                                type="text"
                                class="hide"
                                value="farm"
                                required
                        >
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                        id="txtNombre"
                                        name="txtNombre"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->nombre ?>"
                                        required
                                >
                                <label for="txtNombre">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input
                                        id="txtHectareas"
                                        name="txtHectareas"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->hectareas ?>"
                                        required
                                >
                                <label for="txtHectareas">Hectareas</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtMetrosCuadrados"
                                        name="txtMetrosCuadrados"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->metros_cuadrados ?>"
                                        required
                                >
                                <label for="txtMetrosCuadrados">Metros cuadrados</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtPais"
                                        name="txtPais"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->pais ?>"
                                        required
                                >
                                <label for="txtPais">Pais</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtDepartamento"
                                        name="txtDepartamento"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->departamento ?>"
                                        required
                                >
                                <label for="txtDepartamento">Departamento</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtCiudad"
                                        name="txtCiudad"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->ciudad ?>"
                                        required
                                >
                                <label for="txtCiudad">Ciudad</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <select
                                        id="txtPropietario"
                                        name="txtPropietario"
                                        value="<?php echo $farmUpdate->propietario_finca ?>"
                                        required
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <?php foreach ($users as $itemOption): ?>
                                        <option value="<?php echo $itemOption->id ?>">
                                            <?php echo $itemOption->nombre ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="txtPropietario">Propietario</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                        id="txtCapataz"
                                        name="txtCapataz"
                                        type="text"
                                        class="validate"
                                        value="<?php echo $farmUpdate->capataz ?>"
                                        required
                                >
                                <label for="txtCapataz">Capataz</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        <input
                                            type="checkbox"
                                            id="txtSiProduceLeche"
                                            name="txtSiProduceLeche"
                                            value="<?php echo $farmUpdate->si_produce_leche === 'SI' ?>"
                                        >
                                        <span class="lever"></span>
                                    </label>
                                    <label for="txtSiProduceLeche">¿Produce leche?</label>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" id="txtSiProduceCereal" name="txtSiProduceCereal">
                                        <span class="lever"></span>
                                    </label>
                                    <label for="txtSiProduceCereal">¿Produce Cereal?</label>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" id="txtSiProduceFrutas" name="txtSiProduceFrutas">
                                        <span class="lever"></span>
                                    </label>
                                    <label for="txtSiProduceFrutas">¿Produce Frutas?</label>
                                </div>
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" id="txtSiProduceVerduras" name="txtSiProduceVerduras">
                                        <span class="lever"></span>
                                    </label>
                                    <label for="txtSiProduceVerduras">¿Produce Verduras?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="waves-effect waves-light btn" type="submit">Guardar</button>
                                <a class="waves-effect red btn" href="index.php#test1">Cancelar</a>
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
                <th>Hectareas</th>
                <th>Metros Cuadrados</th>
                <th>Pais</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>¿Produce leche?</th>
                <th>¿Produce cereales?</th>
                <th>¿Produce frutas?</th>
                <th>¿Produce verduras?</th>
                <th>Propietario</th>
                <th>Capataz</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($farms as $item): ?>
                <tr>
                    <td><?php echo $item->id ?></td>
                    <td><?php echo $item->nombre ?></td>
                    <td><?php echo $item->hectareas ?></td>
                    <td><?php echo $item->metros_cuadrados ?></td>
                    <td><?php echo $item->pais ?></td>
                    <td><?php echo $item->departamento ?></td>
                    <td><?php echo $item->ciudad ?></td>
                    <td><?php echo $item->si_produce_leche ?></td>
                    <td><?php echo $item->si_produce_cereales ?></td>
                    <td><?php echo $item->si_produce_frutas ?></td>
                    <td><?php echo $item->si_produce_verduras ?></td>
                    <td><?php echo $item->propietario_finca ?></td>
                    <td><?php echo $item->capataz ?></td>
                    <td>
                        <a
                                class="waves-effect waves-light btn red"
                                href=" index.php?id=<?php echo $item->id ?>&action=delete&origen=farm#test1"
                        >
                            <i class="material-icons center">
                                delete
                            </i>
                        </a>
                        <a
                                class="waves-effect waves-light btn orange"
                                href=" index.php?id=<?php echo $item->id ?>&action=update&origen=farm#test1"
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
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <h4>Registrar Finca</h4>
            <div class="row margin-top-20px">
                <form class="col s12" method="post">
                    <input
                            name="txtOrigen"
                            type="text"
                            class="hide"
                            value="farm"
                            required
                    >
                    <div class="row">
                        <div class="input-field col s6">
                            <input
                                    id="txtNombre"
                                    name="txtNombre"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtNombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input
                                    id="txtHectareas"
                                    name="txtHectareas"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtHectareas">Hectareas</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    id="txtMetrosCuadrados"
                                    name="txtMetrosCuadrados"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtMetrosCuadrados">Metros cuadrados</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    id="txtPais"
                                    name="txtPais"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtPais">Pais</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    id="txtDepartamento"
                                    name="txtDepartamento"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtDepartamento">Departamento</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    id="txtCiudad"
                                    name="txtCiudad"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtCiudad">Ciudad</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="select-dropdown input-field col s12">
                            <select
                                    id="txtPropietario"
                                    name="txtPropietario"
                                    required
                            >
                                <option value="" selected disabled>Seleccione una opción</option>
                                <?php foreach ($users as $itemOption): ?>
                                    <option value="<?php echo $itemOption->id ?>">
                                        <?php echo $itemOption->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="txtPropietario">Propietario</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input
                                    id="txtCapataz"
                                    name="txtCapataz"
                                    type="text"
                                    class="validate"
                                    required
                            >
                            <label for="txtCapataz">Capataz</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="txtSiProduceLeche" name="txtSiProduceLeche">
                                    <span class="lever"></span>
                                </label>
                                <label for="txtSiProduceLeche">¿Produce leche?</label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="txtSiProduceCereal" name="txtSiProduceCereal">
                                    <span class="lever"></span>
                                </label>
                                <label for="txtSiProduceCereal">¿Produce Cereal?</label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="txtSiProduceFrutas" name="txtSiProduceFrutas">
                                    <span class="lever"></span>
                                </label>
                                <label for="txtSiProduceFrutas">¿Produce Frutas?</label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="txtSiProduceVerduras" name="txtSiProduceVerduras">
                                    <span class="lever"></span>
                                </label>
                                <label for="txtSiProduceVerduras">¿Produce Verduras?</label>
                            </div>
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
