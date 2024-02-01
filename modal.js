window.onload = function () {
  let addmodal = document.getElementById("addModal");
  let cntmodal = document.getElementById("cntModal");
  let add = document.getElementById("addButton");
  // let cnt = document.getElementsByClassName("cntLink");
  // let cnts = Array.from(cnt);
  let addspan = document.getElementsByClassName("addclose")[0];
  let cntspan = document.getElementsByClassName("cntclose")[0];

  //追加ボタンを押したとき
  add.onclick = function () {
    addmodal.style.display = "block";
  };
  // //編集ボタンを押したとき
  // cnts.forEach(function (cntclick) {
  //   cntclick.addEventListener("click", function () {
  //     cntmodal.style.display = "block";
  //   });
  // });
  //×ボタンを押したとき
  addspan.onclick = function () {
    addmodal.style.display = "none";
  };
  cntspan.onclick = function () {
    cntmodal.style.display = "none";
  };
  //モーダルウィンドウ以外を押したとき
  window.onclick = function (event) {
    if (event.target == addmodal || event.target == cntmodal) {
      addmodal.style.display = "none";
      cntmodal.style.display = "none";
    }
  };
};
