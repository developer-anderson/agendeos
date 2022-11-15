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
                                            <h4 class="card-title">Dados do cliente</h4>
                                        </div>

                                        <div class="client-type">
                                            <h6>Selecione o tipo de cliente:</h6>

                                            <button type="button" class="btn btn-primary mr-2" id="btnClientPf" onclick="changeFormClientPf()">
                                                Pessoa Física
                                            </button>

                                            <button type="button" class="btn btn-primary btn-disable" id="btnClientPj" onclick="changeFormClientPj()">
                                                Pessoa Jurídica
                                            </button>
                                        </div>

                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="clientePfForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeClientePf">Nome:</label>
                                                            <input type="text" class="form-control" id="nomeClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="cpfClientePf">CPF:</label>
                                                            <input type="text" class="form-control" id="cpfClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="rgClientePf">RG:</label>
                                                            <input type="text" class="form-control" id="rgClientePf">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="emailClientePf">Email:</label>
                                                            <input type="email" class="form-control" id="emailClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="telefoneClientePf">Telefone:</label>
                                                            <input type="text" class="form-control" id="telefoneClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="whatsappCelularClientePf">Whatsapp/Celular:</label>
                                                            <input type="text" class="form-control" id="whatsappCelularClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group form-checked">
                                                            <p>Sexo:</p>
                                                            <div class="box-checked">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="CheckClientePfMasculino">
                                                                    <label class="custom-control-label" for="CheckClientePfMasculino">Masculino</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="CheckClientePfFeminino">
                                                                    <label class="custom-control-label" for="CheckClientePfFeminino">Feminino</label>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-12 mb-3 card-header">
                                                        <h4 class="card-title">Dados de endereço</h4>
                                                    </div>

                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cepClientePf">CEP:</label>
                                                            <input type="text" class="form-control" id="cepClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="enderecoClientePf">Endereço:</label>
                                                            <input type="text" class="form-control" id="enderecoClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="enderecoNumeroClientePf">Número:</label>
                                                            <input type="text" class="form-control" id="enderecoNumeroClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="complementoClientePf">Complemento:</label>
                                                            <input type="text" class="form-control" id="complementoClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="bairroClientePf">Bairro:</label>
                                                            <input type="text" class="form-control" id="bairroClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="estadoClientePf">Estado:</label>
                                                            <input type="text" class="form-control" id="estadoClientePf">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cidadeClientePf">Cidade:</label>
                                                            <input type="text" class="form-control" id="cidadeClientePf">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="observacoesClientePf">Observações</label>
                                                            <textarea class="form-control" id="observacoesClientePf" rows="4"></textarea>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="submit" class="btn btn-primary" id="btnAddClientePf">
                                                    <i class="fa fa-check-square-o"></i> Adicionar
                                                </button>

                                                <form class="row d-none" id="clientePjForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="razaoSocialClientePj">Razão Social:</label>
                                                            <input type="text" class="form-control" id="razaoSocialClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="cnpjClientePj">CNPJ:</label>
                                                            <input type="text" class="form-control" id="cnpjClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="ieClientePj">I.E:</label>
                                                            <input type="text" class="form-control" id="ieClientePj">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="emailClientePj">Email:</label>
                                                            <input type="email" class="form-control" id="emailClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="telefoneClientePj">Telefone:</label>
                                                            <input type="text" class="form-control" id="telefoneClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="whatsappCelularClientePj">Whatsapp/Celular:</label>
                                                            <input type="text" class="form-control" id="whatsappCelularClientePj">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-12 mb-3 card-header">
                                                        <h4 class="card-title">Dados do responsável</h4>
                                                    </div>

                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeResponsavelClientePj">Nome do Responsável:</label>
                                                            <input type="text" class="form-control" id="responsavelClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="emailResponsavelClientePj">Email:</label>
                                                            <input type="email" class="form-control" id="emailResponsavelClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="telefoneResponsavelClientePj">Telefone:</label>
                                                            <input type="text" class="form-control" id="telefoneResponsavelClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="whatsappResponsavelClientePj">Celular/Whatsapp:</label>
                                                            <input type="text" class="form-control" id="whatsappResponsavelClientePj">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-12 mb-3 card-header">
                                                        <h4 class="card-title">Dados de endereço</h4>
                                                    </div>

                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cepClientePj">CEP:</label>
                                                            <input type="text" class="form-control" id="cepClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="enderecoClientePj">Endereço:</label>
                                                            <input type="text" class="form-control" id="enderecoClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="enderecoNumeroClientePj">Número:</label>
                                                            <input type="text" class="form-control" id="enderecoNumeroClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="complementoClientePj">Complemento:</label>
                                                            <input type="text" class="form-control" id="complementoClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="bairroClientePj">Bairro:</label>
                                                            <input type="text" class="form-control" id="bairroClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="estadoClientePj">Estado:</label>
                                                            <input type="text" class="form-control" id="estadoClientePj">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="cidadeClientePj">Cidade:</label>
                                                            <input type="text" class="form-control" id="cidadeClientePj">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-3 col-sm-4">
                                                        <fieldset class="form-group">
                                                            <label for="observacoesClientePj">Observações</label>
                                                            <textarea class="form-control" id="observacoesClientePj" rows="4"></textarea>
                                                        </fieldset>
                                                    </div>
                                                </form>

                                                <button type="submit" class="btn btn-primary d-none" id="btnAddClientePj">
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