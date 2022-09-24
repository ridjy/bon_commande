<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('form'); ?>" />
        <title><?php echo $titre ?></title>
        
    </head>
    <body>

    <div id="page">
        <img src="<?php echo img_url('logo.jpg') ?>" alt="logo"> 
        <div class="entete">
        <h3>BORDEREAU DE COMMANDE</h1>
             <a href="<?php echo site_url('bordereau/liste_bc') ?>"><button class="admin">Revenir sur les listes</button></a>
        </div>

        <div class="form">
            <form id="general" name="form" method="POST" action="<?php echo site_url('pdf/bordereau')?>" target="_blank">
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
                    <label>Devise utilisée  </label> <select id="devise" name="devise"><option value="Ar">Ariary</option>
                                                                            <option value="Eur">Euros</option>
                                                                            <option value="$">Dollars</option>                                                     
                                                </select>                                
                </div>
                        

                <table class="commande" width="720px">
                    <tr> <td>#</td> <td>Quantité</td> <td>Designation</td> <td >Rubrique</td> <td>PU HT</td> <td>Total HT</td></tr>
                    <tr> <td>1</td><td width="80px"><input type="number" id="n1" name="q1" style="width:75px;" required=""></td> <td><input type="text" name="nom1" style="width:300px;" maxlength="47" onKeyUp="suivant(this,'nom2', 47)" required=""></td> 
                        <td><select name='rub1' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu1" id="pu1" style="width:108px;" placeholder=""></td> <td><input name="total1" style="width:108px;" onfocus="javascript:document.form.total1.value=document.getElementById('pu1').value*document.getElementById('n1').value;" onblur="javascript:if(document.form.total1.value<1000) alert('montant minimum 1000 Ariary')" placeholder="min 1 000.00" required="" size="17"/></td>
                        <td><input type="checkbox" class="check" name="c1" value="0.2"></td> </tr>

                    <tr> <td>2</td><td width="80px"><input type="number" id="n2" name="q2" style="width:75px;"></td> <td><input type="text" name="nom2" maxlength="47" onKeyUp="suivant(this,'nom3', 47)" style="width:300px;"></td> 
                        <td><select name='rub2' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu2" id="pu2" style="width:108px;"></td> 
                        <td><input name="total2" onfocus="javascript:document.form.total2.value=document.getElementById('pu2').value*document.getElementById('n2').value;" onblur="javascript:if(document.form.total2.value<1000) alert('montant minimum 1000 Ariary')" style="width:108px;" size="17"></td>
                        <td><input type="checkbox" class="check" name="c2" value="0.2"></td> </tr>

                    <tr> <td>3</td><td width="80px"><input type="number" id="n3" name="q3" style="width:75px;"></td> <td><input type="text" name="nom3" maxlength="47" onKeyUp="suivant(this,'nom4', 47)" style="width:300px;"></td> 
                        <td><select name='rub3' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu3" id="pu3" style="width:108px;"></td> <td><input name="total3" style="width:108px;" onfocus="javascript:document.form.total3.value=document.getElementById('pu3').value*document.getElementById('n3').value;" onblur="javascript:if(document.form.total3.value<1000) alert('montant minimum 1000 Ariary')" size="17"></td><td><input type="checkbox" class="check" name="c3" value="0.2"></td> </tr>

                    <tr> <td>4</td><td width="80px"><input type="number" id="n4" name="q4" style="width:75px;"></td> <td><input type="text" name="nom4" maxlength="47" onKeyUp="suivant(this,'nom5', 47)" style="width:300px;"></td> 
                        <td><select name='rub4' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu4" id="pu4" style="width:108px;"></td> <td><input name="total4" onfocus="javascript:document.form.total4.value=document.getElementById('pu4').value*document.getElementById('n4').value;" onblur="javascript:if(document.form.total4.value<1000) alert('montant minimum 1000 Ariary')" style="width:108px;" size="17"></td><td><input type="checkbox" class="check" name="c4" value="0.2"></td> </tr>

                    <tr> <td>5</td><td width="80px"><input type="number" id="n5" name="q5" style="width:75px;"></td> <td><input type="text" name="nom5" maxlength="47" onKeyUp="suivant(this,'nom6', 47)" style="width:300px;"></td> 
                        <td><select name='rub5' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu5" id="pu5" style="width:108px;"></td> <td><input name="total5" onfocus="javascript:document.form.total5.value=document.getElementById('pu5').value*document.getElementById('n5').value;" style="width:108px;" onblur="javascript:if(document.form.total5.value<1000) alert('montant minimum 1000 Ariary')" size="17"></td><td><input type="checkbox" class="check" name="c5" value="0.2"></td> </tr>

                    <tr> <td>6</td><td width="80px"><input type="number" id="n6" name="q6" style="width:75px;"></td> <td><input type="text" name="nom6" maxlength="47" onKeyUp="suivant(this,'nom7', 47)" style="width:300px;"></td> 
                        <td><select name='rub6' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu6" style="width:108px;" id="pu6"></td> <td><input name="total6" onfocus="javascript:document.form.total6.value=document.getElementById('pu6').value*document.getElementById('n6').value;" style="width:108px;" size="17"></td><td><input type="checkbox" class="check" name="c6" value="0.2"></td> </tr>

                    <tr> <td>7</td><td width="80px"><input type="number" id="n7" name="q7" style="width:75px;"></td> <td><input type="text" name="nom7" maxlength="47" onKeyUp="suivant(this,'nom8', 47)" style="width:300px;"></td> 
                        <td><select name='rub7' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu7" id="pu7" style="width:108px;"></td> <td><input name="total7" onfocus="javascript:document.form.total7.value=document.getElementById('pu7').value*document.getElementById('n7').value;" style="width:108px;"></td><td><input type="checkbox" class="check" name="c7" value="0.2"></td> </tr>

                    <tr> <td>8</td><td width="80px"><input type="number" id="n8" name="q8" style="width:75px;"></td> <td><input type="text" name="nom8" maxlength="47" onKeyUp="suivant(this,'nom9', 47)" style="width:300px;"></td> 
                        <td><select name='rub8' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu8" id="pu8" style="width:108px;"></td> <td><input name="total8" onfocus="javascript:document.form.total8.value=document.getElementById('pu8').value*document.getElementById('n8').value;" style="width:108px;" size="17"></td><td><input type="checkbox" class="check" name="c8" value="0.2"></td> </tr>

                    <tr> <td>9</td><td width="80px"><input type="number" id="n9" name="q9" style="width:75px;"></td> <td><input type="text" name="nom9" maxlength="47" style="width:300px;"></td> 
                        <td><select name='rub9' style="width:163px;">
                            <?php echo $select; ?>       
                            </select>
                        </td>
                        <td><input type="text" name="pu9" id="pu9" style="width:108px;"></td> <td><input name="total9" onfocus="javascript:document.form.total9.value=document.getElementById('pu9').value*document.getElementById('n9').value;" style="width:108px;" size="17"></td><td><input type="checkbox" class="check" name="c9"></td> </tr>
                    
                </table>

                <!-- debut remise -->
                <div class="remise">
                    <p>Avez vous une remise ?<p> <a href="#" id="oui">OUI</a> <a href="#" id="non">NON</a> 
                    <!-- <a href='#'>Remise speciale</a> -->
                </div>
                <div id="pourcent">
                    <label>Remise &nbsp;</label><input type="number" style="width:50px;" name="remise"><label>%</label>
                </div>
                    
                    
                <!-- fin remise -->


                <div class="tva">
                    <label>Sans TVA</label> <input type="checkbox" name="tva" id="tva" value="ok">
                    <div class="special">
                    <a href="#" id="special">TVA special</a>
                    </div>
                </div>    

                <div class="livraison">
                <label><b>Lieu de livraison :</b></label> <br/><!--<select id="selection" name="lieu">
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
                                                </select>-->
            <table>
                <tr> <td>Tanjombato</td><td class="l1"> <input name="Tanjombato" type="checkbox" value="1"></td>
                    <td>Ivato</td><td class="l1"> <input name="Ivato" type="checkbox" value="1"></td>
                    <td>Antanimena</td><td class="l1"> <input name="Antanimena" type="checkbox" value="1"></td>
                    <td>Toamasina Log </td><td><input name="Toamasina" type="checkbox" value="1"></td>
                </tr>
                <tr> <td>Tamatave</td><td > <input name="Tamatave" type="checkbox" value="1"></td>
                    <td>Antsirabe</td><td> <input name="Antsirabe" type="checkbox" value="1"></td>
                    <td>Mahajanga</td><td> <input name="Mahajanga" type="checkbox" value="1"></td>
                    <td>Tolagnaro</td><td> <input name="Tolagnaro" type="checkbox" value="1"></td>
                </tr>
                <tr> <td>Toliary</td><td> <input name="Toliary" type="checkbox" value="1"></td>
                    <td>Antsiranana</td><td> <input name="Antsiranana" type="checkbox" value="1"></td>
                    <td>Nosy Be</td><td> <input name="Nosy_Be" type="checkbox" value="1"></td>
                    <td>Vohémar</td><td> <input name="Vohemar" type="checkbox" value="1"></td>
                </tr>
            </table>
                </div>

                <table class="xm" >
                    <!--<tr> <td>MG</td> <td><input id="point" type="text" name="XM"></td> 
                     <td>XA</td> <td><input id="point" type="text" name="XT"></td>
                     <td>418100</td> <td><input id="point" type="text" name="41"></td> </tr>-->

                     <tr><td>UM</td><td><input id="point" type="text" name="UM"></td> 
                        <td colspan="4" align="center">  </td>
                        </tr>

                     <tr> <td colspan="2" align="center">CHARGE <input id="affiche" type="radio" style="width:15px; height:15px;" name="radio1" value="A"></td>
                      <td colspan="2" align="center">STOCK <input id="rad" type="radio" style="width:15px; height:15px;" name="radio1" value="B"></td> 
                       <td colspan="2" align="center"> DAC <input id="dac" type="text" name="dac"> </td> </tr>

                </table>


                <div id="charge">
                    <table class="choix" border="1">
                        <tr><td class="tete" colspan="2">Site</td>                                          <td class="tete" colspan="7">DEPARTEMENT </td>                                                                                                                                                                <td class="tete" colspan="3">DELEGATIONS ET AUTRES</td></tr>

                        <tr><td>ABE</td><td><input name="abe" type="checkbox" value="4"></td>   <td>SHIPPING</td><td>10A01</td><td><input name="s1" type="checkbox" value="4"></td> <td>10B01</td><td><input name="s2" type="checkbox" value="4"></td> <td>10T01</td><td><input name="s3" type="checkbox" value="4"></td>                                              <td>BLX BORDEAUX</td><td>MG1605B2</td><td><input name="bordeaux" type="checkbox" value="4"></td> </tr>

                        <tr><td>DIE</td><td><input name="die" type="checkbox" value="4"></td>   <td>CTM</td><td>20A01</td><td><input name="ctm1" type="checkbox" value="4"></td> <td>20B01</td><td><input name="ctm2" type="checkbox" value="4"></td> <td>20T01</td><td><input name="ctm3" type="checkbox" value="4"></td>                                                                                                                                <td>BLX ROUEN</td><td>MG 1605F0</td><td><input name="rouen" type="checkbox" value="4"></td> </tr>

                        <tr><td>FTU</td><td><input name="ftu" type="checkbox" value="4"></td>   <td>CTA</td><td>30A01</td><td><input name="cta1" type="checkbox" value="4"></td> <td>30B01</td><td><input name="cta2" type="checkbox" value="4"></td> <td>30A02</td><td><input name="cta3" type="checkbox" value="4"></td>                                                                                                                            <td>BLX PUTEAUX</td><td>MG 1605A2</td><td><input name="puteaux" type="checkbox" value="4"></td> </tr>

                        <tr><td>IVT</td><td><input name="ivt" type="checkbox" value="4"></td>   <td>BASE LOGISTIQUE</td><td>15I00</td><td><input name="base1" type="checkbox" value="4"></td> <td>20E01</td><td><input name="base2" type="checkbox" value="4"></td><td></td><td></td>                                                                                                                             <td>BLX STRUCTURE</td><td>MG 1605A5</td><td><input name="structure" type="checkbox" value="4"></td> </tr>

                        <tr><td>MJN</td><td><input name="mjn" type="checkbox" value="4"></td>   <td>NSN</td>            <td>40D00</td><td><input name="nsn" type="checkbox" value="4"></td> <td>40T00</td> <td><input name="40T00" type="checkbox" value="4"></td> <td></td> <td></td>                                                                                                                           <td>BLX ROISSY CDG</td><td>MG 1605A1</td><td><input name="roissycdg" type="checkbox" value="4"></td> </tr>

                        <tr><td>NSB</td><td><input name="nsb" type="checkbox" value="4"></td>   <td>DG</td>         <td>70B01</td><td><input name="dg" type="checkbox" value="4"></td> <td></td> <td></td> <td></td> <td></td>                                                                                                                                <td>BL INFORMATION</td><td>MG 670700</td><td><input name="blinfo" type="checkbox" value="4"></td>     </tr>

                        <tr><td>TJB</td><td><input name="tjb" type="checkbox" value="4"></td>   <td>AGENCE</td>     <td>70C01</td><td><input name="agence1" type="checkbox" value="4"></td> <td>70C03</td><td><input name="agence2" type="checkbox" value="4"></td> <td>70C04</td><td><input name="agence4" type="checkbox" value="4"></td>                                                                                                                               <td>BLUE STORAGE</td><td>MG 415400</td><td><input name="blstorage" type="checkbox" value="4"></td></tr>

                        <tr><td>TMM</td><td><input name="tmm" type="checkbox" value="4"></td>   <td>DF</td>         <td>70E01</td><td><input name="df" type="checkbox" value="4"></td> <td></td> <td></td> <td></td> <td></td>                                                                                                                                <td colspan="3">AUTRES (à préciser) : </td></tr>

                        <tr><td>TUL</td><td><input name="tul" type="checkbox" value="4"></td>   <td>INFORMATIQUE</td> <td>70F01</td><td><input name="info" type="checkbox" value="4"></td> <td></td> <td></td> <td></td> <td></td>                                                                                                                                <td colspan="3" align="center"><input type="text" name="autre1" size="25"></td></tr>

                        <tr><td>  </td><td> </td>                                               <td>PERSONNEL</td>  <td>70G01</td><td><input name="perso" type="checkbox" value="4"></td> <td></td> <td></td> <td></td> <td></td>                                                                                                                             <td colspan="3" align="center"><input type="text" name="autre2" size="25"></td></tr>
                        <tr><td>  </td><td> </td>                                               <td>COMMERCIAL</td> <td>20T00</td><td><input name="transit" type="checkbox" value="4"></td> <td></td> <td></td> <td></td> <td></td>                                                                                                                           <td colspan="3" align="center"><input type="text" name="autre3" size="25"></td></tr>
                    </table>    
                </div> 


                <div class="bouton">
                 <input id="but" type="submit" name="valid" value="Valider">
                 <input id="but" type="submit" name="preview" value="Prévisualiser">
                 <input id="reset" type="reset" value="Reset"> <!--onclick="javascript:location.reload();"-->
                </div>
            </form> 

       </div>
       <hr>
       <div class="annuler">
        <a href="<?php echo site_url("bordereau/annulation/?s=$service&a=$agence")?>">Annuler certaines commandes</a>
        </div>
       
    </body> 

    <script type="text/javascript" src="<?php echo js_url('jquery-2.1.3.min'); ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // On cache le div a afficher :
            $(".check").hide();
            //checkbox a droite    
            $("#charge").hide(); 
            $("#pourcent").hide();  

            var f= $("#frs").val();
            $.ajax({
                type: 'GET',
                url: "<?php echo site_url('gestion/get_refiris');?>"+'?f='+f,
                timeout: 3000,
                success: function(data) {
                $(".ref").val(data) },
                error: function() {
                alert('Une erreur s\'est produite. La requête n\'a pas abouti'); }
            });
                       
             });

            function min1000()
            {
                alert($(this).val());
            }
    
        </script>

        <script type="text/javascript"> 
            $("input[name='radio1']").click( function () {
                if($('#affiche').is(':checked'))
                {
                    $( "#charge" ).slideDown( "slow" ); 
                }
                /*else
                {
                    $("#charge").slideUp("slow");  
                }*/
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

        $("#devise").change(function()
        {
            if ($("#devise").val()=='$' || $("#devise").val()=='Eur')
            {
                $(".tva").hide();  
                $("#tva").prop('checked', true); 
            }  
            else 
            {
                $(".tva").show(); 
                $("#tva").prop('checked', false); 
            }        
        });

        </script>

</html>
<!--&#10004;-->