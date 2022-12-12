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
                    <section class="app-invoice-wrapper">
                        <div class="row">
                            <div class="col-xl-9 col-md-8 col-12 printable-content">
                                <!-- using a bootstrap card -->
                                <div class="card">
                                    <!-- card body -->
                                    <div class="card-body p-2">
                                        <!-- card-header -->
                                        <div class="card-header px-0">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-7 col-xl-4 mb-50">
                                                    <span class="invoice-id font-weight-bold">Recibo de serviço# </span>
                                                    <span><?php echo ($_GET['os_id']); ?></span>
                                                </div>
                                                <div class="col-md-12 col-lg-5 col-xl-8">
                                                    <div class="d-flex align-items-center justify-content-end justify-content-xs-start">
                                                        <div class="issue-date pr-2">
                                                            <span class="font-weight-bold no-wrap">Impresso em: </span>
                                                            <span><?php echo (date("d/m/Y H:i:s")); ?></span>
                                                        </div>
                                                        <div class="due-date">
                                                            <span class="font-weight-bold no-wrap">Data de lançamento da OS: </span>
                                                            <span id="data_lancamento">06/04/2019</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- invoice logo and title -->
                                        <div class="invoice-logo-title row py-2">
                                            <div class="col-6 d-flex flex-column justify-content-center align-items-start">
                                                <h2 class="text-primary">Recibo</h2>
                                               
                                            </div>
                                    
                                        </div>
                                        <hr>

                                        <div class="row invoice-adress-info py-2">
                                            <div class="col-6 mt-1 from-info">
                                                <div class="info-title mb-1">
                                                    <span id="nome_loja">Bill From</span>
                                                </div>
                                            
                                                <div class="company-address mb-1">
                                                    <span class="text-muted" id="endloja">9205 Whitemarsh Street New York, NY 10002</span>
                                                </div>
                                             
                                                <div class="company-phone  mb-1">
                                                    <span class="text-muted " id="ceploja">601-678-8022</span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-1 to-info">
                                                <div class="info-title mb-1">
                                                    <span id="nome_cliente">Bill To</span>
                                                </div>
                                            
                                                <div class="company-address mb-1">
                                                    <span class="text-muted" id="endceli">9205 Whitemarsh Street New York, NY 10002</span>
                                                </div>
                                       
                                                <div class="company-phone  mb-1">
                                                    <span class="text-muted" id="cepcli">601-678-8022</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--product details table -->
                                        <div class="product-details-table py-2 table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Item</th>                                                                                                                
                                                        <th scope="col">Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="items_servicos">
                                                    <tr>
                                                        
                                                        <td>28</td>
                                                        
                                                        <td class="font-weight-bold">$28.00</td>
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>

                                        <!-- invoice total -->
                                        <div class="invoice-total py-2">
                                            <div class="row">
                                                <div class="col-4 col-sm-6 mt-75">
                                                  
                                                </div>
                                                <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                    <ul class="list-group cost-list">
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Status </span>
                                                            <span class="cost-value" id="status_os">$ 72.00</span>
                                                        </li>
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Disconto </span>
                                                            <span class="cost-value" id="valor_desconto">-$ 09.60</span>
                                                        </li>
                                                 
                                                        <li class="dropdown-divider"></li>
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Sub total </span>
                                                            <span class="cost-value" id="subtotal">$ 61.40</span>
                                                        </li>
                                                    
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Total a pagar </span>
                                                            <span class="cost-value" id="total">$ 10,953</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- buttons section -->
                            <div class="col-xl-3 col-md-4 col-12 action-btns">
                                <div class="card">
                                    <div class="card-body p-2">

                                        <a href="#" class="btn btn-info btn-block mb-1 print-invoice"> <i class="feather icon-printer mr-25 common-size"></i> Imprimir</a>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

                <?php include 'footer.php'; ?>
            </div>