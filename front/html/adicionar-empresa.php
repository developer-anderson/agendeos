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
                                            <h4 class="card-title">Dados da empresa</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="EmpresaForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="razaoSocialEmpresa">Razão Social:</label>
                                                            <input type="text" class="form-control" id="razaoSocialEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeFantasiaEmpresa">Nome Fantasia:</label>
                                                            <input type="text" class="form-control" id="nomeFantasiaEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="cnpjCpfEmpresa">CNPJ/CPF:</label>
                                                            <input type="text" class="form-control" id="cnpjCpfEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="enderecoEmpresa">Endereço:</label>
                                                            <input type="text" class="form-control" id="enderecoEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="numeroEmpresa">Número:</label>
                                                            <input type="text" class="form-control" id="numeroEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="complementoEmpresa">Complemeto:</label>
                                                            <input type="text" class="form-control" id="complementoEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="ufEmpresa">UF:</label>
                                                            <input type="text" class="form-control" id="ufEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cidadeEmpresa">Cidade:</label>
                                                            <input type="text" class="form-control" id="cidadeEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="bairroEmpresa">Bairro:</label>
                                                            <input type="text" class="form-control" id="bairroEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cepEmpresa">CEP:</label>
                                                            <input type="text" class="form-control" id="cepEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="inscricaoEstadualEmpresa">Inscrição Estadual:</label>
                                                            <input type="text" class="form-control" id="inscricaoEstadualEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-2">
                                                        <fieldset class="form-group">
                                                            <label for="isentoEmpresa">Isento:</label>
                                                            <select class="custom-select block" id="isentoEmpresa">
                                                                <option selected="">...</option>
                                                                <option value="sim">Sim</option>
                                                                <option value="nao">Não</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="inscricaoEstadualStEmpresa">Inscrição Estadual ST:</label>
                                                            <input type="text" class="form-control" id="inscricaoEstadualStEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="inscricaoMunicipalEmpresa">Inscrição Municipal:</label>
                                                            <input type="text" class="form-control" id="inscricaoMunicipalEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="cnaeFiscalEmpresa">CNAE Fiscal:</label>
                                                            <input type="text" class="form-control" id="cnaeFiscalEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="regimeTributarioEmpresa">Regime Tributário:</label>
                                                            <select class="custom-select block" id="regimeTributarioEmpresa">
                                                                <option selected="">...</option>
                                                                <option value="mei">MEI</option>
                                                                <option value="simples-nacional">Simples Nacional</option>
                                                                <option value="lucro-real">Lucro Real</option>
                                                                <option value="lucro-presumido">Lucro Presumido</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="telefoneEmpresa">Telefone:</label>
                                                            <input type="text" class="form-control" id="telefoneEmpresa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="emailEmpresa">Email:</label>
                                                            <input type="email" class="form-control" id="emailEmpresa">
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="submit" class="btn btn-primary" id="btnAddEmpresa">
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