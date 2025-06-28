import $ from 'jquery';
window.$ = window.jQuery = $; // pastikan jQuery global

// Import plugin yg error
import 'jquery-slimscroll';

// Sisa plugin
import 'bootstrap4-duallistbox/dist/bootstrap-duallistbox.min.css';
import 'bootstrap4-duallistbox/dist/jquery.bootstrap-duallistbox.min.js';
import 'bootstrap/dist/js/bootstrap.bundle';
import 'feather-icons';
import 'prismjs';
import 'prismjs/plugins/line-numbers/prism-line-numbers';
import 'apexcharts';
import 'dropzone';
import 'select2';
import 'select2/dist/css/select2.min.css';
// import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css';


// Local JS (pindah dari public ke resources/js/vendor)
import './vendor/main.js';
// import './vendor/feather.js';
import feather from 'feather-icons';
import './vendor/copyButton.js';
import './vendor/sidebarMenu.js';
import './vendor/jqClock.min.js';

// DOM ready
$(function () {
    feather.replace();
    $(".preloader").fadeOut();
    $("#jam").clock({ format: "24", calendar: "true" });

    $('.select2-multiple').select2({
        placeholder: 'Pilih item',
        allowClear: true
    });
});
