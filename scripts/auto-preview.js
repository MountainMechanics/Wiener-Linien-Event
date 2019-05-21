window.addEventListener('DOMContentLoaded', () => {
    //Text inputs
    [
        ["#eventTitel", ".live-view .preview-title"],
        ["#event-details", ".live-view .preview-opening"],
        ["#strasse", ".live-view .preview-street"],
        ["#ort", ".live-view .preview-loc"],
        ["#plz", ".live-view .preview-plz"],
    ].forEach((x) => {
        document.querySelector(x[0]).addEventListener('change', () => {
            document.querySelector(x[1]).innerHTML = document.querySelector(x[0]).value;
        });
    });

    //Date - Time
    [
        ["#pickDate", "#pickBeginTime",".live-view .preview-date-begin"],
        ["#pickDate", "#pickEndTime",".live-view .preview-date-end"]
    ].forEach((x) => {
        [document.querySelector(x[0]), document.querySelector(x[1])].forEach(y => {
            y.addEventListener('change', () => {
                document.querySelector(x[2]).innerHTML = new Date(document.querySelector(x[0]).value + " " + document.querySelector(x[1]).value).toLocaleString();
            });
        });
    });
});