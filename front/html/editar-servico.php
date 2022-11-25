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
                                            <h4 class="card-title">Adicionar serviço</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="servicoForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeServico">Nome do Serviço:</label>
                                                            <input type="text" name="nome" class="form-control" id="nomeServico">
                                                        </fieldset>
                                                        <input name="user_id" type="hidden" class="form-control user_id" id="user_id">
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="valorServico">Valor do Serviço (R$):</label>
                                                            <input type="number" name="valor" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" id="valorServico">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-6 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="observacoesGeraisCliente">Observações Gerais</label>
                                                            <textarea class="form-control" name="observacoes" id="observacoesGeraisCliente" rows="6"></textarea>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="button" onclick="addServico('servicoForm')" class="btn btn-primary" id="btnAddServico">
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
    </div><?php include 'head.php'; ?>

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
                                            <h4 class="card-title">Adicionar serviço</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="servicoForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeServico">Nome do Serviço:</label>
                                                            <input type="text" name="nome" class="form-control" id="nomeServico">
                                                        </fieldset>
                                                        <input name="user_id" type="hidden" class="form-control user_id" id="user_id">
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="valorServico">Valor do Serviço (R$):</label>
                                                            <input type="number" name="valor" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" id="valorServico">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-6 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="observacoesGeraisCliente">Observações Gerais</label>
                                                            <textarea class="form-control" name="observacoes" id="observacoes" rows="6"></textarea>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="button" onclick="addServico('servicoForm')" class="btn btn-primary" id="btnAddServico">
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