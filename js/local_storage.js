// $(document).ready(function () {
//     if (window.location.href === 'http://localhost/products/sablon.php?' && sessionStorage.scrollTop != "undefined") {
//         $(window).scrollTop(sessionStorage.scrollTop);
//     }
// });

window.onbeforeunload = function() {
    localStorage.setItem("exemplu", $('#exemplu').val());
    localStorage.setItem("adaos_comercial", $('#adaos_comercial').val());
    localStorage.setItem("manopera", $('#manopera').val());
    localStorage.setItem("ore_manopera", $('#ore_manopera').val());
    localStorage.setItem("transport", $('#transport').val());
    localStorage.setItem("adaos_manopera_procent", $('#adaos_manopera_procent').val());
    // localStorage.setItem("p_header", $('#p_header').html());
    // localStorage.setItem("p_footer", $('#p_footer').html());
    
    for(i=0;i<procent_adaos.length;i++){
        localStorage.setItem(procent_adaos[i].id, $('#' + procent_adaos[i].id).val());
    }

    delete sessionStorage.scrollTop;
	return;
    // ...
}

window.onload = function() {
    delete sessionStorage.scrollTop;
    var exemplu = localStorage.getItem("exemplu");
    var adaos_comercial = localStorage.getItem("adaos_comercial");
    var manopera = localStorage.getItem("manopera");
    var ore_manopera = localStorage.getItem("ore_manopera");
    var transport = localStorage.getItem("transport");
    var adaos_manopera_procent = localStorage.getItem("adaos_manopera_procent");
    // var p_header = localStorage.getItem("p_header");
    // var p_footer = localStorage.getItem("p_footer");
    if (name !== null) $('#exemplu').val(exemplu);
    if (name !== null) $('#adaos_comercial').val(adaos_comercial);
    if (name !== null) $('#manopera').val(manopera);
    if (name !== null) $('#ore_manopera').val(ore_manopera);
    if (name !== null) $('#transport').val(transport);
    if (name !== null) $('#adaos_manopera_procent').val(adaos_manopera_procent);
    // if (name !== null) $('#p_header').html(p_header);
    // if (name !== null) $('#p_footer').html(p_footer);
    for(i=0;i<procent_adaos.length;i++){
        var aux_procent_adaos = localStorage.getItem(procent_adaos[i].id);
        if (name !== null) $('#' + procent_adaos[i].id).val(aux_procent_adaos);
    }

    subTotal();
}