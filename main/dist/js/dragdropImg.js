const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("inputImg");
const imgView = document.getElementById("imgView");

inputFile.addEventListener("change", uploadImage);

function uploadImage() {
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imgView.style.backgroundImage = `url(${imgLink})`;
    imgView.textContent = "";
    imgView.border = 0;
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});

dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});
