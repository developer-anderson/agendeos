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
                                                            <span class="font-weight-bold no-wrap">Data de lançamento do serviço: </span>
                                                            <span>06/04/2019</span>
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
                                            <div class="col-6 d-flex justify-content-end invoice-logo">
                                                <img src="app-assets/images/logo/pixinvent-logo.png" alt="company-logo" height="46" width="164">
                                            </div>
                                        </div>
                                        <hr>

                                        <!-- invoice address and contacts -->
                                        <div class="row invoice-adress-info py-2">
                                            <div class="col-6 mt-1 from-info">
                                                <div class="info-title mb-1">
                                                    <span>Bill From</span>
                                                </div>
                                                <div class="company-name mb-1">
                                                    <span class="text-muted">Clevision PVT.LTD</span>
                                                </div>
                                                <div class="company-address mb-1">
                                                    <span class="text-muted">9205 Whitemarsh Street New York, NY 10002</span>
                                                </div>
                                                <div class="company-email  mb-1 mb-1">
                                                    <span class="text-muted">hello@clevision.net</span>
                                                </div>
                                                <div class="company-phone  mb-1">
                                                    <span class="text-muted">601-678-8022</span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-1 to-info">
                                                <div class="info-title mb-1">
                                                    <span>Bill To</span>
                                                </div>
                                                <div class="company-name mb-1">
                                                    <span class="text-muted">Pixinvent PVT.LTD</span>
                                                </div>
                                                <div class="company-address mb-1">
                                                    <span class="text-muted">9205 Whitemarsh Street New York, NY 10002</span>
                                                </div>
                                                <div class="company-email mb-1">
                                                    <span class="text-muted">hello@clevision.net</span>
                                                </div>
                                                <div class="company-phone  mb-1">
                                                    <span class="text-muted">601-678-8022</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--product details table -->
                                        <div class="product-details-table py-2 table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ITEM</th>
                                                        <th scope="col">DESCRIPTION</th>
                                                        <th scope="col">COST</th>
                                                        <th scope="col">QTY</th>
                                                        <th scope="col">PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Frest Admin</td>
                                                        <td>HTML Admin Template</td>
                                                        <td>28</td>
                                                        <td>1</td>
                                                        <td class="font-weight-bold">$28.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apex Admin</td>
                                                        <td>Angular Admin Template</td>
                                                        <td>24</td>
                                                        <td>1</td>
                                                        <td class="font-weight-bold">$24.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stack Admin</td>
                                                        <td>HTML Admin Template</td>
                                                        <td>24</td>
                                                        <td>1</td>
                                                        <td class="font-weight-bold">$24.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>

                                        <!-- invoice total -->
                                        <div class="invoice-total py-2">
                                            <div class="row">
                                                <div class="col-4 col-sm-6 mt-75">
                                                    <p>Thanks for your business.</p>
                                                </div>
                                                <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                    <ul class="list-group cost-list">
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Forma de pagamento </span>
                                                            <span class="cost-value">$ 72.00</span>
                                                        </li>
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Disconto </span>
                                                            <span class="cost-value">-$ 09.60</span>
                                                        </li>
                                                 
                                                        <li class="dropdown-divider"></li>
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Sub total </span>
                                                            <span class="cost-value">$ 61.40</span>
                                                        </li>
                                                    
                                                        <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                            <span class="cost-title mr-2">Total a pagar </span>
                                                            <span class="cost-value">$ 10,953</span>
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