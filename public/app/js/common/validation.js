 $(".alphabets").on('keypress', function (e) 
     {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
        return true;
        else
        return false; 
     }); 
$(".alphabets_with_space").on('keypress', function (e) 
     {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
        return true;
        else
        return false; 
     }); 
  $(".numbers").on('keypress', function (e) 
    {
  
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
        return false;
        else
        return true;    
     });
  $(".numbers_with_decimal").on('keypress', function (e) 
    {
      
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 45) || e.charCode == 47|| (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
        return false;
        else
        return true;    
     });
  $( "#cargo" ).change(function () 
    {
       var val=$("#cargo option:selected" ).val();
       $("#cargo").attr('data-content', '');
        $('#cargo').css('border','1px solid #ccc');
  });
   $("#select_date").on('keyup', function () 
     {
         if ($(this).val().length <= 0) 
         {
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $(this).css("border", "1px solid #999");
         }
     }); 
    $( "#pax" ).change(function () 
    {
        $('#pax').css('border','1px solid #ccc');
    });
  $('#from,#dept_aero').keypress(function() 
  {
      if($(this).val().length >= 4) {
        return false;
    }
  });
    $("#from").on('keyup', function () 
     {
         
         if ($(this).val().length <= 3) 
         {
            $(this).attr('data-content', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $('#to').focus();
             $(this).attr('data-content', '');
            $(this).css("border", "1px solid #999");
            
         }
     });  
    $("#dept_aero").on('keyup', function () 
     {
         
         if ($(this).val().length <= 3) 
         {
            $(this).attr('data-content', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $('#dest_aero').focus();
            $(this).attr('data-content', '');
            $(this).css("border", "1px solid #999");
            
         }
     });  
 $('#to,#dest_aero').keypress(function() 
  {
      if($(this).val().length >= 4) {
        return false;
    }
  });   
     $("#to").on('keyup', function () 
     {
         
         if ($(this).val().length <= 3) 
         {
            $(this).attr('data-content', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
            $(this).css("border", "red solid 1px");
         }
         else
         {
            $("#select_date").focus();
             $(this).attr('data-content', '');
            $(this).css("border", "1px solid #999");
         } 
     });
 $("[data-toggle = 'popover']").popover({
     html: true,
     trigger: "manual"
 });
 $(".alphabets").on('keypress', function(e) {
     if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0))
         return true;
     else
         return false;
 });
 $(".alphabets_with_space").on('keypress', function(e) {
     if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0) || (e.charCode == 32))
         return true;
     else
         return false;
 });
 $(".numbers").on('keypress', function(e) {
     if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96) || (e.charCode >= 123 && e.charCode <= 127))
         return false;
     else
         return true;
 });

 function errorPopover(id, message) {
     $(id).popover({
         trigger: 'manual',

     });
     $(id).attr('data-content', message);
     $(id).css("border", "red solid 1px ");
     $(id).popover('show');
 }

 function closePopover(id) {
     $(id).popover('destroy');
     $(id).css("border", "1px solid #ccc");
 }
 $("#cargo").change(function() {
     closePopover('#cargo');
 });
 $("#select_date").on('keyup', function() {
     if ($(this).val().length <= 0) {
         $(this).css("border", "red solid 1px");
     } else {
         $(this).css("border", "1px solid #999");
     }
 });
 $("#pax").change(function() {
     $('#pax').css('border', '1px solid #ccc');
 });
 $('#from,#dept_aero').keypress(function() {
     if ($(this).val().length >= 4) {
         return false;
     }
 });
 $("#from").on('keyup', function() {

     if ($(this).val().length <= 3) {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
     } else {
         $('#to').focus();
         closePopover('#from');
     }
 });
 $("#dept_aero").on('keyup', function() {

     if ($(this).val().length <= 3) {
         errorPopover('#dept_aero', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
     } else {
         $('#dest_aero').focus();
         closePopover('#dept_aero');
     }
 });
 $('#to,#dest_aero').keypress(function() {
     if ($(this).val().length >= 4) {
         return false;
     }
 });
 $("#to").on('keyup', function() {

     if ($(this).val().length <= 3) {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
     } else {
         $("#select_date").focus();
         closePopover('#to')
     }
 });
 $("#dest_aero").on('keyup', function() {

     if ($(this).val().length <= 3) {
         errorPopover('$dest_aero', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
     } else {
         $("#select_date").focus();
         closePopover('#dest_aero');
     }
 });
 // $("#take_off_fuel").on('keyup', function ()    /sumit
 // {
 //    console.log($(this).val().length);
 //     if ($(this).val().length <=0) 
 //     {  
 //        $(this).css("border", "red solid 1px");
 //     }
 //     else
 //     {
 //        $(this).css("border", "1px solid #999");
 //     }

 // });  
 $("#cargo_vrl").on('keyup', function() {
     console.log($(this).val().length);
     if ($(this).val().length <= 0) {
         errorPopover('#cargo_vrl', 'Cargo is Compulsory');
     } else {
         closePopover('#cargo_vrl');
     }
 });
 $("#landing_fuel").on('keyup', function() {
     if ($(this).val().length <= 0) {
         console.log('landing_fuel_keup_if');
         $(this).css("border", "red solid 1px");
     } else {
         console.log('landing_fuel_key_up_else');
         $(this).css("border", "1px solid #999");
     }
 });
 $("#pilot").on('keyup', function() {

     if ($(this).val().length <= 1) {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
     } else {
         closePopover('#pilot');
     }
 });
 $("#co_pilot").on('keyup', function() {

     if ($(this).val().length <= 1) {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
     } else {
         closePopover('#co_pilot');
     }
 });

 $('.take_off_fuel_roundoff_vtanf').blur(function() {
     var val = $(this).val();

     var result;
     if (val > 3650)
         result = 3650;
     else
         result = val;
     $(this).val(result);
     if ($("#landing_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result <= parseInt($("#landing_fuel").val())) {
             errorPopover('#landing_fuel', 'Landing Fuel should be less than Take Off Fuel');
         } else {
             closePopover('#landing_fuel');
         }
     }
 });
 $(".take_off_fuel_roundoff_vtavs").on('keyup', function() {
     if ($(this).val().length > 0 && $(this).val() > 50) {
         closePopover('.take_off_fuel_roundoff_vtavs');
     } else {
         errorPopover('.take_off_fuel_roundoff_vtavs', 'Max. Take Off Fuel is 2750 and Min. Take Off Fuel is 50');
     }
 });
 $('.take_off_fuel_roundoff_vtavs').blur(function() {
     var val = $(this).val();
     var result;
     if (val > 2750)
         result = 2750;
     else
         result = val;
     $(this).val(result);
     if ($("#landing_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result <= parseInt($("#landing_fuel").val())) {
             console.log('landing_fuel_if');
             errorPopover('#landing_fuel', 'Landing Fuel should be less than Take Off Fuel');
         } else {
             console.log('landing_fuel_else');
             $("#landing_fuel").css("border", "1px solid #999");
             $("#take_off_fuel").css("border", "1px solid #999");
             closePopover('#landing_fuel');
         }
     }
 });

 $(".take_off_fuel_roundoff_vtanf").on('keyup', function() {
     if ($(this).val().length > 0) {
         closePopover('#take_off_fuel');
     } else {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 3650');
     }
 });
 $(".take_off_fuel_roundoff_vtssf").on('keyup', function() {
     if ($(this).val().length > 0 && $(this).val() > 0) {
         closePopover('#take_off_fuel');
     } else {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 3650 and Min. Take Off Fuel is 100');
     }
 });
 $(".landing_fuel_roundoff_vtanf").on('keyup', function() {
     if ($(this).val().length > 0) {
         closePopover('#landing_fuel');
     } else {
         errorPopover('#landing_fuel', 'Max. Landing Off Fuel is 3650');
     }
 });
 $(".landing_fuel_roundoff_vtssf").on('keyup', function() {
     if ($(this).val().length > 0 && $(this).val() > 0) {
         closePopover('#landing_fuel');
     } else {
         errorPopover('#landing_fuel', 'Max. Landing Off Fuel is 3650 and Min. Landing Off Fuel is 1');
     }
 });
 $('.take_off_fuel_roundoff_vtssf').blur(function() {
     var val = $(this).val();
     var result;
     if (val > 3559)
         result = 3559;
     else
         result = val;
     $(this).val(result);
     if ($("#landing_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result <= parseInt($("#landing_fuel").val())) {
             errorPopover('#landing_fuel', 'Landing Fuel should be less than Take Off Fuel');
         } else {
             console.log('landing_fuel_else');
             closePopover('#landing_fuel');
         }
     }
 });
 $('.take_off_fuel_roundoff').blur(function() {
     var result = $(this).val();
     if ($("#landing_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result <= parseInt($("#landing_fuel").val())) {
             console.log('landing_fuel_if');
             $("#landing_fuel").css("border", "red solid 1px");
             $("#take_off_fuel").css("border", "red solid 1px");
         } else {
             console.log('landing_fuel_else');
             $("#landing_fuel").css("border", "1px solid #999");
             $("#take_off_fuel").css("border", "1px solid #999");
         }
     }
 });
 $(".landing_fuel_roundoff_vtavs").on('keyup', function() {
     if ($(this).val().length > 0 && $(this).val() > 50) {
         closePopover('#landing_fuel');

     } else {
         errorPopover('#landing_fuel', 'Max. Landing Fuel is 2750 and Min. Landing Fuel is 50');
     }
 });
 $('.landing_fuel_roundoff_vtavs').blur(function(e) {
     var val = $(this).val();

     var result;
     if (val > 2750)
         result = 2750;
     else
         result = val;
     $(this).val(result);

     if ($("#take_off_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result >= parseInt($("#take_off_fuel").val())) {
             console.log('take_off_fuel_ifxx');
             errorPopover('#landing_fuel', 'Landing fuel should be less than Take Off Fuel');
             $(this).val(result);
         } else {
             console.log('take_off_fuel_elserr');
             $(this).val(result);
             closePopover('#landing_fuel');
         }
     }
 });
 $('.landing_fuel_roundoff_vtanf').blur(function(e) {
     var val = $(this).val();

     var result;
     if (val > 3650)
         result = 3650;
     else
         result = val;
     $(this).val(result);

     if ($("#take_off_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result >= parseInt($("#take_off_fuel").val())) {
             console.log('take_off_fuel_if');
             errorPopover('#landing_fuel', 'Landing Fuel should be less than Take Off Fuel');
             $(this).val(result);
         } else {
             console.log('take_off_fuel_else');
             $(this).val(result);
             closePopover('#landing_fuel')
         }
     }
 });
 $('.landing_fuel_roundoff_vtssf').blur(function(e) {
     var val = $(this).val();
     if (val > 3650)
         result = 3650;
     else
         result = val;
     $(this).val(result);

     if ($("#take_off_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result >= parseInt($("#take_off_fuel").val())) {
             console.log('take_off_fuel_if');
             errorPopover('#landing_fuel', 'Landing fuel should be less than Take Off Fuel');
             $(this).val(result);
         } else {
             console.log('take_off_fuel_else');
             $(this).val(result);
             closePopover('#landing_fuel');
         }
     }
 });
 $('.landing_fuel_roundoff').blur(function(e) {
     var result = $(this).val();
     if ($("#take_off_fuel").val().length > 0 && $(this).val().length > 0) {
         if (result >= parseInt($("#take_off_fuel").val())) {
             console.log('take_off_fuel_if');
             $("#landing_fuel").css("border", "red solid 1px");
             $("#take_off_fuel").css("border", "red solid 1px");
             $(this).val(result);
         } else {
             console.log('take_off_fuel_else');
             $(this).val(result);
             $("#landing_fuel").css("border", "1px solid #999");
             $("#take_off_fuel").css("border", "1px solid #999");
         }
     }
 });
 $('#baggage_nose').on('keyup', function() {

     if ($("#baggage_nose").val() > 120 || $("#baggage_nose").val() == '') {
         errorPopover('#baggage_nose', 'Max. Baggage (Nose) is 120');
     } else {
         closePopover('#baggage_nose');
     }

 });

 //$('#baggage_aft_cabin').blur(function()
 $("#baggage_aft_cabin").on('keyup', function() {

     if ($("#baggage_aft_cabin").val() > 120 || $("#baggage_aft_cabin").val() == '') {
         errorPopover('#baggage_aft_cabin', 'Max. Baggage (AFT Cabin) is 120');
     } else {
         closePopover('#baggage_aft_cabin');
     }

 });
 // $('#baggage_aft_cabin_fuselage_forward').blur(function()
 $('#baggage_aft_cabin_fuselage_forward').on('keyup', function() {
     if ($("#baggage_aft_cabin_fuselage_forward").val() > 120 || $("#baggage_aft_cabin_fuselage_forward").val() == '') {
         errorPopover('#baggage_aft_cabin_fuselage_forward', 'Max. Aft Fuselage Baggage-Forward is 120');
     } else {
         closePopover('#baggage_aft_cabin_fuselage_forward');
     }
 });
 // $('#baggage_aft_cabin_fuselage').blur(function()
 $('#baggage_aft_cabin_fuselage').on('keyup', function() {

     if ($("#baggage_aft_cabin_fuselage").val() > 120 || $("#baggage_aft_cabin_fuselage").val() == '') {
         errorPopover('#baggage_aft_cabin_fuselage', 'Max. Aft Fuselage Baggage-Aft is 120');
     } else {
         closePopover('#baggage_aft_cabin_fuselage');
     }

 });
 $("#vtssfform").submit(function() {
     var bool = true;

     if ($("#baggage_nose").val() > 120 || $("#baggage_nose").val() == '') {
         errorPopover('#baggage_nose', 'Max. Baggage (Nose) is 120');
         bool = false;
     }
     if ($("#baggage_aft_cabin").val() > 120 || $("#baggage_aft_cabin").val() == '') {
         errorPopover('#baggage_aft_cabin', 'Max. Baggage (AFT Cabin) is 120');

         bool = false;
     }
     if ($("#baggage_aft_cabin_fuselage_forward").val() > 120 || $("#baggage_aft_cabin_fuselage_forward").val() == '') {
         errorPopover('#baggage_aft_cabin_fuselage_forward', 'Max. Aft Fuselage Baggage-Forward is 120');
         bool = false;
     }
     if ($("#baggage_aft_cabin_fuselage").val() > 120 || $("#baggage_aft_cabin_fuselage").val() == '') {
         errorPopover('#baggage_aft_cabin_fuselage', 'Max. Aft Fuselage Baggage-Aft is 120');
         bool = false;
     }
     if ($("#select_date").val() == '') {
         $("#select_date").css("border", "red solid 1px");

         bool = false;
     }
     if ($("#from").val() == '' || $("#from").val().length < 4) {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#to") == '' || $("#to").val().length < 4) {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#take_off_fuel").val() == '' || $("#take_off_fuel").val() < 1) {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 3559 & Min. Take Off Fuel is 1');
         bool = false;
     } else if ($("#take_off_fuel").val() > 3559) {
         $("#take_off_fuel").val(3559);
     }
     if ($("#landing_fuel").val() == '' || $("#landing_fuel").val() < 1) {
         errorPopover('#landing_fuel', 'Max. Landing Fuel is 3650 & Min. Landing Fuel is 1');
         bool = false;
     } else if ($("#landing_fuel").val() > 3650) {
         $("#take_off_fuel").val(3650);
     }
     if (parseInt($("#landing_fuel").val()) >= parseInt($("#take_off_fuel").val())) {
         errorPopover('#landing_fuel', 'Landing fuel should be less than Take Off Fuel');

         bool = false;
     }
     if ($("#pilot").val() == '') {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '') {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });
 $("#vtavsform").submit(function() {
     var bool = true;
     if ($("#cargo").val() == '') {
         errorPopover('#cargo', 'Cargo is Compulsory');
         bool = false;
     }
     if ($("#select_date").val() == '') {
         $("#select_date").css("border", "red solid 1px");

         bool = false;
     }
     if ($("#from").val() == '' || $("#from").val().length < 4) {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#to") == '' || $("#to").val().length < 4) {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#take_off_fuel").val() == '' || $("#take_off_fuel").val() < 50) {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 2750 & Min. Take Off Fuel is 50');
         bool = false;
     } else if ($("#take_off_fuel").val() > 2750) {
         $("#take_off_fuel").val(2750);
     }
     if ($("#landing_fuel").val() == '' || $("#landing_fuel").val() < 50) {
         errorPopover('#landing_fuel', 'Max. Landing Fuel is 2750 & Min. Landing Fuel is 50');
         bool = false;
     } else if ($("#landing_fuel").val() > 2750) {
         $("#landing_fuel").val(2750);
     }
     if (parseInt($("#landing_fuel").val()) >= parseInt($("#take_off_fuel").val())) {
         errorPopover('#landing_fuel', 'Landing fuel should be less than Take Off Fuel');
         bool = false;
     }
     if ($("#pilot").val() == '') {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '') {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });

 $("#vtanfform").submit(function() {
     var bool = true;
     if ($("#cargo_vrl").val() == '') {
         errorPopover('#cargo_vrl', 'Cargo is Compulsory');
         bool = false;
     }
     if ($("#select_date").val() == '') {
         $("#select_date").css("border", "red solid 1px");

         bool = false;
     }
     if ($("#from").val() == '' || $("#from").val().length < 4) {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#to") == '' || $("#to").val().length < 4) {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#take_off_fuel").val() == '') {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 3650');
         bool = false;
     } else if ($("#take_off_fuel").val() > 3650) {
         $("#take_off_fuel").val(3650);
     } else {
         $("#take_off_fuel").attr('data-content', '');
     }
     if ($("#landing_fuel").val() == '') {
         errorPopover('#landing_fuel', 'Max. Landing Fuel is 3650');
         bool = false;
     } else if ($("#landing_fuel").val() > 3650) {
         $("#landing_fuel").val(3650);
     }
     if ($("#landing_fuel").val() != '' && $("#take_off_fuel").val() != '' && parseInt($("#landing_fuel").val()) >= parseInt($("#take_off_fuel").val())) {
         errorPopover('#landing_fuel', 'Landing Fuel Should be less than Take Off Fuel');
         bool = false;
     }
     if ($("#pilot").val() == '') {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '') {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });
 $("#cargo_vrl").on('keyup', function() {
     if ($(this).val().length > 0 && parseInt($(this).val())<601) {
         closePopover('#cargo_vrl');
     } else 
     {
         errorPopover('#cargo_vrl', 'Max. Baggage is 600');
     }
 });
 $(".take_off_fuel_roundoff_vtnma,.take_off_fuel_roundoff_vtnit ").on('keyup', function() {
     if ($(this).val().length > 0 && parseInt($(this).val())<1885) {
         closePopover('#take_off_fuel');
     } else 
     {
         errorPopover('#take_off_fuel', 'Max. Landing Off Fuel is 1884');
     }
 });
 $("#relianceform").submit(function() {
     var bool = true;
     if ($("#cargo_vrl").val() == '' || parseInt($("#cargo_vrl").val()) >600) 
     {
         errorPopover('#cargo_vrl', 'Max. Baggage is 600');
         bool = false;
     }
     if ($("#select_date").val() == '') {
         $("#select_date").css("border", "red solid 1px");

         bool = false;
     }
     if ($("#from").val() == '' || $("#from").val().length < 4) 
     {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#to") == '' || $("#to").val().length < 4) {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#take_off_fuel").val() == ''  || parseInt($("#take_off_fuel").val())>1884) 
     {
         errorPopover('#take_off_fuel', 'Max. Take Off Fuel is 1884');
         bool = false;
     }
     if ($("#pilot").val() == '') {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '') {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });
 $("#calc_form").submit(function() {
     var bool = true;
     if ($('.jump:checked').length == 0) {

         $(".jump_box").css("border", "red solid 1px");
         bool = false;
     }
     if ($("#pax_vtobr").val() > 9) {
         errorPopover('#pax_vtobr', 'Max. Pax Count is 9');
         bool = false;
     }
     if ($("#baggage_fwd_vtobr").val() == '' || $("#baggage_fwd_vtobr").val() > 250) {
         errorPopover('#baggage_fwd_vtobr', 'Max. Baggage Fwd is 250');
         bool = false;
     }
     if ($("#baggage_aft_vtobr").val() == '' || $("#baggage_aft_vtobr").val() > 45) {
         errorPopover('#baggage_aft_vtobr', 'Max. Baggage Aft is 45');
         bool = false;
     }
     if ($("#fuel_wing_tank_vtobr").val() == '' || $("#fuel_wing_tank_vtobr").val() > 8416) {
         errorPopover('#fuel_wing_tank_vtobr', 'Max. Fuel Wing Tank is 8416');
         bool = false;
     }
     if ($("#fuel_ventral_tank_vtobr").val() > 1496) {
         errorPopover('#fuel_ventral_tank_vtobr', 'Max. Fuel Ventral Tank is 1496');
         bool = false;
     }
     if ($("#select_date").val() == '') {
         $("#select_date").css("border", "red solid 1px");

         bool = false;
     }
     if ($("#dept_aero").val() == '' || $("#dept_aero").val().length < 4) {
         errorPopover('#dept_aero', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#dest_aero") == '' || $("#dest_aero").val().length < 4) {
         errorPopover('#dest_aero', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#pilot").val() == '' || $("#pilot").val().length < 2) {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '' || $("#co_pilot").val().length < 2) {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });
 $("#pax_vtobr").on('keyup', function() {
     if ($(this).val() > 9) {
         errorPopover('#pax_vtobr', 'Max. Pax Count is 9');
     } else {
         closePopover('#pax_vtobr');
     }
 });
 $("#baggage_aft_vtobr").on('keyup', function() {
     if ($(this).val() > 45) {
         errorPopover('#baggage_aft_vtobr', 'Max. Baggage Aft is 45');
     } else {
         closePopover('#baggage_aft_vtobr');
     }
 });
 $("#fuel_wing_tank_vtobr").on('keyup', function() {
     if ($(this).val() > 8416) {
         errorPopover('#fuel_wing_tank_vtobr', 'Max. Fuel Wing Tank is 8416');
     } else {
         closePopover('#fuel_wing_tank_vtobr');
     }
 });
 $("#fuel_ventral_tank_vtobr").on('keyup', function() {
     if ($(this).val() > 1496) {
         errorPopover('#fuel_ventral_tank_vtobr', 'Max. Fuel Ventral Tank is 1496');
     } else {
         closePopover('#fuel_ventral_tank_vtobr');
     }
 });
 $("#baggage_fwd_vtobr").on('keyup', function() {
     if ($(this).val() > 250) {
         errorPopover('#baggage_fwd_vtobr', 'Max. Baggage Fwd is 250');
     } else {
         closePopover('#baggage_fwd_vtobr');
     }
 });
 $('.jump').click(function() {
     $(".jump_box").css("border", "1px solid #999");
 })
 $("#take_off_fuel_vtauv").on('keyup', function() {
     if ($(this).val()=='' || $(this).val() > 20000) {
         errorPopover('#take_off_fuel_vtauv', 'Max. Take Off Fuel is 20,000');
     } else 
     {
         closePopover('#take_off_fuel_vtauv');    
     }
     if(parseInt($("#take_off_fuel_vtauv").val())<=parseInt($("#block_fuel").val()))
     {
        console.log("s");
         errorPopover('#block_fuel', 'Block Fuel should be less than Take Off Fuel');
     }
     else
     {
        console.log("ss");
        closePopover('#block_fuel');  
     }
 });
  $("#block_fuel").on('keyup', function() {
      if ($(this).val()=='' || $(this).val() > 9720) {
         errorPopover('#block_fuel', 'Max. Block Fuel is 9720');
     } else {
         closePopover('#block_fuel');  
     }
 });
  $("#baggage").on('keyup', function() {
     if ($(this).val()=='' || $(this).val() > 900) {
         errorPopover('#baggage', 'Max. Baggage is 900');
     } else {
         closePopover('#baggage');  
     }
 });
   $("#life_raft").on('keyup', function() {
     if ($(this).val()=='' || $(this).val() > 131) {
         errorPopover('#life_raft', 'Max. Life Raft is 131');
     } else {
        closePopover('#life_raft');
     }
 });
    $("#toilet_charge").on('keyup', function() {
     if ($(this).val()=='' || $(this).val() > 18.52) {
         errorPopover('#toilet_charge', 'Max. Toilet Charge is 18.52');
     } else {
          closePopover('#toilet_charge');
     }

 });
$("#catering_allowance").on('keyup', function() {
     if ($(this).val()=='' || $(this).val() > 175) {
         errorPopover('#catering_allowance', 'Max. Catering Allowance is 175');
     } else {
          closePopover('#catering_allowance');
     }
 });
$("#portable_water").on('keyup', function() {
  console.log($(this).val())
     if ($(this).val()=='' || $(this).val() > 83.29) {
        errorPopover('#portable_water', 'Max. Potable Water is 83.29');
     } else {
         closePopover('#portable_water');
     }
 });

  $("#vtauvform").submit(function() 
  {
     var bool = true;
     if ($("#baggage").val() == '') 
     {
         errorPopover('#baggage', 'Max. Baggage is 900');
         bool = false;
     }
     if ($('.jump:checked').length == 0) 
     {
         $(".jump_box").css("border", "red solid 1px");
         bool = false;
     }
     if ($("#select_date").val() == '') 
     {
         $("#select_date").css("border", "red solid 1px");
         bool = false;
     }
     if ($("#from").val() == '' || $("#from").val().length < 4) 
     {
         errorPopover('#from', 'ICAO Codes for Departing Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#to") == '' || $("#to").val().length < 4) 
     {
         errorPopover('#to', 'ICAO Codes for Destination Station (Min. & Max. 4 Alphabets)');
         bool = false;
     }
     if ($("#portable_water").val() == '' || $("#from").val()>83.29) 
     {
         errorPopover('#portable_water', 'Max. Potable Water is 83.29');
         bool = false;
     }
     if ($("#catering_allowance").val() == '' || $("#catering_allowance").val()>175) 
     {
         errorPopover('#catering_allowance', 'Max. Catering Allowance is 175');
         bool = false;
     }
     if ($("#toilet_charge").val() == '' || $("#toilet_charge").val()>18.52) 
     {
         errorPopover('#toilet_charge', 'Max. Toilet Charge is 18.52');
         bool = false;
     }
     if ($("#life_raft").val() == '' || $("#life_raft").val()>131) 
     {
         errorPopover('#life_raft', 'Max. Life Raft is 131');
         bool = false;
     }
     if ($("#take_off_fuel_vtauv").val() == '' || $("#take_off_fuel_vtauv").val()>20000) 
     {
         errorPopover('#take_off_fuel_vtauv', 'Max. Take Off Fuel is 20,000');
         bool = false;
     } 
     if ($("#block_fuel").val() == '' || $("#block_fuel").val()>9720) 
     {
         errorPopover('#block_fuel', 'Max. Block Fuel is 9720');
         bool = false;
     } 
     if ($("#block_fuel").val() !='' && parseInt($("#block_fuel").val())>=parseInt($("#take_off_fuel_vtauv").val()) && $("#take_off_fuel_vtauv").val() !='') 
     {
         errorPopover('#block_fuel', 'Block Fuel should be less than Take Off Fuel');
         bool = false;
     } 
     if ($("#pilot").val() == '') 
     {
         errorPopover('#pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     if ($("#co_pilot").val() == '') 
     {
         errorPopover('#co_pilot', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
         bool = false;
     }
     return bool;
 });
  //  $.ajax({
  //       url: "/pilot_autosuggest",
  //       dataType:"json",
  //       data:{'designation':1,'callsign': $("#callsign").val()},  
  //       success: function(result)
  //       {
  //           $("#pilot" ).autocomplete({
  //               source: result,
  //               selectFirst: true,
  //               minLength: 2,
  //           });
  //       }});
  // $.ajax({
  //       url: "/copilot_autosuggest",
  //       dataType:"json",
  //       data:{'designation':2,'callsign': $("#callsign").val()},  
  //       success: function(result)
  //       {
  //           $("#co_pilot" ).autocomplete({
  //               source: result,
  //               selectFirst: true,
  //               minLength: 2,
  //           });
  //       }});

  $("#pilot").autocomplete({
        minLength: 0,
        source: function (request, response) {
            $.ajax({
                    url: base_url + "/pilot_autosuggest",
                    dataType:"json",
                    data:{'designation':1,'callsign': $("#callsign").val()},  
                    success: function(data)
                    {
                        response(data);
                    }});
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#pilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#pilot").css("border", "red solid 1px");
            } else {
                $('#pilot').popover('destroy');
                $("#pilot").css("border", "lightgrey solid 1px");
            }

        }
    }).click(function () {
        $(this).autocomplete('search', $(this).val());
    });
 $("#co_pilot").autocomplete({
        minLength: 0,
        source: function (request, response) {
            $.ajax({
                    url: base_url + "/copilot_autosuggest",
                    dataType:"json",
                    data:{'designation':2,'callsign': $("#callsign").val()},  
                    success: function(data)
                    {
                        response(data);
                    }});
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#co_pilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#co_pilot").css("border", "red solid 1px");
            } else {
                $('#co_pilot').popover('destroy');
                $("#co_pilot").css("border", "lightgrey solid 1px");
            }

        }
    }).click(function () {
        $(this).autocomplete('search', $(this).val());
    });
