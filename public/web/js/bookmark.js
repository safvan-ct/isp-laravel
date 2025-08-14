// ======== Helpers ======== //
function updateIconState(itemId, type) {
    const bookmarks = JSON.parse(localStorage.getItem("ISPBOOKMARKS") || "{}");
    const bookmarked = Object.values(bookmarks).some((col) =>
        (col[type] || []).includes(itemId)
    );

    updateBookmarkIconState(type, itemId, bookmarked);
}

function updateBookmarkIconState(type, id, bookmarked) {
    $(`.item-card[data-id="${id}"][data-type="${type}"] .bookmark-btn i`)
        .toggleClass("fas", bookmarked) // filled
        .toggleClass("far", !bookmarked); // outline
}

// ======== Main ======== //
$(document).on("click", ".bookmark-btn", function () {
    toastr.clear();
    bookMarkItem = $(this).data("id");
    bookMarkType = $(this).data("type");

    renderCollectionList(bookMarkType, bookMarkItem);
    $("#collectionModal").modal("show");
});

$(document).on("click", ".collection-item", function () {
    toastr.clear();
    saveToCollection($(this).data("name"));
    $("#collectionModal").modal("show");
});

function saveToCollection(collectionName, createCollection = false) {
    toastr.clear();
    const bookmarks = JSON.parse(localStorage.getItem("ISPBOOKMARKS") || "{}");
    const exists =
        bookmarks?.[collectionName]?.[bookMarkType]?.includes(bookMarkItem) ||
        false;

    if (!exists) {
        if (!AUTH_USER) {
        } else {
            bookmarks[collectionName] = bookmarks[collectionName] || {};
            bookmarks[collectionName][bookMarkType] =
                bookmarks[collectionName][bookMarkType] || [];
            bookmarks[collectionName][bookMarkType].push(bookMarkItem);
            localStorage.setItem("ISPBOOKMARKS", JSON.stringify(bookmarks));
        }

        toastr.success(
            `Saved to ${
                collectionName.charAt(0).toUpperCase() + collectionName.slice(1)
            }`
        );
    } else {
        if (createCollection) {
            toastr.success(
                `Saved to ${
                    collectionName.charAt(0).toUpperCase() +
                    collectionName.slice(1)
                }`
            );
            return;
        }

        if (!AUTH_USER) {
        } else {
            bookmarks[collectionName][bookMarkType] = bookmarks[collectionName][
                bookMarkType
            ].filter((id) => id !== bookMarkItem);

            localStorage.setItem("ISPBOOKMARKS", JSON.stringify(bookmarks));
            // toastr.info(`Item removed from ${collectionName}`);
        }
    }

    updateIconState(bookMarkItem, bookMarkType);
    renderCollectionList(bookMarkType, bookMarkItem);
}

function renderCollectionList(type, itemId) {
    const $list = $("#collectionList").empty();
    const bookmarks = JSON.parse(localStorage.getItem("ISPBOOKMARKS") || "{}");
    const names = Object.keys(bookmarks);

    if (!names.length) {
        $list.html(`<p class="text-center text-muted">No collections yet.</p>`);
        return;
    }

    names.forEach((name) => {
        const exists = bookmarks?.[name]?.[type]?.includes(itemId) || false;
        const tick = exists
            ? `<i class="fas fa-check text-success"></i>`
            : `<i class="fa-solid fa-xmark text-danger"></i>`;

        const $li = $(`
            <li class="list-group-item collection-item d-flex justify-content-between align-items-center" style="cursor:pointer;" data-name="${name}">
                <span class="text-capitalize">${name}</span> ${tick}
            </li>
        `);

        $list.append($li);
    });
}

// Create new collection
$("#createCollectionBtn").on("click", function () {
    toastr.clear();
    const newName = $.trim($("#newCollectionName").val()).toLowerCase();
    if (!newName) {
        toastr.error("Please enter a collection name");
        return;
    }

    saveToCollection(newName, true);
    $("#newCollectionName").val("");
});
