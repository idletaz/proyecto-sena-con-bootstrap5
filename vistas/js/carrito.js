document.body.onload = () => {
  objCarrito.getNumItemProductos();
  objCarrito.getItemListPorductos();
  objCarrito.contPrecioProducto();
  
}

function addCarrito(data) {
  objCarrito.addItenProducto(data)
}

function deleteCarrito(id_producto) {
  objCarrito.deleteItemProducto(id_producto)
  objCarrito.getNumItemProductos();
  objCarrito.getItemListPorductos();
}

function pagarPedido() {
  objCarrito.pagarPedido()
}


let objCarrito = {
  addItenProducto(articulo) {
    let dataStorage = this.getLocalStorage('listCarrito');
    const isFound = this.isFoundArticulo(dataStorage, articulo);
    if (isFound) { return; }
    dataStorage.push(articulo)
    this.setLocalStorage('listCarrito', dataStorage)
    this.contItemsProducto(dataStorage);

  },
  deleteItemProducto(id_producto){
    let dataStorage = this.getLocalStorage('listCarrito');
    let newDataStorage = this.deleteItemObject(dataStorage,id_producto);
    console.log(newDataStorage);

    this.setLocalStorage('listCarrito', newDataStorage)
    location.reload();
  },

  deleteItemObject(dataStorage,id_producto){
    return dataStorage.filter((articulo) => parseInt(articulo.id_producto) !== parseInt(id_producto))
  },
  contItemsProducto(itemProducto) {
    const numItems = Object.keys(itemProducto).length
    document.querySelector('#numeroArticulos').innerHTML = numItems;
  },

  getNumItemProductos() {
    let dataStorage = this.getLocalStorage('listCarrito');
    this.contItemsProducto(dataStorage);
  },
  setLocalStorage(name, data) {
    localStorage.setItem(name, JSON.stringify([...data]));
  },

  getLocalStorage(name) {
    const dataJson = localStorage.getItem(name) ?? '[]';
    const data = JSON.parse(dataJson);
    return data
  },

  isFoundArticulo(listArticulos, articulo) {
    let result = listArticulos.find((i) => parseInt(i.id_producto) === parseInt(articulo.id_producto));
    return result
  },

  getItemListPorductos() {
    let dataStorage = this.getLocalStorage('listCarrito');
    let tblListadoProductos = document.querySelector('#tblListadoProductos');
    let trItems = [];
    if (tblListadoProductos) {
      for (const articulo of dataStorage) {
        let descuentoPorcentaje = articulo.descuento * 100;
        let precioDescuento;
        if (articulo.descuento > 0) {
            precioDescuento = articulo.precio_producto - (articulo.precio_producto * articulo.descuento);
        } else {
            precioDescuento = articulo.precio_producto;
        }
        let descuentoMsg = (descuentoPorcentaje > 0) ? `${descuentoPorcentaje}%` : '<strong style=color:red>No hay descuento</strong>';

        trItems.push(`
          <tr>
            <input type="hidden" id="id_producto" value="${articulo.id_producto}">
            <input type="hidden" id="nombre_producto" value="${articulo.nombre_producto}">
            <input type="hidden" id="talla" value="${articulo.talla}">
            <input type="hidden" id="color" value="${articulo.color}">
            <input type="hidden" id="precio_producto" value="${articulo.precio_producto}">
            <input type="hidden" id="descuento" value="${articulo.descuento}">

            <td class="contenedor-imagen-y-descripcion-del-producto">
                <figure class="itemside align-items-start">
                    <div class="aside"><img src="../admin/${articulo.ruta_img}" class="aside-img__imagen-del-producto"></div>
                    <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">${articulo.nombre_producto}</a>
                        <p class="text-muted small">Talla: ${articulo.talla} <br> Color:  ${articulo.color}
                        <br> <strong style=color:green>Descuento:${descuentoMsg}</strong> </p>
                    </figcaption>
                </figure>
            </td>
            <td> 
                <select class="form-control" id="cantidad">
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                </select> 
            </td>
            <td>
                <div class="price-wrap"> <var class="price">$${precioDescuento}</var> </div>
            </td>
            <td class="text-right d-none d-md-block">
                <a class="btn btn-light" data-abc="true" onclick="deleteCarrito(${articulo.id_producto}) " >Remove</a> 
            </td>
          </tr>`
        )
      }

      tblListadoProductos.innerHTML = trItems;
    }
  },
  pagarPedido() {
// alert("se metio en funcion");

    let nombreTarjeta = document.querySelector("#nombreTarjeta").value
    let numeroTarjeta = document.querySelector("#numeroTarjeta").value
    let detalleFactura = []
    let tblListadoProductos = document.querySelectorAll("#tblListadoProductos tr")

    for (let tr of tblListadoProductos) {
      detalleFactura.push({
        id_producto: tr.children.id_producto.value,
        nombre_producto: tr.children.nombre_producto.value,
        talla: tr.children.talla.value,
        color: tr.children.color.value,
        precio_producto: tr.children.precio_producto.value,
        descuento: tr.children.descuento.value,
        cantidad: tr.querySelector('#cantidad').value,
      })
    }

    let objCarrito = {
      nombreTarjeta,
      numeroTarjeta,
      detalleFactura
    }

    console.log(objCarrito);// esto es lo que debes mandar
  },
  contPrecioProducto() {
    let dataStorage = this.getLocalStorage('listCarrito');
    let Total = document.querySelector('#totalPrecioProductos');  
    let subTotal = document.querySelector('#subTotalProductos');
    let desc = document.querySelector('#descuentos');
    let descuentoPrecio = 0;
    let totalPrecio = 0; 
    let subPrecio=0;    
      for (const articulo in dataStorage) {
        if (dataStorage.hasOwnProperty(articulo)) {
          let precioProducto = parseFloat(dataStorage[articulo].precio_producto);
          let descuento = parseFloat(dataStorage[articulo].descuento);

          if (descuento > 0) {
              let montoDescuento = precioProducto * descuento; 
              let precioConDescuento = precioProducto - montoDescuento; 
              totalPrecio += precioConDescuento * 1.19; 
              descuentoPrecio += montoDescuento;
          } else {
              totalPrecio += precioProducto * 1.19;
          }

          subPrecio += precioProducto;
      }
  }

  subTotal.innerHTML = `$ ${subPrecio.toFixed(2)}`;
  desc.innerHTML = `$- ${descuentoPrecio.toFixed(2)}`; // Muestra el total del descuento
  Total.innerHTML = `$ ${totalPrecio.toFixed(2)}`;
  //console.log(desc);
  //console.log(Total);

  },
  

}