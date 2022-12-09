<header>
    <section class="container-header-desktop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-left-header">
                    <button type="button" class="btn-fullscreen nav-link nav-link-expand" id="btnFullScrreen">
                        <i class="ficon feather icon-maximize"></i>
                    </button>
                    <form class="header-busca" id="headerBusca">
                        <button type="button" class="btn-header-keyboard" id="btnHeaderKeyboard">
                            <i class="fa fa-keyboard-o"></i>
                        </button>
                        <input type="text" class="header-input" placeholder="Pesquisar">
                        <button type="submit" class="btn-header-search" id="btnHeaderSearch">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-6 col-right-header">
                    <div class="dropdown">
                        <button class="btn-notification dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ficon feather icon-bell"></i>
                            <span class="notification-number">5</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-header dropdown-notification">
                            <li class="dropdown-item dropdown-notification-title">
                                Notificações <span>5 Novas</span>
                            </li>
                            <div class="dropdown-item-content">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-plus-square icon-bg-circle bg-cyan"></i>
                                        <div class="dropdown-item-text">
                                            <h6 class="text-blue">Você tem novos pedidos</h6>
                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor sit amet, consectetur adipisici.</p>
                                            <small>30min atrás</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                        <div class="dropdown-item-text">
                                            <h6 class="text-red">99% do servidor utilizado</h6>
                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor</p>
                                            <small>30min atrás</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-check-circle icon-bg-circle bg-cyan"></i>
                                        <div class="dropdown-item-text">
                                            <h6 class="text-blue">Tarefa completa</h6>
                                            <small>Hoje</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                        <div class="dropdown-item-text">
                                            <h6 class="text-yellow">Atenção</h6>
                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor.</p>
                                            <small>30min atrás</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-file icon-bg-circle bg-teal"></i>
                                        <div class="dropdown-item-text">
                                            <h6 class="text-babe-blue">Relatório semanal</h6>
                                            <p></p>
                                            <small>30min atrás</small>
                                        </div>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn-user dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <figure class="img-user">
                                <img src="../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar">
                            </figure>
                            <span class="online-circle"></span>
                            <span class="name-user">Jamal Jhow</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-header">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user-o"></i>
                                    Editar Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-envelope-o"></i>
                                    Caixa de Entrada
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="feather icon-check-square"></i>
                                    Tarefas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="feather icon-message-square"></i>
                                    Conversas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item header-logout" href="#">
                                    <i class="feather icon-power"></i>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-header-mobile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-header-mobile">
                    <button type="button" class="btn-menu-mobile nav-link nav-menu-main menu-toggle hidden-xs">
                        <i class="feather icon-menu font-large-1"></i>
                    </button>

                    <figure class="logo-mobile">
                        <img src="../assets/img/agendos-logo.png" alt="">
                    </figure>

                    <button type="button" class="btn-options-menu-mobile nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                </div>

                <div class="col-12 col-navbar-mobile">
                    <div class="navbar-container content">
                        <div class="navbar-collapse collapse nav-collapse-show" id="navbar-mobile">
                            <div class="row">
                                <div class="col-6 col-left-header">
                                    <button type="button" class="btn-fullscreen nav-link nav-link-expand" id="btnFullScreen">
                                        <i class="ficon feather icon-maximize"></i>
                                    </button>
                                    <form class="header-busca" id="headerBusca">
                                        <button type="button" class="btn-header-keyboard" id="btnHeaderKeyboard">
                                            <i class="fa fa-keyboard-o"></i>
                                        </button>
                                        <input type="text" class="header-input" placeholder="Pesquisar">
                                        <button type="submit" class="btn-header-search" id="btnHeaderSearch">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6 col-right-header">
                                    <div class="dropdown">
                                        <button class="btn-notification dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ficon feather icon-bell"></i>
                                            <span class="notification-number">5</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-header dropdown-notification">
                                            <li class="dropdown-item dropdown-notification-title">
                                                Notificações <span>5 Novas</span>
                                            </li>
                                            <div class="dropdown-item-content">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="feather icon-plus-square icon-bg-circle bg-cyan"></i>
                                                        <div class="dropdown-item-text">
                                                            <h6 class="text-blue">Você tem novos pedidos</h6>
                                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor sit amet, consectetur adipisici.</p>
                                                            <small>30min atrás</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="feather icon-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                                        <div class="dropdown-item-text">
                                                            <h6 class="text-red">99% do servidor utilizado</h6>
                                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor</p>
                                                            <small>30min atrás</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="feather icon-check-circle icon-bg-circle bg-cyan"></i>
                                                        <div class="dropdown-item-text">
                                                            <h6 class="text-blue">Tarefa completa</h6>
                                                            <small>Hoje</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="feather icon-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                                        <div class="dropdown-item-text">
                                                            <h6 class="text-yellow">Atenção</h6>
                                                            <p>Lorem ipsum dolor sit Lorem ipsum dolor.</p>
                                                            <small>30min atrás</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="feather icon-file icon-bg-circle bg-teal"></i>
                                                        <div class="dropdown-item-text">
                                                            <h6 class="text-babe-blue">Relatório semanal</h6>
                                                            <p></p>
                                                            <small>30min atrás</small>
                                                        </div>
                                                    </a>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn-user dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <figure class="img-user">
                                                <img src="../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar">
                                            </figure>
                                            <span class="online-circle"></span>
                                            <span class="name-user">Jamal Jhow</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-header">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fa fa-user-o"></i>
                                                    Editar Perfil
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fa fa-envelope-o"></i>
                                                    Caixa de Entrada
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="feather icon-check-square"></i>
                                                    Tarefas
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="feather icon-message-square"></i>
                                                    Conversas
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item header-logout" href="#">
                                                    <i class="feather icon-power"></i>
                                                    Sair
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</header>