const botones = document.querySelectorAll(".botonEliminar");//arreglo

botones.forEach(boton=> {
  boton.addEventListener("click",function(){
    //console.log("Hola");
    const id_socio=this.dataset.idsocio;
    //console.log(id_socio);
    const confirm=window.confirm("Estas Seguro de Querer Eliminar Este Socio?"+id_socio);
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/consultarsocio/eliminarSocio/"+id_socio,function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud

        //document.querySelector("#respuesta").innerHTML=this.responseText;
        const tbody= document.querySelector("#tbody-socio");//tbody id
        const fila = document.querySelector("#fila-"+id_socio);//tr id

        tbody.removeChild(fila);//eliminar visualment el hijo
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
