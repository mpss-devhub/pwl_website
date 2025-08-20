// Tailwind CSS
import '../css/app.css';

// FontAwesome
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import 'flowbite/dist/flowbite.min.js';

document.addEventListener('DOMContentLoaded', () => {
  window.Flowbite.init();
});

// Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// ApexCharts
import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// Axios
import axios from 'axios';
window.axios = axios;

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

import QRCode from "qrcode";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
