// Initialize plugins
document.addEventListener("livewire:navigated", function () {
    // ✅ 1. Flatpickr - Date Picker
    flatpickr(".flatpickr", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    // ✅ 2. Choices.js - Select Box
    document.querySelectorAll(".choices").forEach((el) => {
        new Choices(el);
    });

    // ✅ 3. TomSelect - Multi-select
    document.querySelectorAll(".tom-select").forEach((el) => {
        new TomSelect(el, {
            plugins: ["remove_button"],
        });
    });

    // ✅ 4. CountUp - Animated Counter
    document.querySelectorAll(".countup").forEach((el) => {
        let countUp = new CountUp(el, el.dataset.count);
        if (!countUp.error) countUp.start();
    });

    // ✅ 5. ApexCharts - Chart Example
    if (document.querySelector("#chart")) {
        let options = {
            chart: {
                type: "line",
                height: 300,
            },
            series: [
                {
                    name: "Sales",
                    data: [10, 20, 15, 25, 30, 40],
                },
            ],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            },
        };
        new ApexCharts(document.querySelector("#chart"), options).render();
    }

    // ✅ 6. NoUiSlider - Range Slider
    document.querySelectorAll(".nouislider").forEach((el) => {
        noUiSlider.create(el, {
            start: [20, 80],
            connect: true,
            range: {
                min: 0,
                max: 100,
            },
        });
    });

    // ✅ 7. Autosize - Expanding Textarea
    autosize(document.querySelectorAll(".autosize"));

    // ✅ 8. IMask - Input Masking (Pakistan Phone Number)
    let maskedInput = document.querySelectorAll(".phone-mask");
    maskedInput.forEach((el) => {
        IMask(el, {
            mask: "0000 0000000",
        });
    });

    // ✅ 9. Advanced select with tom select
    document.querySelectorAll(".search-select").forEach((el) => {
        new TomSelect(el, {
            copyClassesToDropdown: false,
            dropdownParent: "body",
            controlInput: "<input>",
            render: {
                item: function (data, escape) {
                    if (data.customProperties) {
                        return (
                            '<div><span class="dropdown-item-indicator">' +
                            data.customProperties +
                            "</span>" +
                            escape(data.text) +
                            "</div>"
                        );
                    }
                    return "<div>" + escape(data.text) + "</div>";
                },
                option: function (data, escape) {
                    if (data.customProperties) {
                        return (
                            '<div><span class="dropdown-item-indicator">' +
                            data.customProperties +
                            "</span>" +
                            escape(data.text) +
                            "</div>"
                        );
                    }
                    return "<div>" + escape(data.text) + "</div>";
                },
            },
            multiple: true,
        });
    });

    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    NProgress.configure({
        showSpinner: false,
        easing: "ease",
        speed: 500,
    });
});
