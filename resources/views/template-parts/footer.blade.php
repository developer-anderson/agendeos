<footer>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-10 d-none d-sm-block">
                <h1>AgendOS - Sistema de Agendamento</h1>
            </div>
            <div class="logo col-sm-2 col-6">
                <figure>
                    <img src="https://site.agendos.com.br/wp-content/uploads/2023/06/Logo.png" class="img-fluid">
                </figure>
            </div>
        </div>
    </div>

</footer>


<style>
    footer {
        background: #202020;
        padding: 20px 0;
        color: var(--white);
    }
</style>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jpopper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.en.js') }}"></script>


<script>
const loading = document.getElementById('loading');
        function showLoading() {
            hideLoading()
            loading.style.display = 'block';
        }

        function hideLoading() {
            loading.style.display = 'none';
        }
        var orderForm = {
            id_servico: [],
            remarketing: null,
            id_forma_pagamento: 5,
            user_id: {{$administrador->id}},
            situacao: 0,
            observacoes: null
        };
    jQuery(document).ready(function() {

        // gerar datas
        function generateDateButtons() {
            const buttonContainer = document.createElement('div');
            buttonContainer.classList.add('button-list');

            const calendarResult = document.createElement('div');
            calendarResult.classList.add('calendarResult');

            const currentDate = new Date();
            const daysOfWeek = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui',
                'Sex', 'Sáb'
            ];
            const times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00',
                '17:00', '18:00'
            ];

            for (let i = 0; i <= 30; i++) {
                const dateButton = document.createElement('button');
                if (i === 0) {
                    dateButton.classList.add('active');
                }

                const date = currentDate.getDate();
                const month = currentDate.getMonth() + 1;
                const year = currentDate.getFullYear();
                const dayOfWeek = daysOfWeek[currentDate.getDay()];

                dateButton.setAttribute('data-dia', date);
                dateButton.setAttribute('data-mes', month);
                dateButton.setAttribute('data-ano', year);

                // Verifica se é domingo e pula a geração do botão
                if (dayOfWeek === 'Dom') {
                    currentDate.setDate(currentDate.getDate() + 1);
                    continue;
                }

                dateButton.innerHTML =
                    `<span class='day'>${dayOfWeek}</span><span class='date'>${date.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}</span><span class='year'>${year}</span>`;

                buttonContainer.appendChild(dateButton);
                currentDate.setDate(currentDate.getDate() + 1);
            }

            //clique na data da agenda
            jQuery(document).on('click', '.button-list button', function(e) {
                event.preventDefault();
                $(".button-list button").removeClass("active")
                $(this).addClass("active")
                let mes  = $(this).data("mes")
                let dia  = $(this).data("dia")
                if($(this).data("mes") < "10"){
                    mes = "0"+mes
                }
                   if($(this).data("dia") < "10"){
                    dia = "0"+dia
                }
                orderForm.inicio_os = $(this).data("ano") + '-' + mes  + '-' + dia
                orderForm.previsao_os =  orderForm.inicio_os

                // adicionar a requisição aqui e interagir com o .calendarResult
            })


            const titleSelecioneHour = `<h2>Selecione um Horário:</h2>`;
            calendarResult.innerHTML = titleSelecioneHour;

            for (let i = 0; i < times.length; i++) {
                const hourButton = document.createElement('button');

                if (i == 0) {
                    hourButton.classList.add("empty")
                }

                hourButton.innerHTML =
                    `<span onclick='addHorario("${times[i]}")' class='hour'>${times[i]}</span>`;

                calendarResult.appendChild(hourButton);
            }

            const gridWeekDiv = document.querySelector('.grid-week');
            gridWeekDiv.innerHTML = '';
            gridWeekDiv.appendChild(buttonContainer);
            gridWeekDiv.appendChild(calendarResult)
        }

        generateDateButtons();

        // Validação do e-mail usando JavaScript
        const form = document.getElementById('formulario');
        const emailInput = document.getElementById('email');

        form.addEventListener('submit', function(event) {
            if (!emailInput.checkValidity()) {
                event.preventDefault();
                emailInput.classList.add('is-invalid');
            }
        });

        emailInput.addEventListener('input', function() {
            emailInput.classList.remove('is-invalid');
        });

        // steps

        jQuery(document).on('click', '.btn-step1, .btn-step2, .btn-step3, .btn-step4', function(e){
            if(jQuery(this).hasClass("btn-step1")){
                jQuery(".steps").css("display", 'none')
                jQuery("#step1").css("display", 'flex')
            }

            if(jQuery(this).hasClass("btn-step2")){
                jQuery(".steps").css("display", 'none')
                jQuery("#step2").css("display", 'flex')
            }

            if(jQuery(this).hasClass("btn-step3")){
                jQuery(".steps").css("display", 'none')
                jQuery("#step3").css("display", 'flex')
            }
        });

        var step0 = document.querySelector("#step0");
        var step1 = document.querySelector("#step1");
        var step2 = document.querySelector("#step2");
        var step3 = document.querySelector("#step3");
        var step4 = document.querySelector("#step4");

        var btnStep0 = document.querySelector("#quero-agendar");
        var btnStep3 = document.querySelector("#escolher-data");
        var btnStep4 = document.querySelector("#btn-step4");

        btnStep0.addEventListener('click', function(event) {
            event.preventDefault()
            step0.style.display = "none";
            step1.style.display = "flex";
        });

        btnStep3.addEventListener('click', function(event) {
            event.preventDefault()
            step2.style.display = "none";
            step3.style.display = "flex";
        });

        btnStep4.addEventListener('click', function(event) {
            event.preventDefault()
            step3.style.display = "none";
            step4.style.display = "flex";
        });





        function adicionarAoOrderForm(elemento) {
            var id = elemento.getAttribute('data-id');
            var nome = elemento.getAttribute('data-nome');

            orderForm.funcionario = nome;
            orderForm.id_funcionario = id;

            console.log(orderForm);
        }

        var funcionarios = document.querySelectorAll('.lista-de-profissionais li a');

        for (var i = 0; i < funcionarios.length; i++) {
            funcionarios[i].addEventListener('click', function(event) {
                event.preventDefault();
                adicionarAoOrderForm(this);
                step1.style.display = "none";
                step2.style.display = "flex";
            });
        }

        function calcularTotal() {
            var produtosSelecionados = document.querySelectorAll('.lista-de-servicos li a.selected');
            var total = 0;
            var listaProdutos = [];

            for (var i = 0; i < produtosSelecionados.length; i++) {
                var produto = produtosSelecionados[i];
                var preco = parseFloat(produto.getAttribute('data-preco'));
                total += preco;

                var titulo = produto.getAttribute('data-titulo');
                var id = produto.getAttribute('data-servico');
                var idExiste = orderForm.id_servico.includes(id);

                if (!idExiste) {
                    orderForm.id_servico.push(id);
                }

                listaProdutos.push({
                    titulo: titulo,
                    preco: preco
                });
            }

            var jsonProdutos = JSON.stringify(listaProdutos);
            var spanTotal = document.querySelector('h1.total-price');
            spanTotal.textContent = 'R$ ' + (total / 100).toFixed(2);


            console.log('orderForm', orderForm);

            return jsonProdutos;
        }

        calcularTotal();


        // Adicione um evento de clique aos elementos que possuem a classe "selected"
        var elementosClicaveis = document.querySelectorAll('.lista-de-servicos li a');

        for (var i = 0; i < elementosClicaveis.length; i++) {

            elementosClicaveis[i].addEventListener('click', function(event) {
                event.preventDefault();
                if (!this.classList.contains('selected')) {
                    adicionarSelecao(this.querySelector(".btn-primary"));
                    calcularTotal()
                } else {
                    removerSelecao(this.querySelector(".btn-primary"));
                    calcularTotal();
                }


            });
        }

        // adicionando no subtotal

        function adicionarSelecao(elemento) {
            var aElemento = elemento.parentNode;
            if (!aElemento.classList.contains('selected')) {
                aElemento.classList.add('selected');
                elemento.classList.add('selected');
                elemento.innerHTML = '<i class="fa fa-check"></i>';
            }
        }


        // remove o elemento selecionado
        function removerSelecao(elemento) {
            var aElemento = elemento.parentNode;
            console.log("elemento", aElemento)
            if (aElemento.classList.contains('selected')) {
                aElemento.classList.remove('selected');
                elemento.classList.remove('selected');
                elemento.innerHTML = 'Selecionar';
            }
        }



        jQuery('.datetimepicker').datepicker({
            timepicker: true,
            language: 'en',
            range: true,
            multipleDates: true,
            multipleDatesSeparator: " - "
        });
        jQuery("#add-event").submit(function() {
            alert("Submitted");
            var values = {};
            $.each($('#add-event').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            console.log(
                values
            );
        });
    });
    function addHorario(horario){
        orderForm.inicio_os_time = horario
        orderForm.previsao_os_time = horario
    }
function agendar() {
    showLoading()
  var data = {
    nome_f: $("#nome").val(),
    tipo_cliente: "PF",
    email_f: $("#email").val(),
    telefone_f: $("#whatsapp").val(),
    celular_f: $("#whatsapp").val(),
    observacoes: $("#observacoes").val(),
    user_id: {{$administrador->id}}
  };

  var settings = {
    url: "https://agendos.com.br/clientes/insert",
    method: "POST",
    timeout: 0,
    contentType: "application/json",
    data: JSON.stringify(data)
  };

  $.ajax(settings).done(function(response) {
    orderForm.id_cliente = response.id;
    if(!response.id){
        hideLoading()
        alert("Ocorreu um erro ao realizar o seu agendamento. Favor entrar, tente novamente em alguns instantes. Caso ainda não consiga, entrar em contato com o estabeleciomento.")
    }
    var orderFormSettings = {
      url: "https://agendos.com.br/os/insert",
      method: "POST",
      timeout: 0,
      contentType: "application/json",
      data: JSON.stringify(orderForm)
    };

    $.ajax(orderFormSettings).done(function(response) {
      console.log(response);
          if(!response.id){
        hideLoading()
        alert("Ocorreu um erro ao realizar o seu agendamento. Favor entrar, tente novamente em alguns instantes. Caso ainda não consiga, entrar em contato com o estabeleciomento.")
    }
    else{
        alert("Agendamento realizado com sucesso, em alguns minutos você receberá uma confirmação via Whatsapp.")
        window.location.href = "https://site.agendos.com.br/";
    }
    });
  });
}

    (function() {
        'use strict';
        // ------------------------------------------------------- //
        // Calendar
        // ------------------------------------------------------ //
        jQuery(function() {
            // page is ready
            jQuery('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                // emphasizes business hours
                businessHours: false,
                defaultView: 'agendaWeek',
                // event dragging & resizing
                editable: true,
                // header
                header: {
                    left: 'title',
                    center: 'month,agendaWeek,agendaDay',
                    right: 'today prev,next'
                },
                events: [{
                        title: 'Barber',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-07-07',
                        end: '2019-07-07',
                        className: 'fc-bg-default',
                        icon: "circle"
                    },
                    {
                        title: 'Flight Paris',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-08-08T14:00:00',
                        end: '2019-08-08T20:00:00',
                        className: 'fc-bg-deepskyblue',
                        icon: "cog",
                        allDay: false
                    },
                    {
                        title: 'Team Meeting',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-07-10T13:00:00',
                        end: '2019-07-10T16:00:00',
                        className: 'fc-bg-pinkred',
                        icon: "group",
                        allDay: false
                    },
                    {
                        title: 'Meeting',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-08-12',
                        className: 'fc-bg-lightgreen',
                        icon: "suitcase"
                    },
                    {
                        title: 'Conference',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-08-13',
                        end: '2019-08-15',
                        className: 'fc-bg-blue',
                        icon: "calendar"
                    },
                    {
                        title: 'Baby Shower',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-08-13',
                        end: '2019-08-14',
                        className: 'fc-bg-default',
                        icon: "child"
                    },
                    {
                        title: 'Birthday',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-09-13',
                        end: '2019-09-14',
                        className: 'fc-bg-default',
                        icon: "birthday-cake"
                    },
                    {
                        title: 'Restaurant',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-10-15T09:30:00',
                        end: '2019-10-15T11:45:00',
                        className: 'fc-bg-default',
                        icon: "glass",
                        allDay: false
                    },
                    {
                        title: 'Dinner',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-11-15T20:00:00',
                        end: '2019-11-15T22:30:00',
                        className: 'fc-bg-default',
                        icon: "cutlery",
                        allDay: false
                    },
                    {
                        title: 'Shooting',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-08-25',
                        end: '2019-08-25',
                        className: 'fc-bg-blue',
                        icon: "camera"
                    },
                    {
                        title: 'Go Space :)',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-12-27',
                        end: '2019-12-27',
                        className: 'fc-bg-default',
                        icon: "rocket"
                    },
                    {
                        title: 'Dentist',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
                        start: '2019-12-29T11:30:00',
                        end: '2019-12-29T012:30:00',
                        className: 'fc-bg-blue',
                        icon: "medkit",
                        allDay: false
                    }
                ],
                eventRender: function(event, element) {
                    if (event.icon) {
                        element.find(".fc-title").prepend("<i class='fa fa-" + event.icon +
                            "'></i>");
                    }
                },
                dayClick: function() {
                    jQuery('#modal-view-event-add').modal();
                },
                eventClick: function(event, jsEvent, view) {
                    jQuery('.event-icon').html("<i class='fa fa-" + event.icon + "'></i>");
                    jQuery('.event-title').html(event.title);
                    jQuery('.event-body').html(event.description);
                    jQuery('.eventUrl').attr('href', event.url);
                    jQuery('#modal-view-event').modal();
                },
            })
        });

    })(jQuery);
    hideLoading()
</script>
