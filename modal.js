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


  //編集ボタンをモーダルウィンドウで動かす処理
  //複数の編集ボタンから同じモーダルウィンドウを動かすことができなかった。
  // let cntmodal = document.getElementById("cntModal");
  // let cnt = document.getElementsByClassName("cntLink");
  // let cnts = Array.from(cnt);
  // let cntspan = document.getElementsByClassName("cntclose")[0];
  // //編集ボタンを押したとき
  // cnts.forEach(function (cntclick) {
  //   cntclick.addEventListener("click", function () {
  //     cntmodal.style.display = "block";
  //   });
  // });
  // cntspan.onclick = function () {
  //   cntmodal.style.display = "none";
  // };
