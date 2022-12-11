// Ativar input de busca do header
var btnActive = false;
var html = ''
var options = ''
var id_cliente = 0
var id_veiculo = 0
var id_servico = 0;
var os_id = 0;
var id_fluxo =0;
var os = {};
var endpoint = ''
if(window.location.hostname == 'agendos.com.br'){
  endpoint = 'https://agendos.com.br'
}
else{
  endpoint = 'http://127.0.0.1:8002'
}

var previsao_os_time = ''
if (!localStorage.getItem('id') && window.location.pathname != "/login.html") {
  window.location.href = 'login.html';
}
function sair(){
  localStorage.removeItem('id');
  window.location.href = 'login.html';
}
$(document).ready(function () {
  $('.celular').mask('(00) 0.0000-0000');
  $('.telefone').mask('(00) 0000-0000');
  $('.cnpj').mask('00.000.000/0000-00');
  $('.ie').mask('000.000.000.000');
  $('.cpf').mask('000.000.000-00');
  $('.cep').mask('00.000-000');
  $(".input-serch-data-table").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".pesquisar tr").filter(function() {
        $(this).toggle($(this).text()
        .toLowerCase().indexOf(value) > -1)
    });
});
  $(".cnpj").blur(function () {

    var cnpj = $(this).val().replace(/[^0-9]/g, '');


    if (cnpj.length == 14) {


      $.ajax({
        url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
        method: 'GET',
        dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
        complete: function (xhr) {

          // Aqui recuperamos o json retornado
          response = xhr.responseJSON;

          // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
          if (response.status == 'OK') {
            console.log(response)
            // Agora preenchemos os campos com os valores retornados
            $('#razaoSocialClientePj').val(response.nome);
            $('#emailClientePj').val(response.email);
            $('.cep').val(response.cep).trigger('blur');


            // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
          } else {
           
            Swal.fire({
              title: "Erro",
              text: "Não foi possivel consultar os dados da empresa na receita!",
              type: "error",
              confirmButtonClass: "btn btn-success",
              buttonsStyling: false
            });
          }
        }
      });

      // Tratativa para caso o CNPJ não tenha 14 caracteres
    } else {
      Swal.fire({
        title: "Erro",
        text: "CNPJ inválido!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
  $(".cep").blur(function () {

    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
      var validacep = /^[0-9]{8}$/;
      if (validacep.test(cep)) {


        $(".logradouro").val("Buscando informações....");
        $(".bairro").val("...");
        $(".cidade").val("...");
        $(".estado").val("...");


        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

          if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $(".logradouro").val(dados.logradouro);
            $(".bairro").val(dados.bairro);
            $(".cidade").val(dados.localidade);
            $(".estado").val(dados.uf);
            $(".cep").val($(this).val())

          } //end if.
          else {
            //CEP pesquisado não foi encontrado.
            limpa_formulário_cep();
            Swal.fire({
              title: "Erro",
              text: "CEP não encontrado!",
              type: "error",
              confirmButtonClass: "btn btn-success",
              buttonsStyling: false
            });
        
          }
        });
      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        Swal.fire({
          title: "Erro",
          text: "Formato de CEP inválido!",
          type: "error",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });

      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
    }
  });
});
function limpa_formulário_cep() {
  // Limpa valores do formulário de cep.
  $(".logradouro").val("");
  $(".bairro").val("");
  $(".cidade").val("");
  $(".estado").val("");

}
const activeSearchs = () => {
  const headerInput = document.querySelector('.header-input');
  const headerBusca = document.querySelector('.header-busca');
  const btnHeaderSearch = document.getElementById('btnHeaderSearch');

  if (!btnActive) {
    headerInput.style.width = '400px';
    headerInput.style.padding = '0px, 15px';
    headerBusca.style.background = '#343434';
    btnHeaderSearch.style.display = "block";
    btnActive = true
  } else {
    headerInput.style.width = '0px';
    headerInput.style.padding = '0px';
    btnHeaderSearch.style.display = "none";
    btnActive = false;
  }
};


// END


// Trocar form do cliente Pessoa Física e Jurídica
function changeFormClientPj() {
  if (!btnActive) {
    formclientPf.classList.add('d-none');
    formclientPj.classList.add('d-flex');
    btnClientPj.classList.remove('btn-disable');
    btnClientPf.classList.add('btn-disable');
    btnAddClientePf.classList.add('d-none');
    btnAddClientePj.classList.remove('d-none');
  }
};
function addFluxo(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/fluxo_caixa/insert',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        id_cliente = response.id
        Swal.fire({
          title: "Concluido",
          text: "Cadastrado com Sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-receitas.php';
        }, 2000)
       
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function editarFluxo(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/fluxo_caixa/update/'+id_fluxo,

    type: 'put',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        id_cliente = response.id
        Swal.fire({
          title: "Concluido",
          text: "Cadastrado com Sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-receitas.php';
        }, 2000)
       
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function addCliente(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/clientes/insert',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        id_cliente = response.id
        Swal.fire({
          title: "Feito",
          text: "Solicitação realizada com sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'adicionar-veiculo.php?id_cliente=' + id_cliente;
        }, 2000)

      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    });
}
function addOs(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/os/insert',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        id_cliente = response.id
        Swal.fire({
          title: "Feito",
          text: "Solicitação realizada com sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'ordem-de-servico.php';
        }, 2000)
     
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function addServico(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/servicos/insert',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        id_cliente = response.id
        Swal.fire({
          title: "Feito",
          text: "Solicitação realizada com sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-servico.php?';
        }, 2000)
  
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function addVeiculo(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/veiculos/insert',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        Swal.fire({
          title: "Feito",
          text: "Solicitação realizada com sucesso!",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-veiculo.php';
        }, 2000)

      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function moeda(a, e, r, t) {
  let n = ""
    , h = j = 0
    , u = tamanho2 = 0
    , l = ajd2 = ""
    , o = window.Event ? t.which : t.keyCode;
  if (13 == o || 8 == o)
    return !0;
  if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
    return !1;
  for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
    ;
  for (l = ""; h < u; h++)
    -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
  if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
    for (ajd2 = "",
      j = 0,
      h = u - 3; h >= 0; h--)
      3 == j && (ajd2 += e,
        j = 0),
        ajd2 += l.charAt(h),
        j++;
    for (a.value = "",
      tamanho2 = ajd2.length,
      h = tamanho2 - 1; h >= 0; h--)
      a.value += ajd2.charAt(h);
    a.value += r + l.substr(u - 2, u)
  }
  return !1
}
function login(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/login',

    type: 'post',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      localStorage.setItem('id', response);
      console.log(response)
      Swal.fire({
        title: "Sucesso",
        text: "Login realicado com sucesso!",
        type: "success",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
      setTimeout(function () {
        window.location.href = 'principal.php';
      }, 2000)


    })
    .fail(function (jqXHR, textStatus, msg) {
      Swal.fire({
        title: "Erro",
        text: "Usuário não encontrado",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    });
}
function editarVeiculo(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/veiculos/update/' + id_veiculo,

    type: 'put',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        Swal.fire({
          title: "Sucesso",
          text: "Solicitação realizada com sucesso",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-veiculo.php';
        }, 2000)
 
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function editaros(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/os/update/' + os_id,

    type: 'put',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        Swal.fire({
          title: "Sucesso",
          text: "Solicitação realizada com sucesso",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'ordem-de-servico.php';
        }, 2000)
    
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function editarServico(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/servicos/update/' + id_servico,

    type: 'put',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        Swal.fire({
          title: "Sucesso",
          text: "Solicitação realizada com sucesso",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-servico.php';
        }, 2000)
 
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
function editarCliente(formid) {
  var dados = $("#" + formid).serialize()

  $.ajax({
    url: endpoint+'/clientes/update/' + id_cliente,

    type: 'put',
    dataType: 'json',
    data: $("#" + formid).serialize()
  })
    .done(function (response) {
      console.log(response)
      if (!response.erro) {
        Swal.fire({
          title: "Sucesso",
          text: "Solicitação realizada com sucesso",
          type: "success",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
        setTimeout(function () {
          window.location.href = 'listar-clientes.php';
        }, 2000)
     
      }
    })
    .fail(function (jqXHR, textStatus, msg) {
          Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir o cadastro!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    });
}
if (window.location.pathname == "/listar-clientes.php") {
  getAllclientByType('PF')
  getAllclientByType('PJ')
}
if (window.location.pathname == "/listar-veiculo.php") {
  getAllCar()
}
if (window.location.pathname == "/listar-receitas.php") {
  getAllFluxo()
}
if (window.location.pathname == "/ordem-de-servico.php" || window.location.pathname == "/add_fluxo_caixa.php" || window.location.pathname == "/editar_fluxo_caixa.php") {
  getAllOs()
}
if (window.location.pathname == "/listar-servico.php") {
  getAllServicos()
}
if (window.location.pathname == "/adicionar-veiculo.php" || window.location.pathname == "/add_fluxo_caixa.php" || window.location.pathname == "/editar_fluxo_caixa.php") {
  getAllclientByType('PF', true)
  getAllclientByType('PJ', true)
  var urlParams = new URLSearchParams(window.location.search);
  id_cliente = urlParams.get("id_cliente")

  if (id_cliente) {
    setTimeout(function () {
      $("#donoVeiculo").val(id_cliente).change()
    }, 1000)

  }
}
if (window.location.pathname == "/ordem-de-servico.php") {
  getAllclientByType('PF', true)
  getAllclientByType('PJ', true)
  getAllServicos(true)

}
if (window.location.pathname == "/editar-veiculo.php") {
  var urlParams = new URLSearchParams(window.location.search);
  id_veiculo = urlParams.get("id_veiculo")

  if (id_veiculo) {
    getDataVeiculo(id_veiculo)
  }
  else {
    Swal.fire({
      title: "Erro",
      text: "Erro ao encontrar o veiculo informado",
      type: "error",
      confirmButtonClass: "btn btn-danger",
      buttonsStyling: false
    });
    setTimeout(function () {
      window.location.href = 'listar-veiculo.php';
    }, 2000)

  }

}
if (window.location.pathname == "/editar-servico.php") {
  var urlParams = new URLSearchParams(window.location.search);
  id_servico = urlParams.get("id_servico")

  if (id_servico) {
    getDataServico(id_servico)
  }
  else {
    Swal.fire({
      title: "Erro",
      text: "Erro ao encontrar o serviço informado",
      type: "error",
      confirmButtonClass: "btn btn-danger",
      buttonsStyling: false
    });
    setTimeout(function () {
      window.location.href = 'listar-servico.php';
    }, 2000)
   
  }

}
if (window.location.pathname == "/editar_fluxo_caixa.php") {
  var urlParams = new URLSearchParams(window.location.search);
  id_fluxo = urlParams.get("id_fluxo")

  if (id_fluxo) {
    getItemFluxoCaixa(id_fluxo)
  }
  else {
    Swal.fire({
      title: "Erro",
      text: "Erro ao encontrar o item  informado",
      type: "error",
      confirmButtonClass: "btn btn-danger",
      buttonsStyling: false
    });
    setTimeout(function () {
      window.location.href = 'listar-receitas.php';
    }, 2000)
   
  }

}
if (window.location.pathname == "/editar-cliente.php") {
  var urlParams = new URLSearchParams(window.location.search);
  id_cliente = urlParams.get("id_cliente")

  if (id_cliente) {
    getDataClient(id_cliente)
  }
  else {
    Swal.fire({
      title: "Erro",
      text: "Erro ao encontrar o cliente informado",
      type: "error",
      confirmButtonClass: "btn btn-danger",
      buttonsStyling: false
    });

    setTimeout(function () {
      window.location.href = 'listar-clientes.php';
    }, 2000)
    
  }


}
function getItemFluxoCaixa(id) {

  $.ajax({
    url: endpoint+'/fluxo_caixa/show/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      $("#nome").val(response.nome)
      $("#data").val(response.data)
      $("#valor").val(response.valor)
      $("#desconto").val(response.desconto)
      setTimeout(function () {
        $("#tipo_id").val(response.tipo_id).change()
        $("#cliente_id").val(response.cliente_id).change()
        $("#os_id").val(response.os_id).change()
        $("#pagamento_id").val(response.os_id).change()
      }, 5000)

  
    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
    }
  });
}
function getDataServico(id) {

  $.ajax({
    url: endpoint+'/servicos/show/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      $("#nomeServico").val(response.nome)
      $("#tempo_estimado").val(response.tempo_estimado)
      $("#valorServico").val(response.valor)
      $("#observacoes").text(response.observacoes)
    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getDataVeiculo(id) {

  $.ajax({
    url: endpoint+'/veiculos/show/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      Object.keys(response).forEach(function (key, index) {
        $("#placaVeiculo").val(response[key].placa)
        $("#marca").val(response[key].marca)
        $("#modelo").val(response[key].modelo)
        $("#cor").val(response[key].cor)
        $("#observacoesVeiculo").text(response[key].observacoes)
        getAllclientByType('PF', true)
        getAllclientByType('PJ', true)
        setTimeout(function () {
          $("#donoVeiculo").val(response[key].id_cliente).change()
        }, 2000)
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getDataClient(id) {

  $.ajax({
    url: endpoint+'/clientes/show/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      Object.keys(response).forEach(function (key, index) {
        if (response[key].tipo_cliente == 'PF') {
          $("#btnClientPf").trigger('click');

          $("#nomeClientePf").val(response[key].nome_f)
          $("#cpfClientePf").val(response[key].cpf)
          $("#emailClientePf").val(response[key].email_f)
          $("#rgClientePf").val(response[key].rg)
          $("#telefoneClientePf").val(response[key].telefone_f)
          $("#whatsappCelularClientePf").val(response[key].celular_f)
          $("#cepClientePf").val(response[key].cep).trigger('blur')
          $("#observacoesClientePf").text(response[key].observacoes)
          $("#complementoClientePf").val(response[key].complemento)
          $("#enderecoNumeroClientePf").val(response[key].numero)

          if (response[key].sexo == 'M') {
            $("#CheckClientePfMasculino").attr('checked', true)
          }
          else if (response[key].sexo == 'F') {
            $("#CheckClientePfFeminino").attr('checked', true)
          }
          else {
            $(".sexo").attr('checked', false)
          }
        } else if (response[key].tipo_cliente == 'PJ') {
          $("#btnClientPj").trigger('click');
          $("#razaoSocialClientePj").val(response[key].razao_social)
          $("#cnpjClientePj").val(response[key].cnpj)
          $("#ieClientePj").val(response[key].ie)
          $("#emailClientePj").val(response[key].email_j)
          $("#telefoneClientePj").val(response[key].telefone_j)
          $("#whatsappCelularClientePj").val(response[key].celular_j)

          $("#responsavelClientePj").val(response[key].nome_rj)
          $("#emailResponsavelClientePj").val(response[key].email_rj)
          $("#telefoneResponsavelClientePj").val(response[key].telefone_rj)
          $("#whatsappResponsavelClientePj").val(response[key].celular_rj)
          $("#cepClientePj").val(response[key].cep).trigger('blur')
          $("#observacoesClientePj").text(response[key].observacoes)
          $("#complementoClientePj").val(response[key].complemento)
          $("#enderecoNumeroClientePj").val(response[key].numero)
        }
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getAllclientByType(type = 'PF', select = false) {
  options = ''
  $.ajax({
    url: endpoint+'/clientes/getAllclientByType/' + type + '/' + localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function (response) {
      options += '<option value="0">Selecione o Cliente</option>'
      Object.keys(response).forEach(function (key, index) {

        html += '<tr>'
        if (type == 'PF') {

          html += '<td class="big-item-table">' + response[key].nome_f + '</td>'
          html += '<td class="big-item-table">' + response[key].cpf + '</td>'
          html += '<td class="big-item-table">' + response[key].rg + '</td>'
          html += '<td class="big-item-table">' + response[key].email_f + '</td>'
          html += '<td class="big-item-table">' + response[key].telefone_f + '</td>'
          html += '<td class="big-item-table">' + response[key].celular_f + '</td>'
          options += '<option value="' + response[key].id + '">' + response[key].nome_f + '</option>'

        } else if (type == 'PJ') {

          html += '<td class="big-item-table">' + response[key].razao_social + '</td>'
          html += '<td class="big-item-table">' + response[key].cnpj + '</td>'
          html += '<td class="big-item-table">' + response[key].ie + '</td>'
          html += '<td class="big-item-table">' + response[key].email_j + '</td>'
          html += '<td class="big-item-table">' + response[key].telefone_j + '</td>'
          html += '<td class="big-item-table">' + response[key].celular_j + '</td>'
          html += '<td class="big-item-table">' + response[key].nome_rj + '</td>'
          html += '<td class="big-item-table">' + response[key].email_rj + '</td>'
          html += '<td class="big-item-table">' + response[key].telefone_rj + '</td>'
          html += '<td class="big-item-table">' + response[key].celular_rj + '</td>'
          if (response[key].razao_social) {
            options += '<option value="' + response[key].id + '">' + response[key].razao_social + '</option>'
          }
          else {
            options += '<option value="' + response[key].id + '">' + response[key].cnpj + '</option>'
          }


        }


        html += '<td class="big-item-table action-buttons"><a href="editar-cliente.php?id_cliente=' + response[key].id + '"><button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
        html += '</tr>'


      });

      if (!select) {
        $("#lista" + type).html(html)
        html = ''
      }
      else {
        $("#donoVeiculo").append(options)
        options = ''
      }


    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getAllOs() {
  html = ''
  options += '<option value="0">Selecione a ordem de serviço</option>'
  $.ajax({
    url: endpoint+'/os/getall/' + localStorage.getItem('id')+'/'+$("#inicio").val()+'/'+$("#fim").val(),
    type: 'get',
    dataType: 'json',
    success: function (response) {
      os = response
      Object.keys(response).forEach(function (key, index) {
        let inicio_os = response[key].inicio_os.split(" ")
        let inicio_data = inicio_os[0].split("-")
        let data_formadata_inicio = inicio_data[2] + '/' + inicio_data[1] + '/' + inicio_data[0]

        let previsao_os = response[key].previsao_os.split(" ")
        let previsao_data = inicio_os[0].split("-")
        let data_formadata_previsao = previsao_data[2] + '/' + previsao_data[1] + '/' + previsao_data[0]
        html += '<tr>'
        html += '<td class="big-item-table">#' + response[key].id + '</td>'
        html += '<td class="big-item-table">' + response[key].valor + '</td>'
        if (response[key].nome_f) {
          html += '<td class="big-item-table">' + response[key].nome_f + '</td>'

        }
        else {
          html += '<td class="big-item-table">' + response[key].razao_social + '</td>'
        }
        html += '<td class="big-item-table">' + response[key].nome + '</td>'
        html += '<td class="big-item-table">' + response[key].placa + ' - ' + response[key].modelo + '</td>'
        html += '<td class="big-item-table">' + data_formadata_inicio + ' ' + inicio_os[1] + '</td>'
        html += '<td class="big-item-table">' + data_formadata_previsao + ' ' + previsao_os[1] + '</td>'
        if (!response[key].situacao) {
          html += '<td > <div class="badge badge-warning">Aguardando Pagamento</div></td>'
        }
        else if (response[key].situacao == 1) {

          html += '<td > <div class="badge badge-success">Pago</div></td>'
        }
        else if (response[key].situacao == 2) {

          html += '<td > <div class="badge badge-success">Pago - serviço iniciado</div></td>'
        }
        else if (response[key].situacao == 3) {

          html += '<td > <div class="badge badge-success">Pago - Aguardando retirada do Cliente</div></td>'
        }
        else if (response[key].situacao == 4) {

          html += '<td > <div class="badge badge-success">Pago - Remarketing</div></td>'
        }
        else if (response[key].situacao == 5) {

          html += '<td > <div class="badge badge-warning">Remarketing</div></td>'
        }
        else if (response[key].situacao == 6) {

          html += '<td > <div class="badge badge-danger">Cancelado</div></td>'
        }

        html += '<td class="big-item-table action-buttons"><button onclick="getOs(' + key + ')"class="see-table-item" id="seeTableItem"><i class="fa fa-pencil"></i></button><a href="pdf_os.php?os_id=' + response[key].id + '"> <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'

        html += '</tr>'
        options += '<option value="' + response[key].id + '">' + response[key].nome + ' - R$ ' + response[key].valor + ' - ' + data_formadata_inicio + '</option>'

      });

      $("#tos").html(html)
      $("#responsive_single").html(options)
      options = ''


    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getAllFluxo() {
  let total_receita = 0;
  let totalDespesa = 0;
  let total_geral = 0;
  $.ajax({
    url: endpoint+'/fluxo_caixa/getall/' + localStorage.getItem('id')+'/'+$("#inicio").val()+'/'+$("#fim").val(),
    type: 'get',
    dataType: 'json',
    success: function (response) {

      Object.keys(response).forEach(function (key, index) {

        let inicio_data = response[key].data.split("-")
        let data_formadata_inicio = inicio_data[2] + '/' + inicio_data[1] + '/' + inicio_data[0]
        total_geral += response[key].valor
        html += '<tr>'
        html += '<td class="big-item-table">#' + response[key].id + '</td>'
        if (response[key].valor) {
          html += '<td class="big-item-table">' + response[key].valor.toLocaleString('pt-br', { minimumFractionDigits: 2 }) + '</td>'
          if (response[key].tipo_id){
            total_receita +=response[key].valor
          }
          else{
            totalDespesa +=response[key].valor
          }
        }
        else {
          html += '<td class="big-item-table">' + (0.00).toLocaleString('pt-br', { minimumFractionDigits: 2 }) + '</td>'
        }
        if (response[key].desconto) {
          html += '<td class="big-item-table">' + response[key].desconto.toLocaleString('pt-br', { minimumFractionDigits: 2 }) + '</td>'
        }
        else {
          html += '<td class="big-item-table">' + (0.00).toLocaleString('pt-br', { minimumFractionDigits: 2 }) + '</td>'
        }
        if (response[key].tipo_id) {
          html += '<td class="badge badge-success">Receita</td>'
        }
        else {
          html += '<td class="badge badge-danger">Despesa</td>'
        }

        html += '<td class="big-item-table">' + response[key].nome + '</td>'
        html += '<td class="big-item-table">' + data_formadata_inicio + '</td>'

        html += '<td class="big-item-table action-buttons"><a href="editar_fluxo_caixa.php?id_fluxo='+response[key].id+'"><button class="see-table-item" id="seeTableItem"><i class="fa fa-pencil"></i></button></a><a href="pdf_os.php?os_id=' + response[key].id + '"> <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'

        html += '</tr>'


      });
      $(".total_receita").text(total_receita.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}))
      $(".total_servicos").text(response.length);
      $(".total_Despesas").text(totalDespesa.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
      $("#treceitas").html(html)
      html= ''
    

    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getOs(chave) {
  $("#btnAddOs").trigger("click");
  
  $("#donoVeiculo").val(os[chave].id_cliente).change();
  setTimeout(function () {
    $("#id_veiculo").val(os[chave].id_veiculo).change();
  }, 1000)
  $("#situacao").val(os[chave].situacao).change();
  $("#remarketing").val(os[chave].remarketing)
  $("#observacoes").text(os[chave].observacoes);
  let inicio_os = os[chave].inicio_os.split(" ")
  let previsao_os = os[chave].previsao_os.split(" ")
  $("#inicio_os").val(inicio_os[0])
  $("#inicio_os_time").val(inicio_os[1])
  $("#previsao_os").val(previsao_os[0])
  previsao_os_time = previsao_os[1]
  $("#previsao_os_time").val(previsao_os[1])
  $("#btnAddServico").text("Editar");
  $("#btnAddServico").attr('onclick', "editaros('OrdemDeServicoForm')")
  os_id = os[chave].id
  let vetor = new Array();
  $.ajax({
    url: endpoint+'/os/getServicosOs/' + os_id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      Object.keys(response).forEach(function (key, index) {
        vetor[key] = response[key].id_servico;
       
      });
      console.log(vetor)
      $("#lservicos").val(vetor).change();
    }
  });
 
}
function limparForm() {
  $("input").val('');
  $("#donoVeiculo").val(0).change();
  $("textarea").text('');
  $("#lservicos").val(0).change();
  $("#btnAddServico").text("Adicionar");
  $("#btnAddServico").attr('onclick', "addOs('OrdemDeServicoForm')")

}
function getAllCar() {

  $.ajax({
    url: endpoint+'/veiculos/getall/' + localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function (response) {

      Object.keys(response).forEach(function (key, index) {
        html += '<tr>'
        html += '<td class="big-item-table">' + response[key].placa + '</td>'
        html += '<td class="big-item-table">' + response[key].marca + '</td>'
        html += '<td class="big-item-table">' + response[key].modelo + '</td>'
        html += '<td class="big-item-table">' + response[key].cor + '</td>'
        if (response[key].nome_f) {
          html += '<td class="big-item-table">' + response[key].nome_f + '</td>'
        }
        else {
          html += '<td class="big-item-table">' + response[key].razao_social + '</td>'
        }




        html += '<td class="big-item-table action-buttons"><a href="editar-veiculo.php?id_veiculo=' + response[key].id + '"><button href="editar-veiculo.php?id_veiculo=' + response[key].id + '"class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
        html += '</tr>'


      });

      $("#tveiculos").html(html)



    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getAllServicos(select = false) {
  var teste = ''
  $.ajax({
    url: endpoint+'/servicos/getall/' + localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function (response) {
      options += '<option value="0">Selecione o Serviço</option>'
      Object.keys(response).forEach(function (key, index) {
        html += '<tr>'
        html += '<td class="big-item-table">' + response[key].nome + '</td>'
        html += '<td class="big-item-table">' + response[key].valor.toLocaleString('pt-br', { minimumFractionDigits: 2 }) + '</td>'


        html += '<td class="big-item-table action-buttons"><a href="editar-servico.php?id_servico=' + response[key].id + '"> <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
        html += '</tr>'
        options += '<option value="' + response[key].id + '">' + response[key].nome + '</option>'

      });
      if (select) {
        $("#lservicos").html(options)
      }
      else {
        $("#lservicos").html(html)
      }
      options = ''



    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function getTerminoPrevisao() {
  var teste = ''
  let horario = '00:00:00'
  if ($("#inicio_os_time").val()) {
    horario = $("#inicio_os_time").val()
  }
  if ($("#lservicos").val() > 0) {
    $.ajax({
      url: endpoint+'/servicos/terminoPrevisao/' + horario + '/' + $("#lservicos").val(),
      type: 'get',
      dataType: 'json',
      success: function (response) {
        if (response != '00:00:00') {
          $("#previsao_os_time").val(response)
        }
        else {
          if (!previsao_os_time) {
            $("#previsao_os_time").val('')
          }

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {

        Swal.fire({
          title: "Erro",
          text: "Não foi possivel concluir a solicitação!",
          type: "error",
          confirmButtonClass: "btn btn-success",
          buttonsStyling: false
        });
      }
    });
  }
  else {
    $("#previsao_os_time").val('')
  }

}
function getAllCarByCliente(id) {
  var teste = ''
  $.ajax({
    url: endpoint+'/veiculos/cliente/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {
      options += '<option value="0">Selecione o Carro</option>'
      Object.keys(response).forEach(function (key, index) {
        options += '<option value="' + response[key].id + '">' + response[key].placa + ' - ' + response[key].marca + ' - ' + response[key].modelo + '</option>'


      });
      $("#id_veiculo").html(options)
      options = ''


    },
    error: function (xhr, ajaxOptions, thrownError) {

      Swal.fire({
        title: "Erro",
        text: "Não foi possivel concluir a solicitação!",
        type: "error",
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
    }
  });
}
function changeFormClientPf() {
  if (!btnActive) {
    formclientPf.classList.remove('d-none');
    formclientPj.classList.add('d-none');
    formclientPj.classList.remove('d-flex');
    btnClientPj.classList.add('btn-disable');
    btnClientPf.classList.remove('btn-disable');
    btnAddClientePf.classList.remove('d-none');
    btnAddClientePj.classList.add('d-none');
  }
};

const formclientPf = document.getElementById('clientePfForm');
const formclientPj = document.getElementById('clientePjForm');
const btnClientPf = document.getElementById('btnClientPf');
const btnClientPj = document.getElementById('btnClientPj');
const btnAddClientePf = document.getElementById('btnAddClientePf');
const btnAddClientePj = document.getElementById('btnAddClientePj');


// END

// Trocar data table do cliente Pessoa Física e Jurídica
function changeDataTableClientPj() {
  if (!btnActive) {
    cardContentClientPf.classList.add('d-none');
    cardContentClientPj.classList.remove('d-none');
    btnDataTablePf.classList.add('btn-disable')
    btnDataTablePj.classList.remove('btn-disable')
  }
};

function changeDataTableClientPf() {
  if (!btnActive) {
    cardContentClientPf.classList.remove('d-none');
    cardContentClientPj.classList.add('d-none');
    btnDataTablePf.classList.remove('btn-disable')
    btnDataTablePj.classList.add('btn-disable')
  }
};

const cardContentClientPf = document.getElementById('cardContentClientPf');
const cardContentClientPj = document.getElementById('cardContentClientPj');
const btnDataTablePf = document.getElementById('btnDataTablePf');
const btnDataTablePj = document.getElementById('btnDataTablePj');
// END

// interação modal de add Ordem de Serviço
const openModal = (modal) => {
  modal.classList.remove('d-none')
}

const closeModal = (modal) => {
  modal.classList.add('d-none')
}
if (localStorage.getItem('id')) {
  $(".user_id").val(localStorage.getItem('id'))
}
const btnAddOs = document.getElementById('btnAddOs');
const btnCloseModalOs = document.getElementById('btnCloseModalOs');
const modalOs = document.getElementById('modalOs');

btnAddOs.addEventListener('click', () => openModal(modalOs))
btnCloseModalOs.addEventListener('click', () => closeModal(modalOs))


