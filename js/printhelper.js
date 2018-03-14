function printDiv(div) {
    var printArea = $("#"+div).html();
    var originalArea = $("body").html();
    $("body").html(printArea);
    window.print();
    $("body").html(originalArea);
}