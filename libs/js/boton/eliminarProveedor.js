const botones = document.querySelectorAll(".botonEliminar");//arreglo

botones.forEach(boton=> {
  boton.addEventListener("click",function(){
    //console.log("Hola");
    const id_proveedor=this.dataset.idproveedor;
    //console.log(id_material);
    const confirm=window.confirm("Estas Seguro de Querer Eliminar Este Proveedor?"+id_proveedor);
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/consultarproveedor/eliminarProveedor/"+id_proveedor,function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud

        //document.querySelector("#respuesta").innerHTML=this.responseText;
        const tbody= document.querySelector("#tbody-proveedor");//tbody id
        const fila = document.querySelector("#fila-"+id_proveedor);//tr id

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
