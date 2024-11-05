function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
}

function drop(event) {
    event.preventDefault();
    const id = event.dataTransfer.getData("text/plain");
    const draggableElement = document.getElementById(id);
    const dropzone = event.target.closest("tr");

    if (dropzone && dropzone.id !== id) {
        const parent = draggableElement.parentNode;

        // Verifica se o dropzone é uma linha
        if (dropzone.tagName === "TR") {
            // Move o elemento arrastado antes ou depois do dropzone dependendo de onde é solto
            if (event.clientY < dropzone.getBoundingClientRect().top + dropzone.offsetHeight / 2) {
                // Se o mouse está na parte superior do dropzone, insere antes
                parent.insertBefore(draggableElement, dropzone);
            } else {
                // Se o mouse está na parte inferior do dropzone, insere depois
                parent.insertBefore(draggableElement, dropzone.nextSibling);
            }
        }
    }
}