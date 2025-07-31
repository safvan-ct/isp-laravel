function handleShare() {
    const url = window.location.href;
    if (navigator.share) {
        navigator.share({
            title: document.title,
            text: "Check out this page:",
            url: url,
        });
    } else {
        navigator.clipboard
            .writeText(url)
            .then(() => alert("URL copied to clipboard!"))
            .catch(() => alert("Copy failed. Please copy manually."));
    }
}

async function saveData(fs_db, filePath) {
    const res = await fetch(filePath);
    const topics = await res.json();

    for (const topic of topics) {
        const ref = doc(db, fs_db, topic.id.toString());
        await setDoc(ref, topic);
        console.log("✅ Uploaded:", topic.title);
    }
}

async function exportCollectionToJson(collectionName) {
    try {
        const colRef = collection(db, collectionName);
        const snapshot = await getDocs(colRef);
        const data = [];

        snapshot.forEach((doc) => {
            data.push({ id: doc.id, ...doc.data() });
        });

        const jsonStr = JSON.stringify(data, null, 2);

        const blob = new Blob([jsonStr], { type: "application/json" });
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = `${collectionName}.json`;
        a.click();
        URL.revokeObjectURL(url);

        console.log("✅ Exported:", collectionName);
    } catch (err) {
        console.error("❌ Export failed:", err);
    }
}
