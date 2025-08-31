// Navbar color on scroll
const nav = document.querySelector(".navbar");
const setNav = () => {
    if (window.scrollY > 10) nav.classList.add("scrolled");
    else nav.classList.remove("scrolled");
};
setNav();
window.addEventListener("scroll", setNav);

function toArabicNumber(number) {
    const arabicDigits = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    return String(number)
        .split("")
        .map((d) => arabicDigits[d] || d)
        .join("");
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".ar-number").forEach((span) => {
        const number = span.textContent.trim();
        span.textContent = toArabicNumber(number);
    });
});

//----------------------------------------------------------------
// Play Ayah
//----------------------------------------------------------------
let currentAudio = null;
let currentBtn = null;
let currentCard = null;

async function playAudio() {
    const $btn = $(this);
    const surah = $btn.data("surah");
    const ayah = $btn.data("ayah");
    const $ayahCard = $btn.closest(".card-surface");
    const $icon = $btn.find("i");

    // Toggle pause/resume if same button clicked
    if (currentAudio && currentBtn && currentBtn.is($btn)) {
        if (currentAudio.paused) {
            currentAudio.play();
            $icon.removeClass("far fa-play-circle").addClass("fas fa-pause");
            currentBtn
                .removeClass("btn-outline-success")
                .addClass("btn-success");
            $ayahCard.addClass("playing");
        } else {
            currentAudio.pause();
            $icon.removeClass("fas fa-pause").addClass("far fa-play-circle");
            currentBtn
                .removeClass("btn-success")
                .addClass("btn-outline-success");
            $ayahCard.removeClass("playing");
        }
        return;
    }

    // Stop previous audio if different button clicked
    if (currentAudio) {
        currentAudio.pause();
        currentBtn.removeClass("btn-success").addClass("btn-outline-success");
        currentBtn
            .find("i")
            .removeClass("fas fa-pause")
            .addClass("far fa-play-circle");
        currentCard.removeClass("playing");
        currentAudio = null;
        currentBtn = null;
        currentCard = null;
    }

    try {
        const apiUrl = `https://api.alquran.cloud/v1/ayah/${surah}:${ayah}/ar.alafasy`;
        const response = await fetch(apiUrl);
        const json = await response.json();

        if (json?.data?.audio) {
            const audioUrl = json.data.audio;
            currentAudio = new Audio(audioUrl);
            currentBtn = $btn;
            currentCard = $ayahCard;

            currentAudio.play();
            currentBtn
                .removeClass("btn-outline-success")
                .addClass("btn-success");
            $icon.removeClass("far fa-play-circle").addClass("fas fa-pause");
            $ayahCard.addClass("playing");

            currentAudio.onended = function () {
                currentBtn
                    .removeClass("btn-success")
                    .addClass("btn-outline-success");
                $icon
                    .removeClass("fas fa-pause")
                    .addClass("far fa-play-circle");
                $ayahCard.removeClass("playing");
                currentAudio = null;
                currentBtn = null;
                currentCard = null;
            };
        } else {
            toastr.error("Audio not found for this ayah.");
        }
    } catch (err) {
        console.error(err);
        toastr.error("Error fetching audio.");
    }
}
