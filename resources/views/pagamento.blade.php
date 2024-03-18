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
<div id="overlay">
    <div id="loading-container">
        <div class="spinner-border text-primary" role="status"></div>
        <span class="">Carregando...</span>

    </div>
</div>
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
                                    <label for="payment-method" class="form-label">Método de pagamento</label>
                                    <div class="form-check form-check-inline me-4">
                                        <input class="form-check-input" type="radio" name="payment-method" id="credit-card" value="credit-card" checked>
                                        <label class="form-check-label" for="credit-card">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                                <path d="M21.422 4H2.578C1.571 4 1 4.57 1 5.422v13.156C1 19.43 1.571 20 2.422 20h18c.851 0 1.422-.57 1.422-1.422V5.422C22.844 4.57 22.274 4 21.422 4zM20 15H4v-2h16v2zm0-4H4v-2h16v2zm-2-5H6v3h12V6zm-6 2a1 1 0 1 0 1 1 1 1 0 0 0-1-1z"/>
                                            </svg>
                                            Cartão de Crédito
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment-method" id="pix" value="pix">
                                        <label class="form-check-label" for="pix">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                                                <path d="M 25 0.046875 C 22.924964 0.046875 20.850972 0.83457408 19.273438 2.4121094 L 2.4121094 19.271484 C -0.7429612 22.426555 -0.7429612 27.571493 2.4121094 30.726562 L 19.273438 47.587891 C 22.42773 50.742184 27.57227 50.742184 30.726562 47.587891 L 47.587891 30.728516 C 50.742961 27.573445 50.742961 22.428507 47.587891 19.273438 L 30.728516 2.4121094 C 29.15098 0.83457408 27.075036 0.046875 25 0.046875 z M 25 2.0332031 C 26.558964 2.0332031 28.118988 2.6307072 29.314453 3.8261719 L 38.486328 13 L 37.070312 13 C 35.479355 13 33.953288 13.631896 32.828125 14.755859 A 1.0001 1.0001 0 0 0 32.828125 14.757812 L 26.060547 21.525391 C 25.466839 22.119099 24.532404 22.119686 23.9375 21.525391 L 17.169922 14.757812 C 16.046276 13.632967 14.520644 13 12.929688 13 L 11.511719 13 L 20.6875 3.8261719 C 21.882965 2.6307072 23.441036 2.0332031 25 2.0332031 z M 9.5117188 15 L 12.929688 15 C 13.99073 15 15.007506 15.420769 15.755859 16.169922 A 1.0001 1.0001 0 0 0 15.755859 16.171875 L 22.523438 22.939453 C 23.882532 24.297158 26.116318 24.297745 27.474609 22.939453 L 34.242188 16.171875 C 34.993023 15.421792 36.00927 15 37.070312 15 L 40.486328 15 L 46.173828 20.6875 C 48.564758 23.078429 48.564758 26.923524 46.173828 29.314453 L 40.488281 35 L 37.070312 35 C 36.00927 35 34.993023 34.578161 34.242188 33.828125 L 27.474609 27.060547 C 26.795464 26.381401 25.897789 26.042986 25 26.042969 C 24.102211 26.042952 23.202984 26.381695 22.523438 27.060547 L 15.755859 33.828125 A 1.0001 1.0001 0 0 0 15.755859 33.830078 C 15.007506 34.579184 13.99073 35 12.929688 35 L 9.5136719 35 L 3.8261719 29.3125 C 1.4352424 26.921571 1.4352424 23.076476 3.8261719 20.685547 L 9.5117188 15 z M 25 28.029297 C 25.382185 28.02937 25.763693 28.177755 26.060547 28.474609 L 32.828125 35.242188 A 1.0001 1.0001 0 0 0 32.828125 35.244141 C 33.953288 36.368057 35.479355 37 37.070312 37 L 38.488281 37 L 29.3125 46.173828 C 26.922793 48.563535 23.077207 48.563535 20.6875 46.173828 L 11.513672 37 L 12.929688 37 C 14.520644 37 16.046276 36.367033 17.169922 35.242188 L 23.9375 28.474609 C 24.234952 28.177462 24.617815 28.029224 25 28.029297 z"></path>
                                            </svg>
                                            PIX
                                        </label>
                                    </div>
                                </div>
                                <div id="credit-card-fields" style="display: none;">
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
                                </div>
                                <div id="pix-fields" style="display: none;">
                                    <div class="mb-4">
                                        <label for="holder-cpf" class="form-label"
                                        >CPF</label
                                        >
                                        <input
                                            placeholder="000.000.000-00"
                                            type="text"
                                            class="form-control"
                                            id="holder-cpf-pix"
                                            name="holder-cpf"
                                        />
                                        <span
                                            id="error-message-holder-cpf-pix"
                                            class="error-message"
                                        ></span>
                                    </div>
                                    <div id="dados-pix" style="display: none;">
                                        <div class="mb-4">
                                            <label for="pix-image" class="form-label">Imagem PIX</label>
                                            <img src="caminho/para/imagem-pix.png" id="pix-image" alt="Imagem PIX">
                                        </div>
                                        <div class="mb-4">
                                            <label for="pix-text" class="form-label">PIX copia-e-cola</label>
                                            <input placeholder="Copie e cole o texto PIX aqui" type="text" class="form-control" id="pix-text" name="pix-text">
                                        </div>
                                    </div>

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
                        <p class="text-bold fs-5">R$ {{ number_format(($agendamento->total)/100, 2, ",", ".") }}</p>
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
