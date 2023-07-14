const botones = document.querySelectorAll(".botonEliminar");//arreglo

botones.forEach(boton=> {
  boton.addEventListener("click",function(){
    /*
    si id_usuario==$id_session{
      loismo...
      httpRequest(info/eliminarCuentaActiva/)
    }
    */
    //console.log("Hola");
    const id_usuario=this.dataset.idusuario;//idusuario tabla
    //const id_session=this.dataset.idsession;//idsession
    //console.log(id_material);

    const confirm=window.confirm("Estas Seguro de Querer Eliminar Este Usuario?"+id_usuario);
    //respuesta
    if (confirm) {
      //solicitud AJAX
      httpRequest("http://localhost/coop/consultarusuario/eliminarUsuario/"+id_usuario,function () {
        //console.log(this.responseText);//devolucion del contenido d ela solicitud

        //document.querySelector("#respuesta").innerHTML=this.responseText;
        const tbody= document.querySelector("#tbody-usuario");//tbody id
        const fila = document.querySelector("#fila-"+id_usuario);//tr id

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
