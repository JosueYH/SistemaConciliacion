

//  p = document.getElementById('resultado');
  //p.style.display='none';
//inicializamos una funcion con el documento
    (function(document) {
        'use strict';
    //crear una variable que contenga una funcion array
      var funArray = (function(Arr) {
        //dentro estara una variable vacia _input
        var _input;
        //nace una funcion con params
        function _onInputEvent(e) {//es cuando haya una accion o event en el input
        _input = e.target;//se hace un target para el _input
          var tables = document.getElementsByClassName(_input.getAttribute('data-table'));//se trae el atributo data-table
          //que su contenido es order-table
          //hacemos un foreach, y llamamos a las tablas, conuna funcion, y asi mismo llamamos a los bodys y asi a los tr
          Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function (tbody) {
            Arr.forEach.call(tbody.rows, _filter);//al fuinal se busca usar la funcion de _filter, para filtrar
        });
          });
        }
        //la funcion filter va a arecibir los datos de los row o tr...
        function _filter(row) {
        //se guarda el contenido en una var text
          var text = row.textContent.toLowerCase(),
          //al igua que el input se guarda...
          val = _input.value.toLowerCase();
            //y se anade estilo display none es false lo que contiene el text, y si es verdareo conserva la class table-row
          row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
          //alerts.style.display=text.indexOf(val) ===-1 ? 'block' : 'none';
          //p.style.display = text.indexOf(val) === -1 ? 'none' : 'display';

        }
        //returnamos con la funcion->funArray(una funcion, que tendra que recojer los datos constantes del input del buscador
        //y coje el parametro Arr, haciendo el forech, llamamndo al input, con una funcion que llama a ala funcion event
        //si es que se sigue estando en sobre el input la tecla)
        return {
        init: function() {
            var inputs = document.getElementsByClassName('filtrador');
            Arr.forEach.call(inputs, function(input) {
        input.oninput = _onInputEvent;
            });
          }
        };
      })(Array.prototype);//y se usa un protipo de arrauy
      //se anade un evento para escuchar los cambios, con una funcion donde
      document.addEventListener('readystatechange', function() {
        //si el docuemnto esta completo...aremos una funcion array
        if (document.readyState === 'complete') {
        funArray.init();

        }
      });

    })(document);//llamamos un param document
