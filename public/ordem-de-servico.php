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
                                    <button type="button" class="btn btn-outline-primary btn-add-os" id="btnAddOs"><i class="fa fa-plus"></i> Lançar Os</button>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header card-header-flex">
                                            <h4 class="card-title mb-1">Lista de ordens de serviço</h4>
                                            <div class="form-group filter-date">
                                                <div class="input-group">
                                                    <input type="text" class="form-control showdropdowns">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-content">
                                            <div class="card-body card-dashboard">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                
                                                        <div class="col-sm-12 col-md-6">
                                                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                                <label class="label-data-table-search">
                                                                    <button type="button" class="btn-search-data-table"><i class="fa fa-search"></i></button>
                                                                    <input type="search" class="form-control form-control-sm input-serch-data-table" placeholder="Pesquisar" aria-controls="DataTables_Table_0">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="data-table-scroll-x">
                                                            <table class="table table-striped table-bordered dataTable" id="DataTableOs">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sorting_asc">ID da O.S.</th>
                                                                        <th class="sorting_asc">Valor(R$)</th>
                                                                        <th class="sorting_asc">Nome do cliente</th>
                                                                        <th class="sorting_asc">Serviço</th>
                                                                        <th class="sorting_asc">Veículo</th>
                                                                        <th class="sorting_asc">Data e horário da O.S.</th>
                                                                        <th class="sorting_asc">Previsão de entrega</th>
                                                                        
                                                                        <th class="sorting_asc">Status</th>
                                                                        <th class="sorting_asc">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tos" class="pesquisar">
                                                             
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-modal d-none" id="modalOs">
                                    <div class="addOsModal">
                                        <div class="row">
                                            <div class="col-12 col-mobile">
                                                <div class="card card-modal">
                                                    <div class="card-header">
                                                        <h4 class="card-title card-title-modal-mobile">Adicionar ordem de serviço</h4>

                                                        <button type="button" onclick="limparForm()" class="btn btn-close-modal" id="btnCloseModalOs"><i class="fa fa-times"></i></button>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form class="row" id="OrdemDeServicoForm">
                                                                <div class="col-xxl-6 col-sm-6">
                                                                    <fieldset class="form-group">
                                                                        <label for="servicoOs">Serviço:</label>
                                                                        <select name="id_servico[]" onchange="getTerminoPrevisao()" class="custom-select block select2 select2-placeholder" multiple id="lservicos">
                                                                            <option selected="">...</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <input name="user_id" type="hidden" class="form-control user_id" id="user_id">
                                                                <div class="col-xxl-6 col-sm-6">
                                                                    <fieldset class="form-group">
                                                                        <label for="clienteOs">Nome do cliente:</label>
                                                                        <select  name="id_cliente" onchange="getAllCarByCliente(this.value)" class="custom-select block select2-placeholder" id="donoVeiculo">
                                                                          
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Veículo</label>
                                                                        <div class="input-group date">
                                                                            <select name="id_veiculo" class="custom-select block select2-placeholder" id="id_veiculo">
                                                                                <option selected="">...</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Data de inicio da OS</label>
                                                                        <input type="date" class="form-control"  name="inicio_os"  id="inicio_os">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>Horário de inicio da OS</label>
                                                                        <input type="time" class="form-control"  name="inicio_os_time" onchange="getTerminoPrevisao()"  id="inicio_os_time">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Previsão de entrega</label>
                                                                        <input type="date" class="form-control" name="previsao_os" id="previsao_os">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>Horário previsto da entrega</label>
                                                                        <input type="time" class="form-control" name="previsao_os_time" id="previsao_os_time">
                                                                    </div>
                                                                </div>
                                                                <input name="user_id" type="hidden" class="form-control user_id" id="user_id">
                                                                <div class="col-xxl-2 col-sm-2">
                                                                    <fieldset class="form-group">
                                                                        <label for="clienteOs">Remarketing (dias):</label>
                                                                        <input type="text" class="form-control" name="remarketing" id="remarketing">
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-4 col-sm-4">
                                                                    <fieldset class="form-group">
                                                                        <label for="situacao">Situação:</label>
                                                                        <select class="custom-select block" name="situacao" id="situacao">
                                                                            <option value="0">Aguardando Pagamento</option>
                                                                            <option value="1">Pago</option>
                                                                            <option value="2">Pago - serviço iniciado</option>
                                                                            <option value="3">Pago - Aguardando retirada do Cliente</option>
                                                                            <option value="4">Pago - Remarketing</option>
                                                                            <option value="5">Remarketing</option>
                                                                            <option value="6">Cancelado</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-12 col-sm-12">
                                                                    <fieldset class="form-group">
                                                                        <label for="observacoesOs">Observações</label>
                                                                        <textarea class="form-control" name="observacoes" id="observacoes" rows="4"></textarea>
                                                                    </fieldset>
                                                                </div>
                                                            </form>
                                                            <button type="button" onclick="addOs('OrdemDeServicoForm')" class="btn btn-primary" id="btnAddServico">
                                                                <i class="fa fa-check-square-o"></i> Adicionar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
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