// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/*


$(function () {
    $('#pickBeginTime').timepicker();
    $('#pickEndTime').timepicker({
        //useCurrent: false //Important! See issue #1075
    });
    $("#pickBeginTime").on("dp.change", function (e) {
        $('#pickEndTime').data("DateTimePicker").minDate(e.date);
    });
    $("#pickEndTime").on("dp.change", function (e) {
        $('#pickBeginTime').data("DateTimePicker").maxDate(e.date);
    });
});
*/