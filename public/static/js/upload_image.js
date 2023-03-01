function previewFile(file) {
    if (document.getElementById("preImage")) {
        let init_element = document.getElementById("preview");
        while(init_element.firstChild) {
            init_element.removeChild(init_element.firstChild);
        }
        // init_element.parentNode.removeChild(init_element);
    }
    // プレビュー画像を追加する要素
    const preview = document.getElementById('preview');
    // FileReaderオブジェクトを作成
    const reader = new FileReader();

    // ファイルが読み込まれたときに実行する
    reader.onload = function (e) {
        const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
        const img = document.createElement("img"); // img要素を作成
        img.src = imageUrl; // 画像のURLをimg要素にセット
        img.classList.add("p-1");
        img.classList.add("rounded-lg");
        // img.classList.add("w-52");
        // img.classList.add("h-52");
        img.classList.add("col-md-2");
        img.id = "preImage";
        preview.appendChild(img); // #previewの中に追加
    }

    // いざファイルを読み込む
    reader.readAsDataURL(file);
}

// <input>でファイルが選択されたときの処理
const fileInput = document.getElementById('fileImage');
const handleFileSelect = () => {
  const files = fileInput.files;
  for (let i = 0; i < files.length; i++) {
    previewFile(files[i]);
  }
}
fileInput.addEventListener('change', handleFileSelect);
