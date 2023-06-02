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
                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-4">
                                <label>Periodo Inicial</label>
                                <input type="date" value="<?php echo(date("Y-m-01"));?>" id="inicio"  class="form-control showdropdowns">
                               
                            </div>
                            <div class="col-4">
                            <label>Periodo Fim</label>
                                <input type="date" value="<?php echo(date("Y-m-31"));?>" id="fim"  class="form-control showdropdowns">
                               
                            </div>
                            <div class="col-4">
                            <button type="button" onclick="getAllFluxo()" class="btn btn-primary" style="margin-top: 26px;" id="btnAddServico">  <i class="fa fa-check-square-o"></i> Buscar registros</button>
                               
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
                                            <h3 class="heading-text text-bold-600 total_receita">R$ 50k</h3>
                                            <p class="sub-heading">Receita</p>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-3 col-geral-dates">
                                    <div class="card-geral-dates-content">
                                        <i class="icon p-1 icon-pie-chart customize-icon font-large-1 p-1 danger"></i>
                                        <div class="card-geral-dates-text">
                                            <h3 class="heading-text text-bold-600 total_Despesas">18.63%</h3>
                                            <p class="sub-heading">Despesas</p>
                                        </div>
                                     
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
                                            <h3 class="heading-text text-bold-600 total_servicos">13700</h3>
                                            <p class="sub-heading">Serviços realizados</p>
                                        </div>
                                
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
                                                                    <tbody id="treceitas" class="pesquisar">
                                                                        <tr>
                                                              
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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