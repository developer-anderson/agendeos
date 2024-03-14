<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
    />
    <!-- bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <!-- font awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <title>Pagamento AgendOS</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="https://site.agendos.com.br/" target="_blank">
                    <figure class="img-logo flex-center">
                        <img src="{{ asset('icon.png') }}" alt="AgendOS logo" />
                    </figure>
                </a>
            </div>

            <div class="col-6 flex-end">
                <a
                    href="https://api.whatsapp.com/send?phone=5571993550327"
                    class="contact-link"
                    target="_blank"
                >Contato</a
                >
            </div>
        </div>
    </div>
</header>

<main class="main-container">
    <section class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <h1 class="title-lg">Realize o Pagamento do Agendamento</h1>

                <div class="form-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <form novalidate name="payment-form" action="" onsubmit="">
                                <div class="mb-4">
                                    <label for="card-number" class="form-label"
                                    >Número do cartão</label
                                    >
                                    <input
                                        placeholder="0000 0000 0000 0000"
                                        type="text"
                                        class="form-control"
                                        id="card-number"
                                        name="card-number"
                                    />
                                    <span
                                        id="error-message-card-number"
                                        class="error-message"
                                    ></span>
                                </div>

                                <div class="mb-4">
                                    <label for="holder-name" class="form-label"
                                    >Nome completo</label
                                    >
                                    <input
                                        placeholder="Nome do titular"
                                        type="text"
                                        class="form-control"
                                        id="holder-name"
                                        name="holder-name"
                                    />
                                    <div id="emailHelp" class="form-text">
                                        Conforme aparece no cartão.
                                    </div>
                                    <span
                                        id="error-message-holder-name"
                                        class="error-message"
                                    ></span>
                                </div>

                                <div class="d-flex gap-3">
                                    <div class="mb-4">
                                        <label for="due-date" class="form-label"
                                        >Data de vencimento</label
                                        >
                                        <input
                                            placeholder="11/2027"
                                            type="text"
                                            class="form-control"
                                            id="due-date"
                                            name="due-date"
                                        />
                                        <div id="emailHelp" class="form-text">Mês / Ano</div>
                                        <span
                                            id="error-message-due-date"
                                            class="error-message"
                                        ></span>
                                    </div>

                                    <div class="mb-4">
                                        <label for="cvv" class="form-label"
                                        >Código de segurança</label
                                        >
                                        <input
                                            placeholder="123"
                                            type="text"
                                            class="form-control"
                                            id="cvv"
                                            name="cvv"
                                        />
                                        <div id="emailHelp" class="form-text">CVV</div>
                                        <span
                                            id="error-message-cvv"
                                            class="error-message"
                                        ></span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="holder-cpf" class="form-label"
                                    >CPF do titular do cartão</label
                                    >
                                    <input
                                        placeholder="000.000.000-00"
                                        type="text"
                                        class="form-control"
                                        id="holder-cpf"
                                        name="holder-cpf"
                                    />
                                    <span
                                        id="error-message-holder-cpf"
                                        class="error-message"
                                    ></span>
                                </div>

                                <button type="submit" class="btn btn-primary submit-button">
                                    Continuar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="checkout-container">
                    <h2 class="title-md">Resumo da compra</h2>

                    <span class="separator"></span>
                    @foreach($agendamento->servicos as $servico)

                        <div class="flex-space-between mt-3">
                            <p>{{ $servico['nome'] }}</p>
                            <p>R$ {{ number_format($servico['valor']/100, 2, ",", ".") }}</p>
                        </div>
                    @endforeach

                    <span class="separator mt-2"></span>

                    <div class="flex-space-between mt-3">
                        <p>Você pagará</p>
                        <p class="text-bold fs-5">R$ {{ number_format(($agendamento->total+$agendamento->taxa)/100, 2, ",", ".") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <a href="https://site.agendos.com.br/" target="_blank">
                    <figure class="img-logo flex-center">
                        <img src="{{ asset('/icon.png') }}" alt="AgendOS logo" />
                    </figure>
                </a>
            </div>

            <div class="col-lg-6">
                <p class="text-footer">Copyright 2023 ©</p>
                <p class="text-footer">
                    Todos os Direitos Reservados a AGENDOS SOLUÇÕES EM TECNOLOGIA LTDA
                </p>
                <p class="text-footer">CNPJ: 50.921.244/0001/85</p>
                <p class="text-footer">
                    SAC: WhatsApp: (71) 99355-0327 | E-mail: contato@agendos.com.br
                </p>
            </div>

            <div class="col-lg-4">
                <div class="d-flex gap-3">
                    <a
                        href="https://play.google.com/store/apps/details?id=com.agendos&pli=1"
                        target="_blank"
                    >
                        <figure class="img-logo flex-center">
                            <img src="{{ asset('play-store.webp') }}" alt="AgendOS logo" />

                        </figure>
                    </a>
                    <a
                        href="https://apps.apple.com/br/app/agendos/id6476807033"
                        target="_blank"
                    >
                        <figure class="img-logo flex-center">

                            <img src="{{ asset('apple-store.webp') }}" alt="AgendOS logo" />

                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>
<script src="https://unpkg.com/imask"></script>
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
