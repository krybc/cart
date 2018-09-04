import "../../node_modules/jquery/dist/jquery.min";
import "../../node_modules/bootstrap/dist/js/bootstrap.min";

$(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
});