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
                                            <h4 class="card-title">Lançar</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="row" id="fluxoForm">
                                                    <div class="col-6">
                                                    <input name="user_id" type="hidden" class="form-control user_id" id="user_id">
                                                        <fieldset class="form-group">
                                                            <label for="nome">Nome do item:</label>
                                                            <input type="text" name="nome" class="form-control" id="nome">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="data">Data:</label>
                                                            <input type="date" class="form-control" name="data" id='data' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="tipo_id">Tipo:</label>
                                                            <select class="form-control" name="tipo_id" id='tipo_id'>
                                                            <option value="1">Selecione o tipo</option>
                                                                <option value="0">Despesa</option>
                                                                <option value="1">Receita</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="os_id">OS:</label>
                                                            <select class="form-control  select2-placeholder" name="os_id"  id='responsive_single'>
                                                              
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="os_id">Forma de Pagamento:</label>
                                                            <select class="form-control  select2-placeholder" name="pagamento_id"  id='responsive_single1'>
                                                                <option value="0">Aguardando Pagamento</option>
                                                                <option value="6">Cancelado</option>
                                                                <option value="1">Pago - em Dinehrio </option>
                                                                <option value="2">Pago - em Cartão de Crédito </option>
                                                                <option value="3">Pago - em Cartão  Débito </option>
                                                                <option value="4">Pago - em Boleto </option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="data">Valor do item:</label>
                                                            <input type="text" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" name="valor" value="0" id='valor' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="data">Desconto:</label>
                                                            <input type="text" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" value="0" name="desconto" id='desconto' />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-6">
                                                        <fieldset class="form-group">
                                                            <label for="os_id">Cliente:</label>
                                                            <select class="form-control  select2-placeholder" name="cliente_id"  id='donoVeiculo'>
                                                         
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <button type="button"  onclick="addFluxo('fluxoForm')" class="btn btn-primary" id="btnAddfluxo">
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