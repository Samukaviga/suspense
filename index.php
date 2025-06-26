<?php require_once('header.php'); ?>


<!-- STRAT NAVBAR -->
<nav id="navbar" class="navbar navbar-expand-lg fixed-top sticky">
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

        <!--end collapse-->
    </div>
    <!--end container-->
</nav>
<!-- END NAVBAR -->
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
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
</script>

<section class="bg-home4" id="home">
   
<div class="bg-overlay"></div>
  
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
            
                  <img
                        src="./assets/images/texto-suspense.png"
                        alt="Logo bolsas azul"
                        class="img-fluid logo-bolsa"
                        width="1000" height="800"
                        fetchpriority="high">
             
            </div>
             <!--
            <div class="col-md-1"></div>
           
            <div class="col-md-5 relative align-self-center mt-5">
                <form action="./" method="POST" class="bg-white  pb_form_v1" style="border-radius: 30px">
                    <input type="hidden" name="token" value="Ja1FdWeravHfxUq2GFkUhho5QfoKonaqrEagKLL7">
                    <h2 class="mb-4 mt-0 text-center">Inscreva<span class="carc">-</span>se<span class="carc">!</span></h2>
                    <div class="form-group">
                        <input type="text"
                            class="form-control pb_height-50 reverse "
                            name="name"
                            placeholder="Nome completo*" value="" required="" id="nome">
                    </div>
                    <div class="form-group">
                        <input inputmode="numetic" type="text" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{4,6}$" class="form-control pb_height-50 reverse mobile "
                            name="mobile"
                            placeholder="WhatsApp / Celular*" value="" required="" id="whatsapp">
                        <div class="error" id="errorwp">Whatsapp/Celular já existe em nossa base de dados</div>
                    </div>

                    <div class="form-group">
                        <label style="color:#333; font-weight:400;">Data de Nascimento</label>
                        <input type="text" class="form-control pb_height-50 reverse " name="nascimento"
                            placeholder="Data de Nascimento*" id="nascimento" required=""
                            value="">
                    </div>


                    <div class="form-group">
                        <div class="pb_select-wrap">
                       
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pb_select-wrap">
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pb_select-wrap">
                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="id_unidade">Cidade</label>
                        <div class="pb_select-wrap">
                            <select class="form-control pb_height-50 reverse " name="id_unidade" required="" id="id_unidade">
                                <option value="" hidden selected>Selecione uma Cidade*</option>
                                <option value="1">Itaquaquecetuba</option>
                                <option value="6">Arujá</option>
                                <option value="3">Suzano</option>
                                <option value="4">Poá</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="enviar" type="submit" class="btn btn-primary btn-lg btn-block pb_btn-pill  "
                            value="Confirmar inscrição">

                        <a id="corrija" class="btn btn-dark btn-lg btn-block pb_btn-pill" href="#">Corrija erro acima</a>
                    </div>
                </form>

            </div> 
            -->
        </div>
    </div>

</section>



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

<!-- Contact Js -->
<script src="assets/js/contact.js"></script>

<!-- Main Js -->
<script src="assets/js/app.js"></script>



<script src="js/jquery.mask.js"></script>
<script src="js/mask.js"></script>

</body>

</html>

<?php



?>