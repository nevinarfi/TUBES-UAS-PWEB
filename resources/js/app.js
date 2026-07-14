
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

window.Alpine = Alpine;
Alpine.start();

// Mapping hari Indonesia ke nomor JS
const hariMap = {
    Minggu: 0,
    Senin: 1,
    Selasa: 2,
    Rabu: 3,
    Kamis: 4,
    Jumat: 5,
    Sabtu: 6,
};

document.addEventListener("DOMContentLoaded", () => {

    const dokter = document.getElementById("dokter_id");
    const tanggal = document.getElementById("tanggal");

    if (!dokter || !tanggal) return;

    let picker;

    function initCalendar() {

        const selected =
            dokter.options[dokter.selectedIndex].dataset.hari;

        const hariPraktik = JSON.parse(selected || "[]");

        const hariAktif = hariPraktik.map(h => hariMap[h]);

        if (picker) {
            picker.destroy();
        }

        picker = flatpickr(tanggal, {
            dateFormat: "Y-m-d",
            minDate: "today",

            disable: [
                function(date) {
                    return !hariAktif.includes(date.getDay());
                }
            ]
        });
    }

    initCalendar();

    dokter.addEventListener("change", initCalendar);

});