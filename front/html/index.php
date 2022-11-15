<?php include 'head.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-sm-2 col-dashboard">
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


                    <section id="geral-dates">
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
                            </div>
                        </div>
                    </section>

                    <section id="calendar">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div id="fc-default" class="fc fc-ltr fc-unthemed">
                                        <div class="fc-toolbar fc-header-toolbar">
                                            <div class="fc-left">
                                                <h2>Setembro 2022</h2>
                                            </div>
                                            <div class="fc-center"></div>
                                            <div class="fc-right">
                                                <button type="button" class="fc-today-button fc-button fc-button-primary">Hoje</button>

                                                <div class="fc-button-group">
                                                    <button type="button" class="fc-prev-button fc-button fc-button-primary" aria-label="prev">
                                                        <span class="fc-icon fc-icon-chevron-left"></span>
                                                    </button>

                                                    <button type="button" class="fc-next-button fc-button fc-button-primary" aria-label="next">
                                                        <span class="fc-icon fc-icon-chevron-right"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fc-view-container">
                                            <div class="fc-view fc-dayGridMonth-view fc-dayGrid-view">
                                                <table class="">
                                                    <thead class="fc-head">
                                                        <tr>
                                                            <td class="fc-head-container fc-widget-header">
                                                                <div class="fc-row fc-widget-header">
                                                                    <table class="">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="fc-day-header fc-widget-header fc-sun">
                                                                                    <span>Dom</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-mon">
                                                                                    <span>Seg</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-tue">
                                                                                    <span>Ter</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-wed">
                                                                                    <span>Qua</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-thu">
                                                                                    <span>Qui</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-fri">
                                                                                    <span>Sex</span>
                                                                                </th>
                                                                                <th class="fc-day-header fc-widget-header fc-sat">
                                                                                    <span>Sab</span>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fc-body">
                                                        <tr>
                                                            <td class="fc-widget-content">
                                                                <div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 842.703px;">
                                                                    <div class="fc-day-grid">
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 140px;">
                                                                            <div class="fc-bg">
                                                                                <table class="">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="29-08-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="30-08-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="31-08-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-past" data-date="01-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-past" data-date="02-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-past" data-date="03-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-past" data-date="04-09-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-other-month fc-past" data-date="29-08-2022">
                                                                                                <span class="fc-day-number">29</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-other-month fc-past" data-date="30-08-2022">
                                                                                                <span class="fc-day-number">30</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-other-month fc-past" data-date="31-08-2022">
                                                                                                <span class="fc-day-number">31</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-past" data-date="01-09-2022">
                                                                                                <span class="fc-day-number">1</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-past" data-date="02-09-2022">
                                                                                                <span class="fc-day-number">2</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-past" data-date="03-09-2022">
                                                                                                <span class="fc-day-number">3</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-past" data-date="04-09-2022">
                                                                                                <span class="fc-day-number">4</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td class="fc-event-container">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-title">Todos os evento</span>
                                                                                                    </div>
                                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 140px;">
                                                                            <div class="fc-bg">
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-past" data-date="05-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-past" data-date="06-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-past" data-date="07-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-past" data-date="08-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-past" data-date="09-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-past" data-date="10-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-past" data-date="11-09-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-past" data-date="05-09-2022">
                                                                                                <span class="fc-day-number">5</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-past" data-date="06-09-2022">
                                                                                                <span class="fc-day-number">6</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-past" data-date="07-09-2022">
                                                                                                <span class="fc-day-number">7</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-past" data-date="08-09-2022">
                                                                                                <span class="fc-day-number">8</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-past" data-date="09-09-2022">
                                                                                                <span class="fc-day-number">9</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-past" data-date="10-09-2022">
                                                                                                <span class="fc-day-number">10</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-past" data-date="11-09-2022">
                                                                                                <span class="fc-day-number">11</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td rowspan="2"></td>
                                                                                            <td rowspan="2"></td>
                                                                                            <td class="fc-event-container" colspan="3">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-title">Evento longo</span>
                                                                                                    </div>
                                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td rowspan="2"></td>
                                                                                            <td class="fc-event-container" rowspan="2">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-title">Conferido</span>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td class="fc-event-container">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-time">16h</span>
                                                                                                        <span class="fc-title">Evento</span>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 140px;">
                                                                            <div class="fc-bg">
                                                                                <table class="">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-past" data-date="12-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-past" data-date="13-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-past" data-date="14-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-past" data-date="15-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-past" data-date="16-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-past" data-date="17-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-past" data-date="18-09-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-past" data-date="12-09-2022">
                                                                                                <span class="fc-day-number">12</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-past" data-date="13-09-2022">
                                                                                                <span class="fc-day-number">13</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-past" data-date="14-09-2022">
                                                                                                <span class="fc-day-number">14</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-past" data-date="15-09-2022">
                                                                                                <span class="fc-day-number">15</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-past" data-date="16-09-2022">
                                                                                                <span class="fc-day-number">16</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-past" data-date="17-09-2022">
                                                                                                <span class="fc-day-number">17</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-past" data-date="18-09-2022">
                                                                                                <span class="fc-day-number">18</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-event-container">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable fc-resizable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-title">Conferido</span>
                                                                                                    </div>
                                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td class="fc-event-container" rowspan="6">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-time">7h</span>
                                                                                                        <span class="fc-title">Aniversário</span>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td rowspan="6"></td>
                                                                                            <td rowspan="6"></td>
                                                                                            <td class="fc-event-container" rowspan="6">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-time">12h</span>
                                                                                                        <span class="fc-title">Evento</span>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td rowspan="6"></td>
                                                                                            <td rowspan="6"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-event-container">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-time">10:30h</span> <span class="fc-title">Reunião</span>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="fc-more-cell" rowspan="1">
                                                                                                <div>
                                                                                                    <a class="fc-more">+4 mais</a>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr class="fc-limited">
                                                                                            <td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content"><span class="fc-time">14:30h</span> <span class="fc-title">Renião</span></div>
                                                                                                </a></td>
                                                                                        </tr>
                                                                                        <tr class="fc-limited">
                                                                                            <td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                    <div class="fc-content"><span class="fc-time">17:30</span> <span class="fc-title">Fim de expediente</span></div>
                                                                                                </a></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 140px;">
                                                                            <div class="fc-bg">
                                                                                <table class="">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-past" data-date="19-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-past" data-date="20-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-past" data-date="21-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-past" data-date="22-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-past" data-date="23-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-past" data-date="24-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-past" data-date="25-09-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-past" data-date="19-09-2022">
                                                                                                <span class="fc-day-number">19</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-past" data-date="20-09-2022">
                                                                                                <span class="fc-day-number">20</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-past" data-date="21-09-2022">
                                                                                                <span class="fc-day-number">21</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-past" data-date="22-09-2022">
                                                                                                <span class="fc-day-number">22</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-past" data-date="23-09-2022">
                                                                                                <span class="fc-day-number">23</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-past" data-date="24-09-2022">
                                                                                                <span class="fc-day-number">24</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-past" data-date="25-09-2022">
                                                                                                <span class="fc-day-number">25</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 140px;">
                                                                            <div class="fc-bg">
                                                                                <table class="">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-past" data-date="26-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-past" data-date="27-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-past" data-date="28-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-past" data-date="29-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-past" data-date="30-09-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="01-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-past" data-date="02-10-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-past" data-date="26-09-2022">
                                                                                                <span class="fc-day-number">26</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-past" data-date="27-09-2022">
                                                                                                <span class="fc-day-number">27</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-past" data-date="28-09-2022">
                                                                                                <span class="fc-day-number">28</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-past" data-date="29-09-2022">
                                                                                                <span class="fc-day-number">29</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-past" data-date="30-09-2022">
                                                                                                <span class="fc-day-number">30</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-other-month fc-past" data-date="01-10-2022">
                                                                                                <span class="fc-day-number">1</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-other-month fc-past" data-date="02-10-2022">
                                                                                                <span class="fc-day-number">2</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td class="fc-event-container">
                                                                                                <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable" href="http://google.com/">
                                                                                                    <div class="fc-content">
                                                                                                        <span class="fc-title">Google</span>
                                                                                                    </div>
                                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 142px;">
                                                                            <div class="fc-bg">
                                                                                <table class="">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="03-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="04-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="05-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="06-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="07-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="08-10-2022"></td>
                                                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-past" data-date="09-10-2022"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="fc-content-skeleton">
                                                                                <table>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <td class="fc-day-top fc-sun fc-other-month fc-past" data-date="03-10-2022">
                                                                                                <span class="fc-day-number">3</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-mon fc-other-month fc-past" data-date="04-10-2022">
                                                                                                <span class="fc-day-number">4</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-tue fc-other-month fc-past" data-date="05-10-2022">
                                                                                                <span class="fc-day-number">5</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-wed fc-other-month fc-past" data-date="06-10-2022">
                                                                                                <span class="fc-day-number">6</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-thu fc-other-month fc-past" data-date="07-10-2022">
                                                                                                <span class="fc-day-number">7</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-fri fc-other-month fc-past" data-date="08-10-2022">
                                                                                                <span class="fc-day-number">8</span>
                                                                                            </td>
                                                                                            <td class="fc-day-top fc-sat fc-other-month fc-past" data-date="09-10-2022">
                                                                                                <span class="fc-day-number">9</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                    </section>

                    <section id="box-graphics">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-8 col-xxl-6 col-line-graphics">
                                    <div class="line-graphics-content">
                                        <div class="line-graphics-title">
                                            <h4 class="text-gray">Consumo mensal de energia</h4>
                                            <p class="text-gray">(kWh/100km)</p>
                                        </div>
                                        <div class="content-svg">
                                            <svg class="line-graphics-svg" id="SvgjsSvg1845" width="100%" height="370" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                <g id="SvgjsG1847" class="apexcharts-inner apexcharts-graphical" transform="translate(58.421875, 30)">
                                                    <defs id="SvgjsDefs1846">
                                                        <clipPath id="gridRectMaskjt4nsrla">
                                                            <rect id="SvgjsRect1852" width="710.01611328125" height="298.11199999999997" x="-2" y="-2" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMaskjt4nsrla">
                                                            <rect id="SvgjsRect1853" width="708.01611328125" height="296.11199999999997" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient1859" x1="0" y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1860" stop-opacity="0.2" stop-color="rgba(0,181,184,0.2)" offset="0"></stop>
                                                            <stop id="SvgjsStop1861" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="0.9"></stop>
                                                            <stop id="SvgjsStop1862" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="1"></stop>
                                                        </linearGradient>
                                                        <filter id="SvgjsFilter1865" filterUnits="userSpaceOnUse">
                                                            <feFlood id="SvgjsFeFlood1866" flood-color="#00b5b8" flood-opacity="0.1" result="SvgjsFeFlood1866Out" in="SourceGraphic"></feFlood>
                                                            <feComposite id="SvgjsFeComposite1867" in="SvgjsFeFlood1866Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1867Out"></feComposite>
                                                            <feOffset id="SvgjsFeOffset1868" dx="0" dy="18" result="SvgjsFeOffset1868Out" in="SvgjsFeComposite1867Out"></feOffset>
                                                            <feGaussianBlur id="SvgjsFeGaussianBlur1869" stdDeviation="2 " result="SvgjsFeGaussianBlur1869Out" in="SvgjsFeOffset1868Out"></feGaussianBlur>
                                                            <feMerge id="SvgjsFeMerge1870" result="SvgjsFeMerge1870Out" in="SourceGraphic">
                                                                <feMergeNode id="SvgjsFeMergeNode1871" in="SvgjsFeGaussianBlur1869Out"></feMergeNode>
                                                                <feMergeNode id="SvgjsFeMergeNode1872" in="[object Arguments]"></feMergeNode>
                                                            </feMerge>
                                                            <feBlend id="SvgjsFeBlend1873" in="SourceGraphic" in2="SvgjsFeMerge1870Out" mode="normal" result="SvgjsFeBlend1873Out"></feBlend>
                                                        </filter>
                                                        <filter id="SvgjsFilter1876" filterUnits="userSpaceOnUse">
                                                            <feFlood id="SvgjsFeFlood1877" flood-color="#00b5b8" flood-opacity="0.1" result="SvgjsFeFlood1877Out" in="SourceGraphic"></feFlood>
                                                            <feComposite id="SvgjsFeComposite1878" in="SvgjsFeFlood1877Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1878Out"></feComposite>
                                                            <feOffset id="SvgjsFeOffset1879" dx="0" dy="18" result="SvgjsFeOffset1879Out" in="SvgjsFeComposite1878Out"></feOffset>
                                                            <feGaussianBlur id="SvgjsFeGaussianBlur1880" stdDeviation="2 " result="SvgjsFeGaussianBlur1880Out" in="SvgjsFeOffset1879Out"></feGaussianBlur>
                                                            <feMerge id="SvgjsFeMerge1881" result="SvgjsFeMerge1881Out" in="SourceGraphic">
                                                                <feMergeNode id="SvgjsFeMergeNode1882" in="SvgjsFeGaussianBlur1880Out"></feMergeNode>
                                                                <feMergeNode id="SvgjsFeMergeNode1883" in="[object Arguments]"></feMergeNode>
                                                            </feMerge>
                                                            <feBlend id="SvgjsFeBlend1884" in="SourceGraphic" in2="SvgjsFeMerge1881Out" mode="normal" result="SvgjsFeBlend1884Out"></feBlend>
                                                        </filter>
                                                    </defs>
                                                    <line id="SvgjsLine1851" x1="470.1774088541667" y1="0" x2="470.1774088541667" y2="294.11199999999997" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="470.1774088541667" y="0" width="1" height="294.11199999999997" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                    <g id="SvgjsG1885" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                        <g id="SvgjsG1886" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1887" font-family="Helvetica, Arial, sans-serif" x="0" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1888" style="font-family: Helvetica, Arial, sans-serif;">Mon</tspan>
                                                                <title>Mon</title>
                                                            </text><text id="SvgjsText1889" font-family="Helvetica, Arial, sans-serif" x="117.66935221354166" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1890" style="font-family: Helvetica, Arial, sans-serif;">Tue</tspan>
                                                                <title>Tue</title>
                                                            </text><text id="SvgjsText1891" font-family="Helvetica, Arial, sans-serif" x="235.33870442708334" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1892" style="font-family: Helvetica, Arial, sans-serif;">Wed</tspan>
                                                                <title>Wed</title>
                                                            </text><text id="SvgjsText1893" font-family="Helvetica, Arial, sans-serif" x="353.00805664062506" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1894" style="font-family: Helvetica, Arial, sans-serif;">Thu</tspan>
                                                                <title>Thu</title>
                                                            </text><text id="SvgjsText1895" font-family="Helvetica, Arial, sans-serif" x="470.6774088541667" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1896" style="font-family: Helvetica, Arial, sans-serif;">Fri</tspan>
                                                                <title>Fri</title>
                                                            </text><text id="SvgjsText1897" font-family="Helvetica, Arial, sans-serif" x="588.3467610677083" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1898" style="font-family: Helvetica, Arial, sans-serif;">Sat</tspan>
                                                                <title>Sat</title>
                                                            </text><text id="SvgjsText1899" font-family="Helvetica, Arial, sans-serif" x="706.0161132812499" y="323.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="14" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1900" style="font-family: Helvetica, Arial, sans-serif;">Sun</tspan>
                                                                <title>Sun</title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG1907" class="apexcharts-grid">
                                                        <g id="SvgjsG1908" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine1910" x1="0" y1="0" x2="706.01611328125" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1911" x1="0" y1="98.03733333333332" x2="706.01611328125" y2="98.03733333333332" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1912" x1="0" y1="196.07466666666664" x2="706.01611328125" y2="196.07466666666664" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1913" x1="0" y1="294.11199999999997" x2="706.01611328125" y2="294.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1909" class="apexcharts-gridlines-vertical"></g>
                                                        <line id="SvgjsLine1915" x1="0" y1="294.11199999999997" x2="706.01611328125" y2="294.11199999999997" stroke="transparent" stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1914" x1="0" y1="1" x2="0" y2="294.11199999999997" stroke="transparent" stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1855" class="apexcharts-area-series apexcharts-plot-series">
                                                        <g id="SvgjsG1856" class="apexcharts-series" seriesName="" data:longestSeries="true" rel="1" data:realIndex="0">
                                                            <path id="apexcharts-area-0" d="M 0 294.11199999999997L 0 197.47519999999986C 41.18427327473958 197.47519999999986 76.48507893880209 252.096 117.66935221354167 252.096C 158.85362548828124 252.096 194.15443115234376 184.8703999999999 235.33870442708334 184.8703999999999C 276.5229777018229 184.8703999999999 311.82378336588545 210.07999999999993 353.008056640625 210.07999999999993C 394.1923299153646 210.07999999999993 429.4931355794271 84.03199999999993 470.6774088541667 84.03199999999993C 511.8616821289063 84.03199999999993 547.1624877929688 210.07999999999993 588.3467610677084 210.07999999999993C 629.5310343424479 210.07999999999993 664.8318400065104 147.05599999999993 706.01611328125 147.05599999999993C 706.01611328125 147.05599999999993 706.01611328125 147.05599999999993 706.01611328125 294.11199999999997M 706.01611328125 147.05599999999993z" fill="url(#SvgjsLinearGradient1859)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjt4nsrla)" filter="url(#SvgjsFilter1865)" pathTo="M 0 294.11199999999997L 0 197.47519999999986C 41.18427327473958 197.47519999999986 76.48507893880209 252.096 117.66935221354167 252.096C 158.85362548828124 252.096 194.15443115234376 184.8703999999999 235.33870442708334 184.8703999999999C 276.5229777018229 184.8703999999999 311.82378336588545 210.07999999999993 353.008056640625 210.07999999999993C 394.1923299153646 210.07999999999993 429.4931355794271 84.03199999999993 470.6774088541667 84.03199999999993C 511.8616821289063 84.03199999999993 547.1624877929688 210.07999999999993 588.3467610677084 210.07999999999993C 629.5310343424479 210.07999999999993 664.8318400065104 147.05599999999993 706.01611328125 147.05599999999993C 706.01611328125 147.05599999999993 706.01611328125 147.05599999999993 706.01611328125 294.11199999999997M 706.01611328125 147.05599999999993z" pathFrom="M -1 1008.3840000000002L -1 1008.3840000000002L 117.66935221354167 1008.3840000000002L 235.33870442708334 1008.3840000000002L 353.008056640625 1008.3840000000002L 470.6774088541667 1008.3840000000002L 588.3467610677084 1008.3840000000002L 706.01611328125 1008.3840000000002"></path>
                                                            <path id="apexcharts-area-0" d="M 0 197.47519999999986C 41.18427327473958 197.47519999999986 76.48507893880209 252.096 117.66935221354167 252.096C 158.85362548828124 252.096 194.15443115234376 184.8703999999999 235.33870442708334 184.8703999999999C 276.5229777018229 184.8703999999999 311.82378336588545 210.07999999999993 353.008056640625 210.07999999999993C 394.1923299153646 210.07999999999993 429.4931355794271 84.03199999999993 470.6774088541667 84.03199999999993C 511.8616821289063 84.03199999999993 547.1624877929688 210.07999999999993 588.3467610677084 210.07999999999993C 629.5310343424479 210.07999999999993 664.8318400065104 147.05599999999993 706.01611328125 147.05599999999993" fill="none" fill-opacity="1" stroke="#179bad" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjt4nsrla)" filter="url(#SvgjsFilter1876)" pathTo="M 0 197.47519999999986C 41.18427327473958 197.47519999999986 76.48507893880209 252.096 117.66935221354167 252.096C 158.85362548828124 252.096 194.15443115234376 184.8703999999999 235.33870442708334 184.8703999999999C 276.5229777018229 184.8703999999999 311.82378336588545 210.07999999999993 353.008056640625 210.07999999999993C 394.1923299153646 210.07999999999993 429.4931355794271 84.03199999999993 470.6774088541667 84.03199999999993C 511.8616821289063 84.03199999999993 547.1624877929688 210.07999999999993 588.3467610677084 210.07999999999993C 629.5310343424479 210.07999999999993 664.8318400065104 147.05599999999993 706.01611328125 147.05599999999993" pathFrom="M -1 1008.3840000000002L -1 1008.3840000000002L 117.66935221354167 1008.3840000000002L 235.33870442708334 1008.3840000000002L 353.008056640625 1008.3840000000002L 470.6774088541667 1008.3840000000002L 588.3467610677084 1008.3840000000002L 706.01611328125 1008.3840000000002"></path>
                                                            <g id="SvgjsG1857" class="apexcharts-series-markers-wrap">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle1921" r="0" cx="470.6774088541667" cy="84.03199999999993" class="apexcharts-marker w95vl6rd2 no-pointer-events" stroke="#ffffff" fill="#00b5b8" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1858" class="apexcharts-datalabels"></g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1916" x1="0" y1="0" x2="706.01611328125" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1917" x1="0" y1="0" x2="706.01611328125" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1918" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1919" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1920" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <rect id="SvgjsRect1850" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                <g id="SvgjsG1901" class="apexcharts-yaxis" rel="0" transform="translate(25.421875, 0)">
                                                    <g id="SvgjsG1902" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1903" font-family="Helvetica, Arial, sans-serif" x="20" y="31.3" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">24.0</text><text id="SvgjsText1904" font-family="Helvetica, Arial, sans-serif" x="20" y="129.43733333333333" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">21.7</text><text id="SvgjsText1905" font-family="Helvetica, Arial, sans-serif" x="20" y="227.57466666666664" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">19.3</text><text id="SvgjsText1906" font-family="Helvetica, Arial, sans-serif" x="20" y="325.71199999999993" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">17.0</text></g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-xxl-3 col-charts">
                                    <div class="card chart-with-tabs">
                                        <div class="card-content">
                                            <ul class="nav nav-pills card-tabs mb-2 pl-2 border-bottom-blue-grey border-bottom-lighten-5" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link text-primary bg-transparent active px-0 mr-1 py-1" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Gráfico</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-primary bg-transparent px-0 py-1" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Dados</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="position: relative;">
                                                    <div class="body-header pl-2">
                                                        <div class="d-flex">
                                                            <h3 class="mr-2 body-header-title text-bold-600 mb-0">1,934</h3>
                                                            <small class="success"><i class="fa fa-long-arrow-up"></i> +8.0%</small>
                                                        </div>
                                                        <div class="body-header-subtitle">
                                                            <span class="text-muted">Vendas</span>
                                                        </div>
                                                    </div>

                                                    <div class="content-svg">
                                                        <svg id="SvgjsSvg1078" width="100%" height="320" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                            <g id="SvgjsG1080" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 30)">
                                                                <defs id="SvgjsDefs1079">
                                                                    <linearGradient id="SvgjsLinearGradient1082" x1="0" y1="0" x2="0" y2="1">
                                                                        <stop id="SvgjsStop1083" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                                        <stop id="SvgjsStop1084" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                                        <stop id="SvgjsStop1085" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                                    </linearGradient>
                                                                    <clipPath id="gridRectMaskh224ksd1">
                                                                        <rect id="SvgjsRect1087" width="371" height="240" x="0" y="0" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="gridRectMarkerMaskh224ksd1">
                                                                        <rect id="SvgjsRect1088" width="373" height="242" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <rect id="SvgjsRect1086" width="14.221666666666668" height="240" x="0" y="0" rx="0" ry="0" fill="url(#SvgjsLinearGradient1082)" opacity="1" stroke-width="0" stroke-dasharray="3" class="apexcharts-xcrosshairs" y2="240" filter="none" fill-opacity="0.9"></rect>
                                                                <g id="SvgjsG1105" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                                    <g id="SvgjsG1106" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1107" font-family="Helvetica, Arial, sans-serif" x="30.916666666666668" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1108" style="font-family: Helvetica, Arial, sans-serif;">Jan</tspan>
                                                                            <title>Jan</title>
                                                                        </text><text id="SvgjsText1109" font-family="Helvetica, Arial, sans-serif" x="92.75" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1110" style="font-family: Helvetica, Arial, sans-serif;">Fab</tspan>
                                                                            <title>Fab</title>
                                                                        </text><text id="SvgjsText1111" font-family="Helvetica, Arial, sans-serif" x="154.58333333333334" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1112" style="font-family: Helvetica, Arial, sans-serif;">Mar</tspan>
                                                                            <title>Mar</title>
                                                                        </text><text id="SvgjsText1113" font-family="Helvetica, Arial, sans-serif" x="216.41666666666669" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1114" style="font-family: Helvetica, Arial, sans-serif;">Apr</tspan>
                                                                            <title>Apr</title>
                                                                        </text><text id="SvgjsText1115" font-family="Helvetica, Arial, sans-serif" x="278.25" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1116" style="font-family: Helvetica, Arial, sans-serif;">May</tspan>
                                                                            <title>May</title>
                                                                        </text><text id="SvgjsText1117" font-family="Helvetica, Arial, sans-serif" x="340.0833333333333" y="269" text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label apexcharts-xaxis-title" style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1118" style="font-family: Helvetica, Arial, sans-serif;">Jun</tspan>
                                                                            <title>Jun</title>
                                                                        </text></g>
                                                                </g>
                                                                <g id="SvgjsG1120" class="apexcharts-grid">
                                                                    <line id="SvgjsLine1122" x1="0" y1="240" x2="371" y2="240" stroke="transparent" stroke-dasharray="0"></line>
                                                                    <line id="SvgjsLine1121" x1="0" y1="1" x2="0" y2="240" stroke="transparent" stroke-dasharray="0"></line>
                                                                </g>
                                                                <g id="SvgjsG1090" class="apexcharts-bar-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1091" class="apexcharts-series" rel="1" seriesName="" data:realIndex="0">
                                                                        <rect id="SvgjsRect1093" width="14.221666666666668" height="240" x="23.805833333333332" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M23.805833333333332 240L23.805833333333332 137.14285714285717L38.0275 137.14285714285717L38.0275 240L23.805833333333332 240 " fill="rgba(0,181,184,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 23.805833333333332 240L 23.805833333333332 137.14285714285717L 38.0275 137.14285714285717L 38.0275 240L 23.805833333333332 240" pathFrom="M 23.805833333333332 240L 23.805833333333332 240L 38.0275 240L 38.0275 240L 23.805833333333332 240" cy="137.14285714285717" cx="85.63916666666667" j="0" val="30" barHeight="102.85714285714285" barWidth="14.221666666666668"></path>
                                                                        <rect id="SvgjsRect1095" width="14.221666666666668" height="240" x="85.63916666666667" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M85.63916666666667 240L85.63916666666667 85.71428571428572L99.86083333333333 85.71428571428572L99.86083333333333 240L85.63916666666667 240 " fill="rgba(0,181,184,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 85.63916666666667 240L 85.63916666666667 85.71428571428572L 99.86083333333333 85.71428571428572L 99.86083333333333 240L 85.63916666666667 240" pathFrom="M 85.63916666666667 240L 85.63916666666667 240L 99.86083333333333 240L 99.86083333333333 240L 85.63916666666667 240" cy="85.71428571428572" cx="147.4725" j="1" val="45" barHeight="154.28571428571428" barWidth="14.221666666666668"></path>
                                                                        <rect id="SvgjsRect1097" width="14.221666666666668" height="240" x="147.4725" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M147.4725 240L147.4725 72L161.69416666666666 72L161.69416666666666 240L147.4725 240 " fill="rgba(255,143,158,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 147.4725 240L 147.4725 72L 161.69416666666666 72L 161.69416666666666 240L 147.4725 240" pathFrom="M 147.4725 240L 147.4725 240L 161.69416666666666 240L 161.69416666666666 240L 147.4725 240" cy="72" cx="209.30583333333334" j="2" val="49" barHeight="168" barWidth="14.221666666666668"></path>
                                                                        <rect id="SvgjsRect1099" width="14.221666666666668" height="240" x="209.30583333333334" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M209.30583333333334 240L209.30583333333334 96L223.5275 96L223.5275 240L209.30583333333334 240 " fill="rgba(0,181,184,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 209.30583333333334 240L 209.30583333333334 96L 223.5275 96L 223.5275 240L 209.30583333333334 240" pathFrom="M 209.30583333333334 240L 209.30583333333334 240L 223.5275 240L 223.5275 240L 209.30583333333334 240" cy="96" cx="271.13916666666665" j="3" val="42" barHeight="144" barWidth="14.221666666666668"></path>
                                                                        <rect id="SvgjsRect1101" width="14.221666666666668" height="240" x="271.13916666666665" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M271.13916666666665 240L271.13916666666665 30.85714285714286L285.36083333333335 30.85714285714286L285.36083333333335 240L271.13916666666665 240 " fill="rgba(255,185,151,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 271.13916666666665 240L 271.13916666666665 30.85714285714286L 285.36083333333335 30.85714285714286L 285.36083333333335 240L 271.13916666666665 240" pathFrom="M 271.13916666666665 240L 271.13916666666665 240L 285.36083333333335 240L 285.36083333333335 240L 271.13916666666665 240" cy="30.85714285714286" cx="332.97249999999997" j="4" val="61" barHeight="209.14285714285714" barWidth="14.221666666666668"></path>
                                                                        <rect id="SvgjsRect1103" width="14.221666666666668" height="240" x="332.97249999999997" y="0" rx="0" ry="0" fill="#" opacity="0.1" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-backgroundBar"></rect>
                                                                        <path id="apexcharts-bar-area-0" d="M332.97249999999997 240L332.97249999999997 89.14285714285714L347.19416666666666 89.14285714285714L347.19416666666666 240L332.97249999999997 240 " fill="rgba(0,181,184,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskh224ksd1)" pathTo="M 332.97249999999997 240L 332.97249999999997 89.14285714285714L 347.19416666666666 89.14285714285714L 347.19416666666666 240L 332.97249999999997 240" pathFrom="M 332.97249999999997 240L 332.97249999999997 240L 347.19416666666666 240L 347.19416666666666 240L 332.97249999999997 240" cy="89.14285714285714" cx="394.8058333333333" j="5" val="44" barHeight="150.85714285714286" barWidth="14.221666666666668"></path>
                                                                        <g id="SvgjsG1092" class="apexcharts-datalabels"></g>
                                                                    </g>
                                                                </g>
                                                                <line id="SvgjsLine1123" x1="0" y1="0" x2="371" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                                <line id="SvgjsLine1124" x1="0" y1="0" x2="371" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                                <g id="SvgjsG1125" class="apexcharts-yaxis-annotations"></g>
                                                                <g id="SvgjsG1126" class="apexcharts-xaxis-annotations"></g>
                                                                <g id="SvgjsG1127" class="apexcharts-point-annotations"></g>
                                                            </g>
                                                            <g id="SvgjsG1119" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"></g>
                                                        </svg>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <div class="tracking-tab-container px-2">
                                                        <div class="tracking-tab-content">
                                                            <div class="top-content d-flex flex-wrap justify-content-start mt-2 pb-1 mb-2">

                                                                <div class="tracking-heading-icon mr-2">
                                                                    <i class="icon icon-pie-chart"></i>
                                                                </div>
                                                                <div class="pb-75">
                                                                    <h5 class="tracking-tab-title mb-0 text-bold-600">Total de Vendas</h5>
                                                                    <small class="text-muted">Produtos mais vendáveis</small>
                                                                </div>
                                                            </div>
                                                            <div class="bottom-content">
                                                                <ul class="tracking-list list-group">
                                                                    <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                                                        <span class="tracking-task text-bold-600 text-left">Lorem</span>
                                                                        <span class="badge badge-pill badge-warning px-1 py-50">Médio</span>
                                                                    </li>
                                                                    <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                                                        <span class="tracking-task text-bold-600 text-left">Lorem</span>
                                                                        <span class="badge badge-pill badge-success px-1 py-50">Alto</span>
                                                                    </li>
                                                                    <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                                                        <span class="tracking-task text-bold-600 text-left">Lorem</span>
                                                                        <span class="badge badge-pill badge-warning px-1 py-50">Médio</span>
                                                                    </li>
                                                                    <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                                                        <span class="tracking-task text-bold-600 text-left">Lorem</span>
                                                                        <span class="badge badge-pill badge-danger px-1 py-50">Baixo</span>
                                                                    </li>
                                                                    <li class="list-group-item border py-1 px-0 d-flex justify-content-between align-items-center">
                                                                        <span class="tracking-task text-bold-600 text-left">Lorem</span>
                                                                        <span class="badge badge-pill badge-success px-1 py-50">Alto</span>
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
                            </div>
                        </div>

                    </section>
                </main>

                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>