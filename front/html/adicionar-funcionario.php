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
                                            <h4 class="card-title">Dados do funcionário</h4>
                                        </div>

                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="funcionarioForm">
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="nomeFuncionario">Nome:</label>
                                                            <input type="text" class="form-control" id="nomeFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="cpfFuncionario">CPF:</label>
                                                            <input type="text" class="form-control" id="cpfFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="rgFuncionario">RG:</label>
                                                            <input type="text" class="form-control" id="rgFuncionario">
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-xxl-4 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="emailFuncionario">Email:</label>
                                                            <input type="email" class="form-control" id="emailFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="telefoneFuncionario">Telefone:</label>
                                                            <input type="text" class="form-control" id="telefoneFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="whatsappCelularFuncionario">Whatsapp/Celular:</label>
                                                            <input type="text" class="form-control" id="whatsappCelularFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group form-checked">
                                                            <p>Sexo:</p>
                                                            <div class="box-checked">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="CheckFuncionarioMasculino">
                                                                    <label class="custom-control-label" for="CheckFuncionarioMasculino">Masculino</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="CheckFuncionarioFeminino">
                                                                    <label class="custom-control-label" for="CheckFuncionarioFeminino">Feminino</label>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="setorFuncionario">Setor:</label>
                                                            <select class="custom-select block" id="setorFuncionario">
                                                                <option selected="">...</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="senhaFuncionario">Senha:</label>
                                                            <input type="password" class="form-control" id="senhaFuncionario">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-xxl-2 col-sm-3">
                                                        <fieldset class="form-group">
                                                            <label for="confirmarSenhaFuncionario">Confirmar senha:</label>
                                                            <input type="password" class="form-control" id="confirmarSenhaFuncionario">
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="submit" class="btn btn-primary" id="btnAddFuncionario">
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