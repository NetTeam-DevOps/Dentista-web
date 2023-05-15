<div class="container title">
    <h2>
        <span>CONSULTAS</span>
    </h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?=ROOT?>ficha_consulta/new"><button type="button" class="btn btn-success">Nuevo</button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tablaDatos" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Id. Consulta</th>
                            <th>Paciente</th>
                            <th>Especialista</th>
                            <th>Monto(bs)</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="list-data">
                        <?php while($consulta = $consultas->fetch((PDO::FETCH_OBJ))):?>
                        <tr>
                            <td><?= $consulta->id ?></td>
                            <td><?= $consulta->id_paciente ?></td>
                            <td><?= $consulta->id_especialista ?></td>
                            <td><?= $consulta->monto ?></td>
                            <td><?= $consulta->fecha ?></td>
                            <td><?= $consulta->hora ?></td>
                            <td>
                                <div class='text-center'>    
                                    <div class='btn-group'>
                                        <a href="<?=ROOT?>ficha_consulta/editView&id=<?=$consulta->id?>&id_p=<?=$consulta->id_paciente?>&id_e=<?=$consulta->id_especialista?>"><button type='button' class='btn btn-primary' id='btnEdit-consulta'>Editar</button></a>
                                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modalDelete' id='btnDelete-consulta'>Eliminar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal Delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLabel">Eliminar Consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?=ROOT?>ficha_consulta/delete" method="POST">
            <div class="modal-body">
                <input type="hidden" name="id" id="delete-id">
                <h4>¿Esta seguro que desea eliminar esta consulta??</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="confirm-button">Si</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="refuse-button">No</button>
            </div>
        </form>
        </div>
    </div>
</div>