/*Remember to use this function name your form anyting_form,
  The response div anything_form_response,
  The button to trigger the submission anything_form_button,
  then onclick of that button submitCall(anything) and watch the magic */
  
function  submitCall(div_id) {
    console.log(div_id);
    event.preventDefault();
    let x = div_id;
    console.log(x)
    if (confirm("Click Cancel to Confirm Values Before Submitting and Click Ok to Submit !!") == true) {
        console.log(x);
        let form_id = "#" + x + "_form";
        console.log(form_id)
        genericAjax(form_id);
    }
};

 function genericAjax(x) {
    var postData = $(x).serializeArray();
    var formURL = $(x).attr("action");
    $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function (data, textStatus, jqXHR) {
            $(x+'_button').hide();
            $(x+'_response').html(data);
            $(x+'_response').focus();
            console.log(data);
        },
        error: function (jqXHR, status, error) {
            alert('Error please try again');
            console.log(status + ": " + error);
        }
    });
}
// this code belongs to dop3ch3f