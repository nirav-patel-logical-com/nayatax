var BSP = function() {
    //Console flag
    var console_log_flag = true;
    return {
        redirect_to: function (url){
            window.location=url;
        },

        redirect_back:function(){
            history.go(-1);
        },
        reload_page:function(){
            location.reload();
        },

        only:function(val,el){
            if(val=="digit"){
                if(document.getElementById(el).value.match(/[^0-9]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^0-9]/g, '');
                }
            }if(val=="int_flot"){
                if(document.getElementById(el).value.match(/[^0-9.]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^0-9]/g, '');
                }
            }else if(val=="alpha"){
                if(document.getElementById(el).value.match(/[^a-zA-Z]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z]/g, '');
                }
            }else if(val=="only_string"){
                if(document.getElementById(el).value.match(/[^a-zA-Z .]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z]/g, '');
                }
            }else if(val=="alpha_digit"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9]/g, '');
                }
            }else if(val=="alpha_digit_space"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 ]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9 ]/g, '');
                }
            }else if(val=="alpha_space"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 ]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z ]/g, '');
                }
            }else if(val=="alpha_digit_space_hifun"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 -]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9 -]/g, '');
                }
            }
        },


        regx:function(elem){
            if(elem == 'mobile'){
                return /^[0-9]{4,12}$/;
            }else if(elem == 'email'){
                return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
            }else if(elem == 'only_alpha'){
                return /^[a-zA-Z]+$/;
            }else if(elem == 'only_digit'){
                return /^[0-9]+$/;
            }else if(elem == 'int_flot'){
                return /^(?=.*\d)\d*(?:\.\d+)?$/;
            }else if(elem == 'only_alpha_number'){
                return /^[a-zA-Z0-9]+$/;
            }else if(elem == 'only_alpha_space'){
                return /^[a-zA-Z ]+$/;
            }else if(elem == 'url'){
                return /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
            }else if(elem == 'number'){
                return /^[0-9]{1,6}$/;
            }else if(elem == 'only_alpha_number_space') {
                return /^[a-zA-Z0-9 ]+$/;
            }else if(elem == 'only_alpha_number_space_hifun') {
                return /^[a-zA-Z0-9 -]+$/;
            }else if(elem == 'only_alpha_number_hifun') {
                return /^[a-zA-Z0-9-]+$/;
            }else if(elem== 'url_general'){
                //return /(https|http|ftp)\:\/\/|([a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4})|([a-z0-9A-Z]+\.[a-zA-Z]{2,4})|\?([a-zA-Z0-9]+[\&\=\#a-z]+)/i;
                return /^((https|http|ftp)\:\/\/|)?([\da-z-]+\.)+([a-z]{2,6})?(\/([a-z0-9+\$_-]\.?)+)*\/?$/
            }else if(elem== 'numeric_3_decimal_point'){
                return /^\d+(\.\d{1,3})?$/;
            }else if(elem== 'numeric_2_decimal_point_with_postfix'){
                return /^\d+(\.\d{1,2})?ct\b$/;
            }else if(elem == 'only_english_cher') {
                return /^[a-zA-Z0-9 !@#%*()_+-=]+$/;
            }else if(elem== 'digit_with_two_decimal'){
                return /^\d+(\.\d{1,2})?$/;
            }else if(elem== 'digit_with_three_decimal'){
                return /^\d+(\.\d{1,3})?$/;
            }else if(elem=='gst_no'){
                return /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            }
        },
        placeApi:function(element,element_city,element_state,element_country,element_place_id){
            var input = /** @type {HTMLInputElement} */(document.getElementById(element));
            /*var options = {
             componentRestrictions: {country: "in"}
             };
             var autocomplete = new google.maps.places.Autocomplete(input,options);*/
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
                /*$("#result").html('');*/
                var types_arr;
                $("#"+element_place_id).val(place.place_id);
                var city='';
                var state='';
                var country='';
                console.log(place);
                $.each(place.address_components, function(index,value){
                    //$("#result").html($("#result").html()+'<label><strong>'+index+'</strong>:&nbsp;&nbsp;</label>'+value+'<br>');
                    /*$.each(this.types,function(index,value){
                     alert(this.index);
                     });*/
                    var locality=0;
                    var administrative_area_level_2=0;
                    var administrative_area_level_1=0;
                    var country=0;
                    //alert(place.place_id);

                    $.each(this.types, function(index,value){
                        //alert(index+' -- '+value);
                        if(value=='locality'){ locality++; return; };
                        if(value=='administrative_area_level_2'){ administrative_area_level_2++; return; };
                        if(value=='administrative_area_level_1'){ administrative_area_level_1++; return; };
                        if(value=='country'){ country++; return; };
                    });

                    if(locality>0){
                        city=this.long_name;
                        $("#"+element_city).val(this.long_name);
                    }else if(administrative_area_level_1>0){
                        state=this.long_name;
                        if(city==''){
                            //$("#"+element_city).val(this.long_name);
                            $("#"+element_city).val('');
                        }
                        $("#"+element_state).val(this.long_name);
                    }else if(country>0){
                        country=this.long_name;
                        if(state==''){
                            //$("#"+element_state).val(this.long_name);
                            $("#"+element_state).val('');
                        }
                        if(city==''){
                            if(state!=''){
                                //$("#"+element_city).val(state);
                                $("#"+element_city).val('');
                            }else{
                                //$("#"+element_city).val(this.long_name);
                                $("#"+element_city).val('');
                            }
                        }

                        $("#"+element_country).val(this.long_name);
                    }else{

                    }
                });
                //alert(JSON.stringify(place));
            });
        },
        scroll_upto_div:function(element_id){
            $("html, body").animate({
                scrollTop: $("#"+element_id).offset().top-180
            }, 600);
        },

        get_page_name:function(url) {
            var index = url.lastIndexOf("/") + 1;
            var filenameWithExtension = url.substr(index);
            var filename = filenameWithExtension.split(".")[0];
            return filename;
        },

        replace_strinng:function(){
        },

        getCookie:function(cname){
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length,c.length);
                }
            }
            return "";
        },
        setTimeOutAlerts:function(){
            setTimeout(function() {
                //$(".alert").css("display", "none");
                $('.alert').each(function () {
                    if($(this).attr('role')=='alert'){
                        $(this).fadeOut();
                    }
                });
            }, 5000);
        },

       // Used for print console data
        console_log : function(console_data)
        {
           if(console_log_flag == true)
           {
              console.log(console_data);
           }
        }
    };
}();