<asside class="dashboard-menu">
    <a href="index.php" class="box-logo">
        <figure class="logo">
            <img src="../assets/img/agendos-logo.png" alt="">
        </figure>
    </a>

    <div class="scroll-y">
        <div class="box-menu-list">
            <ul class="dashboard-menu-list">
                <li class="sub-title-dashboard">
                    Menu
                </li>
                <li class="item-list-menu"><a href="index.php"><i class="feather icon-home"></i> Dashboard</a></li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmpresa" aria-expanded="false" aria-controls="collapseExample">
                        <i class="feather icon-briefcase"></i> Empresas <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseEmpresa">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-empresa.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-empresa.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseFuncionario" aria-expanded="false" aria-controls="collapseExample">
                        <i class="feather icon-users"></i> Funcionários <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseFuncionario">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-funcionario.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-funcionario.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseClientes" aria-expanded="false" aria-controls="collapseExample">
                        <i class="feather icon-users"></i> Clientes <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseClientes">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-clientes.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-cliente.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseVeiculos" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-car"></i> Veículos <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseVeiculos">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-veiculo.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-veiculo.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseServicos" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-wrench"></i> Serviços <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseServicos">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-servico.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-servico.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <a href="ordem-de-servico.php">
                        <i class="feather icon-calendar"></i> Ordem de Serviço
                    </a>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseProdutos" aria-expanded="false" aria-controls="collapseExample">
                        <i class="feather icon-shopping-cart"></i> Produtos <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseProdutos">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-produto.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-produto.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseGarantia" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-check-circle-o"></i> Garantia <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseGarantia">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-garantia.php"> <span>Listar</span></a></li>
                                <li class="item-list-menu"><a href="adicionar-garantia.php"> <span>Adicionar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="item-list-menu">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseFinanceiro" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-money"></i> Financeiro <i class="feather icon-chevron-right"></i>
                    </button>
                    <div class="collapse" id="collapseFinanceiro">
                        <div class="card card-body sub-menu">
                            <ul class="sub-menu-list">
                                <li class="item-list-menu"><a href="listar-receitas.php"> <span>Fluxo de caixa</span></a></li>
                                <li class="item-list-menu"><a href="add_fluxo_caixa.php"> <span>Lançar</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="sub-title-dashboard mt-1">
                    Configurações
                </li>
                <li class="item-list-menu"><a href="#"><i class="fa fa-cog"></i> Config. Geral</a></li>
            </ul>
        </div>
    </div>
</asside>