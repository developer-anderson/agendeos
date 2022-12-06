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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-mobile px-1">
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
                        </div>
                    </div>

                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-3 col-geral-dates">
                                    <div class="card-geral-dates-content">
                                        <i class="icon p-1 icon-bar-chart customize-icon font-large-1 p-1 text-blue"></i>
                                        <div class="card-geral-dates-text">
                                            <h3 class="heading-text text-bold-600">R$ 50k</h3>
                                            <p class="sub-heading">Receita</p>
                                        </div>
                                        <span class="inc-dec-percentage">
                                            <small class="success"><i class="fa fa-long-arrow-up"></i> 5.2%</small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-geral-dates">
                                    <div class="card-geral-dates-content">
                                        <i class="icon p-1 icon-pie-chart customize-icon font-large-1 p-1 danger"></i>
                                        <div class="card-geral-dates-text">
                                            <h3 class="heading-text text-bold-600">18.63%</h3>
                                            <p class="sub-heading">Crescimento</p>
                                        </div>
                                        <span class="inc-dec-percentage">
                                            <small class="danger"><i class="fa fa-long-arrow-down"></i> 2.0%</small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-geral-dates">
                                    <div class="card-geral-dates-content">
                                        <i class="icon p-1 icon-graph customize-icon font-large-1 p-1 success"></i>
                                        <div class="card-geral-dates-text">
                                            <h3 class="heading-text text-bold-600">R$ 27k</h3>
                                            <p class="sub-heading">Vendas</p>
                                        </div>
                                        <span class="inc-dec-percentage">
                                            <small class="success"><i class="fa fa-long-arrow-up"></i> 10.0%</small>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-geral-dates">
                                    <div class="card-geral-dates-content">
                                        <i class="icon p-1 icon-basket-loaded customize-icon font-large-1 p-1 warning"></i>
                                        <div class="card-geral-dates-text">
                                            <h3 class="heading-text text-bold-600">13700</h3>
                                            <p class="sub-heading">Pedidos</p>
                                        </div>
                                        <span class="inc-dec-percentage">
                                            <small class="danger"><i class="fa fa-long-arrow-down"></i> 13.6%</small>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12 col-data-table-receitas">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Receitas</h4>
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
                                                                <table class="table table-striped table-bordered dataTable" id="DataTableOs">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting_asc">ID da nota</th>
                                                                            <th class="sorting_asc">Valor(R$)</th>
                                                                            <th class="sorting_asc">Desconto(R$)</th>
                                                                            <th class="sorting_asc">Tipo</th>
                                                                            <th class="sorting_asc">Nome do item</th>
                                                                            <th class="sorting_asc">Data</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="treceitas">
                                                                        <tr>
                                                              
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