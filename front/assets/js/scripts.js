// Ativar input de busca do header
var btnActive = false;
var html = ''
var options = ''
var id_cliente = 0
var id_veiculo = 0
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
    url: 'http://127.0.0.1:8001/clientes/insert',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      id_cliente = response.id
      alert("Cliente cadastrado com Sucesso.")
      window.location.href = 'adicionar-veiculo.php?id_cliente='+id_cliente;
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
function addVeiculo(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/insert',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      alert("Veiculo cadastrado com Sucesso.")
      window.location.href = 'listar-veiculo.php';
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
function login(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/login/authenticate',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    alert("Login realizado com sucesso")
    window.location.href = 'index.php';
  
  })
  .fail(function(jqXHR, textStatus, msg){
      alert('E-mail ou senha é inválido');
  });
}
function editarVeiculo(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/update/'+id_veiculo,
    
    type: 'put',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      alert("Veiculo Editado com Sucesso.")
      window.location.href = 'listar-veiculo.php';
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
function editarCliente(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/clientes/update/'+id_cliente,
    
    type: 'put',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      alert("Cliente Editado com Sucesso.")
      window.location.href = 'listar-clientes.php';
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
if(window.location.pathname  == "/html/listar-clientes.php"){
  getAllclientByType('PF')
  getAllclientByType('PJ')
}
if(window.location.pathname  == "/html/listar-veiculo.php"){
  getAllCar() 
}
if(window.location.pathname  == "/html/adicionar-veiculo.php"){
  getAllclientByType('PF', true)
  getAllclientByType('PJ', true)
  var urlParams = new URLSearchParams(window.location.search);
  id_cliente = urlParams.get("id_cliente")

 if(id_cliente){
  setTimeout(function() {
    $("#donoVeiculo").val(id_cliente).change()
}, 1000)
  
 }
}
if(window.location.pathname  == "/html/editar-veiculo.php"){
  var urlParams = new URLSearchParams(window.location.search);
  id_veiculo = urlParams.get("id_veiculo")
 
  if(id_veiculo){
    getDataVeiculo(id_veiculo)
  }
  else{
    alert("Erro ao encontrar o veiculo informado");
    window.location.href = 'listar-veiculo.php';
  }
 
}
if(window.location.pathname  == "/html/editar-cliente.php"){
  var urlParams = new URLSearchParams(window.location.search);
   id_cliente = urlParams.get("id_cliente")
 
  if(id_cliente){
    getDataClient(id_cliente)
  }
  else{
    alert("Erro ao encontrar o cliente informado");
    window.location.href = 'listar-clientes.php';
  }
 
  
}
function getDataVeiculo(id){

  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/show/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      Object.keys(response).forEach(function(key, index) {
         $("#placaVeiculo").val(response[key].placa)
         $("#marca").val(response[key].marca)
         $("#modelo").val(response[key].modelo)
         $("#cor").val(response[key].cor)
         $("#observacoesVeiculo").text(response[key].observacoes)
         getAllclientByType('PF', true)
         getAllclientByType('PJ', true)
        setTimeout(function() {
          $("#donoVeiculo").val(response[key].id_cliente).change()
        }, 2000)
      }); 
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getDataClient(id){

  $.ajax({
    url: 'http://127.0.0.1:8001/clientes/show/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      Object.keys(response).forEach(function(key, index) {
         if(response[key].tipo_cliente == 'PF'){
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
          
           if(response[key].sexo == 'M'){
            $("#CheckClientePfMasculino").attr('checked', true)
           }
           else if(response[key].sexo == 'F'){
            $("#CheckClientePfFeminino").attr('checked', true)
           }
           else{
            $(".sexo").attr('checked', false)
           }
         }else if(response[key].tipo_cliente == 'PJ'){
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
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getAllclientByType(type = 'PF', select = false){
 
  $.ajax({
    url: 'http://127.0.0.1:8001/clientes/getAllclientByType'+type,
    type: 'get',
    dataType: 'json',
    success: function(response) {
    
      Object.keys(response).forEach(function(key, index) {
      
        html += '<tr>'
        if(type == 'PF'){
         
          html += '<td class="big-item-table">'+response[key].nome_f+ '</td>'
          html += '<td class="big-item-table">'+response[key].cpf+ '</td>'
          html += '<td class="big-item-table">'+response[key].rg+ '</td>'
          html += '<td class="big-item-table">'+response[key].email_f+ '</td>'
          html += '<td class="big-item-table">'+response[key].telefone_f+ '</td>'
          html += '<td class="big-item-table">'+response[key].celular_f+ '</td>'
          options += '<option value="'+response[key].id +'">'+response[key].nome_f+'</option>'
       
        }else if(type == 'PJ'){
         
          html += '<td class="big-item-table">'+response[key].razao_social+ '</td>'
          html += '<td class="big-item-table">'+response[key].cnpj+ '</td>'
          html += '<td class="big-item-table">'+response[key].ie+ '</td>'
          html += '<td class="big-item-table">'+response[key].email_j+ '</td>'
          html += '<td class="big-item-table">'+response[key].telefone_j+ '</td>'
          html += '<td class="big-item-table">'+response[key].celular_j+ '</td>'
          html += '<td class="big-item-table">'+response[key].nome_rj+ '</td>'
          html += '<td class="big-item-table">'+response[key].email_rj+ '</td>'
          html += '<td class="big-item-table">'+response[key].telefone_rj+ '</td>'
          html += '<td class="big-item-table">'+response[key].celular_rj+ '</td>'
          if(response[key].razao_social){
            options += '<option value="'+response[key].id +'">'+response[key].razao_social+'</option>'
          }
          else{
            options += '<option value="'+response[key].id +'">'+response[key].cnpj+'</option>'
          }
         
          
        }
      

        html += '<td class="big-item-table action-buttons"><a href="editar-cliente.php?id_cliente='+response[key].id+ '"class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></a></td>'
        html += '</tr>'
        

      });

      if(!select){
        $("#lista"+type).html(html)
        html = ''
      }
      else{
        $("#donoVeiculo").append(options)
        options = ''
      }
     
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getAllCar(){
 
  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/getall',
    type: 'get',
    dataType: 'json',
    success: function(response) {
    
      Object.keys(response).forEach(function(key, index) {
      
        html += '<td class="big-item-table">'+response[key].placa+ '</td>'
        html += '<td class="big-item-table">'+response[key].marca+ '</td>'
        html += '<td class="big-item-table">'+response[key].modelo+ '</td>'
        html += '<td class="big-item-table">'+response[key].cor+ '</td>'
        if(response[key].nome_f)
        {
          html += '<td class="big-item-table">'+response[key].nome_f+ '</td>'
        }
        else{
          html += '<td class="big-item-table">'+response[key].razao_social+ '</td>'
        }
     
    
      

        html += '<td class="big-item-table action-buttons"><a href="editar-veiculo.php?id_veiculo='+response[key].id+ '"class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></a></td>'
        html += '</tr>'
        

      });

      $("#tveiculos").html(html)

     
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
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


