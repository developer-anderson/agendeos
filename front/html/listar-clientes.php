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
                                                            <table class="table table-striped table-bordered dataTable" id="DataTableClientPf">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="sorting_asc">Nome</th>
                                                                        <th class="sorting_asc">CPF</th>
                                                                        <th class="sorting_asc">RG</th>
                                                                        <th class="sorting_asc">Email</th>
                                                                        <th class="sorting_asc">Telefone</th>
                                                                        <th class="sorting_asc">Whatsapp/Celular</th>
                                                                        <th class="sorting_asc">Sexo</th>
                                                                        <th class="sorting_asc">CEP</th>
                                                                        <th class="sorting_asc">Endereço</th>
                                                                        <th class="sorting_asc">Número</th>
                                                                        <th class="sorting_asc">Complemento</th>
                                                                        <th class="sorting_asc">Bairro</th>
                                                                        <th class="sorting_asc">Estado</th>
                                                                        <th class="sorting_asc">Cidade</th>
                                                                        <th class="sorting_asc">Observações Gerais</th>
                                                                        <th class="sorting_asc">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="big-item-table">Cliente Teste 1</td>
                                                                        <td class="big-item-table">000.111.222-77</td>
                                                                        <td class="big-item-table">00.111.222-77</td>
                                                                        <td class="big-item-table">contato@gmail.com</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td>Masculino</td>
                                                                        <td class="big-item-table">48.655-48</td>
                                                                        <td class="big-item-table">R. do cliente</td>
                                                                        <td>220</td>
                                                                        <td>B</td>
                                                                        <td class="big-item-table">Bairro teste</td>
                                                                        <td>Bahia</td>
                                                                        <td class="big-item-table">Salvador</td>
                                                                        <td class="xxl-item-table">Lorem ipsum dolor sit, amet consectetur</td>
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

                                        <div class="card-content d-none" id="cardContentClientPj">
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
                                                                        <th class="sorting_asc">Email</th>
                                                                        <th class="sorting_asc">Telefone</th>
                                                                        <th class="sorting_asc">Celular/Whatsapp</th>
                                                                        <th class="sorting_asc">CEP</th>
                                                                        <th class="sorting_asc">Endereço</th>
                                                                        <th class="sorting_asc">Número</th>
                                                                        <th class="sorting_asc">Complemento</th>
                                                                        <th class="sorting_asc">Bairro</th>
                                                                        <th class="sorting_asc">Estado</th>
                                                                        <th class="sorting_asc">Cidade</th>
                                                                        <th class="sorting_asc">Ações</th>
                                                                        <th class="sorting_asc">Observações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="big-item-table">Cliente Teste 2</td>
                                                                        <td class="big-item-table">000.111.222-77</td>
                                                                        <td class="big-item-table">123.45.678.9</td>
                                                                        <td class="big-item-table">contato@gmail.com</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td class="big-item-table">Responsável teste</td>
                                                                        <td class="big-item-table">contato@gmail.com</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td class="big-item-table">(77) 95555-4444</td>
                                                                        <td class="big-item-table">45.654-555</td>
                                                                        <td class="big-item-table">R. cliente PJ</td>
                                                                        <td>4655</td>
                                                                        <td></td>
                                                                        <td class="big-item-table">Bairro teste</td>
                                                                        <td class="big-item-table">Bahia</td>
                                                                        <td class="big-item-table">Salvador</td>
                                                                        <td class="xxl-item-table">Lorem ipsum dolor sit, amet consectetur</td>
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
                            </div>
                        </div>
                    </section>
                </main>
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>