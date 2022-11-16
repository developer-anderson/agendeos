// Ativar input de busca do header
var btnActive = false;
var token = ''
$(document).ready(function(){
  $('.celular').mask('(00) 0.0000-0000');
  $('.telefone').mask('(00) 0000-0000');
  $('.cnpj').mask('00.000.000/0000-00');
  $('.ie').mask('000.000.000.000');
  $('.cpf').mask('000.000.000-00');
  $('.cep').mask('00.000-000');
  $(".cnpj").blur(function() {
    
    var cnpj = $(this).val().replace(/[^0-9]/g, '');
    
   
    if(cnpj.length == 14) {
    
      
      $.ajax({
        url:'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
        method:'GET',
        dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
        complete: function(xhr){
        
          // Aqui recuperamos o json retornado
          response = xhr.responseJSON;
          
          // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
          if(response.status == 'OK') {
            console.log(response)
            // Agora preenchemos os campos com os valores retornados
            $('#razaoSocialClientePj').val(response.nome);
            $('#emailClientePj').val(response.email);
            $('.cep').val(response.cep).trigger('blur');
           
          
          // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
          } else {
            console.log(response.message);
            alert("Não foi possivel consultar os dados da empresa na receita"); // Neste caso estamos imprimindo a mensagem que a própria API retorna
          }
        }
      });
    
    // Tratativa para caso o CNPJ não tenha 14 caracteres
    } else {
      alert('CNPJ inválido');
    }
  });
  $(".cep").blur(function() {

    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {

          
            $(".logradouro").val("Buscando informações....");
            $(".bairro").val("...");
            $(".cidade").val("...");
            $(".estado").val("...");
            

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

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
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
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

const btnHeaderKeyboard = document.getElementById('btnHeaderKeyboard');
btnHeaderKeyboard.addEventListener('click', activeSearchs);
// END


// Trocar form do cliente Pessoa Física e Jurídica
function changeFormClientPj() {
  if(!btnActive) {
    formclientPf.classList.add('d-none');
    formclientPj.classList.add('d-flex');
    btnClientPj.classList.remove('btn-disable');
    btnClientPf.classList.add('btn-disable');
    btnAddClientePf.classList.add('d-none');
    btnAddClientePj.classList.remove('d-none');
  }
};
function addCliente(formid){
  var dados = $("#"+formid).serialize()

  $.ajax({
    url: 'http://127.0.0.1:8001/api/clientes/store',
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize(),
  
    success: function(response) {
        console.log(response)
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getToken(){

  $.ajax({
    url: 'http://127.0.0.1:8001/api/clientes/viewToken',
    type: 'get',
    dataType: 'json',
    success: function(response) {
       token = response
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function changeFormClientPf() {
  if(!btnActive) {
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
  if(!btnActive) {
    cardContentClientPf.classList.add('d-none');
    cardContentClientPj.classList.remove('d-none');
    btnDataTablePf.classList.add('btn-disable')
    btnDataTablePj.classList.remove('btn-disable')
  }
};

function changeDataTableClientPf() {
  if(!btnActive) {
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

const btnAddOs = document.getElementById('btnAddOs');
const btnCloseModalOs = document.getElementById('btnCloseModalOs');
const modalOs = document.getElementById('modalOs');

btnAddOs.addEventListener('click', () => openModal(modalOs))
btnCloseModalOs.addEventListener('click', () => closeModal(modalOs))


