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
                                            <h4 class="card-title">Lista de clientes</h4>
                                        </div>

                                        <div class="client-type">
                                            <h6>Selecione o tipo de cliente:</h6>

                                            <button type="button" class="btn btn-primary mr-2" id="btnDataTablePf" onclick="changeDataTableClientPf()">
                                                Pessoa Física
                                            </button>

                                            <button type="button" class="btn btn-primary btn-disable" id="btnDataTablePj" onclick="changeDataTableClientPj()">
                                                Pessoa Jurídica
                                            </button>
                                        </div>

                                        <div class="card-content" id="cardContentClientPf">
                                            <div class="card-body card-dashboard">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                    <div class="col-sm-12 col-md-6"></div>
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
                                                            <table class="table table-striped table-bordered dataTable" id="DataTableClientPf">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sorting_asc">Nome</th>
                                                                        <th class="sorting_asc">CPF</th>
                                                                        <th class="sorting_asc">RG</th>
                                                                        <th class="sorting_asc">Email</th>
                                                                        <th class="sorting_asc">Telefone</th>
                                                                        <th class="sorting_asc">Whatsapp/Celular</th>
                                                    
                                                                        <th class="sorting_asc">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listaPF" class="pesquisar">
                                                                   
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-content d-none" id="cardContentClientPj">
                                            <div class="card-body card-dashboard">
                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6">
                                                        
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
                                                            <table class="table table-striped table-bordered dataTable" id="DataTableClientPj">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sorting_asc">Razão Social</th>
                                                                        <th class="sorting_asc">CNPJ</th>
                                                                        <th class="sorting_asc">I.E</th>
                                                                        <th class="sorting_asc">Email</th>
                                                                        <th class="sorting_asc">Telefone</th>
                                                                        <th class="sorting_asc">Whatsapp/Celular</th>
                                                                        <th class="sorting_asc">Nome do Responsável</th>
                                                                        <th class="sorting_asc">Email Responsável</th>
                                                                        <th class="sorting_asc">Telefone Responsável</th>
                                                                        <th class="sorting_asc">Celular/Whatsapp Responsável</th>
                                                           
                                                                        <th class="sorting_asc">Ações</th>
                                                                       
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listaPJ" class="pesquisar">
                                                                   
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
                    </section>
                </main>
              
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>