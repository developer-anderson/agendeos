<style>
    :root {
        --white: #FFFFFF;
    }

    header {
        background: {{ $estabelecimento->cor_primaria }};
        max-height: 350px;
    }

    header h1 {
        color: var(--white);
        font-size: 20px;
        padding: 20px;
    }

    header .icon-bar {
        text-align: right;
    }

    header .icon-bar a.btn-login {
        border: 2px solid var(--white);
        padding: 10px 50px;
        border-radius: 50px;
        color: #FFF;
        font-weight: bold;
        text-decoration: none;
        display: flex;
        flex-direction: center;
        align-items: center;
        float: right;
    }

    header .icon-bar a.btn-login:hover {
        border: 2px solid #02D07A;
        color: #02D07A;
    }

    header .icon-bar a.btn-login i {
        font-size: 35px;
    }

    header .banner-full figure img {
        border-radius: 10px;
    }

    main {
        margin-top: 120px;
    }

    @media screen and (max-width: 768px) {
        header .container .row {
            padding: 20px;
        }

        header .icon-bar a.btn-login {
            justify-content: center;
            width: 100%;
            padding: 5px;
            text-align: center;
        }

        main {
            margin-top: 0;
        }

        .btn-button {
            display: block;
            font-size: 20px !important;
        }

        .card {
            margin: 20px 0;
        }

        .lista-de-servicos li a {
            grid-template-columns: 1fr !important;
            text-align: center;
            gap: 10px;
        }
    }
</style>

<header>
    <div class="container">
        <div class="row banner-full">
            <div class="col-12 text-center">
                <h1>Sistema de Agendamento</h1>
            </div>
            <figure>
                <img src="{{ asset('assets/img/mikacorts/banner.jpg') }}" class="img-fluid" alt="">
            </figure>
        </div>
    </div>
</header>
