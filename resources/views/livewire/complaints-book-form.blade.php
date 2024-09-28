<form wire:submit="submitForm" class="contact-form pt-4">
	{{-- 1. Identity --}}
	<fieldset>
		<legend>1. Identificación del consumidor reclamante</legend>
		<div class="cols-2">
			<div class="form-row">
				<label>Tipo de documento de identidad *</label>
				<select>
					<option value="">--</option>
					<option>DNI</option>
					<option>RUC</option>
					<option>Pasaporte</option>
				</select>
			</div>
			<div class="form-row">
				<label>Documento de identidad *</label>
				<input type="text" wire:model="form.id_document_number" id="input-id_document_number" required="required" />
				@error('form.id_document_number')
				<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Nombre completo *</label>
				<input type="text" wire:model="form.name" id="input-name" required="required" />
				@error('form.name')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Razón social</label>
				<input type="text" wire:model="form.name" id="input-name" />
					@error('form.name')
				<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="cols-3">
			<div class="form-row">
				<label>Departamento *</label>
				<select>
					<option value="">--</option>
					<option>DNI</option>
					<option>RUC</option>
					<option>Pasaporte</option>
				</select>
			</div>
			<div class="form-row">
				<label>Provincia *</label>
				<select>
					<option value="">--</option>
					<option>DNI</option>
					<option>RUC</option>
					<option>Pasaporte</option>
				</select>
			</div>
			<div class="form-row">
				<label>Distrito *</label>
				<select>
					<option value="">--</option>
					<option>DNI</option>
					<option>RUC</option>
					<option>Pasaporte</option>
				</select>
			</div>
		</div>
		<div class="form-row">
			<label>Dirección completa *</label>
			<input type="text" wire:model="form.address" id="input-address" required="required" />
			@error('form.address')
			<div class="form-error">{{ $message }}</div>
			@enderror
		</div>
		<div class="cols-2">
			<div class="form-row">
				<label>Teléfono / Celular</label>
				<input type="tel" wire:model="form.phone" id="input-phone" aria-label="Teléfono" />
				@error('form.phone')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Correo electrónico *</label>
				<input type="email" wire:model="form.email" id="input-email" required="required" aria-label="Correo electrónico" />
				@error('form.email')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</fieldset>
	{{-- 2. Purchased product/service --}}
	<fieldset>
		<legend>2. Identificación del bien contratado</legend>
		<div class="cols-3">
			<div class="form-row">
				<label>Tipo de bien *</label>
				<select wire:model="form.is_service" required="required">
					<option value="">--</option>
					<option value="0">Producto</option>
					<option value="1">Servicio</option>
				</select>
				@error('form.is_service')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>N&ordm; de pedido</label>
				<input type="text" wire:model="form.amount" />
				@error('form.address')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Monto reclamado (S/)</label>
				<input type="number" wire:model="form.amount" />
				@error('form.address')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</fieldset>
	{{-- 3. Detail and request --}}
	<fieldset>
		<legend>3. Detalle de la reclamación y pedido del consumidor</legend>
		<div class="document text-sm">
			<p><strong class="uppercase">Reclamo:</strong> Es la expresión de disconformidad del consumidor referida a los bienes expendidos o suministrados o a los servicios prestados.</p>
			<p><strong class="uppercase">Queja:</strong> Es aquella disconformidad que no se encuentra relacionada a los bienes que comercializa el proveedor o a los servicios que presta. Puede expresar el malestar o descontento del consumidor respecto a la atención al público.</p>
		</div>
		<div class="cols-3">
			<div class="form-row">
				<label>Tipo de reclamo *</label>
				<select required="required">
					<option value="">--</option>
					<option value="">Queja</option>
					<option value="">Reclamo</option>
				</select>
			</div>
			<div class="form-row">
				<label>Fecha del incidente *</label>
				<input type="date" required="required" />
			</div>
			<div class="form-row">
				<label>Hora del incidente (aproximada)</label>
				<input type="time" />
			</div>
		</div>
		<div class="cols-2">
			<div class="form-row">
				<label>Detalle, según lo indicado por el cliente *</label>
				<textarea wire:model="form.detail" required="required"></textarea>
				@error('form.detail')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Pedido del cliente</label>
				<textarea wire:model="form.request"></textarea>
				@error('form.request')
					<div class="form-error">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-row">
				<label>Adjuntar archivo</label>
				<input type="file" placeholder="Adjuntar archivo" aria-label="Adjuntar archivo" />
				<small>Formatos: PDF, JPEG, PNG</small>
			</div>
		</div>
	</fieldset>
	{{-- Acceptance and footnotes --}}
	<div class="cols">
		<div class="form-row">
			<div class="checkbox-wrapper">
				<input type="checkbox" id="input-accept_owner" />
				<label for="input-accept_owner">Declaro que soy el dueño del servicio y acepto el contenido de este formulario al declarar bajo Declaración Jurada la veracidad de los hechos descritos.</label>
			</div>
			<div class="checkbox-wrapper">
				<input type="checkbox" id="input-accept_terms" />
				<label for="input-accept_terms">He leído y autorizo el tratamiento de mis datos según la <a href="{{ $privacyPolicyUrl }}">Política de Privacidad de Persé Librerías</a>.</label>
			</div>
		</div>
		<div class="form-row document text-sm">
			<ul>
				<li>La formulación del reclamo no excluye el recurso a otros medios de resolución de controversias ni es un requisito previo para presentar una denuncia ante el Indecopi.</li>
				<li>De conformidad y en cumplimiento del D.S.011-2011 PCM, el plazo de atención del reclamo es de quince (15) días hábiles desde su presentación, el cual podrá extenderse excepcionalmente de acuerdo a la complejidad del requerimiento.</li>
				<li>Con la firma de este documento, el cliente autoriza a ser contactado después de la tramitación de la reclamación para evaluar la calidad y satisfacción del proceso de atención de reclamaciones.</li>
			</ul>
		</div>
	</div>

	{{-- Submit --}}
	<div class="form-row">
		<button type="submit">Enviar reclamo</button>
	</div>
</form>
