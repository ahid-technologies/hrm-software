import "@tabler/core/dist/js/tabler.min.js";
// import "./jquery";

// Importing plugins
import ApexCharts from "apexcharts";
import autosize from "autosize";
import { CountUp } from "countup.js";
import flatpickr from "flatpickr";
import IMask from "imask";
import Litepicker from "litepicker";
import noUiSlider from "nouislider";
import NProgress from "nprogress";
import toastr from "toastr";
import TomSelect from "tom-select";

// Making them globally available
window.ApexCharts = ApexCharts;
window.autosize = autosize;
window.CountUp = CountUp;
window.flatpickr = flatpickr;
window.IMask = IMask;
window.Litepicker = Litepicker;
window.noUiSlider = noUiSlider;
window.TomSelect = TomSelect;
window.toastr = toastr;
window.NProgress = NProgress;

import "./custom";
import "./init";
