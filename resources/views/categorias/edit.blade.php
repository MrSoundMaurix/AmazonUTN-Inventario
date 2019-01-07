<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalEdit">
	{{ Form::open(array('url' => 'categorias')) }}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Editar Categoría</h4>
			</div>
			<div class="modal-body">
				<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="cat_codigo">Código</label>
                            <input type="text" name="cat_codigo" value="" id="codigo" readonly class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">								
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="cat_nombre">Nombre</label> <label for="cat_nombre" style="color:red">*</label>
                            <input type="text" name="cat_nombre" maxlength="100" value="" id="nombre" class="form-control" placeholder="Nombre...">
                        </div>
                    </div>
                </div>
                <div class="row">								
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="cat_codigop">Categoría Superior</label> <label for="cat_codigop" style="color:red"></label>
                            <select name="cat_codigop" class="form-control">
                                <option value="-1">--   Seleccione  --</option>
                                @foreach ($cats as $c)
                                    <option value="{{$c->cat_id}}">{{$c->cat_nombre}}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>