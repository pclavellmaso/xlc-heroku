<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

p {
    color: black;
}

.llistaFlex {
    margin-top: 1em;
}

.promoFlex {
    background-color: rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    border-radius: 3px;
    display: flex;
    padding: 1em;
    width: 100%;
}

.slick-slide.slick-current.slick-active {
    border-radius: 2px;
}

.slick-slide {
    display: none;
    float: left;
    height: auto!important;
    min-height: 1px;
}

.left {
    width: 20%;
    padding: 1em;
}

.right {
    width: 80%;
    padding: 1em;
    margin-left: 1em;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.right_bottom {
    display: flex;
    flex-direction: column;
}


.right_bottom > div:nth-child(2) {
    margin-top: 20px;
    margin-left: auto;
}

.titol1 {
    margin: 1em 0;
}


.llistaFlex {
    display: flex;
    flex: ;
    flex-direction: column;
    justify-content: ;
    align-content: ;
    align-items: center;
}

.veureMes_btn {
    color: white;
    padding: 1em;
    font-size: 1em;
    border-radius: 2px;
    background: #EFA243;
    margin-left: auto;
    margin-top: auto;
    transition: 0.4s;
}

.veureMes_btn:hover {
    transform: scale(1.06);
    color: white!important;
}

.content {
    margin-bottom: 3em;
}

#cntdwn {
    color: brown!important;
    margin-left: 1em;
    margin-bottom: 1em;
    background: transparent!important;
}

.timer {
    display: inline;
}

</style>

<?php include "header.php";?>

<?php

    $cons_promos = "SELECT distinct p.id, n.nom, p.descompte_add, p.data_fi  FROM promocio p, usuari u, negoci n WHERE n.id = p.negoci_id";
    $res_promos = $bd->query($cons_promos);
    $data_promos = $res_promos->fetch_all(MYSQLI_ASSOC);

?>

<div class="contingut">
  
    <h1 class="titol1">Mur de promocions</h1>
    <h4>En aquest espai trobaràs les promocions actives dels comerços adherits</h4>
        
    <div class="llistaFlex">

        <?php for ($i = 0; $i < count($data_promos); $i++) { ?>

            <?php
            
                $cons_subpromo = "SELECT p.imatge, p.nom, p.preu FROM subpromocio sp, producte p WHERE sp.producte_id = p.id and sp.promocio_id = ".$data_promos[$i]['id']."";
                $res_subpromo = $bd->query($cons_subpromo);

                $data_subpromo = $res_subpromo->fetch_all(MYSQLI_ASSOC);

            ?>

            <div class="promoFlex">

                <div class="left">

                    <div class="your-class">

                        <?php for ($k = 0; $k < count($data_subpromo); $k++) { ?>

                            <img src="/XLC/vista/img/<?php echo $data_subpromo[$k]['imatge']; ?>" alt="">
                        <?php } ?>

                    </div>

                </div>

                <div class="right">

                    <div>
                        <h3><?php echo $data_promos[$i]['nom']; ?></h3>
                    </div>

                    <?php

                        $prods = '';
                        $preu = 0;
                        for ($k = 0; $k < count($data_subpromo); $k++) {

                            $prods .= ucfirst($data_subpromo[$k]['nom']) . ' | ';
                            $preu += $data_subpromo[$k]['preu'];
                        }

                        // Descompte aplicat al preu total dels productes, no individualment, pensarho un xic
                        $preu_desc = $preu - ($preu * ($data_promos[$i]['descompte_add'] / 100));
                    ?>

                    <div>
                        <h5 style="display: inline;">Inclou:</h5>
                        <p><?php echo $prods; ?></p>

                        <h5>Finalitza el:</h5>
                        <p class="data_fi" data-time="<?php echo $data_promos[$i]['data_fi']; ?>" style="display: inline;"><?php echo $data_promos[$i]['data_fi']; ?></p>
                        
                        
                            <!--<script>
                                TargetDate = jQuery(".data_fi").data('time');
                                BackColor = "palegreen";
                                ForeColor = "navy";
                                CountActive = true;
                                CountStepper = -1;
                                LeadingZero = true;
                                DisplayFormat = "%%D%% Dies, %%H%% Hores, %%M%% Minuts, %%S%% Segons.";
                                FinishMessage = "No disponible";
                            </script>

                            <script>
                                
                                counter = 1;

                                function calcage(secs, num1, num2) {
                                    
                                    s = ((Math.floor(secs/num1))%num2).toString();

                                    if (LeadingZero && s.length < 2)
                                        s = "0" + s;
                                    return "<b>" + s + "</b>";
                                }

                                function CountBack(secs) {

                                    if (secs < 0) {
                                        document.getElementById("cntdwn").innerHTML = FinishMessage;
                                        return;
                                    }

                                    DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
                                    DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
                                    DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
                                    DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

                                    //document.getElementById("cntdwn").innerHTML = DisplayStr;
                                    let clase = 'cntdwn' + counter.toString()
                                    console.log('clase' + clase)
                                    jQuery(`.${clase}`).html(DisplayStr)

                                    if (CountActive) setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
                                }

                                function putspan() {
                                    document.write("<span id='cntdwn' class='cntdwn'></span>");
                                    let clase = 'cntdwn' + counter.toString()
                                    document.getElementById("cntdwn").setAttribute("class", clase)
                                }

                                
                                if (typeof(TargetDate)=="undefined") TargetDate = "12/31/2020 5:00 AM";
                                if (typeof(DisplayFormat)=="undefined") DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
                                if (typeof(CountActive)=="undefined") CountActive = true;
                                if (typeof(FinishMessage)=="undefined") FinishMessage = "";
                                if (typeof(CountStepper)!="number") CountStepper = -1;
                                if (typeof(LeadingZero)=="undefined") LeadingZero = true;

                                CountStepper = Math.ceil(CountStepper);

                                if (CountStepper == 0) CountActive = false;

                                var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
                                putspan();

                                var dthen = new Date(TargetDate);
                                var dnow = new Date();

                                if(CountStepper>0)
                                    ddiff = new Date(dnow-dthen);
                                else
                                    ddiff = new Date(dthen-dnow);

                                gsecs = Math.floor(ddiff.valueOf()/1000);
                                CountBack(gsecs);
                                counter++;

                            </script>-->
                        

                            <?php
                                $descompte = $data_promos[$i]['descompte_add'];
                                $id_promo = $data_promos[$i]['id'];
                            ?>

                        <h5 style="margin-top: 1em;">Preu original:</h5>
                        <p style="text-decoration: line-through;"><?php echo $preu; ?> €</p>
                        
                    </div>

                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <h5>Preu amb descompte aplicat del <?php echo $data_promos[$i]['descompte_add']; ?> %: </h5>
                            <p style="font-size: 1.5em;"><?php echo $preu_desc; ?> €</p>
                        </div>
                        <div style="margin-top: auto;">
                            <a class="veureMes_btn" href="index.php?accio=pagina_promo&id_promo=<?php echo $id_promo; ?>">Veure més</a>
                        </div>
                    </div>                 

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include "footer.php";?>

<script>

    $(document).ready(function(){
        $('.your-class').slick();
    });

</script>


