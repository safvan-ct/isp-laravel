//----------------------------------------------------------------------------
// Like
//----------------------------------------------------------------------------

$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});

/**
 * Toggle like for a given type & id
 */
function toggleLike(type, id) {
    if (AUTH_USER) {
        if (!LIKE_URL) {
            return;
        }

        $.post(LIKE_URL, { id, type }).done(function (res) {
            let isAdding = res.status === "added";
            updateLikeIconState(type, id, isAdding);
            if (isAdding) showHeartAnimation();
        });
    } else {
        const likes = JSON.parse(localStorage.getItem("likes") || "{}");
        likes[type] = likes[type] || [];
        let index = likes[type].indexOf(id);
        let isAdding = index === -1;

        if (isAdding) {
            likes[type].push(id);
            showHeartAnimation();
        } else {
            likes[type].splice(index, 1);
        }

        localStorage.setItem("likes", JSON.stringify(likes));
        updateLikeIconState(type, id, isAdding);
    }
}

/**
 * Update the heart icon for an item
 */
function updateLikeIconState(type, id, isLiked) {
    $(`.item-card[data-id="${id}"][data-type="${type}"] .like-btn i`)
        .toggleClass("fas", isLiked) // filled
        .toggleClass("far", !isLiked); // outline
}

function showHeartAnimation(themeColor = "#4E2D45") {
    const heart = document.createElement("div");
    // heart.textContent = "❤️";
    heart.innerHTML = `<svg viewBox="0 0 24 24" width="80" height="80" fill="${themeColor}">
        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42
                4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81
                14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4
                6.86-8.55 11.54L12 21.35z"/>
        </svg>`;
    heart.style.position = "fixed";
    heart.style.top = "50%";
    heart.style.left = "50%";
    heart.style.transform = "translate(-50%, -50%) scale(0)";
    heart.style.fontSize = "80px";
    heart.style.color = themeColor;
    heart.style.opacity = "0";
    heart.style.pointerEvents = "none";
    heart.style.transition =
        "transform 0.5s ease, opacity 0.5s ease, top 0.5s ease";

    document.body.appendChild(heart);

    // Force browser to register the initial state
    heart.getBoundingClientRect();

    // Animate in
    heart.style.transform = "translate(-50%, -60%) scale(1.3)";
    heart.style.opacity = "1";

    // Animate out after 0.5s
    setTimeout(() => {
        heart.style.transform = "translate(-50%, -80%) scale(0)";
        heart.style.opacity = "0";
    }, 500);

    // Remove from DOM after animation
    setTimeout(() => heart.remove(), 1000);
}
//----------------------------------------------------------------------------

//----------------------------------------------------------------------------
// Bookmark
//----------------------------------------------------------------------------

//----------------------------------------------------------------------------

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
    const $ayahCard = $btn.closest(".ayah-card");
    const $icon = $btn.find("i");

    // Toggle pause/resume if same button clicked
    if (currentAudio && currentBtn && currentBtn.is($btn)) {
        if (currentAudio.paused) {
            currentAudio.play();
            $icon.removeClass("fa-play").addClass("fa-pause");
            $ayahCard.addClass("playing");
        } else {
            currentAudio.pause();
            $icon.removeClass("fa-pause").addClass("fa-play");
            $ayahCard.removeClass("playing");
        }
        return;
    }

    // Stop previous audio if different button clicked
    if (currentAudio) {
        currentAudio.pause();
        currentBtn.find("i").removeClass("fa-pause").addClass("fa-play");
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
            $icon.removeClass("fa-play").addClass("fa-pause");
            $ayahCard.addClass("playing");

            currentAudio.onended = function () {
                $icon.removeClass("fa-pause").addClass("fa-play");
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
//----------------------------------------------------------------
