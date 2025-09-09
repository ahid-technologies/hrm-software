<script data-navigate-once>
    Livewire.on("print", event => {
        let iframe = document.getElementById("printFrame");
        let doc = iframe.contentWindow.document;

        doc.open();
        doc.write(event.html);
        doc.close();

        iframe.onload = function() {
            setTimeout(() => iframe.contentWindow.print(), 500);
        };
    });

    document.addEventListener("DOMContentLoaded", function() {
        NProgress.configure({
            showSpinner: false,
            easing: "ease",
            speed: 500
        });

        NProgress.start();
        window.addEventListener("load", () => NProgress.done());
        window.NProgress = NProgress;
    });

    Livewire.on("success", response => {
        document.querySelectorAll(".modal").forEach(modal => {
            const instance = bootstrap.Modal.getInstance(modal);
            if (instance) instance.hide();
        });

        toastr.success(response.message || "Form submitted successfully!", "Success");
    });

    Livewire.on("error", response => {
        if (Array.isArray(response) && response.length > 0 && response[0].message) {
            try {
                const errorData = JSON.parse(response[0].message);

                if (errorData.message) toastr.error(errorData.message, "Error");

                if (errorData.errors) {
                    Object.keys(errorData.errors).forEach(field => {
                        errorData.errors[field].forEach(errorMsg => toastr.error(errorMsg,
                            "Validation Error"));
                    });
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
                toastr.error("An unexpected error occurred.", "Error");
            }
        } else {
            toastr.error(response.message || "Form submission failed!", "Error");
        }
    });

    Livewire.hook("request", ({
        respond
    }) => {
        let timeout = setTimeout(() => {
            if (!NProgress.isStarted()) NProgress.start();
        }, 500);

        respond(() => {
            clearTimeout(timeout);
            setTimeout(NProgress.done, 200);
        });
    });

    document.addEventListener("livewire:navigated", function() {
        const sidebar = document.getElementById("sidebar");
        const header = document.getElementById("header");
        const contentArea = document.getElementById("content-area");
        const toggleButton = document.getElementById("sidebar-toggle");

        toggleButton?.addEventListener("click", function() {
            const isHidden = sidebar.classList.contains("hidden");

            if (isHidden) {
                sidebar.classList.remove("hidden");
                contentArea.style.marginLeft = "15rem";
                header.style.marginLeft = "15rem";
            } else {
                sidebar.classList.add("hidden");
                contentArea.style.marginLeft = "0";
                header.style.marginLeft = "0";
            }
        });
    });
</script>
