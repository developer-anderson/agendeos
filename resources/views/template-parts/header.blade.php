<style>
    :root {
        --white: #FFFFFF;
    }

    header {
        background: #202020;
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
        margin-top: 250px;
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
            grid-template-columns: 1fr!important;
            text-align: center;
            gap: 10px;
        }
    }
</style>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12 d-none d-sm-block">
                <h1>AgendOS - Sistema de Agendamento</h1>
            </div>
            <div class="logo col-sm-3 col-7">
                <figure>
                    <img src="{{ asset('assets/img/logo-agendos.png') }}" class="img-fluid">
                </figure>
            </div>
            <div class="col-sm-9 col-5 icon-bar">
                <a href="#" class="btn-login">
                    <i class="fa fa-user"></i> <span class="d-none d-sm-block">Já Sou Cliente</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row banner-full">
            <figure>
                <img src="https://placehold.it/2000x700" class="img-fluid" alt="">
            </figure>
        </div>
    </div>
</header>
