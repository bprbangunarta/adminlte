// slim scroll
$('#box-perizinan').slimScroll({
    height: '300px'
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-permission");
    if (!form) return;

    const submitButton = form.querySelector("#btn-submit");

    // Event: Disable Botton on Submit
    if (submitButton) {
        form.addEventListener("submit", function () {
            submitButton.disabled = true;
            submitButton.innerText = "Menyimpan...";
            submitButton.classList.add("opacity-70", "cursor-not-allowed");
        });
    }
});