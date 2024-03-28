document.body.onload = () => {
  objCarrito.getNumItemProductos();
  objCarrito.getItemListPorductos();
}

function addCarrito(data) {
  objCarrito.addItenProducto(data)
}

function deleteCarrito(id_producto) {
  objCarrito.deleteItemProducto(id_producto)
  objCarrito.getNumItemProductos();
  objCarrito.getItemListPorductos();
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
        trItems.push(`
          <tr>
            <td class="contenedor-imagen-y-descripcion-del-producto">
                <figure class="itemside align-items-start">
                    <div class="aside"><img src="../admin/${articulo.ruta_img}" class="aside-img__imagen-del-producto"></div>
                    <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">${articulo.descripcion}</a>
                        <p class="text-muted small">Talla: ${articulo.talla} <br> Color:  ${articulo.color}</p>
                    </figcaption>
                </figure>
            </td>
            <td> 
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select> 
            </td>
            <td>
                <div class="price-wrap"> <var class="price">$${articulo.precio_producto}</var> </div>
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

}