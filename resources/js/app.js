import './bootstrap';
import 'flatpickr/dist/flatpickr.min.css'; 
import flatpickr from "flatpickr";
import { Spanish } from "flatpickr/dist/l10n/es.js";

flatpickr(".datepicker", {
    locale: Spanish,
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d/m/Y",
    allowInput: true,
});
