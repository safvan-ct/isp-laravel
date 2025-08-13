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
        });
    } else {
        const likes = JSON.parse(localStorage.getItem("likes") || "{}");
        likes[type] = likes[type] || [];
        let index = likes[type].indexOf(id);
        let isAdding = index === -1;

        if (isAdding) {
            likes[type].push(id);
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
