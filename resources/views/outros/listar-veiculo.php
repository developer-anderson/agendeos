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
                                            <h4 class="card-title">Lista de veículos</h4>
                                        </div>

                                        <div class="card-content">
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
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="data-table-scroll-x">
                                                                <table class="table table-striped table-bordered dataTable" id="DataTableCliente">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting_asc">Placa</th>
                                                                            <th class="sorting_asc">Marca</th>
                                                                            <th class="sorting_asc">Modelo</th>
                                                                            <th class="sorting_asc">Cor</th>
                                                                            <th class="sorting_asc">Dono do Veículo</th>
                                                                     
                                                                            <th class="sorting_asc">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tveiculos" class="pesquisar">
                                                                        <tr>
                                                                            <td class="big-item-table">ABC123</td>
                                                                            <td class="big-item-table">Gol</td>
                                                                            <td class="big-item-table">lorem ipsum</td>
                                                                            <td>azul</td>
                                                                            <td class="big-item-table">José</td>
                                                                            <td class="big-item-table">Lorem ipsum dolor sitt</td>
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