<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>GANT</h3>
    </div>
    <div class="panel-body">
      <div class="">
        <form class="nueva form-horizontal" action="{{ route('proyectos.storeActividade',$proyecto->id) }}" method="POST" >
          {{ csrf_field() }}
          <!-- tarea -->
          @if($errors->has("actividad"))
          <span class="help-block">{{ $errors->first("actividad") }}</span>
          @endif
          <div class="form-group">


            <div class="input-group col-sm-offset-1 col-sm-10">
              <input type="text" name="actividad" id="actividad" class="form-control" value="{{ old('actividad') }}" placeholder="nuevo diagrama">

              <span class="input-group-btn">
                <button class="btn btn-success" type="submit"><i class="fa fa-btn fa-plus"></i>agregar</button>
              </span>

            </div><!-- /input-group -->
          </div> <!-- tarea -->
        </form> <!-- /form.nueva -->
      </div>
      @if (count($actividades)>0)
      <table class="table table-striped">
        <thead>
        </thead>
        <tbody>
          @foreach ($actividades as $t)
          <tr>
            <td class="table-text">
              <form class="modificar" action="{{route('proyectos.updateActividade',[$proyecto->id,$t->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                  <button type="submit" class="checkbox">Crear/ver Proyecto</button>
                  <a class="checkbox-link pull-right" href="{{route('proyectos.updateActividade',[$proyecto->id,$t->id])}}"></a>
                  <label>
                    <input
                    type="checkbox"
                    {{($t->completo==1)?'checked="checked"':''}}
                    name="completo"
                    value="1"
                    onclick="$(this).parent().parent().parent().submit()"
                    >
                    {{ $t->actividad }}
                  </label>
                </div>
              </form><!-- /form.modificar -->
            </td>
            <!-- eliminar -->
            <td>
              <form class="eliminar" action="{{route('proyectos.destroyActividade',[$proyecto->id,$t->id])}}" method="POST" onsubmit="return confirm('Está seguro de eliminar el Diagrama?')">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" id="delete-task-{{ $t->id }}" class="btn btn-danger pull-right" title="Eliminar Gant">
                  <i class="fa fa-trash"></i>
                </button>
              </form><!-- /form.eliminar -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h3>No Hay Diagramas</h3>
      @endif
    </div>
  </div>
</div>
