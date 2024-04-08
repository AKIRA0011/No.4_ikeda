window.onload = function () {
  const addmodal = document.getElementById("addModal");
  const add = document.getElementById("addButton");
  const addspan = document.getElementsByClassName("addclose")[0];

  //追加ボタンを押したとき
  add.onclick = function () {
    addmodal.style.display = "block";
  };

  //×ボタンを押したとき
  addspan.onclick = function () {
    addmodal.style.display = "none";
  };

  //モーダルウィンドウ以外を押したとき
  window.onclick = function (event) {
    if (event.target == addmodal || event.target == cntmodal) {
      addmodal.style.display = "none";
      cntmodal.style.display = "none";
    }
  };
};

