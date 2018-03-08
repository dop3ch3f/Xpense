function printDiv(div) {
    console.log("function called");
    var printArea = $("#"+div).html();
    var originalArea = $("body").html();
    console.log(printArea,originalArea);
    $("body").html(printArea);
    window.print();
    $("body").html(originalArea);
}