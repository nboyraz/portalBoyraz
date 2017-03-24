$( document ).ready(function() {
    $.ajax({
        type:"post",
        url: $("html").attr("ajax_prelink") + "getAjaxDenemeResult/",
        data:{ method_type: "ajax" },//data hata veriyor
        dataType:"json",
        success:function(res){ 
            alert(res); 
        }
    });
});