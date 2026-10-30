<style>
    @import url(../assets/css/fontawesome-all.min.css);
    @import url("https://fonts.googleapis.com/css?family=Merriweather:300,700,300italic,700italic|Source+Sans+Pro:900");
    #wrapper {
        -moz-transition: opacity 0.5s ease;
        -webkit-transition: opacity 0.5s ease;
        -ms-transition: opacity 0.5s ease;
        transition: opacity 0.5s ease;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    #wrapper > .bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #212931;
        background-image: url('./admin/media/couverture/<?= $infoCouv['photo_cv'] ?>'), linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('./admin/media/couverture/<?= $infoCouv['photo_cv'] ?>');
        background-size: auto,auto,100% auto;
        background-position: center,center,top center;
        background-repeat: no-repeat,no-repeat;
        background-attachment: scroll,scroll,scroll;
        z-index: -1;
    }
</style>
<div id="wrapper" class="fade-in">

    <!-- Header -->
    <header id="header">
        <a href="index.html" class="logo">QUI SOMMES-NOUS</a>
    </header>

    <!-- Nav -->
    <?php //include('menu/menu.php'); ?>
    <nav id="nav">
        <ul class="links">
            <li class=""><a href="?pages=home">ACCUEIL</a></li>
            <li class="active"><a href="?pages=evenement">QUI SOMMES-NOUS</a></li>
        </ul>

    </nav>
    <!-- Main -->
    <!-- Main -->
    <div id="main">

        <!-- Post -->
        <section class="post">
            <div class="image main"><img  src="images/mirela-001-PCA.jpg" alt="" /></div>
            <p>
                L'Association Nationale des Institutions de Microfinance en R.D.Congo, ANIMF-RDC en sigle, est une association sans but lucratif,
                une ONG à vocation socio-professionnelle. Créée dans l'objectif de mettre en oeuvre 1 seul Organe représentatif des Institutions de
                Microfinance en R.D.C. et conformément à la loi sur la microfmance que l’ANIMF a été fondée le 28 septembre 2012. Au cours de la même année, les statuts, le règlement d’ ordre intérieur,
                le code de conduite, un plan stratégique et un plan d’actions ont été élaborés et approuvés par les membres.
            </p>
            <p>
                Malgré tous les documents administratifs à sa disposition, l’ANIMF a éprouvé beaucoup de difficultés pour le démarrage de ses
                activités. C’est seulement en octobre 2013 que l’association est opérationnelle et active sur le terrain. Et c’est en fin avril
                2014 que l’ANIMF a tenu sa 1ère Assemblée Générale élective qui lui a permis de se doter d'organes de direction...
                Par <b>Mirela PEKMEZI - PCA ANIMF-RDC</b>

            </p>
        </section>

    </div>