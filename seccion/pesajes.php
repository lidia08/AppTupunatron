<?php include('../template/cabecera.php');?>

<?php 

include('../config/bd.php');

$sentenciaSQL=$conexion->prepare("SELECT * FROM pesaje");
$sentenciaSQL->execute();
$lista_pesaje=$sentenciaSQL->FetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-12 text-center">
    <h3>PESAJES EN TIEMPO REAL </h3> 
    <br/>
    <table class="table table-bordered">
        <thead>
            <tr class="table-info">
                <th>ID</th>
                <th>Num_grupo</th>
                <th>Peso_bruto</th>
                <th>Peso_tara</th>
                <th>Peso_neto</th>
                <th>Peso_brutoTotal</th>
                <th>Peso_taraTotal</th>
                <th>Peso_netoTotal</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($lista_pesaje as $pesaje){ ?>   
            <tr class="table-secondary">
                <td scope="row"><?php echo $pesaje['id_pesaje'];?></td>
                <td><?php echo $pesaje['num_grupo']; ?></td>
                <td><?php echo $pesaje['peso_bruto']; ?></td>
                <td><?php echo $pesaje['peso_tara']; ?></td>
                <td><?php echo $pesaje['peso_neto']; ?></td>
                <td><?php echo $pesaje['bruto_total']; ?></td>
                <td><?php echo $pesaje['tara_total']; ?></td>
                <td><?php echo $pesaje['neto_total']; ?></td>
                <td><?php echo $pesaje['fecha']; ?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>

</div>

<?php include('../template/pie.php');?>