import './bootstrap';
import * as toastr from 'toastr';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
window.toastr = toastr;
window.toastr.options = {
    "progressBar": false,
    "easing": "swing",
    "easeTime": 50,
    "newestOnTop": true,
    // "progressAnimation":"decreasing",
    "tapToDismiss": true,

};
