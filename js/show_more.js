$(document).ready(function () {
    var context = $('#smd');
    context.hide();

    var button = $('#showmore');
    button.click(function () {
        context.show();
    });
});
