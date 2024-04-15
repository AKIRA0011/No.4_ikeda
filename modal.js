window.onload = function () {
  const addModal = document.getElementsByClassName("addModal")[0];
  const addButton = document.getElementsByClassName("addButton")[0];
  const addClose = document.getElementsByClassName("addClose")[0];

  //追加ボタンを押したとき
  addButton.onclick = function () {
    addModal.style.display = "block";
  };

  //×ボタンを押したとき
  addClose.onclick = function () {
    addModal.style.display = "none";
  };

  //モーダルウィンドウ以外を押したとき
  window.onclick = function (event) {
    if (event.target == addModal) {
      addModal.style.display = "none";
    }
  };
};
