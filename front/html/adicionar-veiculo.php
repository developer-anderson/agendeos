<?php include 'head.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 col-dashboard">
                <?php include 'dashboard-menu.php'; ?>
            </div>

            <div class="col-12 col-sm-10 col-geral-content">
                <?php include 'header.php'; ?>

                <main>
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-mobile">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Dados do veículo</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="veiculoForm">
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="placaVeiculo">Placa:</label>
                                                            <input type="text" name="placa" class="form-control" id="placaVeiculo">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="marcaVeiculo">Marca:</label>
                                                            <input class="form-control" name="marca" id='marca' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="modeloVeiculo">Modelo:</label>
                                                            <input class="form-control" name="modelo" id='modelo' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="corVeiculo">Cor:</label>
                                                            <input class="form-control" name="cor" id='cor' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="donoVeiculo">Dono do Veículo:</label>
                                                            <select class="custom-select block" name="id_cliente" id="donoVeiculo">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="observacoesVeiculo">Observações</label>
                                                            <textarea class="form-control" name="observacoes" id="observacoesVeiculo" rows="4"></textarea>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="button"  onclick="addVeiculo('veiculoForm')" class="btn btn-primary" id="btnAddVeiculo">
                                                    <i class="fa fa-check-square-o"></i> Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>