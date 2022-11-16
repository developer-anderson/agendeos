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
                                    <button type="button" class="btn btn-outline-primary btn-add-os" id="btnAddOs"><i class="fa fa-plus"></i> Add</button>
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
                                                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                                                <label>
                                                                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select custom-select-sm form-control form-control-sm">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select> Páginas
                                                                </label>
                                                            </div>
                                                        </div>
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
                                                                        <th class="sorting_asc">Observações</th>
                                                                        <th class="sorting_asc">Status</th>
                                                                        <th class="sorting_asc">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="big-item-table id-os">
                                                                            <a href="#">#123456</a>
                                                                        </td>
                                                                        <td class="big-item-table">800,00</td>
                                                                        <td class="big-item-table">Cliente teste</td>
                                                                        <td class="big-item-table">Serviço teste</td>
                                                                        <td class="big-item-table">123ABC</td>
                                                                        <td class="big-item-table">15/02/2022 às 15:30</td>
                                                                        <td class="big-item-table">15/03/2022</td>
                                                                        <td class="xxl-item-table">Lorem ipsum dolor, sit amet consectetur adipisicing elit</td>
                                                                        <td>
                                                                            <div class="badge badge-success">
                                                                                Em aberto
                                                                            </div>
                                                                        </td>
                                                                        <td class="big-item-table action-buttons">
                                                                            <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button>

                                                                            <button class="edit-table-item" id="editTableItem"><i class="fa fa-pencil"></i></button>

                                                                            <button class="remove-table-item" id="removeTableItem"><i class="fa fa-trash-o"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="big-item-table id-os">
                                                                            <a href="#">#123456</a>
                                                                        </td>
                                                                        <td class="big-item-table">800,00</td>
                                                                        <td class="big-item-table">Cliente teste</td>
                                                                        <td class="big-item-table">Serviço teste</td>
                                                                        <td class="big-item-table">123ABC</td>
                                                                        <td class="big-item-table">15/02/2022 às 15:30</td>
                                                                        <td class="big-item-table">15/03/2022</td>
                                                                        <td class="xxl-item-table">Lorem ipsum dolor, sit amet consectetur adipisicing elit</td>
                                                                        <td>
                                                                            <div class="badge badge-warning">
                                                                                Em atraso
                                                                            </div>
                                                                        </td>
                                                                        <td class="big-item-table action-buttons">
                                                                            <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button>

                                                                            <button class="edit-table-item" id="editTableItem"><i class="fa fa-pencil"></i></button>

                                                                            <button class="remove-table-item" id="removeTableItem"><i class="fa fa-trash-o"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="big-item-table id-os">
                                                                            <a href="#">#123456</a>
                                                                        </td>
                                                                        <td class="big-item-table">800,00</td>
                                                                        <td class="big-item-table">Cliente teste</td>
                                                                        <td class="big-item-table">Serviço teste</td>
                                                                        <td class="big-item-table">123ABC</td>
                                                                        <td class="big-item-table">15/02/2022 às 15:30</td>
                                                                        <td class="big-item-table">15/03/2022</td>
                                                                        <td class="xxl-item-table">Lorem ipsum dolor, sit amet consectetur adipisicing elit</td>
                                                                        <td>
                                                                            <div class="badge badge-danger">
                                                                                Cancelado
                                                                            </div>
                                                                        </td>
                                                                        <td class="big-item-table action-buttons">
                                                                            <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button>

                                                                            <button class="edit-table-item" id="editTableItem"><i class="fa fa-pencil"></i></button>

                                                                            <button class="remove-table-item" id="removeTableItem"><i class="fa fa-trash-o"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-5">
                                                            <p>Página 1 de 3</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-7">
                                                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                                                <ul class="pagination">
                                                                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" data-dt-idx="0" class="page-link">Anterior</a></li>
                                                                    <li class="paginate_button page-item active"><a href="#" data-dt-idx="1" class="page-link">1</a></li>
                                                                    <li class="paginate_button page-item "><a href="#" data-dt-idx="2" class="page-link">2</a></li>
                                                                    <li class="paginate_button page-item "><a href="#" data-dt-idx="3" class="page-link">3</a></li>
                                                                    <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" class="page-link">Próximo</a></li>
                                                                </ul>
                                                            </div>
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

                                                        <button type="button" class="btn btn-close-modal" id="btnCloseModalOs"><i class="fa fa-times"></i></button>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form class="row" id="OrdemDeServicoForm">
                                                                <div class="col-xxl-6 col-sm-6">
                                                                    <fieldset class="form-group">
                                                                        <label for="servicoOs">Serviço:</label>
                                                                        <select class="custom-select block" id="servicoOs">
                                                                            <option selected="">...</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-6 col-sm-6">
                                                                    <fieldset class="form-group">
                                                                        <label for="clienteOs">Nome do cliente:</label>
                                                                        <select class="custom-select block" id="clienteOs">
                                                                            <option selected="">...</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-3 col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Veículo</label>
                                                                        <div class="input-group date">
                                                                            <select class="custom-select block" id="clienteOs">
                                                                                <option selected="">...</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-3 col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Data e horário da OS</label>
                                                                        <div class="input-group date" id="datetimepicker1">
                                                                            <input type="text" class="form-control" id="dataHorarioOs">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">
                                                                                    <span class="fa fa-calendar"></span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-3 col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Previsão de entrega</label>
                                                                        <div class="input-group date" id="datetimepicker2">
                                                                            <input type="text" class="form-control" id="dataEntregaOs">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">
                                                                                    <span class="fa fa-calendar"></span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-2 col-sm-3">
                                                                    <fieldset class="form-group">
                                                                        <label for="clienteOs">Remarketing:</label>
                                                                        <select class="custom-select block" id="clienteOs">
                                                                            <option selected="">Não se aplica</option>
                                                                            <option selected="">8 dias</option>
                                                                            <option selected="">15 dias</option>
                                                                            <option selected="">30 dias</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xxl-12 col-sm-12">
                                                                    <fieldset class="form-group">
                                                                        <label for="observacoesOs">Observações</label>
                                                                        <textarea class="form-control" id="observacoesOs" rows="4"></textarea>
                                                                    </fieldset>
                                                                </div>
                                                            </form>
                                                            <button type="submit" class="btn btn-primary" id="btnAddServico">
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