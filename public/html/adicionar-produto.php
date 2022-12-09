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
                                            <h4 class="card-title">Adicionar produto</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="produtoForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeProduto">Nome do Produto:</label>
                                                            <input type="text" class="form-control" id="nomeProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="codigoDeBarrasProduto">Código de Barras:</label>
                                                            <input type="text" class="form-control" id="codigoDeBarrasProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="fabricanteProduto">Fabricante:</label>
                                                            <input type="text" class="form-control" id="fabricanteProduto">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="numeroDeSerieProduto">Nº de Série:</label>
                                                            <input type="text" class="form-control" id="numeroDeSerieProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="FornecedorProduto">Fornecedor:</label>
                                                            <select class="custom-select block" id="FornecedorProduto">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="unidadeProduto">Unidade:</label>
                                                            <input type="text" class="form-control" id="unidadeProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="classificacaoProduto">Classificação:</label>
                                                            <select class="custom-select block" id="classificacaoProduto">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="localizacaoProduto">Localização:</label>
                                                            <input type="text" class="form-control" id="localizacaoProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="valorDaVendaProduto">Valor da Venda (R$):</label>
                                                            <input type="number" class="form-control" id="valorDaVendaProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="valorDaCompraProduto">Valor da Compra (R$):</label>
                                                            <input type="number" class="form-control" id="valorDaCompraProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="estoqueProduto">Estoque:</label>
                                                            <input type="number" class="form-control" id="estoqueProduto">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-2">
                                                        <fieldset class="form-group">
                                                            <label for="ativacaoCliente">Situação:</label>
                                                            <select class="custom-select block" id="ativacaoCliente">
                                                                <option selected="">...</option>
                                                                <option value="sim">Ativado</option>
                                                                <option value="nao">Desativado</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="submit" class="btn btn-primary" id="btnAddProduto">
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