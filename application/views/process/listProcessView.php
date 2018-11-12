<?php $this->load->view("layouts/header"); ?>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<div class="container">
	<div class="row">
		<div class="col-12 mt-3">
			<div class="row">
				<div class="col-8">
					<h2>
						Lista de procesos
					</h2>
				</div>
				<div class="col-4 text-right">
					<button class="btn btn-primary" id="btnCreateProcess" data-toggle="modal" data-target="#newProcessModal">Nuevo proceso</button>
				</div>
			</div>
		</div>
		<div class="col-12 mt-3">
			<form action="<?= base_url() ?>lista_procesos" id="dateForm" class="row">
				<div class="col-sm-2 col-md-1">
					<label>
						<strong>
							Fecha:
						</strong>
					</label>
				</div>
				<div class="col-sm-5 col-md-5 col-lg-4 col-xl-3">
					<input id="dateFilter" width="100%" name="dateFilter" readonly="readonly" value="<?php if(isset($_GET["dateFilter"])){ ?><?= $_GET["dateFilter"] ?> <?php } ?>">
				</div>
				<div class="col-sm-5 col-md-6 col-lg-7 col-xl-8">
					<button class="btn btn-primary" id="btnFilter">Filtrar</button>
					<button class="btn btn-primary" id="btnCleanFilter">Limpiar filtro</button>
				</div>
			</form>
		</div>
		<div class="col-12 mx-auto table-responsive-sm table-responsive-md ">
			<table class="table text-center mt-3">
				<thead class="thead-dark">
					<tr>
						<th scope="col"># proceso</th>
						<th scope="col">Descripción</th>
						<th scope="col">Sede</th>
						<th scope="col">Fecha</th>
						<th scope="col">COP</th>
						<th scope="col">USD</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php

					if(count($data['process']) > 0){

						foreach ($data['process'] as $pros) {

							?>
							<tr>
								<th scope="row"><?= $pros->process_number ?></th>
								<td><?= $pros->description ?></td>
								<td><?= $pros->name ?></td>
								<td><?= $pros->create_date ?></td>
								<td>$<?= str_replace(",", ".", number_format($pros->budget)) ?></td>
								<td>$<?= number_format(round($pros->budget/ $this->session->userdata("currency"),2), 2); ?></td>
								<td><label onclick="editProcess(<?= $pros->id ?>)">Editar</label></td>
							</tr>
							<?php
						}

					} else {

						?>
						<tr>
							<td>
								No se encontraron resultados
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-6 text-center mx-auto">
			<div class="div_pagination">
				<ul class="pagination mx-auto justify-content-center">
					<?= $this->pagination->create_links(); ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="newProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nuevo proceso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>
					<textarea id="descriptionProcess" class="form-control" onkeyup="updateContadorTa(this.value)" onkeypress="updateContadorTa(this.value)" maxlength="200"></textarea>
					<div class="text-right">
						<span id="countText">0/200</span>
					</div>
				</div>
				<br>
				<div>
					<select id="headquartersProcess" class="form-control">
						<?php 

						if(count($data['headquarters']) > 0){

							?>
							<option value="0">Seleccione una sede</option>
							<?php
							foreach ($data['headquarters'] as $hq) {
								

								?>
								<option value="<?= $hq->id ?>"><?= $hq->name ?></option>
								<?php

							}
						}else {

							?>
							<option value="0">No hay sedes disponibles</option>
							<?php
						}
						?>
					</select>
				</div>
				<br>
				<div>
					<input type="text" name="budgetProcess" id="budgetProcess" class="form-control" onkeyup="format(this)">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="createProcess()" id="saveProcess">Generar proceso</button>
			</div>
		</div>
	</div>
</div>


<!-- edita modal -->

<div class="modal fade" id="editProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar proceso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>
					No. Proceso <strong id="numProcessLabelEdit"></strong>
				</div>
				<br>
				<div>
					<textarea id="descriptionProcessEdit" class="form-control" onkeyup="updateContadorTa(this.value)" onkeypress="updateContadorTa(this.value)" maxlength="200"></textarea>
					<div class="text-right">
						<span id="countText">0/200</span>
					</div>
				</div>
				<br>
				<div>
					<select id="headquartersProcessEdit" class="form-control">
						<?php 

						if(count($data['headquarters']) > 0){

							?>
							<option value="0">Seleccione una sede</option>
							<?php
							foreach ($data['headquarters'] as $hq) {
								

								?>
								<option value="<?= $hq->id ?>"><?= $hq->name ?></option>
								<?php

							}
						}else {

							?>
							<option value="0">No hay sedes disponibles</option>
							<?php
						}
						?>
					</select>
				</div>
				<br>
				<div>
					<input type="text" name="budgetProcess" id="budgetProcessEdit" class="form-control" onkeyup="format(this)">
				</div>
				<input type="hidden" name="idProcessNumberEdit" id="idProcessNumberEdit">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="updateProcess()" id="updateProcess">Actualizar proceso</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/functionProcess.js?<?= config_item("version") ?>"></script>

<?php $this->load->view("layouts/footer"); ?>