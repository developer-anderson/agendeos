// Ativar input de busca do header
var btnActive = false;
var html = ''
var options = ''
var id_cliente = 0
var id_veiculo = 0
var id_servico = 0;
var os_id = 0;
var os = {};
var previsao_os_time = ''
if(!localStorage.getItem('id')){
  window.location.href = 'login.html';
}
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
function addOs(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/os/insert',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      id_cliente = response.id
      alert("Serviço cadastrado com Sucesso.")
      window.location.href = 'ordem-de-servico.php';
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
function addServico(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/servicos/insert',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      id_cliente = response.id
      alert("Servico cadastrado com Sucesso.")
      window.location.href = 'listar-servico.php?';
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
function login(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/login',
    
    type: 'post',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    localStorage.setItem('id', response);
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
function editaros(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/os/update/'+os_id,
    
    type: 'put',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      alert("Ordem de Serviço Editado com Sucesso.")
      window.location.href = 'ordem-de-servico.php';
    }
  })
  .fail(function(jqXHR, textStatus, msg){
      alert(msg);
  });
}
function editarServico(formid){
  var dados = $("#"+formid).serialize()
 
  $.ajax({
    url: 'http://127.0.0.1:8001/servicos/update/'+id_servico,
    
    type: 'put',
    dataType: 'json',
    data: $("#"+formid).serialize()
  })
  .done(function(response){
    console.log(response)
    if(!response.erro){
      alert("Servico Editado com Sucesso.")
      window.location.href = 'listar-servico.php';
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
if(window.location.pathname  == "/html/ordem-de-servico.php"){
  getAllOs() 
}
if(window.location.pathname  == "/html/listar-servico.php"){
  getAllServicos()
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
if(window.location.pathname  == "/html/ordem-de-servico.php"){
  getAllclientByType('PF', true)
  getAllclientByType('PJ', true)
  getAllServicos(true)
 
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
if(window.location.pathname  == "/html/editar-servico.php"){
  var urlParams = new URLSearchParams(window.location.search);
  id_servico = urlParams.get("id_servico")
 
  if(id_servico){
    getDataServico(id_servico)
  }
  else{
    alert("Erro ao encontrar o serviço informado");
    window.location.href = 'listar-servico.php';
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
function getDataServico(id){

  $.ajax({
    url: 'http://127.0.0.1:8001/servicos/show/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      $("#nomeServico").val(response.nome)
      $("#tempo_estimado").val(response.tempo_estimado)
      $("#valorServico").val(response.valor)
      $("#observacoes").text(response.observacoes)
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
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
    url: 'http://127.0.0.1:8001/clientes/getAllclientByType/'+type+'/'+localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function(response) {
      options += '<option value="0">Selecione o Cliente</option>'
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
      

        html += '<td class="big-item-table action-buttons"><a href="editar-cliente.php?id_cliente='+response[key].id+ '"><button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
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
function getAllOs(){
 
  $.ajax({
    url: 'http://127.0.0.1:8001/os/getall/'+localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function(response) {
     os = response
      Object.keys(response).forEach(function(key, index) {
        let inicio_os = response[key].inicio_os.split(" ")
        let inicio_data = inicio_os[0].split("-")
        let data_formadata_inicio = inicio_data[2] + '/' + inicio_data[1] + '/' + inicio_data[0]

        let previsao_os = response[key].previsao_os.split(" ")
        let previsao_data = inicio_os[0].split("-")
        let data_formadata_previsao = previsao_data[2] + '/' + previsao_data[1] + '/' + previsao_data[0]
        html += '<tr>'
        html += '<td class="big-item-table">#'+response[key].id+ '</td>'
        html += '<td class="big-item-table">'+response[key].valor+ '</td>'
        if(response[key].nome_f){
          html += '<td class="big-item-table">'+response[key].nome_f+ '</td>'
        }
        else{
          html += '<td class="big-item-table">'+response[key].razao_social+ '</td>'
        }
        html += '<td class="big-item-table">'+response[key].nome+ '</td>'
        html += '<td class="big-item-table">'+response[key].placa+ ' - '+ response[key].modelo + '</td>'
        html += '<td class="big-item-table">'+data_formadata_inicio+ ' ' +inicio_os[1] + '</td>'
        html += '<td class="big-item-table">'+data_formadata_previsao+ ' ' +previsao_os[1] + '</td>'
        if(!response[key].situacao){
          html += '<td > <div class="badge badge-warning">Aguardando Pagamento</div></td>'
        }
        else if(response[key].situacao == 1){

          html += '<td > <div class="badge badge-success">Pago</div></td>'
        }
        else if(response[key].situacao == 2){

          html += '<td > <div class="badge badge-success">Pago - serviço iniciado</div></td>'
        }
        else if(response[key].situacao == 3){

          html += '<td > <div class="badge badge-success">Pago - Aguardando retirada do Cliente</div></td>'
        }
        else if(response[key].situacao == 4){

          html += '<td > <div class="badge badge-success">Pago - Remarketing</div></td>'
        }
        else if(response[key].situacao == 5){

          html += '<td > <div class="badge badge-warning">Remarketing</div></td>'
        }
        else if(response[key].situacao == 6){

          html += '<td > <div class="badge badge-danger">Cancelado</div></td>'
        }

        html += '<td class="big-item-table action-buttons"><button onclick="getOs('+key+')"class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></td>'
        html += '</tr>'
        

      });

      $("#tos").html(html)

     
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getOs(chave){
  $("#btnAddOs").trigger("click");
  $("#lservicos").val(os[chave].id_servico).change();
  $("#donoVeiculo").val(os[chave].id_cliente).change();
  setTimeout(function() {
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
}
function limparForm(){
  $("input").val('');
  $("#donoVeiculo").val(0).change();
  $("textarea").text('');
  $("#lservicos").val(0).change();
  $("#btnAddServico").text("Adicionar");
  $("#btnAddServico").attr('onclick', "addOs('OrdemDeServicoForm')")
  
}
function getAllCar(){
 
  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/getall/'+localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function(response) {
     
      Object.keys(response).forEach(function(key, index) {
        html += '<tr>'
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
     
    
      

        html += '<td class="big-item-table action-buttons"><a href="editar-veiculo.php?id_veiculo='+response[key].id+ '"><button href="editar-veiculo.php?id_veiculo='+response[key].id+ '"class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
        html += '</tr>'
        

      });

      $("#tveiculos").html(html)

     
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getAllServicos(select = false){
  var teste = ''
  $.ajax({
    url: 'http://127.0.0.1:8001/servicos/getall/'+localStorage.getItem('id'),
    type: 'get',
    dataType: 'json',
    success: function(response) {
      options += '<option value="0">Selecione o Serviço</option>'
      Object.keys(response).forEach(function(key, index) {
        html += '<tr>'
        html += '<td class="big-item-table">'+response[key].nome+ '</td>'
        html += '<td class="big-item-table">'+response[key].valor.toLocaleString('pt-br', {minimumFractionDigits: 2})+ '</td>'
     
    
        html += '<td class="big-item-table action-buttons"><a href="editar-servico.php?id_servico='+response[key].id+ '"> <button class="see-table-item" id="seeTableItem"><i class="fa fa-eye"></i></button></a></td>'
        html += '</tr>'
        options += '<option value="'+response[key].id +'">'+response[key].nome+'</option>'

      });
      if(select){
        $("#lservicos").html(options)
      }
      else{
        $("#lservicos").html(html)
      }
      options = ''

     
        
    },
    error: function(xhr, ajaxOptions, thrownError) {
      
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
function getTerminoPrevisao(){
  var teste = ''
  let horario  = '00:00:00'
  if($("#inicio_os_time").val()){
     horario = $("#inicio_os_time").val()
  }
  if($("#lservicos").val() > 0){
    $.ajax({
      url: 'http://127.0.0.1:8001/servicos/terminoPrevisao/'+horario+'/'+$("#lservicos").val(),
      type: 'get',
      dataType: 'json',
      success: function(response) {
        if(response != '00:00:00'){
          $("#previsao_os_time").val(response) 
        }
        else{
          if(!previsao_os_time){
             $("#previsao_os_time").val('')
          }
         
        }
               
      },
      error: function(xhr, ajaxOptions, thrownError) {
        
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
  else{
    $("#previsao_os_time").val('')
  }

}
function getAllCarByCliente(id){
  var teste = ''
  $.ajax({
    url: 'http://127.0.0.1:8001/veiculos/cliente/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response) {
      options += '<option value="0">Selecione o Carro</option>'
      Object.keys(response).forEach(function(key, index) {
        options += '<option value="'+response[key].id +'">'+response[key].placa+' - '+response[key].marca+' - '+response[key].modelo+'</option>'
        

      });
      $("#id_veiculo").html(options)
      options = ''
     
        
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
if(localStorage.getItem('id')){
  $(".user_id").val(localStorage.getItem('id'))
}
const btnAddOs = document.getElementById('btnAddOs');
const btnCloseModalOs = document.getElementById('btnCloseModalOs');
const modalOs = document.getElementById('modalOs');

btnAddOs.addEventListener('click', () => openModal(modalOs))
btnCloseModalOs.addEventListener('click', () => closeModal(modalOs))


