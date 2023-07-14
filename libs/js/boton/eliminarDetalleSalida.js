const botones = document.querySelectorAll(".botonEliminar");//arreglo

botones.forEach(boton=> {
  boton.addEventListener("click",function(){
    //console.log("Hola");
    const detalle=this.dataset.iddetalle;
    //console.log(detalle);
    const confirm=window.confirm("Estas Seguro de Querer Eliminar Este Ingreso Material?"+detalle);
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/salidamaterial/eliminado/"+detalle,function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud

        //document.querySelector("#respuesta").innerHTML=this.responseText;
        const tbody= document.querySelector("#tbody");//tbody id
        const fila = document.querySelector("#fila-"+detalle);//tr id

        tbody.removeChild(fila);//eliminar visualment el hijo
      });//url que necesito cargar
    }
  })
});

const cancelar = document.querySelectorAll(".botonCancelar");//arreglo

cancelar.forEach(boton=> {
  boton.addEventListener("click",function(){
    //console.log(detalle);
    const confirm=window.confirm("Estas Seguro de Cancelar El Ingreso?");
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/salidamaterial/cancelado",function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud
        tbody.style.display='none';//eliminar visualment el hijo

      });//url que necesito cargar
    }
  })
});
//FUNICON AJAX
function httpRequest(url,callback) {
  const http= new XMLHttpRequest();//nuevo objeto
  http.open("GET",url);//abrir
  http.send();//enviar

  //evento, para mapearlo
  http.onreadystatechange= function() {//funcion asincorna
    if (this.readyState==4 && this.status== 200) {
      //callback
      callback.apply(http);//parametro http
    }
  }
}
