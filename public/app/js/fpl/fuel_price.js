$(document).ready(function () {
    // $(".pencil_fuel_price,.plus_fuel_price").hover(function(){
    //            if(edt_license==true)
    //             return false
    //             $(this).addClass('hover_red').removeClass('hover_black');
               
    //         }, function(){
    //           if(edt_license==true)
    //             return false
    //         $(this).addClass('hover_black').removeClass('hover_red');
    //     });
   var currentdate = new Date();
       last_month=currentdate.getMonth()-1;
       next_month=currentdate.getMonth()+1;
       currentyear=currentdate.getFullYear();
       if(currentyear==1)
          currentyear1=currentyear+1;
        else
          currentyear1=currentyear;
       
    $(".from_fuel_date").datepicker({ 
         dateFormat: 'd-M-yy',
         minDate: new Date(currentyear,last_month,1), 
         maxDate: new Date(currentyear1,next_month,31),
         onSelect: function(selectedDate) 
         {   
             id="to_date"+$(this).attr('data-fuelid');
             $("#"+id).datepicker('option',{minDate:new Date(selectedDate)});  
                setTimeout(function(){
                    $("#"+id).datepicker("show");
                    
                }, 16);
             //$(".notify-bg-v").fadeOut();
         }
     });
    $(".to_fuel_date" ).datepicker({ 
         dateFormat: 'd-M-yy',
         minDate: new Date(currentyear,last_month,1), 
         maxDate: new Date(currentyear1,next_month,31),
         onSelect: function(selectedDate) 
         {   
             console.log($(this).parent().parent().find("#to_date").val());
             $(".notify-bg-v").fadeOut();
         }
     });
    // $('.tax_decimal').blur(function(e){
    //     var val=$(this).val();
    //     if (val.indexOf('.') == -1 && val!="" && val.length<4)
    //     {  
    //             $(this).val($(this).val()+'.00');
    //     }
    //  });
    // $('.decimal').blur(function(e){
    //     var val=$(this).val();
    //     if (val.indexOf('.') == -1 && val!="" && val.length<7)
    //     {  
    //             $(this).val($(this).val()+'.00');
    //     }
    //  });
     $("#to,#fuelto_date").datepicker({ 
           showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
     });  
     $("#fuelfrom_date").datepicker({  
         dateFormat: 'd-M-yy',
         minDate: new Date(currentyear,last_month,1), 
         maxDate: new Date(currentyear1,next_month,31),
         showMonthAfterYear: true,
         closeText: 'Clear',
         onSelect: function(selectedDate) 
         { 
           
           closePopover('#fuelfrom_date');
           closePopover('#fuelto_date');
           $("#fuelfrom_date").css({"border-color": "#C1E0FF", 
             "border-weight":"1px"});
           if($("#fuelto").val()!="")
            $(".notify-bg-v").fadeOut();
        }
      });
     $("#frm").datepicker({  
        dateFormat: 'd-M-yy',
        changeMonth: true,
        changeYear: true,
        closeText: 'Clear',
        onSelect: function(selectedDate) 
        { 
           if($("#to").val()!="")
           {
            $(".notify-bg-v").fadeOut();
            }
        }
      });
     $('#frm,#fuelfrom_date').focusin(function(){  
         if($(this).val()=="")
           $(this).addClass('focusin');
          else
           $(this).removeClass('focusin');  
       });
     $('#frm,#fuelfrom_date').focusout(function(){  
          $(this).removeClass('focusin');  
       });
      $("#frm,#fuelfrom_date").click(function() {  
        
        $(this).focus();
      });
      $("#fuelto_date").bind("click focus", function() {
        
        $($(this).data("date-range-start")).click();
        
      });
      $("#to").bind("click focus", function() {
        $($(this).data("date-range-start")).click();
        
      });
        $("[data-toggle = 'popover']").popover({
             html: true,
             trigger: "manual"
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
         $.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
         {
             return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
                 return $('input', td).val() * 1;
             } );
         }
        $('#fuelpricelist').DataTable({
            
            "pageLength":15,
            "lengthChange": false,
            "aaSorting": [],
            "searching": false,
            "bInfo" : false,
            "processing": true,
            "dom": '<"top"flp<"clear">>',
            "aoColumns":[
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": true},
                // {
                //     "orderDataType": "dom-text-numeric",  
                //     "bSortable": true
                // },
                {"bSortable": true},
                {   
                    "orderDataType": "dom-text-numeric",  
                    "bSortable": true
                },
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                    
                ]
        });
        $(document).on("keypress",".alphabets",function(e)
        {
               if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
               return true;
               else
               return false; 
        });
        $(document).on("keypress",".alphabets_with_space",function(e)     
        {
                if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
                return true;
                else
                return false; 
        });
        $(document).on("keypress",".numbers_decimal",function(e)     
          {
        
              if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <46) || (e.charCode ==47) ||(e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
              return false;
              else
              return true;    
           });       
        $('#airport_code').keypress(function() 
        {
            if($(this).val().length >= 4) 
              return false;
        });
        $("#airport_code").on('keyup', function () 
        {
             if($(this).val().length == 4)
             { 
                $('#city').focus();  
                closePopover('#airport_code');
             }  
        });  
        $("#city").on('keyup', function () 
        {
             if($(this).val().length >1) 
                closePopover('#city');
        });
        edt_license=false;
        $(document).on("click",".Add_row_fuel",function()
        {   
            $('#addfuelprice')[0].reset();
            $("#fuel-city").val($(this).attr('data-city'));
            $("#fuel-aerocode").val($(this).attr('data-aerocode'));
            $("#fuel-type").val($(this).attr('data-fuel_type'));
            $("#fueltax").val($(this).attr('data-tax'));
            $("#fuel_price_heading").html($(this).attr('data-aerocode')+' - '+$(this).attr('data-city')+" ");
            closePopover('#fueleflightprice');
            closePopover('#fuelbasicprice');
            closePopover('#fueltax');
            closePopover('#fuelfrom_date');
            closePopover('#fuelto_date');
        });    
        $("#add-fuel-airport").click(function(){
             $('#add-airport')[0].reset();
             closePopover('#airport_code');
             closePopover('#city');
        });
        $('body').on('click','.e_price_popover,.b_price_popover',function(){
         $(this).select();     
        })
        $("#bp_hp").submit(function(event){
           if(edt_license==true){
         event.preventDefault();
            
                checksave();
                return false
            }
        });
        $(document).on("click",".edit_license",function()
        {

            if(edt_license==true){
                // $(".hover").removeClass('hide');
                checksave();
            }
            if(edt_license==false){
              edt_license=true;
              $('.paginate_button').addClass('disable');    
            $("#edit_fuel").css('display','none');
            $("#succ_msg").html("");
            var id='record_'+$(this).attr('data-fuelid');

            $(this).parents().find("#"+id).addClass('edit_record');
            // $(this).parent().parent().parent().find('#eflght_price,#basic_price').select();
            $(this).parent().parent().find(".Add_row_fuel").css('display','none');
            $(this).parent().parent().find(".viewhistory").css('display','none');
            $(this).parent().parent().parent().find('.edit').prop("disabled",false);
            $(this).parent().parent().parent().find('.editrow').addClass("coloraddEditable");;
            $(this).parent().parent().parent().find('.from_fuel_date,.to_fuel_date').prop("disabled", false).prop("readonly", true).addClass('white');
            $(this).css("display", "none")
            $(this).parent().parent().find('.saverecord').css("display","inline-block");
            $(".hover").addClass('hide');
            $('.edit_license,.viewhistory,.Add_row_fuel').addClass('hide');
            // $('.pencil_fuel_price').unbind('mouseenter mouseleave');

            }
          });
        // $(document).on("keyup",".e_price_popover",function() {
        //     if($(this).val().length >0){   
        //         $(".e_price_popover").popover('destroy');
        //      }  
        // }); 
        $(document).on("keyup",".b_price_popover",function() {
            if($(this).val().length >0){   
                $(".b_price_popover").popover('destroy');
             }  
        }); 
        $(document).on("keyup",".tax_decimal",function() {
            if($(this).val().length >0){   
                $(".tax_decimal").popover('destroy');
             }  
        }); 
        // $("#fueleflightprice").on('keyup', function () 
        // {   
        //     if($(this).val().length >0)
        //      {   
        //         closePopover('#fueleflightprice');
        //      }  
        // }); 
        $("#fuelbasicprice").on('keyup', function () 
        {   
            if($(this).val().length >0)
             {   
                closePopover('#fuelbasicprice');
             }  
        }); 
        $("#fueltax").on('keyup', function () 
        {   
            if($(this).val().length >0)
             {   
                closePopover('#fueltax');
             }  
        }); 
        $("#addfuelprice").submit(function(event){
            
            event.preventDefault();
            var bool = true;
            // var fueleflightprice=$("#fueleflightprice").val();
            var fuelbasicprice=$("#fuelbasicprice").val();
            //var split_fueleflightprice = String(fueleflightprice).split(".");
            var split_fuelbasicprice = String(fuelbasicprice).split(".");
           

            // if ($("#fueleflightprice").val()=="" ) {
            //     errorPopover('#fueleflightprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
            //     bool = false;
            // }
            // else if($("#fueleflightprice").val().length<5 || $("#fueleflightprice").val().length>5){
            //     errorPopover('#fueleflightprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
            //     bool = false;
            // }
            // else if(split_fueleflightprice[0].length<5 || split_fueleflightprice[0].length>5){
            //     errorPopover('#fueleflightprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
            //     bool = false;
            // }
            // else if(($("#fueleflightprice").val()< $("#fuelbasicprice").val())){
            //     errorPopover('#fueleflightprice', 'INVALID EFIGHT PRICE ');
            //     bool = false;
            // }

            if ($("#fuelbasicprice").val() =="") {
                errorPopover('#fuelbasicprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
                bool = false;
            }
            else if($("#fuelbasicprice").val().length<5 || $("#fuelbasicprice").val().length>5){
                errorPopover('#fuelbasicprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
                bool = false;
            }
            // else if(split_fuelbasicprice[0].length<4 || split_fuelbasicprice[0].length>5){
            //     errorPopover('#fuelbasicprice', 'PLEASE ENTER MIN 5 & MAX 5 DIGITS');
            //     bool = false;
            // }
            if ($("#fueltax").val() =="") {
                errorPopover('#fueltax', 'MIN 1 & MAX 2 DIGITS BEFORE DECIMAL');
                bool = false;
            }
            else if($("#fueltax").val()>100)
            {
                errorPopover('#fueltax', 'MIN 1 & MAX 2 DIGITS BEFORE DECIMAL');
                bool = false;
            }
            if ($("#fuelfrom_date").val() =="" ) {
                errorPopover('#fuelfrom_date', 'FROM DATE REQUIRED');
                bool = false;
            }
            if ($("#fuelto_date").val() =="" ) {
                errorPopover('#fuelto_date', 'TO DATE REQUIRED');
                bool = false;
            }
             if(bool==false)
                return false;
            var substrtax = $("#fueltax").val().split('.');
            // var substreflight_price = $("#fueleflightprice").val().split('.');
            var substrbasic_price = $("#fuelbasicprice").val().split('.');
            if(substrtax[1]=="")
             {
                $("#fueltax").val($("#fueltax").val()+"00");
             }
             // if(substreflight_price[1]=="")
             // {
             //    $("#fueleflightprice").val($("#fueleflightprice").val()+"00");
             // }
             if(substrbasic_price[1]=="")
             {
                $("#fuelbasicprice").val($("#fuelbasicprice").val()+"00");
             }
            $.ajax({
                context : this,  
                type: "POST",  
                url: $(this).attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                dataType:"json",
                data:$(this).serialize(),
                success: function(result) {
                    if(result.success==false){
                         $.each(result.message, function(key,value){
                          errorPopover('#fuel'+key,value);
                        });
                    }
                    if(result.success==true){
                       location.reload();
                    }
                }
              });
        });
        // $("#fueltax").keyup(function(event)
        // {
        //   var fueltax_length=$(this).val().length;
        //   if(fueltax_length==2 && event.keyCode!=8)
        //   {
        //     var fueltax=$(this).val().substring(0,2)+'.';
        //      $(this).val(fueltax);
        //      $(this).focus();
        //   }
        //    if(fueltax_length==5)
        //    {
        //     $("#fuelfrom").focus();
        //    }
        // });
        // $(document).on("keyup",".edit_decimal",function()    
        // {
        //   var fueltax_length=$(this).val().length;
        //   console.log(fueltax_length);
        //   if(fueltax_length==2 && event.keyCode!=8)
        //   {
        //     var fueltax=$(this).val().substring(0,2)+'.';
        //      $(this).val(fueltax);
        //      // $(this).focus();
        //   }
        // });
        $('.dataTables_paginate').click(function(e){
            checksave();
        });
        function checksave()
        {
            if(edt_license==true){
            $.confirm({
                title: 'Confirm!',
                content: 'Would you like to exit without saving?',
                buttons: {
                     Yes:{
                             text: 'YES',
                             btnClass: 'btn-black',
                             action: function(){
                                //$(".hover").removeClass('hide');
                                $('.edit_license,.viewhistory,.Add_row_fuel').removeClass('hide');
                                clear();
                            }

                         } ,
                    save: {
                              text: 'SAVE',
                              btnClass: 'btn-red',
                              action: function(){
                                    //$(".hover").removeClass('hide');
                                    $('.edit_license,.viewhistory,.Add_row_fuel').removeClass('hide');
                                    save();
                                }
                          }
                   
                }
            });

           }
        }
        function save()
        {
            //$('.paginate_button').removeClass('disable');
             // $(".hover").removeClass('hide');
            $('.pencil_fuel_price').bind('mouseenter mouseleave');
            var edit_record_id=$('body').find('.edit_record').attr('id');
            var id=edit_record_id.substr(7);
            var code=$("#"+edit_record_id).find('#aero_code').html();
            var city=$("#"+edit_record_id).find('#aero_city').html();
            // var eflight_price=$("#"+edit_record_id).find('#eflght_price').val();
            var basic_price=$("#"+edit_record_id).find('#basic_price').val();
            var tax=$("#"+edit_record_id).find('#tax').val();
            var split_tax = String(tax).split(".");
            // var split_eflightprice = String(eflight_price).split(".");
            var split_basicprice = String(basic_price).split(".");
            var tax=$("#"+edit_record_id).find('#tax').val();
            var from_date=$("#"+edit_record_id).find('.from_fuel_date').val();
            var to_date=$("#"+edit_record_id).find('.to_fuel_date').val();
            var fuelid=$(this).attr('data-fuelid');
            // console.log('code='+code+'&city='+city+'&eflight_price='+eflight_price+'&basic_price='+basic_price+'&tax='+tax+'&from_date='+from_date+'&to_date'+to_date)
            //var id='record_'+fuelid;
            var bool = true;
             // if (eflight_price=="") {
             //     $($("#"+edit_record_id).find('#eflght_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
             //     $($("#"+edit_record_id).find('#eflght_price')).popover('show');
             //     $("#"+edit_record_id).find('#eflght_price').focus();
             //     bool = false;
             // }
             // else if(eflight_price.length<5 || eflight_price.length>5){
             //    $($("#"+edit_record_id).find('#eflght_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
             //    $($("#"+edit_record_id).find('#eflght_price')).popover('show');
             //    $("#"+edit_record_id).find('#eflght_price').focus();
             //    bool = false;
             // }
             if (basic_price=="") {
                  $($("#"+edit_record_id).find('#basic_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
                  $($("#"+edit_record_id).find('#basic_price')).popover('show');
                  $("#"+edit_record_id).find('#basic_price').focus();
                 bool = false;
             }
              else if(basic_price.length<5 ||basic_price.length>5){
                 $($("#"+edit_record_id).find('#basic_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
                 $($("#"+edit_record_id).find('#basic_price')).popover('show');
                 $("#"+edit_record_id).find('#basic_price').focus();
                 bool = false;
             }
             else if (tax=="" ||tax>100) {
                 $($("#"+edit_record_id).find('#tax')).attr('data-content', "MIN 1 & MAX 2 DIGITS BEFORE DECIMAL");
                 $($("#"+edit_record_id).find('#tax')).popover('show');
                 $("#"+edit_record_id).find('#tax').val('').focus();
                 bool = false;
             }
             else if (from_date=="") {
                $("#"+edit_record_id).find('.from_fuel_date').focus();
                 bool = false;
             }
             else if (to_date=="") {
                 $("#"+edit_record_id).find('.to_fuel_date').focus();
                 bool = false;
             }
             if(bool==false)
                 return false;
              //$(this).parents().find("#"+id).removeClass('edit_record');
             var substrtax = tax.split('.');
             // var substreflight_price = eflight_price.split('.');
             var substrbasic_price = basic_price.split('.');
             if(substrtax[1]==""){
                 $("#"+edit_record_id).find('#tax').val(tax+"00");
              }
             // if(substreflight_price[1]==""){
             //     $("#"+edit_record_id).find('#eflght_price').val(eflight_price+"00");
             //  }
              if(substrbasic_price[1]==""){
                 $("#"+edit_record_id).find('#basic_price').val(basic_price+"00");
              }
               $.ajax({
                context : this,  
                type: "POST",  
                url: '/fpl/fuelprice/update-fuelprice',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                dataType:"json",
                data:{'basic_price':basic_price,'tax':tax,'from_date':from_date,'to_date':to_date,'id':id,'airport_code':code,'city':city},  
                success: function(result) {

                   if(result.success==false){
                       $("#"+edit_record_id).find('.from_fuel_date,.to_fuel_date').val('');
                   }
                    if(result.success==true){
                        edt_license=false;
                         $("#"+edit_record_id).removeClass('edit_record');
                         $('.paginate_button').removeClass('disable');
                         $("#"+edit_record_id).find('#basic_price').attr('data-value',basic_price);
                         $("#"+edit_record_id).find('#tax').attr('data-value',tax);
                         $("#"+edit_record_id).find('.from_fuel_date').attr('data-value',from_date);
                         $("#"+edit_record_id).find('.to_fuel_date').attr('data-value',to_date);
                         $("#"+edit_record_id).find(".Add_row_fuel").css('display','inline-block');
                         $("#"+edit_record_id).find(".viewhistory").css('display','inline-block');
                         $("#"+edit_record_id).find('.edit').prop("disabled",true);
                         $("#"+edit_record_id).find('.editrow').attr("contentEditable", "false").removeClass("coloraddEditable");
                         $("#"+edit_record_id).find('.saverecord').css("display", "none");
                         $("#"+edit_record_id).find('.edit_license').css("display", "inline-block");
                         $("#"+edit_record_id).find('.Add_row_fuel,.viewhistory').css('display','inline-block');
                         $("#"+edit_record_id).find('.from_fuel_date,.to_fuel_date').prop("disabled", true).removeClass('white');
                         // $("#msg_code").html(code);
                         // $("#msg_city").html(city);
                         // $("#edit_fuel").css('display','block');
                         $('.edit_license,.viewhistory,.Add_row_fuel').removeClass('hide');
                         $.growl({ title:'',location:'tc',size:'large', message: code+'-'+city+' FUEL PRICE UPDATED SUCCESSFULLY'});
                         if(result.data.tax_amount !="")
                          $("#"+edit_record_id).find('#tax_amount').html(Math.round(result.data.tax_amount));
                         if(result.data.hp_price !="")
                          $("#"+edit_record_id).find('#hp_price').html(Math.round(result.data.hp_price));
                          $("#"+edit_record_id).find('.edit').prop("disabled",true).removeClass("coloraddEditable");
                    }
                }
              });


        }
        function clear(){
            edt_license=false;
            $('.paginate_button').removeClass('disable');
            var edit_record_id=$('body').find('.edit_record').attr('id');
            var id=edit_record_id.substr(7);
            // $("#"+edit_record_id).find('#eflght_price').val($("#"+edit_record_id).find('#eflght_price').attr('data-value'));
            $("#"+edit_record_id).find('#basic_price').val($("#"+edit_record_id).find('#basic_price').attr('data-value'));
            $("#"+edit_record_id).find('.from_fuel_date').val($("#"+edit_record_id).find('.from_fuel_date').attr('data-value'));
            $("#"+edit_record_id).find('#tax').val($("#"+edit_record_id).find('#tax').attr('data-value'));
            $("#"+edit_record_id).find('.to_fuel_date').val($("#"+edit_record_id).find('.to_fuel_date').attr('data-value'));
            $("#"+edit_record_id).find('.edit_license,.Add_row_fuel,.viewhistory').css("display", "inline-block");
            $("#"+edit_record_id).find('.saverecord').css("display", "none");
            $("#"+edit_record_id).find('.edit').prop("disabled",true);
            $("#"+edit_record_id).find('.editrow').attr("contentEditable", "false").removeClass("coloraddEditable");
            $("#"+edit_record_id).find('.from_fuel_date,.to_fuel_date').prop("disabled", true).removeClass('white');
            $("#"+edit_record_id).find('.edit').prop("disabled",true).removeClass("coloraddEditable");
            $("#"+edit_record_id).removeClass('edit_record');


        }
        $(document).on("click",".saverecord",function()
        {
            edt_license=false;
            $(".hover").removeClass('hide');
            $(".pencil_fuel_price").bind("mouseenter mouseleave");
            $('.paginate_button').removeClass('disable');
            var code=$(this).parent().parent().siblings('#aero_code').html();
            var city=$(this).parent().parent().siblings('#aero_city').html();
            // var eflight_price=$(this).parent().parent().parent().find('#eflght_price').val();
            var basic_price=$(this).parent().parent().parent().find('#basic_price').val();
            var tax=$(this).parent().parent().parent().find('#tax').val();

            var split_tax = String(tax).split(".");
            // var split_eflightprice = String(eflight_price).split(".");
            var split_basicprice = String(basic_price).split(".");
            var tax=$(this).parent().parent().parent().find('#tax').val();
            var from_date=$(this).parent().parent().parent().find('.from_fuel_date').val();
            var to_date=$(this).parent().parent().parent().find('.to_fuel_date').val();
            var fuelid=$(this).attr('data-fuelid');
            var id='record_'+fuelid;

            
            var bool = true;
             // if (eflight_price=="") {
             //     $($(this).parent().parent().parent().find('#eflght_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
             //     $($(this).parent().parent().parent().find('#eflght_price')).popover('show');
             //     $(this).parent().parent().parent().find('#eflght_price').focus();
             //     bool = false;
             // }
             // else if(eflight_price.length<5 || eflight_price.length>5){
             //    $($(this).parent().parent().parent().find('#eflght_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
             //    $($(this).parent().parent().parent().find('#eflght_price')).popover('show');
             //    $(this).parent().parent().parent().find('#eflght_price').focus();
             //    bool = false;
             // }
             if (basic_price=="") {
                  $($(this).parent().parent().parent().find('#basic_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
                  $($(this).parent().parent().parent().find('#basic_price')).popover('show');
                  $(this).parent().parent().parent().find('#basic_price').focus();
                 bool = false;
             }
              else if(basic_price.length<5 ||basic_price.length>5){
                 $($(this).parent().parent().parent().find('#basic_price')).attr('data-content', "PLEASE ENTER MIN 5 & MAX 5 DIGITS");
                 $($(this).parent().parent().parent().find('#basic_price')).popover('show');
                 $(this).parent().parent().parent().find('#basic_price').focus();
                 bool = false;
             }
             else if (tax=="" ||tax>100) {
                 $($(this).parent().parent().parent().find('#tax')).attr('data-content', "MIN 1 & MAX 2 DIGITS BEFORE DECIMAL");
                 $($(this).parent().parent().parent().find('#tax')).popover('show');
                 $(this).parent().parent().parent().find('#tax').val('').focus();
                 bool = false;
             }
             else if (from_date=="") {
                $(this).parent().parent().parent().find('.from_fuel_date').focus();
                 bool = false;
             }
             else if (to_date=="") {
                 to_date=$(this).parent().parent().siblings().find('.to_fuel_date').focus();
                 bool = false;
             }
            if(bool==false)
                 return false;  
             $(this).parents().find("#"+id).removeClass('edit_record');
            var substrtax = tax.split('.');
            // var substreflight_price = eflight_price.split('.');
            var substrbasic_price = basic_price.split('.');
            if(substrtax[1]==""){
                $(this).parent().parent().parent().find('#tax').val(tax+"00");
             }
            // if(substreflight_price[1]==""){
            //     $(this).parent().parent().parent().find('#eflght_price').val(eflight_price+"00");
            //  }
             if(substrbasic_price[1]==""){
                $(this).parent().parent().parent().find('#basic_price').val(basic_price+"00");
             }

                $.ajax({
                 context : this,  
                 type: "POST",  
                 url: '/fpl/fuelprice/update-fuelprice',
                 headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                 dataType:"json",
                 data:{'basic_price':basic_price,'tax':tax,'from_date':from_date,'to_date':to_date,'id':fuelid,'airport_code':code,'city':city},  
                 success: function(result) {
                    if(result.success==false){
                        $(this).parent().parent().parent().find('.from_fuel_date,.to_fuel_date').val('');
                    }
                     if(result.success==true){
                        
                          // $(this).parent().parent().parent().find('#eflght_price').attr('data-value',eflight_price);
                          $(this).parent().parent().parent().find('#basic_price').attr('data-value',basic_price);
                          $(this).parent().parent().parent().find('#tax').attr('data-value',tax);
                          $(this).parent().parent().parent().find('.from_fuel_date').attr('data-value',from_date);
                          $(this).parent().parent().parent().find('.to_fuel_date').attr('data-value',to_date);
                          $(this).parent().parent().find(".Add_row_fuel").css('display','inline-block');
                          $(this).parent().parent().find(".viewhistory").css('display','inline-block');
                          $(this).parent().parent().parent().find('.edit').prop("disabled",true);
                          $(this).parent().parent().siblings('.editrow').attr("contentEditable", "false").removeClass("coloraddEditable");
                          $(this).css("display", "none");
                          $(this).parent().parent().find('.edit_license').css("display", "inline-block");
                          $(this).parent().next().css('display','inline-block');
                          $(this).parent().parent().parent().find('.from_fuel_date,.to_fuel_date').prop("disabled", true).removeClass('white');
                          // $("#msg_code").html(code);
                          // $("#msg_city").html(city);
                          // $("#edit_fuel").css('display','block');
                           $('.edit_license,.viewhistory,.Add_row_fuel').removeClass('hide');
                          $.growl({ title:'',location:'tc',size:'large', message: code+'-'+city+' FUEL PRICE UPDATED SUCCESSFULLY'});
                          if(result.data.tax_amount !="")
                          $(this).parent().parent().parent().find('#tax_amount').html(Math.round(result.data.tax_amount));
                          if(result.data.hp_price !="")
                          $(this).parent().parent().parent().find('#hp_price').html(Math.round(result.data.hp_price));
                          $(this).parent().parent().parent().find('.edit').prop("disabled",true).removeClass("coloraddEditable");
                     }
                 }
               });
              
        });
        $(document).on("click",".viewhistory",function()
        {   $("#fuel_info_tbody").empty();
            var fuelid=$(this).attr('data-fuelid');

            viewhistory(fuelid)
        });    
        function viewhistory(fuelid)
        {

          $('#fuel_info').DataTable( {
                     destroy: true,   
                    "serverSide": true,
                    "pageLength":10,
                    "lengthChange": false,
                    "aaSorting": [],
                    "searching": false,
                    "bInfo" : false,
                    "dom": '<"top"flp<"clear">>',
                    "aoColumns":[
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    // {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},
                    {"bSortable": false},   
                ],
                 "ajax":"/fpl/fuelprice/viewhistory?fuelid="+fuelid,
            });
        }
        $('[data-toggle="popover"]').popover();
        $(".ui-datepicker-trigger,#frm,#to").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
        $('body').on('click','.from_fuel_date,.to_fuel_date',function(){ 
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
        $("#add-airport").submit(function(event){
             event.preventDefault();
             var bool = true;
             if ($("#airport_code").val()=="" || $("#airport_code").val().length<4) {
                 errorPopover('#airport_code', 'Airport Codes (Min. & Max. 4)');
                 bool = false;
             }
             if ($("#city").val() =="" ) {
                 errorPopover('#city', 'City is Required');
                 bool = false;
             }
              if(bool==false)
                 return false;
             $.ajax({
                 context : this,  
                 type: "POST",  
                 url: $(this).attr('action'),
                 headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                 dataType:"json",
                 data:$(this).serialize(),
                 success: function(result) {
                     if(result.success==false){
                          $.each(result.message, function(key,value){
                           errorPopover('#'+key,value);
                         });
                     }
                     if(result.success==true){
                        location.replace(location.href)
                     }
                 }
               });
        });
        $("#fuel_search").submit(function(){
            if($("#aero").val()==""||$("#aero").val().length<=3)
            { 
              if ($("#aero").val() =="") {
                  errorPopover('#aero', 'MIN 3 & MAX 3 Character');
                  bool = false;
              }   
              return false;
            }
        })
        $.ajax({
        url: '/fpl/fuelprice/autosuggest',
        dataType:"json",  
        success: function(result)
        {
            $("#aero" ).autocomplete({
                source: result,
                selectFirst: true,
                minLength: 3,
                select: function (event, ui) 
                {
                    console.log(ui);
                    closePopover("#aero");
                    $("#aero_code").css('border','1px solid #999');
                   

                }
            });
        }});
    });
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });
    $("#v_toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
    });