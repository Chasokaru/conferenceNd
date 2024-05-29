import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.datepicker').forEach( function (item) {
        flatpickr(item, {
            mode: 'range'
        });
    });
});
