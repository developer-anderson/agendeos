<footer>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-10 d-none d-sm-block">
                <h1>AgendOS - Sistema de Agendamento</h1>
            </div>
            <div class="logo col-sm-2 col-6">
                <figure>
                    <img src="{{ asset('assets/img/logo-agendos.png') }}" class="img-fluid">
                </figure>
            </div>
        </div>
    </div>

</footer>

<!-- modal de alerts -->
<div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="msgModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-danger">
                ...
            </div>
        </div>
    </div>
</div>


<style>
    footer {
        background: #202020;
        padding: 20px 0;
        color: var(--white);
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.en.js') }}"></script>


<script>
    const overlay = document.getElementById('overlay');

    var agendamentoData = {
        "data_agendamento": "",
        "hora_agendamento": "",
        'funcionario_id': "",
        'forma_pagamento_id': "",
        'itens': "",
        'telefone':"",
        'email':"",
        'nome': "",
        "validar": 1,
        "situacao_id": 1,
        "user_id": {{ $administrador->id }}
    };
    const swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1.5,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2.5,
                spaceBetween: 10
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 4.5,
                spaceBetween: 10
            }
        }
    });


    $(document).ready(function() {

        function verificarDadosAgendamento() {
            // Lista das chaves que você deseja verificar
            const chavesDesejadas = ['nome', 'email', 'forma_pagamento_id', 'funcionario_id', 'itens',
                'data_agendamento', 'hora_agendamento', 'situacao', 'telefone', 'user_id'
            ];

            // Verificar se todas as chaves têm dados em agendamentoData
            const dadosCompletos = chavesDesejadas.every(chave => agendamentoData[chave] !== undefined &&
                agendamentoData[chave] !== null);
            if (dadosCompletos) {
                console.log('Todos os dados necessários estão presentes em agendamentoData:', agendamentoData);
            } else {
                console.log('Faltam alguns dados em agendamentoData:', agendamentoData);
            }
        }


        /////

        const idServicos = [];


        // verifica os inputs preenchidos
        $(document).on('input', 'input[type="text"],input[type="email"],input[type="tel"], textarea', (e) => {
            let value = e.target.value;
            let id = e.target.id;
            console.log(e)
            agendamentoData[id] = value;
            console.log(agendamentoData)
        })

        // verifica o funcionario clicado
        $(document).on('click', '.funcionario-item', (e) => {
            e.preventDefault();
            $('.funcionario-item').removeClass('active');
            $(e.currentTarget).addClass("active")

            agendamentoData['funcionario_id'] = $(e.currentTarget).data('id');
            verificarDadosAgendamento();
        })

        // verifica o pagamento clicado
        $(document).on('click', '.payment-button', (e) => {
            let value = $(e.currentTarget).data('id');
            $('.payment-button').removeClass('active');
            $(e.target).addClass('active');

            agendamentoData['forma_pagamento_id'] = value;
            verificarDadosAgendamento()
        })

        //verifica os serviços clicados
        $(document).on('click', '.servico-item input[type="checkbox"]', function() {
            var checkbox = $(this);
            var servico_id = parseInt(checkbox.val());

            // Verifica se o checkbox foi marcado ou desmarcado
            if (checkbox.prop('checked')) {
                let dados = {
                    "servicos_id": servico_id,
                    "quantidade": 1
                };
                idServicos.push(dados);
            } else {
                // Remove o ID do serviço do array se desmarcado
                for (let i = 0; i < idServicos.length; i++) {
                    if (idServicos[i].servicos_id === servico_id) {
                        idServicos.splice(i, 1);
                        break; // Importante para interromper o loop após a remoção
                    }
                }
            }


            // Atualiza agendamentoData com o array de IDs
            agendamentoData['itens'] = idServicos;

            // Exibe o array atualizado no console
            verificarDadosAgendamento()
        });


        // Função para formatar o número como moeda brasileira
        function formatMoney(value) {
            return parseFloat(value).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }

        // Função para atualizar o total quando um checkbox é alterado
        function updateTotal() {
            var total = 0;
            // Itera sobre os checkboxes marcados e soma os preços
            $('.servico-item input:checked').each(function() {
                total += parseFloat($(this).closest('.servico-item').data('price')) /
                    100; // Divida por 100 para obter o valor decimal
            });
            // Atualiza o texto do total
            $('.order-resume strong').text(formatMoney(total)); // Formata o total como moeda brasileira
        }

        // Atualiza o total quando a página é carregada
        updateTotal();

        // Adiciona um ouvinte de eventos para os checkboxes
        $('.servico-item input').change(function() {
            updateTotal();
        });

        // Adiciona um ouvinte de eventos para o campo de busca
        $('.search-servico').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            // Oculta ou exibe os itens de acordo com a pesquisa
            $('.servico-item').each(function() {
                var itemName = $(this).data('name').toLowerCase();
                if (itemName.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        //verificar agendamento

        // gerar datas
        function generateDateButtons() {
            // verifico os dias disponiveis no banco de dados
            const diasSemana = {
                'Seg': {{ $estabelecimento->segunda ?? 0 }},
                'Ter': {{ $estabelecimento->terca ?? 0 }},
                'Qua': {{ $estabelecimento->quarta ?? 0 }},
                'Qui': {{ $estabelecimento->quinta ?? 0 }},
                'Sex': {{ $estabelecimento->sexta ?? 0 }},
                'Sab': {{ $estabelecimento->sabado ?? 0 }},
                'Dom': {{ $estabelecimento->domingo ?? 0 }},
            };

            const buttonContainer = document.createElement('div');
            buttonContainer.classList.add('button-list');

            const calendarResult = document.createElement('div');
            calendarResult.classList.add('calendarResult');

            const currentDate = new Date();
            const daysOfWeek = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui',
                'Sex', 'Sáb'
            ];

            const arrayDiasSemana = Object.entries(diasSemana);

            // verificos quais os dias abertos
            const opennedDays = arrayDiasSemana
                .map(function(item) {
                    if (item[1] === 1) {
                        return item[0];
                    }
                })
                .filter(Boolean);

            const dayOfWeek = daysOfWeek[currentDate.getDay()];


            const times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00',
                '17:00', '18:00'
            ];

            // exibo os proximos 14 dias abertos
            for (let i = 0; i <= 14; i++) {
                const dateButton = document.createElement('button');

                const date = currentDate.getDate();
                const month = currentDate.getMonth() + 1;
                const year = currentDate.getFullYear();
                const dayOfWeek = daysOfWeek[currentDate.getDay()];
                const fullDate = year + '-' + month.toString().padStart(2, '0') + '-' + date.toString()
                    .padStart(2, '0');

                dateButton.setAttribute('data-dia', date);
                dateButton.setAttribute('data-mes', month);
                dateButton.setAttribute('data-ano', year);
                dateButton.setAttribute('data-data', fullDate);

                // Verifica se é um dia aberto e gera os botões
                if (opennedDays.includes(dayOfWeek)) {
                    dateButton.innerHTML =
                        `<span class='day'>${dayOfWeek}</span><span class='date'>${date.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}</span><span class='year'>${year}</span>`;

                    buttonContainer.appendChild(dateButton);
                }

                currentDate.setDate(currentDate.getDate() + 1);
            }

            function showHours(data) {
                $(".hoursResult").html("");
                data.map(function(item) {
                    $(".hoursResult").append(
                        `<button class="hour-item" data-hour="${item.horario}" ${!item.disponivel ? 'disabled': ''}>${item.horario}</button>`
                    );
                });

                // verifica o pagamento clicado
                $(document).on('click', '.hour-item', (e) => {
                    let value = $(e.currentTarget).data('hour');
                    $('.hour-item').removeClass('active');
                    $(e.target).addClass('active');
                    agendamentoData['hora_agendamento'] = value;
                    $(".btAgendar").attr("disabled", false);

                    verificarDadosAgendamento()
                })
            }

            // verificar os horários disponiveis e liberar na api
            function checkHours(empresa, funcionario, data) {
                const url =
                    `https://producao.agendos.com.br/public/api/agendamentos/agenda_funcionario/${empresa}/${funcionario}/${data}`;
                overlay.style.display = 'flex';

                // Variável para rastrear o estado de carregamento
                let isLoading = false;

                // Verifica se já há uma solicitação em andamento
                if (isLoading) {
                    console.log('Aguarde, a solicitação está em andamento...');
                    return;
                }

                // Ativa o indicador de loading
                isLoading = true;
                console.log('Carregando...');

                if (!agendamentoData["itens"]) {
                    $("#msgModalLabel").html("Ops... Você não selecionou um serviço!");
                    $(".modal-body").html(
                        "Para exibir os horários disponíveis, você precisa selecionar um serviço."
                    );
                    $('#msgModal').modal('show');
                } else {
                    let itens = agendamentoData["itens"];

                    let objServicos = itens.map(item => {
                        return {
                            "id": item.servicos_id
                        };
                    });


                    // Opções para a solicitação POST
                    const options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            "servicos": objServicos
                        }),
                    };

                    // Inicia a solicitação fetch
                    fetch(url, options)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`Erro de rede - ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            $(".title-horarios").html("Escolha um horário:")
                            showHours(data);
                            overlay.style.display = 'none';

                            isLoading = false;
                        })
                        .catch(error => {
                            console.error('Erro ao fazer a solicitação:', error);

                            // Desativa o indicador de loading em caso de erro
                            isLoading = false;
                        });
                }
            }

            //clique na data da agenda
            jQuery(document).on('click', '.button-list button', function(e) {
                event.preventDefault();
                $(".button-list button").removeClass("active")

                if ($(this).data("data")) {
                    agendamentoData["data_agendamento"] = $(this).data("data");
                    verificarDadosAgendamento()
                }

                if (!agendamentoData['funcionario_id']) {
                    $("#msgModalLabel").html("Ops... Você não selecionou um funcionário!");
                    $(".modal-body").html(
                        "Para exibir os horários disponíveis, você precisa selecionar um funcionário."
                    );
                    $('#msgModal').modal('show');
                } else {
                    $(this).addClass("active")

                    checkHours(agendamentoData['user_id'], agendamentoData['funcionario_id'], $(this)
                        .data(
                            "data"));
                }
            })


            const titleSelecioneHour =
                `<h2 class="title-horarios">Escolha uma data para exibir os horários.</h2><div class="hoursResult"></div>`;
            calendarResult.innerHTML = titleSelecioneHour;

            const gridWeekDiv = document.querySelector('.grid-week');
            gridWeekDiv.innerHTML = '';
            gridWeekDiv.appendChild(buttonContainer);
            gridWeekDiv.appendChild(calendarResult)
        }

        generateDateButtons();

    });
    function agendarServico() {
        overlay.style.display = 'flex';

        $(".btAgendar").attr("disabled", true);
        var settings = {
            "url": "https://producao.agendos.com.br/public/api/agendamentos",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json"
            },
            "data": JSON.stringify(agendamentoData),
        };

        $.ajax(settings).done(function(response) {
            console.log(response);
            if (response.erro === false) {
                $("#msgModalLabel").html("Sucesso!");
                $(".modal-body").html(
                    response.mensagem
                );
                overlay.style.display = 'none';
                Swal.fire({
                    icon: "success",
                    title: "Confirmado!",
                    text: "Seu agendamento foi realizado com sucesso. Logo você receberá detalhes em seu WhatsApp",
                    footer: '<a href="https://site.agendos.com.br/">Conheça o AgendOS</a>'
                });
                $(".btAgendar").attr("disabled", false);
            } else {
                overlay.style.display = 'none';

                $(".btAgendar").attr("disabled", false);
                // Se houver erro, você pode tratar de acordo com sua lógica
                console.error('Erro ao cadastrar:', response.mensagem);
            }
        });

    }

</script>
