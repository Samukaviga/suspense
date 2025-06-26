<?php require_once('header.php'); ?>
<?php require_once('env.php'); ?>


<!-- STRAT NAVBAR -->
<nav style="background:#002bbb ;" id="navbar" class="navbar navbar-expand-lg fixed-top sticky">
  <a class="navbar-brand" href="./" style="padding: 0 50px">
    <img src="assets/images/logo-dark.png" alt="logo" height="60" class="logo-light" />
    <img src="assets/images/logo-dark.png" alt="logo" height="60" class="logo-dark" />
  </a>
  <div class="container">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="padding: 0 50px">
      <span class="mdi mdi-menu" style="color: #FFFFFF !important"></span>
    </button>
    <!--end button-->
    <div class="collapse navbar-collapse" id="navbarCollapse" style="padding: 0 50px">
      <ul id="navbar-navlist" class="navbar-nav ms-auto">

      </ul>
      <!--end navbar nav-->

    </div>
    <!--end collapse-->
  </div>
  <!--end container-->
</nav>
<!-- END NAVBAR -->

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
  jQuery(function($) {


    jQuery("#cep").mask("00000-000", {
      placeholder: "CEP"
    });
  });

  jQuery(function($) {

    jQuery("#numero").mask("000000", {
      placeholder: "_____"
    });
  });

  jQuery(function($) {
    $("#nascimento").mask('99/99/9999', {
      placeholder: "___ / ___ / ____"
    });
    $("#nascimento").blur(function(event) {
      if ($(this).val().length == 15) {
        $('#nascimento').mask('99/99/9999', {
          placeholder: "___ / ___ / ____"
        });
      } else {
        $('#nascimento').mask('99/99/9999', {
          placeholder: "___ / ___ / ____"
        });
      }
    });
  });

  jQuery(document).ready(function() {

    function limpa_formulário_cep() {
      // Limpa valores do formulário de cep.
      $("#rua").val("");
      $("#bairro").val("");
      $("#cidade").val("");
      $("#uf").val("");
      $("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    jQuery("#cep").blur(function() {

      //Nova variável "cep" somente com dígitos.
      var cep = jQuery(this).val().replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          jQuery("#rua").val("");
          jQuery("#bairro").val("");
          jQuery("#cidade").val("");
          jQuery("#uf").val("");



          //Consulta o webservice viacep.com.br/
          jQuery.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
              //Atualiza os campos com os valores da consulta.
              jQuery("#rua").val(dados.logradouro);
              jQuery("#bairro").val(dados.bairro);
              jQuery("#cidade").val(dados.localidade);
              jQuery("#uf").val(dados.uf);
              document.getElementById('cep').style.border = "1px solid #2e29bc";
              document.getElementById('cep').style.background = "#fff";
              document.getElementById('msg_cep').style.display = 'none';
              controle_cep = '1';
              var element = document.getElementById("cep");
              element.classList.remove("erro");
              element.classList.add("sucesso");



              if (dados.logradouro.length > 1) {
                var element = document.getElementById("rua");
                element.classList.remove("erro");
                document.getElementById('rua').style.color = "#333";
                document.getElementById('rua').style.background = "#eaeaea";
                document.getElementById('rua').style.border = "1px solid #333";
                document.getElementById('rua').readOnly = true;
              } else {
                document.getElementById('rua').style.background = "#fff";
                document.getElementById('rua').readOnly = false;
              }



              if (dados.bairro.length > 1) {
                var element = document.getElementById("bairro");
                element.classList.remove("erro");
                document.getElementById('bairro').style.color = "#333";
                document.getElementById('bairro').style.background = "#eaeaea";
                document.getElementById('bairro').style.border = "1px solid #333";
                document.getElementById('bairro').readOnly = true;
              } else {
                document.getElementById('bairro').style.background = "#fff";
                document.getElementById('bairro').readOnly = false;
              }

              // console.log(dados.localidade.length);

              var element = document.getElementById("cidade");
              element.classList.remove("erro");

              if (dados.localidade.length > 1) {
                document.getElementById('cidade').style.color = "#333";
                document.getElementById('cidade').style.background = "#eaeaea";
                document.getElementById('cidade').style.border = "1px solid #333";
                document.getElementById('cidade').readOnly = true;
              } else {
                document.getElementById('cidade').readOnly = true;
                document.getElementById('cidade').style.background = "#fff";
              }

              // console.log(dados.uf.length);
              if (dados.uf.length > 1) {
                var element = document.getElementById("uf");
                element.classList.remove("erro");
                document.getElementById('uf').style.background = "#eaeaea";
                document.getElementById('uf').style.color = "#333";
                document.getElementById('uf').style.border = "1px solid #333";
                document.getElementById('uf').readOnly = true;
              } else {
                document.getElementById('uf').readOnly = false;
                document.getElementById('uf').style.background = "#fff";
              }
              //Não deixa editar

            } //end if.
            else {
              //CEP pesquisado não foi encontrado.
              limpa_formulário_cep();


              document.getElementById('cep').style.border = "1px solid #a8002c";
              document.getElementById('cep').style.background = "#fff";
              document.getElementById('msg_cep').style.display = 'block';
              controle_cep = '0';
              var element = document.getElementById("cep");
              element.classList.remove("sucesso");
              element.classList.add("erro");

              document.getElementById('rua').readOnly = false;
              document.getElementById('bairro').readOnly = false;
              document.getElementById('cidade').readOnly = false;
              document.getElementById('uf').readOnly = false;


            }
          });
        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          document.getElementById('cep').style.border = "1px solid #a8002c";
          document.getElementById('cep').style.background = "fff";
          document.getElementById('msg_cep').style.display = 'block';
          controle_cep = '0';
          var element = document.getElementById("cep");
          element.classList.remove("sucesso");
          element.classList.add("erro");

          document.getElementById('rua').readOnly = false;
          document.getElementById('bairro').readOnly = false;
          document.getElementById('cidade').readOnly = false;
          document.getElementById('uf').readOnly = false;

        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
        document.getElementById('msg_cep').style.display = 'none';
        controle_cep = '0';
        var element = document.getElementById("cep");
        element.classList.remove("sucesso");
        element.classList.add("erro");

        document.getElementById('rua').readOnly = false;
        document.getElementById('bairro').readOnly = false;
        document.getElementById('cidade').readOnly = false;
        document.getElementById('uf').readOnly = false;

      }
    });
  });

  function checaSemNumero() {

    if (document.getElementById('sn').checked) {
      document.getElementById('numero').readOnly = true;
      document.getElementById('numero').value = "";
      document.getElementById('numero').style.background = '#f2eeea';
      var element = document.getElementById("numero");
      element.classList.remove("erro");

    } else {
      document.getElementById('numero').readOnly = false;
      document.getElementById('numero').style.background = '#fff';


    }
  }

  function checaNumero() {
    var numero = $("#numero").val();
    /// var numero = document.getElementById('numero').value;

    if (numero.length > 5) {
      //console.log(numero.length);
      var element = document.getElementById("numero");
      element.classList.remove("sucesso");
      element.classList.add("erro");
      document.getElementById('msg_n_correto').style.display = 'block';
    } else {
      document.getElementById('msg_n_correto').style.display = 'none';
      var element = document.getElementById("numero");
      element.classList.remove("erro");
      element.classList.add("sucesso");

    }

    teste_numero = /^[0-9]*$/.test(numero);


    if (teste_numero == false) {

      var element = document.getElementById("numero");
      element.classList.remove("sucesso");
      element.classList.add("erro");
      document.getElementById('msg_n_letra').style.display = 'block';

    } else {
      document.getElementById('msg_n_letra').style.display = 'none';
      var element = document.getElementById("numero");
      element.classList.remove("erro");
      element.classList.add("sucesso");
    }

  }


  function checaIdade() {
    var nascimento = $("#nascimento").val();

    const dataAtual = new Date();
    const anoAtual = dataAtual.getFullYear();
    const mesAtual = dataAtual.getMonth() + 1;
    const diaoAtual = dataAtual.getDay();

    data_nascimento = nascimento.split("/");
    ano_nascimento = data_nascimento[2];
    mes_nascimento = data_nascimento[1];
    dia_nascimento = data_nascimento[0];

    nova_nascimento = data_nascimento[2] + "-" + data_nascimento[1] + "-" + data_nascimento[0];

    nova_data = anoAtual + "-" + mesAtual + "-" + diaoAtual;

    //console.log(nova_data);
    //console.log(nova_nascimento);

    const d1 = nova_nascimento;
    const d2 = nova_data;
    const diffInMs = new Date(d2) - new Date(d1)
    const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

    if (diffInDays < 6574) {
      document.getElementById('msg_idade').style.display = 'block';
      controle_idade = '0';
      var element = document.getElementById("nascimento");
      element.classList.remove("sucesso");
      element.classList.add("erro");
      //console.log("menor deidade");
      //console.log(diffInDays);
    } else {
      controle_idade = '1';
      document.getElementById('msg_idade').style.display = 'none';
      var element = document.getElementById("nascimento");
      element.classList.remove("erro");
      element.classList.add("sucesso");
      //console.log("maior de idade");
    }

    //console.log(d1);
    //console.log(d2);

  }


  function save() {

    var id_site = $("#id_site").val()

    var cep = $("#cep").val();
    var rua = $("#rua").val();
    var numero = $("#numero").val();
    var compl = $("#compl").val();
    var bairro = $("#bairro").val();
    var cidade = $("#cidade").val();
    var uf = $("#uf").val();
    var genero = $("#genero").val();
    var menor_idade = $("#menor_idade").val();



    if (rua.length < 3) {
      document.getElementById('msg_rua').style.display = 'block';
      var controle_rua = '0';
      var element = document.getElementById("rua");
      element.classList.remove("sucesso");
      element.classList.add("erro");
    } else {
      document.getElementById('msg_rua').style.display = 'none';
      var controle_rua = '1';
      var element = document.getElementById("rua");
      element.classList.remove("erro");
      element.classList.add("sucesso");
    }

    if (bairro.length < 2) {
      document.getElementById('msg_bairro').style.display = 'block';
      var controle_bairro = '0';
      var element = document.getElementById("bairro");
      element.classList.remove("sucesso");
      element.classList.add("erro");
    } else {
      document.getElementById('msg_bairro').style.display = 'none';
      var controle_bairro = '1';
      var element = document.getElementById("bairro");
      element.classList.add("sucesso");
    }

    if (cidade.length < 3) {
      document.getElementById('msg_cidade').style.display = 'block';
      var controle_cidade = '0';
      var element = document.getElementById("cidade");
      element.classList.remove("sucesso");
      element.classList.add("erro");
    } else {
      document.getElementById('msg_cidade').style.display = 'none';
      var controle_cidade = '1';
      var element = document.getElementById("cidade");
      element.classList.add("sucesso");
    }


    if ((controle_cep == 1) && (controle_rua == 1) && (controle_bairro == 1) && (controle_cidade == 1)) {
      //Exibe o loading
      var element = document.getElementById("loader");
      element.classList.remove("oculta_loading");
      element.classList.add("exibe_loading");
      var vUrl = "endereco.php";

      var vData = {
        id_site: id_site,
        cep: cep,
        rua: rua,
        numero: numero,
        compl: compl,
        bairro: bairro,
        cidade: cidade,
        uf: uf,
        genero: genero
      };

      $.post(
        vUrl, //Required URL of the page on server
        vData,
        function(response, status) {
          //Oculta o Loading
          var element = document.getElementById("loader");
          element.classList.add("oculta_loading");

          if (status == "success") {
            // pegando os dados jSON
            var obj = jQuery.parseJSON(response);
            var id_site_resposta = obj.id_site;
            var debug = obj.debug;


            if (menor_idade == 1) {
              window.location = 'parabens.php?id_site=' + id_site;
              //window.location='sucesso.php?id_site='+id_site;
            } else {
              window.location = 'parabens.php?id_site=' + id_site;
            }


          }
        }
      );


    }



  }
</script>

<style>
  input[type="checkbox"] {
    visibility: visible !important;
    opacity: 10;
    /* display: inline-block; */
    /* vertical-align: middle; */
    width: 20px;
    height: 20px;
    display: block !important;
  }

  label {
    display: flex;
    align-items: center;
    justify-content: start;
    column-gap: 5px;
  }





  .input-icons i {
    position: absolute;
  }

  .input-icons {
    width: 100%;
    margin-bottom: 10px;
  }

  .icon {
    padding: 15px;
    color: #1e527f;
    min-width: 50px;
    text-align: center;
  }

  .input-field {
    width: 100%;
    padding: 10px;
    padding-left: 40px;
    text-align: left;
  }

  h2 {
    color: #1e527f;
  }

  .erro {
    border: 1px solid #a61f23 !important;
    color: #bc1212;
  }

  .sucesso {
    border: 1px solid #12669e !important;

  }


  .exibe_loading {
    display: block;

  }

  .oculta_loading {
    display: none;

  }

  .div_loader {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
  }





  .loader {
    border: 8px solid #f3f3f3;
    /* Light grey */
    border-top: 8px solid #003B71;
    /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;

  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }


  .btn-danger {
    --bs-btn-color: #fff;
    --bs-btn-bg: #333;
    --bs-btn-border-color: #333;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #333;
    --bs-btn-hover-border-color: #333;
    --bs-btn-focus-shadow-rgb: 225, 83, 97;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #333;
    --bs-btn-active-border-color: #a52834;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: #333;
    --bs-btn-disabled-border-color: #333;
  }
</style>


<br><br>

<section class="section">
  <div class="container">

    <div style="text-align:center" class="section-title">
      <h4 style="color:#002bbb">
        <?php
        require_once('env.php');
        $id_site = $_GET['id'];
        $select = "select *,TIMESTAMPDIFF(YEAR, nascimento, CURDATE()) as idade from tb_site where id='$id_site' ";
        $result = mysqli_query($CONNECTION_SITE, $select);
        $row = mysqli_fetch_assoc($result);

        $_SESSION['id_site'] = $row['id'];

        $n = explode(" ", strtolower($row['nome']));
        echo strtoupper($row['nome'] = ucfirst($n[0]));
        ?>
      </h4>


      <?php



      $post = json_encode(
        array(
          'name' => 'Adilson',
          'email' => 'adilson.gditecnologia@gmail.com',
          'phone' => '11952048970'
        )
      );


      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://webhook.sellflux.app/webhook/custom/lead/9899730af1aea9549d802c920de86c3c',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => $post,

      ));

      $response = curl_exec($curl);

      curl_close($curl);


      ?>
      <p style="font-size:20px;"><i>Para finalizar seu cadastro , informe seu <b>endereço</b></i></p>


    </div>
    <div class="row">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-8 ">

        <form method="post" role="form" class="php-email-form">
          <input type="hidden" name="id_site" id="id_site" value="<?php echo $row['id']; ?>">

          <div class="row">
            <div class="col-md-3 form-group">
              <label style="color:#333; font-weight:400; ">CEP</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" name="cep" id="cep" class="form-control" required>
            </div>
            <div class="col-md-9 form-group ">
              <label style="color:#333; font-weight:400;">Rua</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" class="form-control" name="rua" id="rua" placeholder="rua" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 form-group">
              <label style="color:#333; font-weight:400;">Numero</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" name="numero" id="numero" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
              <label style="color:#333; font-weight:400;">Complemento</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" class="form-control" name="compl" id="compl" required>
            </div>
            <div class="col-md-6 form-group">
              <label style="color:#333; font-weight:400;">Bairro</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" class="form-control" name="bairro" id="bairro" required>
              <input type="hidden" name="uf" id="uf">
            </div>
          </div>

          <div class="row">
            <div class="col-md-7 form-group">
              <label style="color:#333; font-weight:400;">Cidade</label>
              <input style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" type="text" name="cidade" id="cidade" class="form-control" required>
            </div>

            <div class="col-md-2 form-group">
              <label style="color:#333; font-weight:400;">Gênero</label>
              <select style="border:1px solid#cecece; height:50px; color:#333; font-weight:500;" id="genero" name="genero" class="form-select">
                <option selected value="">...</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>

            </div>

          </div>

          <div class="row">
            <div class="col-md-12 form-group" style="text-align:center ;">

              <button style="background-color: 910319;" onclick="save();" type="button" class="btn btn-primary btn-lg btn-block pb_btn-pill ">Salvar</button>
            </div>
          </div>


          <div class="row">

            <div class="col-md-12 form-group">
              <div class="div_loader">
                <div id="loader" class="oculta_loading">
                  <div class="loader "></div>
                  <i style="font-size:12px; text-align:center;">Estamos verificando seu email, aguarde...</i>
                </div>
              </div>

              <div id="msg_cep" name="msg_cep" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Digite o <b>CEP</b> corretamente.</i>
              </div>

              <div id="msg_rua" name="msg_rua" style="color:#a61f23;display: none; text-align:left;">
                <i><i class="fa fa-check"></i> Digite o nome da <b>RUA</b> corretamente.</i>
              </div>

              <div id="msg_numero" name="msg_numero" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Digite o <b> NÚMERO </b> da residência corretamente.</i>
              </div>

              <div id="msg_compl" name="msg_compl" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Importante: para residência sem número é obrigatorio informar o complemento.</i>
              </div>

              <div id="msg_bairro" name="msg_bairro" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Digite o <b> BAIRRO </b> corretamente.</i>
              </div>


              <div id="msg_cidade" name="msg_cidade" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Digite a <b> CIDADE </b> corretamente.</i>
              </div>

              <div id="msg_uf" name="msg_uf" style="color:#a61f23;display: none;  text-align:left;">
                <i><i class="fa fa-check"></i> Digite o Estado</i>
              </div>

              <div id="msg_nascimento" name="msg_nascimento" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> Digite a <b>DATA DE NASCIMENTO</b> corretamente. formato (dd/mm/aaaa)</i>
              </div>

              <div id="msg_idade" name="msg_idade" style="color:#a61f23;display: none;  text-align:left;">
                <i> <i class="fa fa-check"></i> O Sr(a) parece ser menor de idade!</i>
              </div>
            </div>

          </div>



      </div>





      </form>

    </div>
    <div class="col-lg-2">


    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>
  </div>
  </div>
</section><!-- End Contact Section -->




<?php require_once('footer.php'); ?>

<!--start back-to-top-->
<button onclick="topFunction()" id="back-to-top">
  <i class="mdi mdi-arrow-up-bold"></i>
</button>
<!--end back-to-top-->

<!-- javascript -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Swiper slider -->
<script src="assets/js/swiper-bundle.min.js"></script>


<!-- Main Js -->
<script src="assets/js/app.js"></script>

<script src="landing/assets/js/jquery.min.js"></script>

<script src="js/jquery.mask.js"></script>
<script src="js/mask.js"></script>




</body>

</html>

<?php

if ((!empty($_POST["name"])) && (!empty($_POST["email"])) && (!empty($_POST["mobile"]))) {


  $nome  = substr(str_replace("'", "", $_POST['name']), 0, 100);
  $email = substr(str_replace("'", "", $_POST['email']), 0, 100);
  $telefone = substr(preg_replace('#[^0-9]#', '', $_POST['mobile']), 0, 15);



  $select = "SELECT id FROM tb_site WHERE  telefone='$telefone' OR email='$email' ";
  $result = mysqli_query($CONNECTION_SITE, $select);
  $row = mysqli_fetch_assoc($result);
  $nums_rows = mysqli_num_rows($result);

  if ($nums_rows == 0) {
    $insert = "INSERT INTO tb_site (nome, telefone, email, id_unidade,id_tipo_escola) VALUES ('$nome', '$telefone', '$email', '$id_unidade','$id_tipo_escola')";
    mysqli_query($CONNECTION_SITE, $insert);
    $id_site = $CONNECTION_SITE->insert_id;
  } else {

    $insert = "INSERT INTO tb_site (nome, telefone, email, id_unidade,id_tipo_escola,duplicado) VALUES ('$nome', '$telefone', '$email', '$id_unidade','$id_tipo_escola',1)";
    mysqli_query($CONNECTION_SITE, $insert);
    $id_site = $CONNECTION_SITE->insert_id;
  }
?>





  <?php if (!empty($id_site)) { ?>
    <script>
      window.location = <?php echo $$URL_SITE; ?>.
      "geral/complete-seu-cadastro.php?id=<?php echo $id_site; ?>"
    </script>

  <?php } ?>


<?php


}

?>