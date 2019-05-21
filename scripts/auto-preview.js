window.addEventListener('DOMContentLoaded', () => {
    //Text inputs
    [
        ["#eventTitel", ".live-view .preview-title"],
        ["#email-content", ".live-view .preview-opening"],
    ].forEach((x) => {
        document.querySelector(x[0]).addEventListener('change', () => {
            document.querySelector(x[1]).innerHTML = document.querySelector(x[0]).value;
        });
    });

    //Date - Time
    [
        ["#pickDate", "#pickTime", ".live-view .preview-date-begin"]
    ].forEach((x) => {
        [document.querySelector(x[0]), document.querySelector(x[1])].forEach(y => {
            y.addEventListener('change', () => {
                document.querySelector(x[2]).innerHTML = new Date(document.querySelector(x[0]).value + " " + document.querySelector(x[1]).value).toLocaleString();
            });
        });
    });
});