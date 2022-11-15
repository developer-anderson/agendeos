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
                                            <h4 class="card-title">Lista de Produtos</h4>
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
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="data-table-scroll-x">
                                                                <table class="table table-striped table-bordered dataTable" id="DataTableProduto">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting_asc">Nome do Produto</th>
                                                                            <th class="sorting_asc">Código de Barras</th>
                                                                            <th class="sorting_asc">Fabricante</th>
                                                                            <th class="sorting_asc">Nº de Série</th>
                                                                            <th class="sorting_asc">Fornecedor</th>
                                                                            <th class="sorting_asc">Unidade</th>
                                                                            <th class="sorting_asc">Classificação</th>
                                                                            <th class="sorting_asc">Localização</th>
                                                                            <th class="sorting_asc">Valor da Venda (R$)</th>
                                                                            <th class="sorting_asc">Valor da Compra (R$)</th>
                                                                            <th class="sorting_asc">Estoque</th>
                                                                            <th class="sorting_asc">Situação</th>
                                                                            <th class="sorting_asc">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="big-item-table">Produto Teste 1</td>
                                                                            <td class="big-item-table">1234567891011121314151617</td>
                                                                            <td class="big-item-table">Fabricante teste 1</td>
                                                                            <td class="big-item-table">1234567891011</td>
                                                                            <td class="big-item-table">Fornecedor teste 1</td>
                                                                            <td>25</td>
                                                                            <td class="big-item-table">Classificação teste</td>
                                                                            <td class="big-item-table">Brasília</td>
                                                                            <td class="big-item-table">250,00</td>
                                                                            <td>100,00</td>
                                                                            <td>150</td>
                                                                            <td>Ativado</td>
                                                                            <td class="big-item-table action-buttons">
                                                                                <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button>

                                                                                <button class="edit-table-item" id="editTableItem"><i class="fa fa-pencil"></i></button>

                                                                                <button class="remove-table-item" id="removeTableItem"><i class="fa fa-trash-o"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="big-item-table">Produto Teste 1</td>
                                                                            <td class="big-item-table">1234567891011121314151617</td>
                                                                            <td class="big-item-table">Fabricante teste 1</td>
                                                                            <td class="big-item-table">1234567891011</td>
                                                                            <td class="big-item-table">Fornecedor teste 1</td>
                                                                            <td>25</td>
                                                                            <td class="big-item-table">Classificação teste</td>
                                                                            <td class="big-item-table">Brasília</td>
                                                                            <td class="big-item-table">250,00</td>
                                                                            <td>100,00</td>
                                                                            <td>150</td>
                                                                            <td>Ativado</td>
                                                                            <td class="big-item-table action-buttons">
                                                                                <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button>

                                                                                <button class="edit-table-item" id="editTableItem"><i class="fa fa-pencil"></i></button>

                                                                                <button class="remove-table-item" id="removeTableItem"><i class="fa fa-trash-o"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="big-item-table">Produto Teste 1</td>
                                                                            <td class="big-item-table">1234567891011121314151617</td>
                                                                            <td class="big-item-table">Fabricante teste 1</td>
                                                                            <td class="big-item-table">1234567891011</td>
                                                                            <td class="big-item-table">Fornecedor teste 1</td>
                                                                            <td>25</td>
                                                                            <td class="big-item-table">Classificação teste</td>
                                                                            <td class="big-item-table">Brasília</td>
                                                                            <td class="big-item-table">250,00</td>
                                                                            <td>100,00</td>
                                                                            <td>150</td>
                                                                            <td>Ativado</td>
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
                            </div>
                        </div>
                    </section>
                </main>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>