@extends('layouts.layout')


@section('content')
<div class="m-5">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalagregar">Agregar Libro</button>
    <button type="button" class="btn btn-warning"  style="float:right;" id="botonEliminarVarios">Eliminar Selección</button>
<form id="formEliminarVarios" action="{{ route('libro.deleteVarios')}}" method="POST" hidden> @csrf<input type="text" name="ids" id="ids"></form>
</div>

{{-- Tabla--}}
<div style="margin:40px;">
  <table class="table table-dark" style="" id="tblLibros">
    <thead>
      <tr>
        <td><input type="checkbox" id="checkBoxAll"> check all</td>
        <th>Id</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Género</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($libros as $libro)
      <tr class="fila" >
            <td><input type="checkbox" class="case" id="{{$libro->id}}"></td>
            <td>{{$libro->id}}</td>
            <td>{{$libro->titulo}}</td>
            <td>{{$libro->autor}}</td>
            <td>{{$libro->editorial}}</td>
            <td>{{$libro->categoria->nombre}}</td>
            <td>
                   <!-- Button trigger modal ver -->
                <button type="button" class="btn btn-primary" data-id="{{$libro->id}}" data-titulo="{{$libro->titulo}}" data-autor="{{$libro->autor}}" data-editorial="{{$libro->editorial}}" data-genero="{{$libro->categoria->nombre}}" data-toggle="modal" data-target="#modalver" style="width:25%">
                    ver
                </button>
                <button type="button" class="btn btn-danger" data-id="{{$libro->id}}" data-titulo="{{$libro->titulo}}" data-autor="{{$libro->autor}}" data-editorial="{{$libro->editorial}}" data-genero="{{$libro->categoria->nombre}}" data-toggle="modal" data-target="#modaleliminar" style="width:25%">
                    Eliminar
                </button>
            </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
  {{-- fin Tabla--}}
  {{-- modal ver--}}
      <!-- Modal -->
      <div class="modal fade" id="modalver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Libro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group inline">
                      <label for="titulo"><h4>Título:  <span id="titulover"></span> </h4></label>
                    </div>
                    <div class="form-group">
                        <label for="autor"><h4>Autor:  <span id="autorver"></span> </h4></label>
                    </div>
                    <div class="form-group">
                            <label for="editorial"><h4>Editorial:  <span id="editorialver"></span> </h4></label>
                    </div>
                    <div class="form-group">
                            <label for="genero"><h4>Género:  <span id="generover"></span> </h4></label>
                    </div>


                    <span hidden id="idver"></span>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrrar</button>
              <button type="button" class="btn btn-primary" id="botonEdit">editar</button>
            </div>
          </div>
        </div>
      </div>
  {{-- fon modal ver--}}

  {{-- modal agregar--}}
      <!-- Modal -->
      <div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Libro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('libro.store')}}" method="POST" id="formAdd">
                    @csrf
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="inputTitulo" name="titulo"  placeholder="Título">

                        </div>
                        <div class="form-group">
                                <label for="editorial">Género</label>
                                <select   id="categoria_idGenero" name="categoria_id">
                                    <option selected disabled>Seleccione una opción</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" class="form-control" id="inputAutor" name="autor" placeholder="Autor">
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input type="text" class="form-control" id="inputEditorial" name="editorial" placeholder="Editorial">
                        </div>



                       {{--  <button type="submit" class="btn btn-primary">Submit</button> --}}
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrrar</button>
                  <button type="button" class="btn btn-primary" id="guardarAdd">Guardar</button>
                </div>
              </div>
            </div>
          </div>
      {{-- fon modal agregar--}}



          {{-- modal editar--}}
      <!-- Modal -->
      <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Libro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('libro.update')}}" method="POST" id="formEdit">
                @csrf
                    <div class="form-group">
                        <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="editTitulo" name="titulo"   >

                    </div>
                    <div class="form-group">
                            <label for="editorial">Género</label>
                            <select   id="editcategoria_idGenero" name="categoria_id">

                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" class="form-control" id="editAutor" name="autor" placeholder="Autor">
                    </div>
                    <div class="form-group">
                        <label for="editorial">Editorial</label>
                        <input type="text" class="form-control" id="editEditorial" name="editorial" placeholder="Editorial">
                    </div>
                    <div class="form-group">
                        <input type="text" id="idedit" name="id" hidden >
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrrar</button>
               <!-- Button trigger modal editar -->
               <button type="button" class="btn btn-primary"  id="botonEditar" >
                    Actualizar
               </button>
            </div>
          </div>
        </div>
      </div>
    {{-- form modal editar--}}


         {{-- modal eliminar--}}
      <!-- Modal -->
      <div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Estas a punto de eliminar el siguiente libro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('libro.delete')}}" method="POST" id="formEliminar">
                    @csrf
                        <div class="form-group">
                            <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="eliminarTitulo"   disabled >
                         <input type="text" id="eliminarTituloHide" name="titulo" hidden>
                        </div>
                        <div class="form-group">
                            <label for="editorial">Género</label>
                            <select   id="eliminarcategoria_idGenero"  disabled>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            <select    id="eliminarcategoria_idGeneroHide" name="categoria_id"  hidden>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" class="form-control" id="eliminarAutor"  placeholder="Autor" disabled>
                            <input type="text"  id="eliminarAutorHide"  name="autor" hidden>
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input type="text" class="form-control" id="eliminarEditorial"  placeholder="Editorial" disabled>
                            <input type="text" id="eliminarEditorialHide" name="editorial" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" id="ideliminar" name="id" hidden >
                        </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   <!-- Button trigger modal editar -->
                   <button type="button" class="btn btn-danger"  id="botonEliminar" >
                        Eliminar
                   </button>
                </div>
              </div>
            </div>
          </div>
        {{-- form modal eliminar--}}


        {{-- Emnsajes en caso de errores --}}
        @if ($errors->any())
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
<script>



// Cargar datos en el Modal ver
$('#modalver').on('show.bs.modal', function (event) {
  var button= $(event.relatedTarget);
  var titulo= button.data('titulo');
  var autor= button.data('autor');
  var editorial= button.data('editorial');
  var genero= button.data('genero');
  var id= button.data('id');

  var  modal = $(this);

  modal.find('.modal-body   #titulover').html(titulo);
  modal.find('.modal-body   #autorver').html(autor);
  modal.find('.modal-body   #editorialver').html(editorial);
  modal.find('.modal-body   #generover').html(genero);
  modal.find('.modal-body   #idver').html(id);
});

//Modal editar
$('#botonEdit').on('click', function() {
    var titulo= $('#titulover').html();
    var autor= $('#autorver').html();
    var editorial= $('#editorialver').html();
    var genero= $('#generover').html();
    var id= $('#idver').html();

    $('#modalver').modal('hide');
    $('#modaleditar').modal('show');

    //quitando la el atributo selected a los option de genero, si lo lo tienen.
    $("#editcategoria_idGenero option").each(function(){
        $("#editcategoria_idGenero option").attr("selected",false);
    });
    //Asignando la option que debe ir con selected  en genero
    $("#editcategoria_idGenero option").each(function(){
        if ($(this).text() == genero ){
            let val=$(this).val();
            $(`#editcategoria_idGenero > option[value="${val}"]`).attr('selected', 'selected');
        }
    })

    $('#editTitulo').val(titulo);
    $('#editAutor').val(autor);
    $('#editEditorial').val(editorial);
    $('#idedit').val(id);

});



// Modal Eliminar un libro
$('#modaleliminar').on('show.bs.modal', function (event) {
  var button= $(event.relatedTarget);
  var titulo= button.data('titulo');
  var autor= button.data('autor');
  var editorial= button.data('editorial');
  var genero= button.data('genero');
  var id= button.data('id');

  var  modal = $(this);


  modal.find('.modal-body   #eliminarTitulo').val(titulo);
  modal.find('.modal-body   #eliminarTituloHide').val(titulo);
  modal.find('.modal-body   #eliminarAutor').val(autor);
  modal.find('.modal-body   #eliminarAutorHide').val(autor);
  modal.find('.modal-body   #eliminarEditorial').val(editorial);
  modal.find('.modal-body   #eliminarEditorialHide').val(editorial);
  modal.find('.modal-body   #ideliminar').val(id);

   //quitando la el atributo selected a los option de genero, si lo lo tienen.
   $("#eliminarcategoria_idGenero option").each(function(){
        $("#eliminarcategoria_idGenero option").attr("selected",false);
    });
    $("#eliminarcategoria_idGeneroHide option").each(function(){
        $("#eliminarcategoria_idGenero option").attr("selected",false);
    });
    //Asignando la option que debe ir con selected  en genero
    $("#eliminarcategoria_idGenero option").each(function(){
        if ($(this).text() == genero ){
            let val=$(this).val();
            $(`#eliminarcategoria_idGenero > option[value="${val}"]`).attr('selected', 'selected');
        }
    })
    $("#eliminarcategoria_idGeneroHide option").each(function(){
        if ($(this).text() == genero ){
            let val=$(this).val();
            $(`#eliminarcategoria_idGeneroHide > option[value="${val}"]`).attr('selected', 'selected');
        }
    })
});


//Guardar libro nuevo submit
$('#guardarAdd').click(function(){
    $('#formAdd').submit();
});


//Guardar edicion submit
$('#botonEditar').click(function(){
    $('#formEdit').submit();
});


//Eliminar libro submit
$('#botonEliminar').click(function(){
    $('#formEliminar').submit();
});

//Checkbox

$(function() {

    $("#checkBoxAll").on("change", function () {
        $("#tblLibros tbody input[type='checkbox'].case").prop("checked", this.checked);

    });

    $("#tblLibros tbody").on("change", "input[type='checkbox'].case", function () {
        if ($("#tblLibros tbody input[type='checkbox'].case").length == $("#tblLibros tbody input[type='checkbox'].case:checked").length) {
            $("#checkBoxAll").prop("checked", true);
        } else {
            $("#checkBoxAll").prop("checked", false);
        }
    });
});


//eliminar varios
$('#botonEliminarVarios').on('click', function(){

    if($("#tblLibros tbody input[type='checkbox'].case:checked").length > 0){

        var confirmar = confirm("Seguro?");

        if(confirmar==true){
            var ids='';
            $('.case').parent('td').find('input').each(function(){

                if($(this).prop('checked')){
                    ids +=$(this).attr('id')+',';
                }
            });
            $('#ids').val(ids);

            $('#formEliminarVarios').submit();
        }
    }else{
        alert('Debe seleccionar un registro antes!!');
    }
});


</script>


@endsection
