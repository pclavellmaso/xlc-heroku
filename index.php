<?php

//include("model/bd.php");
include("model/debug.php");

session_start();


if (isset($_GET['accio'])) {
    $accio = $_GET['accio'];
} else if (isset($_POST['accio'])) {
    $accio = $_POST['accio'];
} else {
    $accio = null;
}


switch ($accio) {
    case 'registreLogin':
        include('vista/registreLogin.php');
        break;

    case 'val_registreLogin':
        include('controlador/validacio_registreLogin.php');
        break;
    
    case 'val_login':
        include('controlador/validacio_login.php');

        break;
    case 'logout':
        include('controlador/tancar_sessio.php');
        break;

    case 'perfil':
        include('vista/paginaPerfil.php');
        break;

    case 'perfil_personal':
        include('vista/perfilPersonal.php');
        break; 

    case 'act_dadesPersonals':
        include('controlador/act_dadesPersonals.php');
        break;

    case 'perfil_cistella':
        include('vista/perfilCistella.php');
        break;

    case 'buida_cistella':
        include('controlador/buidaCistella.php');
        break;

    case 'perfil_negoci':
        include('vista/perfilNegoci.php');
        break;

    case 'perfil_productes':
        include('vista/perfilProductes.php');
        break;

    case 'perfil_promos':
        include('vista/perfilPromos.php');
        break;

    case 'crear_promo':
        include('controlador/crearPromo.php');
        break;

    case 'sobre_projecte':
        include('vista/sobreProjecte.php');
        break;

    case 'mur_promos':
        include('vista/murPromocions.php');
        break;

    case 'pagina_promo':
        include('vista/paginaPromo.php');
        break;
    
    case 'pagina_producte':
        include('vista/paginaProducte.php');
        break;

    case 'nova_comanda':
        include('controlador/afegirComanda.php');
        break; 

    case 'llista_negocis':
        include('vista/llistaNegocis.php');
        break;

    case 'afegir_producte':
        include('controlador/validacio_producte.php');
        break;

    case 'afegir_cistella':
        include('controlador/afegirCistella.php');
        break;

    default:
        include('vista/inici.php');
        break;
}
?>