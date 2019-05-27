window.addEventListener('DOMContentLoaded', () => {
    //Text inputs
    [
        ["#eventTitel", ".live-view .preview-title"],
        ["#event-details", ".live-view .preview-opening"],
        ["#strasse", "#hNummer", ".live-view .preview-street"],
        ["#plz", "#ort", ".live-view .preview-plz-loc"]
    ].forEach((x) => {
        for(let i = 0; i < x.length - 1; i++) {
            document.querySelector(x[i]).addEventListener('change', () => {
                document.querySelector(x[x.length - 1]).innerHTML = "";
                for (let j = 0; j < x.length - 1; j++)
                    document.querySelector(x[x.length - 1]).innerHTML += " " + document.querySelector(x[j]).value;
            });
        }
    });

    //Date - Timec
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

    //Images
    [
        ["#validatedCustomFile", ".live-view .preview-pic"]
    ].forEach((x) => {
            document.querySelector(x[0]).addEventListener('change', () => {
                if (document.querySelector(x[0]).files && document.querySelector(x[0]).files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => document.querySelector(x[1]).src = e.target.result;
                    reader.readAsDataURL(document.querySelector(x[0]).files[0]);
                }

                document.querySelector(x[0]).innerHTML = document.querySelector(x[1]).value;
            });
    });
});