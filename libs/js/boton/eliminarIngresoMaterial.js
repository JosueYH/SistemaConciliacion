const botones = document.querySelectorAll(".botonEliminar");//arreglo

botones.forEach(boton=> {
  boton.addEventListener("click",function(){
    //console.log("Hola");
    const id_ingresar_material=this.dataset.idingresomaterial;
    //console.log(id_ingresar_material);
    const confirm=window.confirm("Estas Seguro de Querer Eliminar Este Ingreso Material?"+id_ingresar_material);
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/consultaringresarmaterial/eliminarIngresarMaterial/"+id_ingresar_material,function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud

        //document.querySelector("#respuesta").innerHTML=this.responseText;
        const tbody= document.querySelector("#tbody-material");//tbody id
        const fila = document.querySelector("#fila-"+id_ingresar_material);//tr id

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
