let tbody = document.querySelector("tbody");
let tr = tbody.getElementsByTagName("tr");
let select = document.querySelector("select");
let ul = document.querySelector(".pagination");

let arrayTr = [];

for (let i = 0; i < tr.length; i++) {
  arrayTr.push(tr[i]);
}
select.onchange = rowCount;
function rowCount(e) {
  let neil = ul.querySelectorAll(".list");
  neil.forEach((n) => n.remove());
  let limit = parseInt(e.target.value);
  displayPage(limit);
}
function displayPage(limit) {
  tbody.innerHTML = "";
  buttonGenerator(limit);
  for (let i = 0; i < limit; i++) {
    tbody.appendChild(arrayTr[i]);
  }
}
displayPage(5); //defecto

function buttonGenerator(limit) {
  const nofTr = arrayTr.length;
  if (nofTr <= limit) {
    ul.style.display = "none";
  } else {
    ul.style.display = "flex";
    const nofPage = Math.ceil(nofTr / limit);
    for (i = 1; i < nofPage + 1; i++) {
      let li = document.createElement("li");
      li.className = "list";
      let a = document.createElement("a");
      a.className = "page-link";
      a.href = "#";
      a.setAttribute("data-page", i);
      li.appendChild(a);
      a.innerText = i;
      ul.insertBefore(li, ul.querySelector(".next"));
      a.onclick = (e) => {
        let x = e.target.getAttribute("data-page");
        tbody.innerHTML = "";
        x--;
        let start = limit * x;
        let end = start + limit;
        let page = arrayTr.slice(start, end);
        for (let i = 0; i < page.length; i++) {
          let item = page[i];
          tbody.appendChild(item);
        }
      };
      let nextto = ul.querySelector(".next");
    }
  }
  let z = 0;
  function nextElement() {
    tbody.innerHTML = "";
    if (this.id == "prev") {
      z == 0 ? arrayTr.length - limit : (z -= limit);
    }
    for (let c = z; c < z + limit; c++) {
      tbody.appendChild(arrayTr[c]);
    }
    if (this.id == "next") {
      z == arrayTr.length - limit ? (z = 0) : (z += limit);
    }
  }
  document.getElementById("next").onclick = nextElement;
  document.getElementById("prev").onclick = nextElement;
}
