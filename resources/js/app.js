console.log("APP JS BERJALAN");

import Alpine from "alpinejs";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

window.Alpine = Alpine;
Alpine.start();

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

    // ===========================
    // INISIALISASI SEMUA SELECT
    // ===========================
    document.querySelectorAll("select").forEach((select) => {

        if (select.tomselect) return;

        const ts = new TomSelect(select, {
    create: false,
    allowEmptyOption: true,
    copyClassesToDropdown: false,
    hidePlaceholder: true,
    maxOptions: 1000,
    sortField: {
        field: "text",
        direction: "asc",
    },
});

// Saat focus sembunyikan item yang dipilih
ts.on("focus", function () {

    const item = this.control.querySelector(".item");

    if (item) {
        item.style.display = "none";
    }

    this.control_input.placeholder = "Cari...";
});

// Saat blur tampilkan lagi
ts.on("blur", function () {

    const item = this.control.querySelector(".item");

    if (item) {
        item.style.display = "";
    }

});

// Saat memilih item tampilkan lagi
ts.on("change", function () {

    const item = this.control.querySelector(".item");

    if (item) {
        item.style.display = "";
    }

});
        

    });

    // ===========================
    // KHUSUS HALAMAN JADWAL
    // ===========================
    const dokter = document.getElementById("dokter_id");
    const tanggal = document.getElementById("tanggal");
    const infoBox = document.getElementById("hari-praktik-box");
    const infoHari = document.getElementById("hari-praktik");

    if (!dokter || !tanggal) return;

    let picker;

    function getHariPraktik() {

        const option = dokter.options[dokter.selectedIndex];

        if (!option) return [];

        try {
            const hari = JSON.parse(option.dataset.hari);
            return Array.isArray(hari) ? hari : [];
        } catch {
            return [];
        }
    }

    function tampilHari() {

        const hari = getHariPraktik();

        infoBox.classList.remove("hidden");

        infoHari.innerHTML =
            hari.length
                ? hari.join(", ")
                : "Belum diatur";
    }

    function initCalendar() {

        const hariAktif = getHariPraktik().map(h => hariMap[h]);

        if (picker) picker.destroy();

        picker = flatpickr(tanggal, {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [
                (date) => !hariAktif.includes(date.getDay())
            ]
        });

    }

    tampilHari();
    initCalendar();

    dokter.tomselect.settings.placeholder = "Cari dokter...";

    dokter.tomselect.on("change", () => {
        tampilHari();
        initCalendar();
    });

});