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
    LIKED_ITEMS[type] = LIKED_ITEMS[type] || [];

    let index = LIKED_ITEMS[type].indexOf(id);
    let isAdding = index === -1;

    if (isAdding) {
        LIKED_ITEMS[type].push(id);
    } else {
        LIKED_ITEMS[type].splice(index, 1);
    }

    if (AUTH_USER) {
        sendLikeRequest(id, type, isAdding);
    } else {
        localStorage.setItem("likes", JSON.stringify(LIKED_ITEMS));
    }

    updateLikeIcon(type, id);
}

/**
 * Send like/unlike request to backend
 */
function sendLikeRequest(id, type) {
    if (!LIKE_URL || !AUTH_USER) {
        return;
    }

    $.post(LIKE_URL, { id, type }).done(function (res) {
        let status = res.status;
        if (status === "added" && !LIKED_ITEMS[type].includes(id)) {
            LIKED_ITEMS[type].push(id);
        } else if (status === "removed") {
            LIKED_ITEMS[type] = LIKED_ITEMS[type].filter((item) => item !== id);
        }

        updateLikeIcon(type, id);
    });
}

/**
 * Group likes for authenticated user into type => [ids]
 */
function groupLikesFromAuth(likes) {
    const typeMap = {
        "App\\Models\\QuranVerse": "quran",
        "App\\Models\\HadithVerse": "hadith",
        "App\\Models\\Topic": "topic",
    };

    return likes.reduce((acc, item) => {
        let key = typeMap[item.likeable_type] || item.likeable_type;
        acc[key] = acc[key] || [];
        acc[key].push(item.likeable_id);
        return acc;
    }, {});
}

/**
 * Update the heart icon for an item
 */
function updateLikeIcon(type, id) {
    let isLiked = (LIKED_ITEMS[type] || []).includes(id);

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
