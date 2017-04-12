$( document ).ready(function() {
    $('#eventsPreviousPage').click(function(){
        window.location.href = $("html").attr("ajax_prelink") + "index/" + (Number($("#eventsGrid").attr("pageNum")) - 1);
    });
    $('#eventsNextPage').click(function(){
        window.location.href = $("html").attr("ajax_prelink") + "index/" + (Number($("#eventsGrid").attr("pageNum")) + 1);
    });
});