// ======== Helpers ======== //
function saveBookmarkData() {
    localStorage.setItem(
        "bookmarkCollections",
        JSON.stringify(BOOK_MARK_COLLECTIONS)
    );
}

function itemExistsInCollection(collectionName, type, itemId) {
    return (
        BOOK_MARK_COLLECTIONS?.[collectionName]?.[type]?.includes(itemId) ||
        false
    );
}

function updateIconState(itemId, type) {
    const $icon = $(`.learn-item[data-id="${itemId}"] .bookmark-btn i`);
    const bookmarked = Object.values(BOOK_MARK_COLLECTIONS).some((col) =>
        (col[type] || []).includes(itemId)
    );

    $icon.toggleClass("fas", bookmarked).toggleClass("far", !bookmarked);
}

// ======== Main ======== //
$(document).on("click", ".bookmark-btn", function () {
    toastr.clear();
    bookMarkItem = parseInt($(this).data("id"));
    bookMarkType = $(this).data("type");

    openCollectionModal();
});

function openCollectionModal() {
    renderCollectionList();
    $("#collectionModal").modal("show");
}

function renderCollectionList() {
    const $list = $("#collectionList").empty();
    const names = Object.keys(BOOK_MARK_COLLECTIONS);

    if (!names.length) {
        $list.html(`<p class="text-center text-muted">No collections yet.</p>`);
        return;
    }

    names.forEach((name) => {
        const exists = itemExistsInCollection(name, bookMarkType, bookMarkItem);

        const $li = $(`
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="cursor:pointer;">
                <span>${name}</span>
                ${
                    exists
                        ? `<i class="fas fa-check text-success tick-icon"></i>`
                        : ""
                }
            </li>
        `);

        // Toggle add/remove on list click
        $li.on("click", function (e) {
            if (exists) {
                removeFromCollection(name);
            } else {
                saveToCollection(name);
            }

            renderCollectionList(); // Refresh list UI
        });

        $list.append($li);
    });
}

function saveToCollection(collectionName) {
    toastr.clear();
    BOOK_MARK_COLLECTIONS[collectionName] ??= {};
    BOOK_MARK_COLLECTIONS[collectionName][bookMarkType] ??= [];

    if (!itemExistsInCollection(collectionName, bookMarkType, bookMarkItem)) {
        BOOK_MARK_COLLECTIONS[collectionName][bookMarkType].push(bookMarkItem);

        saveBookmarkData();
        // Also save to DB
        updateIconState(bookMarkItem, bookMarkType);
        toastr.success(`Item saved to ${collectionName}`);
        //$("#collectionModal").modal("hide");
    }
}

function removeFromCollection(collectionName) {
    toastr.clear();

    if (!BOOK_MARK_COLLECTIONS?.[collectionName]?.[bookMarkType]) return;

    BOOK_MARK_COLLECTIONS[collectionName][bookMarkType] = BOOK_MARK_COLLECTIONS[
        collectionName
    ][bookMarkType].filter((id) => id !== bookMarkItem);

    saveBookmarkData();
    // Send delete request to backen
    updateIconState(bookMarkItem, bookMarkType);
    toastr.info(`Item removed from ${collectionName}`);
    //$("#collectionModal").modal("hide");
}

// Create new collection
$("#createCollectionBtn").on("click", function () {
    toastr.clear();
    const newName = $.trim($("#newCollectionName").val());

    if (!newName) {
        toastr.error("Please enter a collection name");
        return;
    }

    saveToCollection(newName);
    $("#newCollectionName").val("");
    renderCollectionList();
});

// ======== Like ======== //
$(document).on("click", ".like-btn", function () {
    likeItem.call(this);
});

function likeItem() {
    const itemId = parseInt($(this).data("id"));
    let type = $(this).data("type");

    if (!LIKED_ITEMS[type]) {
        LIKED_ITEMS[type] = [];
    }

    const index = LIKED_ITEMS[type].indexOf(itemId);
    if (index !== -1) {
        LIKED_ITEMS[type].splice(index, 1);

        if (typeof fetchLikes === "function") {
            fetchLikes();
        }
    } else {
        LIKED_ITEMS[type].push(itemId);
    }

    localStorage.setItem("likes", JSON.stringify(LIKED_ITEMS));
    updateLikeIconState(itemId, type);
}
function updateLikeIconState(itemId, type) {
    const $icon = $(`.learn-item[data-id="${itemId}"] .like-btn i`);
    const likedItemsForType = LIKED_ITEMS[type] || [];
    const isLiked = likedItemsForType.includes(itemId);
    $icon.toggleClass("fas", isLiked).toggleClass("far", !isLiked);
}
