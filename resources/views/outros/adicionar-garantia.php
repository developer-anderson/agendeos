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
                                            <h4 class="card-title">Adicionar garantia</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="garantiaForm">
                                                    <div class="col-xxl-4 col-sm-5">
                                                        <fieldset class="form-group">
                                                            <label for="clienteGarantia">Nome do Cliente:</label>
                                                            <select class="custom-select block" id="clienteGarantia">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-5">
                                                        <fieldset class="form-group">
                                                            <label for="servicoGarantia">Serviço:</label>
                                                            <select class="custom-select block" id="servicoGarantia">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-5">
                                                        <fieldset class="form-group">
                                                            <label for="OsGarantia">O.S:</label>
                                                            <select class="custom-select block" id="OsGarantia">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-2">
                                                        <fieldset class="form-group">
                                                            <label for="placaVeiculoGarantia">Placa Veículo:</label>
                                                            <select class="custom-select block" id="placaVeiculoGarantia">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="dataServicoGarantia">Data do Serviço:</label>
                                                            <input type="date" class="form-control" id="clienteGarantia">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="periodoGarantia">Período de Garantia:</label>
                                                            <select class="custom-select block" id="clienteGarantia">
                                                                <option selected="">...</option>
                                                                <option selected="">3 meses</option>
                                                                <option selected="">6 meses</option>
                                                                <option selected="">12 meses</option>
                                                                <option selected="">24 meses</option>
                                                                <option selected="">32 meses</option>
                                                                <option selected="">48 meses</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="vencimentoGarantia">Vencimento:</label>
                                                            <input type="date" class="form-control" id="vencimentoGarantia">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group form-checked">
                                                            <p>Notificar ADMIN:</p>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="CheckNotificarAdmin">
                                                                <label class="custom-control-label" for="CheckNotificarAdmin">Desejo receber uma notificação um dia antes do vencimento</label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="submit" class="btn btn-primary" id="btnAddGarantia">
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