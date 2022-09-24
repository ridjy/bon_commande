<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('form'); ?>" />
        <title><?php echo $titre ?></title>
        
    </head>
    <body>   

    <div id="page">
        <img src="<?php echo img_url('havas.jpg') ?>" alt="logo"> 
        <div class="entete">
        <h3>BORDEREAU DE COMMANDE</h1>
             <!--<a href="<?php echo site_url('bordereau/login') ?>"><button class="admin">Voir les commandes effectués</button></a>-->
             <a href="<?php echo site_url('bordereau/liste_bc') ?>"><button class="admin">Revenir sur les listes</button></a>
        </div>

        <div class="form">
            <form id="general" name="form" method="POST" action="<?php echo site_url('pdf/havas')?>">
                
                <div class="fournisseur">
                &nbsp;&nbsp;&nbsp;<label>Fournisseur : </label>    
                <select id="frs" name="fournisseur" >
                    <?php foreach($fournisseur as $item):?>
                    <option value="<?php echo $item->nom_fournisseur; ?>"><?php echo $item->nom_fournisseur; ?></option>
                    <?php endforeach; ?> 
                </select>     
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>REF IRIS &nbsp;</label> <input id="point" type="text" class="ref" name="ref" readonly>
                </div>

                 <fieldset>
                    <legend>Informations</legend>
                    Ce bordereau est pris en charge par  <br/><br/>
                    <label>Agence : </label> <input id="point" type="text" name="agen" value="<?php echo $agence;?>" readonly="true"> 
                    &nbsp;
                    <label>Service &nbsp;</label> <input id="point" type="text" name="serv" value="<?php echo $service;?>" readonly="true">
                </fieldset>

                <div class="devise">
                    <label>Devise utilisée  </label> <select name="devise"><option value="Ar">Ariary</option>
                                                                            <option value="Eur">Euros</option> 
                                                                            <option value="$">Dollars</option>                                                    
                                                </select>                                
                </div>

                <table class="commande" width="720px">
                    <tr> <td>Quantité</td> <td>Designation</td> <td>PU HT</td> <td>Total HT</td></tr>
                    <tr> <td width="80px"><input type="number" id="n1" name="q1" style="width:75px;" required=""></td> <td><input type="text" name="nom1" style="width:300px;" maxlength="47" onKeyUp="suivant(this,'nom2', 47)" required=""></td> <td><input type="text" name="pu1" id="pu1" placeholder="exemple : 28 166.67"></td> <td><input name="total1" onfocus="javascript:document.form.total1.value=document.getElementById('pu1').value*document.getElementById('n1').value;" required="" size="17"/></td><td><input type="checkbox" class="check" name="c1" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n2" name="q2" style="width:75px;"></td> <td><input type="text" name="nom2" maxlength="47" onKeyUp="suivant(this,'nom3', 47)" style="width:300px;"></td> <td><input type="text" name="pu2" id="pu2"></td> <td><input name="total2" onfocus="javascript:document.form.total2.value=document.getElementById('pu2').value*document.getElementById('n2').value;" size="17"></td><td><input type="checkbox" class="check" name="c2" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n3" name="q3" style="width:75px;"></td> <td><input type="text" name="nom3" maxlength="47" onKeyUp="suivant(this,'nom4', 47)" style="width:300px;"></td> <td><input type="text" name="pu3" id="pu3"></td> <td><input name="total3" onfocus="javascript:document.form.total3.value=document.getElementById('pu3').value*document.getElementById('n3').value;" size="17"></td><td><input type="checkbox" class="check" name="c3" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n4" name="q4" style="width:75px;"></td> <td><input type="text" name="nom4" maxlength="47" onKeyUp="suivant(this,'nom5', 47)" style="width:300px;"></td> <td><input type="text" name="pu4" id="pu4"></td> <td><input name="total4" onfocus="javascript:document.form.total4.value=document.getElementById('pu4').value*document.getElementById('n4').value;" size="17"></td><td><input type="checkbox" class="check" name="c4" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n5" name="q5" style="width:75px;"></td> <td><input type="text" name="nom5" maxlength="47" onKeyUp="suivant(this,'nom6', 47)" style="width:300px;"></td> <td><input type="text" name="pu5" id="pu5"></td> <td><input name="total5" onfocus="javascript:document.form.total5.value=document.getElementById('pu5').value*document.getElementById('n5').value;" size="17"></td><td><input type="checkbox" class="check" name="c5" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n6" name="q6" style="width:75px;"></td> <td><input type="text" name="nom6" maxlength="47" onKeyUp="suivant(this,'nom7', 47)" style="width:300px;"></td> <td><input type="text" name="pu6" id="pu6"></td> <td><input name="total6" onfocus="javascript:document.form.total6.value=document.getElementById('pu6').value*document.getElementById('n6').value;" size="17"></td><td><input type="checkbox" class="check" name="c6" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n7" name="q7" style="width:75px;"></td> <td><input type="text" name="nom7" maxlength="47" onKeyUp="suivant(this,'nom8', 47)" style="width:300px;"></td> <td><input type="text" name="pu7" id="pu7"></td> <td><input name="total7" onfocus="javascript:document.form.total7.value=document.getElementById('pu7').value*document.getElementById('n7').value;" size="17"></td><td><input type="checkbox" class="check" name="c7" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n8" name="q8" style="width:75px;"></td> <td><input type="text" name="nom8" maxlength="47" onKeyUp="suivant(this,'nom9', 47)" style="width:300px;"></td> <td><input type="text" name="pu8" id="pu8"></td> <td><input name="total8" onfocus="javascript:document.form.total8.value=document.getElementById('pu8').value*document.getElementById('n8').value;" size="17"></td><td><input type="checkbox" class="check" name="c8" value="0.2"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n9" name="q9" style="width:75px;"></td> <td><input type="text" name="nom9" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu9" id="pu9"></td> <td><input name="total9" onfocus="javascript:document.form.total9.value=document.getElementById('pu9').value*document.getElementById('n9').value;" size="17"></td><td><input type="checkbox" class="check" name="c9"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n10" name="q10" style="width:75px;"></td> <td><input type="text" name="nom10" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu10" id="pu10"></td> <td><input name="total10" onfocus="javascript:document.form.total10.value=document.getElementById('pu10').value*document.getElementById('n10').value;" size="17"></td><td><input type="checkbox" class="check" name="c10"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n11" name="q11" style="width:75px;"></td> <td><input type="text" name="nom11" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu11" id="pu11"></td> <td><input name="total11" onfocus="javascript:document.form.total11.value=document.getElementById('pu11').value*document.getElementById('n11').value;" size="17"></td><td><input type="checkbox" class="check" name="c11"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n12" name="q12" style="width:75px;"></td> <td><input type="text" name="nom12" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu12" id="pu12"></td> <td><input name="total12" onfocus="javascript:document.form.total12.value=document.getElementById('pu12').value*document.getElementById('n12').value;" size="17"></td><td><input type="checkbox" class="check" name="c12"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n13" name="q13" style="width:75px;"></td> <td><input type="text" name="nom13" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu13" id="pu13"></td> <td><input name="total13" onfocus="javascript:document.form.total13.value=document.getElementById('pu13').value*document.getElementById('n13').value;" size="17"></td><td><input type="checkbox" class="check" name="c13"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n14" name="q14" style="width:75px;"></td> <td><input type="text" name="nom14" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu14" id="pu14"></td> <td><input name="total14" onfocus="javascript:document.form.total14.value=document.getElementById('pu14').value*document.getElementById('n14').value;" size="17"></td><td><input type="checkbox" class="check" name="c14"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n15" name="q15" style="width:75px;"></td> <td><input type="text" name="nom15" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu15" id="pu15"></td> <td><input name="total15" onfocus="javascript:document.form.total15.value=document.getElementById('pu15').value*document.getElementById('n15').value;" size="17"></td><td><input type="checkbox" class="check" name="c15"></td> </tr>
                    <tr> <td width="80px"><input type="number" id="n16" name="q16" style="width:75px;"></td> <td><input type="text" name="nom16" maxlength="47" style="width:300px;"></td> <td><input type="text" name="pu16" id="pu16"></td> <td><input name="total16" onfocus="javascript:document.form.total16.value=document.getElementById('pu16').value*document.getElementById('n16').value;" size="17"></td><td><input type="checkbox" class="check" name="c16"></td> </tr>
                    
                </table>


                <div class="remise">
                    <p>Avez vous une remise ?<p> <a href="#" id="oui">OUI</a> <a href="#" id="non">NON</a>
                </div>
                <div id="pourcent">
                    <label>Remise &nbsp;</label><input type="number" style="width:50px;" name="remise"><label>%</label>
                </div>

                <div class="tva">
                    <label>Sans TVA</label> <input type="checkbox" name="tva" value="ok">
                    <div class="special">
                    <a href="#" id="special">TVA special</a>
                    </div>
                </div>    

                <div class="livraison">
                <label>Lieu de livraison</label> <select id="selection" name="lieu">
                                                    <option value="1">Tanjombato</option> 
                                                    <option value="2">Ivato</option>
                                                    <option value="3">Antanimena</option>
                                                    <option value="4">Toamasina Log</option>
                                                    <option value="5">Tamatave</option>
                                                    <option value="6">Antsirabe</option>
                                                    <option value="7">Mahajanga</option>
                                                    <option value="8">Tolagnaro</option>
                                                    <option value="9">Toliary</option>
                                                    <option value="10">Antsiranana</option>
                                                    <option value="11">Nosy Be</option>  
                                                    <option value="12">Vohémar</option>
                                                </select>
                </div>

                <table style="margin-left:50px">
                    <tr><td>IMPUTATION</td><td><input name="imputation" type="text" id="point" value=""></td></tr>
                </table>    

                <!--
                     <tr> <td colspan="2" align="center">CHARGE <input id="affiche" type="radio" style="width:15px; height:15px;" name="radio1" value="A"></td>
                      <td colspan="2" align="center">STOCK <input id="rad" type="radio" style="width:15px; height:15px;" name="radio1" value="B"></td> 
                       <td colspan="2" align="center"> DAC <input id="dac" type="text" name="dac" value="<?php //$a=getdate(); echo $a['year']; ?>"> </td> </tr>

                </table>-->


                <div class="bouton">
                 <input id="but" type="submit" name="valid" value="Valider">
                 <input id="but" type="submit" name="preview" value="Prévisualiser">
                 <input id="reset" type="reset" value="Reset"> <!--onclick="javascript:location.reload();"-->
                </div>
            </form> 

       </div>
       <hr>
       <!--<div class="annuler">
        <a href="<?php echo site_url("bordereau/annulation/?s=$service&a=$agence")?>">Annuler certaines commandes</a>
        </div>-->
        <br/>

    <script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // On cache le div a afficher :
            $(".check").hide();
            //checkbox a droite    
            $("#charge").hide(); 
            $("#pourcent").hide();             
             });
    
        </script>

        <script type="text/javascript"> 
            $("input[name='radio1']").click( function () {
                if($('#affiche').is(':checked'))
                {
                    $( "#charge" ).slideDown( "slow" ); 
                }
                else
                {
                    $("#charge").slideUp("slow");  
                }
            });      
        </script>

        <script>
        $("#reset").click(function() {
        $("#charge").hide();              
             });        
        </script>
       
        <script type="text/javascript">
            $("#oui").click( function () {
                $(".remise").slideUp("slow");
                $( "#pourcent" ).slideDown( "slow" );
               }); 
            $("#non").click( function () { $(".remise").slideUp("slow"); $("#pourcent").slideUp("slow");  })
        </script>

        <script type="text/javascript">
            $("#special").click( function () {
                $(".check").slideDown("slow");
                $(".tva").hide();
                alert('Maintenant , cochez les commandes AVEC TVA');
               }); 
        </script>

        <script type="text/javascript">
        function suivant(enCours, suivant, limite)
        {
        if (enCours.value.length == limite)
            document.form[suivant].focus();
        }
        </script>

        <script>
        $("#frs").change(function() {
            //alert(this.value);
            $.ajax({
                type: 'GET',
                url: "<?php echo site_url('gestion/get_refiris');?>"+'?f='+this.value,
                timeout: 3000,
                success: function(data) {
                $(".ref").val(data) },
                error: function() {
                alert('Une erreur s\'est produite. La requête n\'a pas abouti'); }
            });
                
        });
        </script>
        <script type="text/javascript">
        function reload(pu){
           pu = pu.replace(/ /g, "");
           var p = parseFloat(pu);
           return p ;
        }
        </script>

</body> 

</html>
<!--&#10004;-->