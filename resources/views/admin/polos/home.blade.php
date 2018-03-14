@extends('layouts.app')

@section('title', 'Todos os Polos')
@section('content')

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
$('#polos').DataTable({
	processing: true,
	serverSide: true,
	"autoWidth": true,
	ajax: '{{route('admin.polos.todos')}}',
	columns: [
		//{data: 'id', name: 'id'},
        {data: 'nome', name: 'nome'},
        {data: 'curso_id', name: 'curso_id'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
	],
	"language": {
		url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
	},
	"columnDefs": [
		//{ "width": "15%", "targets": 0 },
		{ "width": "40%", "targets": 1 },
  	]
});
</script>
<script type="text/javascript">
$(document).on("click", "[data-excluir]", function (e) {
	e.preventDefault();
	var $this = $(this);
	var nome = $this.attr('data-excluir');
	swal({
		title: "Você tem certeza?",
		text: 'Todos os dados de <strong>"'+nome+'"</strong> serão apagados e não é possível recuperar.',
		html:true,
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn red",
		confirmButtonText: "Sim, exclua!",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true
	},
	function(isConfirm) {
	if (isConfirm) {
		$this.closest('form').submit();
		swal("Excluindo!", "O usuário será excluído", "success");
	}
	});
});
</script>
@endpush
<a href="{{ route('admin.polos.adicionar') }}" class="btn bg-green-jungle bg-font-green-jungle">Adicionar novo Polo</a>
<div class="portlet-body">
	<table class="table table-striped table-bordered table-hover order-column" id="polos">
		<thead>
			<tr>
				<!--<th> ID </th>-->
				<th> Polo </th>
				<th> Curso </th>
				<th> Ações </th>
			</tr>
		</thead>
	</table>
</div>

@endsection
