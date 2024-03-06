jQuery.browser = {
    msie: false,
    version: 0
};

$(document).ready(function () {
    $('#myTable').dataTable( {
        "paging": false,
        "showing": false,
    
      } ); 
});

$(document).ready(function () {
    $('#adaugaproduseTable').dataTable( {
        "paging": false
    
      } );
});

$('.addsablon').click(function(){
    var self = $(this).parent().parent().parent().parent();
    self.toggleClass("green_bg");
});

$('.deletesablon').click(function(){
    var self = $(this).parent().parent().parent();
    self.toggleClass("red_bg");
});
// inceput drag&drop
var nr_prod = document.getElementsByClassName("nr_produs_td");
var nr_input = document.getElementsByClassName("nr_produs");
        $(function () {
            $("#myTable").sortable({
                items: 'tr:not(.header_tabel)',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    $(this).find("tr").each(function (index) {
                        if (index > 0) {
                            $(this).find("td").eq(0).html(index);
                        }
                    });
                }
            });
        });
 
//  terminare drag&drop
//
    var pret_achizitie= 0;
    var pret_vanzare= 0;
	var cantitate = document.getElementsByClassName('cantitate_produs');
	var pret = document.getElementsByName('tb_pret');
	var total = document.getElementsByName('tb_total');
    var ptotal =document.getElementById('ptotal');
    var ptotalv =document.getElementById('total_vanzare');
    var ptotalv_tva = document.getElementById('vanzare');
    var ptotal_materiale_tva = document.getElementById('ptotal_materiale_tva');
    //pret_vanzare
    var adaos_comercial = document.getElementById('adaos_comercial');
    var total_vanzare = document.getElementsByName('tb_vanzare');
    var total_adaos = document.getElementsByName('tb_adaos');
    var procent_adaos = document.getElementsByName('adaos_procent');
    var manopera = document.getElementById('manopera');
    var salarii_brute = document.getElementById('salarii_brute');
    var salarii_nete = document.getElementById('salarii_nete');
    var ore_manopera = document.getElementById('ore_manopera');
    var transport = document.getElementById('transport');
    var val_euro = document.getElementById('valoare_euro');
    // var moneda_lei = document.getElementById('moneda_lei');
    // var moneda_euro = document.getElementById('moneda_euro');

$('#print_btn').click(function(){
     $(".dataTables_info").hide();
     $(".dataTables_filter").hide();
     $('#text_header').css('cols', '10');
     $('#title_data').css('visibility', 'visible');
    // document.getElementById('btn_copiaza_sablon').hidden = true;
    document.getElementsByName('td_move').hidden = true;
    document.getElementById("print_span").hidden = true;
    document.getElementById("print_span_2").hidden = true;
    document.getElementById("input_adaos").hidden = true;
    document.getElementById("input_salveaza_sablon").hidden = true;
    document.getElementById("btn_add_prod").hidden = true;
    document.getElementById("total_cheltuieli").hidden = true;
    document.getElementById("total_profit").hidden = true;
    document.getElementById("adaos%_th").hidden = true;
    document.getElementById("total_th").hidden = true;
    document.getElementById("pret_th").hidden = true;
    document.getElementById("vanzare_th").hidden = true;
    document.getElementById('actiuni_th').hidden = true;
    document.getElementById("adaos_th").hidden = true;
    document.getElementById('div_profit').style.width  = "100%";
    var a_imagine = document.getElementById('a_imagine');
    a_imagine.setAttribute("href","#");
    document.getElementById('div_cheltuieli').hidden  = true;
    document.getElementById('title_page').hidden = true;
    // moneda_lei.hidden = true;
    // moneda_euro.removeAttribute('hidden');
    $('.container').removeClass('big_container');
  
    //variabile
    var adaos_td = document.getElementsByName("adaos_td");
    var adaos2_td = document.getElementsByName("tb_adaos");
    var total_td = document.getElementsByName("tb_total");
    var pret_td = document.getElementsByName("tb_pret2");
    var vanzare_td = document.getElementsByName("tb_vanzare");
    var actiuni_td = document.getElementsByName("tb_actiuni");
    
    $('#div_profit').removeClass('pull-right');
    $('#div_profit').addClass('text-center');
    // var aux = Number(ptotalv_tva.innerText) / Number(val_euro.value);
    // ptotalv_tva.innerText = aux.toFixed(2);


    for(i=0; i < adaos_td.length;i++){
        adaos_td[i].hidden = true;
        adaos2_td[i].hidden = true;
        total_td[i].hidden = true;
        pret_td[i].hidden = true;
        vanzare_td[i].hidden = true;
        actiuni_td[i].hidden = true;
    }

    // window.print();
}); 
 
$('#print_btn_2').click(function(){
     $(".dataTables_info").hide();
     $(".dataTables_filter").hide();
     $('#title_data').css('visibility', 'visible');  
    // document.getElementById('btn_copiaza_sablon').hidden = true;
    document.getElementsByName('td_move').hidden = true;
    document.getElementById("print_span").hidden = true;
    document.getElementById("print_span_2").hidden = true;
    document.getElementById("input_adaos").hidden = true;
    document.getElementById("input_salveaza_sablon").hidden = true;
    document.getElementById("btn_add_prod").hidden = true;
    document.getElementById("total_cheltuieli").hidden = true;
    document.getElementById("total_profit").hidden = true;
    document.getElementById("adaos%_th").hidden = true;
    document.getElementById("total_th").hidden = true;
    document.getElementById("pret_th").innerText = "Pret unitar (Lei fara T.V.A)";
    //document.getElementById("vanzare_th").hidden = true;
    document.getElementById('actiuni_th').hidden = true;
    document.getElementById("adaos_th").hidden = true;
    document.getElementById('div_profit').style.width  = "100%";
    var a_imagine = document.getElementById('a_imagine');
    a_imagine.setAttribute("href","#");
    document.getElementById('div_cheltuieli').hidden  = true;
    document.getElementById('title_page').hidden = true;
    // moneda_lei.hidden = true;
    // moneda_euro.removeAttribute('hidden');
    $('.container').removeClass('big_container');
  
    //variabile
    var adaos_td = document.getElementsByName("adaos_td");
    var adaos2_td = document.getElementsByName("tb_adaos");
    var total_td = document.getElementsByName("tb_total");
    var pret_td = document.getElementsByName("tb_pret2");
    var vanzare_td = document.getElementsByName("tb_vanzare");
    var actiuni_td = document.getElementsByName("tb_actiuni");
    
    $('#div_profit').removeClass('pull-right');
    $('#div_profit').addClass('text-center');
    // var aux = Number(ptotalv_tva.innerText) / Number(val_euro.value);
    // ptotalv_tva.innerText = aux.toFixed(2);
  

    for(i=0; i < adaos_td.length;i++){
        adaos_td[i].hidden = true;
        adaos2_td[i].hidden = true;
        total_td[i].hidden = true;
        var pret_unitar_tmp = Number(vanzare_td[i].innerText) / Number(cantitate[i].value);
        pret_td[i].innerText = pret_unitar_tmp.toFixed(2);
        //vanzare_td[i].hidden = true;
        actiuni_td[i].hidden = true;
    }

    // window.print();
});

function test(e) {
    var exemplu = document.getElementById('exemplu');
    localStorage.setItem('exemplu', exemplu.value);
    e.preventDefault();
}

function updateAdaos() {
    // var search = $("#myTable_filter:first-child").children().html();
    // var search = document.querySelectorAll('[type="search"]')[0];
    // search.value = "asdasdsa";
    // search.select();

    // var write_text = function() {
    //     search.value+="asdasd";
    //     search.sSearch();
    //   }
    //   setTimeout(function(){write_text()},1000);


    // console.log(search);
    for(i=0;i<pret.length;i++){
        aux = Number(adaos_comercial.value);
        procent_adaos[i].value = aux;
    }
    subTotal();
}
updateAdaos();
function subTotal(){
    pret_achizitie=0;
    pret_vanzare=0;
    for(i=0;i<pret.length;i++){
        var aux = pret[i].value*cantitate[i].value;
        total[i].innerText = aux.toFixed(2);
        var aux2 = Number(total[i].innerText) * (1 + Number(procent_adaos[i].value)/100);
        total_vanzare[i].innerText = aux2.toFixed(2);
        var aux3 = pret[i].value * procent_adaos[i].value/100.00;

        total_adaos[i].innerText = aux3.toFixed(2);
        var cost_manopera_fara_tva = Number(manopera.value)*Number(ore_manopera.value);
        var cost_transport_fara_tva = Number(transport.value)*0.3*Number(val_euro.value);
        // procent_adaos[i].value = Number(adaos_comercial.value);
        pret_achizitie = pret_achizitie + aux;
        pret_vanzare = pret_vanzare + aux2;
    }
    ptotal.innerText = pret_achizitie.toFixed(2);
    var cost_materiale_cu_tva = pret_achizitie * 1.19;
    ptotal_materiale_tva.innerText = cost_materiale_cu_tva.toFixed(2);
    ptotalv.innerText = pret_vanzare.toFixed(2);

    // valoare pret vanzare materiale cu TVA
    var total_materiale_cu_tva = document.getElementById('total_materiale_cu_tva');
    var pret_vanzare_materiale_cu_tva_calculat = pret_vanzare * 1.19;
    total_materiale_cu_tva.innerText = pret_vanzare_materiale_cu_tva_calculat.toFixed(2);
    
    // total manopera Lei fara TVA si cu TVA
        // var total_manopera = document.getElementById('total_manopera');
        // var total_manopera_cu_tva = document.getElementById('total_manopera_cu_tva');
        // total_manopera.innerText = cost_manopera_fara_tva;
        // var costuri_manopera_cu_tva = Number(cost_manopera_fara_tva * 1.19);
        // total_manopera_cu_tva.innerText = costuri_manopera_cu_tva.toFixed(2);

    // salarii brute
    var taxe_cas = document.getElementById('taxe_cas');
    var taxe_cam = document.getElementById('taxe_cam');
    var costuri_salarii_brute = cost_manopera_fara_tva*(1 + Number(taxe_cas.value)/100.00 + Number(taxe_cam.value)/100.00);
    salarii_nete.innerText = cost_manopera_fara_tva.toFixed(2);
    salarii_brute.innerText = costuri_salarii_brute.toFixed(2);

    // total transport Lei fara tva si cu TVA
    var total_transport = document.getElementById('total_transport');
    var total_transport_cu_tva = document.getElementById('total_transport_cu_tva');
    total_transport.innerText = cost_transport_fara_tva.toFixed(2);
    var costuri_transport_cu_tva = Number(cost_transport_fara_tva*1.19);
    total_transport_cu_tva.innerText = costuri_transport_cu_tva.toFixed(2);

    //valoare totala cheltuieli cu si fara TVA
    var valoare_totala_cheltuieli = document.getElementById('valoare_totala_cheltuieli');
    var costuri_totale = pret_achizitie + cost_manopera_fara_tva + cost_transport_fara_tva;
    valoare_totala_cheltuieli.innerText = costuri_totale.toFixed(2);

    // valoare adaos materiale
    var adaos_materiale_valoare = document.getElementById('adaos_materiale_valoare');
    var adaos_materiale_calculat = pret_vanzare - pret_achizitie;
    adaos_materiale_valoare.innerText = adaos_materiale_calculat.toFixed(2);

    //valoare adaos manopera_lei
    var adaos_manopera_procent = document.getElementById('adaos_manopera_procent');
    var adaos_manopera_lei = document.getElementById('adaos_manopera_lei');
    var adaos_manopera_lei_calculat = costuri_salarii_brute *(1 + Number(adaos_manopera_procent.value/100.00)) - costuri_salarii_brute;
    adaos_manopera_lei.innerText = adaos_manopera_lei_calculat.toFixed(2); 

    //valoare manopera lei fara TVA
    var valoare_manopera_ofertata = document.getElementById('valoare_manopera_ofertata');
    var valoare_manopera_ofertata_cu_tva = document.getElementById('valoare_manopera_ofertata_cu_tva');
    var valoare_manopera_ofertata_calculata = costuri_salarii_brute + adaos_manopera_lei_calculat;
    var valoare_manopera_ofertata_cu_tva_calculata = valoare_manopera_ofertata_calculata*1.19;
    valoare_manopera_ofertata.innerText = valoare_manopera_ofertata_calculata.toFixed(2);
    valoare_manopera_ofertata_cu_tva.innerText = valoare_manopera_ofertata_cu_tva_calculata.toFixed(2);

    //valoare total venituri
    var total_venituri = document.getElementById('total_venituri');
    var total_venituri_calculat  = adaos_manopera_lei_calculat + adaos_materiale_calculat;
    total_venituri.innerText = total_venituri_calculat.toFixed(2);
    //valoare comision
    var comision = document.getElementById('comision');
    var comision_nr = Number(comision.value);

    var pret_tva = (pret_vanzare + cost_transport_fara_tva + valoare_manopera_ofertata_calculata) * 1.19 + comision_nr;
    ptotalv_tva.innerText = pret_tva.toFixed(2);
}
subTotal();

function myFunction() {
    var x = document.getElementById("btn_copiaza_sablon");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
//inceput script mutarea elementelor in tabel
$('#myTable input.move').click(function() {
    var row = $(this).closest('tr');
   
    if ($(this).hasClass('up')){
        row.prev().before(row);
        for(i = 0; i< nr_prod.length;i++){
            nr_prod[i].innerText = i+1;
            nr_input[i].value = i+1;
        }
    }

    else{ 
        row.next().after(row);
        for(i = 0; i< nr_prod.length;i++){
            nr_prod[i].innerText = i+1;
            nr_input[i].value = i+1;
        }
    }            

    $(this).closest('table').find('tr:first').find('td:eq(1) input');
    $(this).closest('table').find('tr:last').find('td:eq(2) input');
    $(this).closest('table').find('tr').not(':first').not(':last').find('td:eq(1) input');
    $(this).closest('table').find('tr').not(':first').not(':last').find('td:eq(2) input');
});
//sfarsit script mutarea elementelor in tabel

$('#salveaza_sablon').click(function(){
    for(i = 0; i< nr_prod.length;i++){
        nr_prod[i].innerText = i+1;
        nr_input[i].value = i+1;
    }
})

// var frm = $('#myform');
//     frm.submit(function (ev) {
//         $.ajax({
//             type: "POST",
//             url: "salveaza_sablon.php" ,
//             data: frm.serialize(),
//         });
//         alert("Salvat cu succes!");
//         ev.preventDefault();
//     });

